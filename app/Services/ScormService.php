<?php

namespace App\Services;

use App\Services\Contracts\ScormServiceContract;
use App\Services\Contracts\ScormTrackServiceContract;
use DOMDocument;
use App\Strategies\ScormFieldStrategy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Peopleaps\Scorm\Entity\Scorm;
use Peopleaps\Scorm\Exception\InvalidScormArchiveException;
use Peopleaps\Scorm\Exception\StorageNotFoundException;
use Peopleaps\Scorm\Library\ScormLib;
use Peopleaps\Scorm\Model\ScormModel;
use Peopleaps\Scorm\Model\ScormScoTrackingModel;
use Ramsey\Uuid\Uuid;
use ZipArchive;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Peopleaps\Scorm\Model\ScormScoModel;

class ScormService implements ScormServiceContract
{
    private ScormLib $scormLib;

    private ScormTrackServiceContract $scormTrackService;

    /**
     * Constructor
     */
    public function __construct(
        ScormTrackServiceContract $scormTrackService
    )
    {
        $this->scormLib = new ScormLib();
        $this->scormTrackService = $scormTrackService;
    }

    public function uploadScormArchive(UploadedFile $file): array
    {
        // Checks if it is a valid scorm archive
        $zip = new ZipArchive();
        $openValue = $zip->open($file);
        $isScormArchive = (true === $openValue) && $zip->getStream('imsmanifest.xml');

        $zip->close();

        if (!$isScormArchive) {
            throw new InvalidScormArchiveException('invalid_scorm_archive_message');
        }

        $scormData = $this->generateScorm($file);

        // save to db
        if ($scormData && is_array($scormData)) {
            $scorm = new ScormModel();
            $scorm->version = $scormData['version'];
            $scorm->hash_name = $scormData['hashName'];
            $scorm->origin_file = $scormData['name'];
            $scorm->origin_file_mime = $scormData['type'];
            $scorm->uuid = $scormData['hashName'];
            $scorm->save();

            $this->saveToDb($scormData['scos'], $scorm);
        }

        return [
            'scormData' => $scormData,
            'model' => $scorm ?? null
        ];
    }

    public function saveToDb(array $scormData, ScormModel $scormModel = null): void
    {
        foreach ($scormData as $scorm) {
            $sco = new ScormScoModel();
            $sco->scorm_id = $scormModel->id;
            $sco->uuid = $scorm->uuid;
            $sco->sco_parent_id = $scorm->scoParent ? $scorm->scoParent->id : null;
            $sco->entry_url = $scorm->entryUrl;
            $sco->identifier = $scorm->identifier;
            $sco->title = $scorm->title;
            $sco->visible = $scorm->visible;
            $sco->sco_parameters = $scorm->parameters;
            $sco->launch_data = $scorm->launchData;
            $sco->max_time_allowed = $scorm->maxTimeAllowed;
            $sco->time_limit_action = $scorm->timeLimitAction;
            $sco->block = $scorm->block;
            $sco->score_int = $scorm->scoreToPassInt;
            $sco->score_decimal = $scorm->scoreToPassDecimal;
            $sco->completion_threshold = $scorm->completionThreshold;
            $sco->prerequisites = $scorm->prerequisites;
            $sco->save();
            $scorm->id = $sco->id;

            if (!empty($scorm->scoChildren)) {
                $this->saveToDb($scorm->scoChildren, $scormModel);
            }
        }
    }

    public function removeRecursion(array $data): array
    {
        $scormData = $data['scormData'];
        $scormData['scos'] = $this->removeRecursionFromChildren($scormData['scos']);

        return array_merge($data, ['scormData' => $scormData]);
    }

    public function removeRecursionFromChildren(array $data): array
    {
        foreach ($data as $row) {
            if (isset($row->scoChildren)) {
                $row->scoChildren = array_map(function ($child) {
                    if (isset($child->scoParent)) {
                        unset($child->scoParent);
                    }
                    return $child;
                }, $row->scoChildren);

                $this->removeRecursionFromChildren($row->scoChildren);
            }
        }

        return $data;
    }

    public function parseScormArchive(UploadedFile $file): array
    {
        $data = [];
        $contents = '';
        $zip = new \ZipArchive();

        $zip->open($file);
        $stream = $zip->getStream('imsmanifest.xml');

        while (!feof($stream)) {
            $contents .= fread($stream, 2);
        }

        $dom = new DOMDocument();

        if (!$dom->loadXML($contents)) {
            throw new InvalidScormArchiveException('cannot_load_imsmanifest_message');
        }

        $scormVersionElements = $dom->getElementsByTagName('schemaversion');

        if ($scormVersionElements->length > 0) {
            switch ($scormVersionElements->item(0)->textContent) {
                case '1.2':
                    $data['version'] = Scorm::SCORM_12;
                    break;
                case 'CAM 1.3':
                case '2004 3rd Edition':
                case '2004 4th Edition':
                    $data['version'] = Scorm::SCORM_2004;
                    break;
                default:
                    throw new InvalidScormArchiveException('invalid_scorm_version_message');
            }
        } else {
            throw new InvalidScormArchiveException('invalid_scorm_version_message');
        }
        $scos = $this->scormLib->parseOrganizationsNode($dom);

        if (0 >= count($scos)) {
            throw new InvalidScormArchiveException('no_sco_in_scorm_archive_message');
        }
        $data['scos'] = $scos;

        return $data;
    }

    public function deleteScormData(ScormModel $model): void
    {
        // Delete after the previous item is stored
        if ($model->exists) {
            $oldScos = $model->scos()->get();

            // Delete all tracking associate with sco
            foreach ($oldScos as $oldSco) {
                $oldSco->scoTrackings()->delete();
            }

            $model->scos()->delete(); // delete scos
            $model->delete(); // delete scorm

            // Delete folder from server
            $this->deleteScormFolder($model->version, $model->hash_name);
        }
    }

    /**
     * @param string $version
     * @param string $folderHashedName
     * @return bool
     */
    protected function deleteScormFolder(string $version, string $folderHashedName): bool
    {
        return Storage::disk(config('scorm.disk'))
            ->deleteDirectory('scorm' . DIRECTORY_SEPARATOR . $version . DIRECTORY_SEPARATOR . $folderHashedName);
    }

    /**
     * Unzip a given ZIP file into the web resources directory.
     *
     * @param string $hashName name of the destination directory
     * @throws StorageNotFoundException
     */
    private function unzipScormArchive(UploadedFile $file, string $hashName): void
    {
        $zip = new \ZipArchive();
        $zip->open($file);

        if (!config()->has('filesystems.disks.' . config('scorm.disk') . '.root')) {
            throw new StorageNotFoundException();
        }

        if (!Storage::disk(config('scorm.disk'))->exists($hashName)) {
            Storage::disk(config('scorm.disk'))->makeDirectory($hashName);
        }

        $zip->extractTo(Storage::disk(config('scorm.disk'))->path($hashName));
        $zip->close();
    }

    /**
     * @param UploadedFile $file
     * @return array
     * @throws InvalidScormArchiveException|StorageNotFoundException
     */
    private function generateScorm(UploadedFile $file): array
    {
        $hashName = Uuid::uuid4();
        $hashFileName = $hashName . '.zip';
        $scormData = $this->parseScormArchive($file);
        $scormFilePath = 'scorm/' . $scormData['version'] . '/' . $hashName;
        $this->unzipScormArchive($file, $scormFilePath);

        if (!config()->has('filesystems.disks.' . config('scorm.disk') . '.root')) {
            throw new StorageNotFoundException();
        }

        Storage::disk(config('scorm.disk'))->putFileAs($scormFilePath, $file, $hashFileName . '.zip');

        return [
            'name' => $hashFileName, // to follow standard file data format
            'hashName' => $hashName,
            'type' => $file->getMimeType(),
            'version' => $scormData['version'],
            'scos' => $scormData['scos'],
        ];
    }

    /**
     * Get SCO list
     * @param $scormId
     * @return Builder[]|Collection
     */
    public function getScos($scormId): ScormScoModel
    {
        return ScormScoModel::with(['scorm'])
            ->where('scorm_id', $scormId)
            ->get();
    }

    /**
     * Get sco by uuid
     * @param $scoUuid
     * @return null|Builder|Model
     */
    public function getScoByUuid($scoUuid): ScormScoModel
    {
        return ScormScoModel::with(['scorm'])
            ->where('uuid', $scoUuid)
            ->firstOrFail();
    }

    /**
     * Get sco data to view by uuid
     * @param string $scoUuid
     * @param int|null $userId
     * @param string|null $token
     * @return ScormScoModel
     */
    public function getScoViewDataByUuid(string $scoUuid, ?int $userId = null, ?string $token = null): ScormScoModel
    {
        $data = $this->getScoByUuid($scoUuid);
        $cmi = $this
            ->getScormFieldStrategy($data->scorm->version)
            ->getCmiData(
                $this->getScormTrack($data->getKey(), $userId)
            );

        $data['entry_url_absolute'] = Storage::disk(config('scorm.disk'))
            ->url('scorm/' . $data->scorm->version . '/' . $data->scorm->uuid . '/' . $data->entry_url . $data->sco_parameters);
        $data['version'] = $data->scorm->version;
        $data['token'] = $token;
        $data['lmsUrl'] = url('/scorm/track');

        $data['player'] = (object) [
            'lmsCommitUrl' => ' ',
            'logLevel' => 1,
            'autoProgress' => true,
            'cmi' => $cmi
        ];
        return $data;
    }

    public function zipScorm(int $id): string
    {
        $scormDisk = Storage::disk(config('scorm.disk'));
        $scorm = ScormModel::find($id);
        $scormPath = 'scorm' . DIRECTORY_SEPARATOR . $scorm->version . DIRECTORY_SEPARATOR . $scorm->hash_name;
        $files = $scormDisk->allFiles($scormPath);

        if (!Storage::disk('local')->exists('scorm/exports')) {
            Storage::disk('local')->makeDirectory('scorm/exports');
        }

        $zip = new \ZipArchive();
        $zipFilePath = 'scorm/exports/' . uniqid(rand(), true) . $scorm->hash_name . '.zip';
        $zipFile = Storage::disk('local')->path($zipFilePath);

        if (!$zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            throw new \Exception("Zip file could not be created: " . $zip->getStatusString());
        }

        foreach ($files as $file) {
            if (! $zip->addFile($scormDisk->path($file), basename($file))) {
                throw new \Exception("File [`{$file}`] could not be added to the zip file: " . $zip->getStatusString());
            }
        }

        $zip->close();

        return $zipFilePath;
    }

    public function listModels($per_page = 15, array $columns = ['*']): LengthAwarePaginator
    {
        return ScormModel::with(['scos' => fn($query) => $query->select(['*'])->where('block', '=', 0)])
            ->select($columns)
            ->paginate(intval($per_page));
    }

    public function listScoModels(array $columns = ['*']): Collection
    {
        return ScormScoModel::query()
            ->select($columns)
            ->get();
    }

    private function getScormTrack(int $scoId, ?int $userId): ?ScormScoTrackingModel
    {
        if (is_null($userId)) {
            return null;
        }

        return $this->scormTrackService->getUserResult($scoId, $userId);
    }

    private function getScormFieldStrategy(string $version): ScormFieldStrategy
    {
        $scormVersion = Str::ucfirst(Str::camel($version));
        $strategy = 'App\\Strategies\\' . $scormVersion . 'FieldStrategy';

        return new ScormFieldStrategy(new $strategy());
    }
}