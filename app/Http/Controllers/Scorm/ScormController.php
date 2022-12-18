<?php

namespace App\Http\Controllers\Scorm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Scorm\Swagger\ScormControllerContract;
use App\Http\Requests\scorm\ScormDeleteRequest;
use Exception;
use App\Http\Requests\scorm\ScormCreateRequest;
use App\Http\Requests\scorm\ScormListRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Peopleaps\Scorm\Model\ScormModel;
use App\Services\Contracts\ScormServiceContract;


class ScormController extends Controller implements ScormControllerContract
{
    private $scormService;

    public function __construct(
        ScormServiceContract $scormService
    ) {
        $this->scormService = $scormService;
    }

    private function sendSuccess($message = '', $code = 200)
    {
        return $this->sendResponse(null, $message, $code);
    }

    public function upload(ScormCreateRequest $request): JsonResponse
    {
        $file = $request->file('zip');

        try {
            $data = $this->scormService->uploadScormArchive($file);
            $data = $this->scormService->removeRecursion($data);
        } catch (Exception $error) {
            return $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse($data, "Scorm Package uploaded successfully");
    }

    public function parse(ScormCreateRequest $request): JsonResponse
    {
        $file = $request->file('zip');

        try {
            $data = $this->scormService->parseScormArchive($file);
            $data = $this->scormService->removeRecursion($data);
        } catch (Exception $error) {
            $this->sendError($error->getMessage(), 422);
        }

        return $this->sendResponse($data, "Scorm Package uploaded successfully");
    }

    public function show($uuid, Request $request): View
    {
        // $data = $this->scormService->getScoViewDataByUuid(
        //     $uuid,
        //     $request->user() ? $request->user()->getKey() : null,
        //     $request->bearerToken()
        // );
        $data = $this->scormService->getScoViewDataByUuid(
            $uuid,
            auth()->id(),
            'bearer'
        );

        // dd($data);
        return view('player', ['data' => $data]);
    }

    public function index(ScormListRequest $request): JsonResponse
    {
        $list = $this->scormService->listModels($request->get('per_page'));
        return $this->sendResponse($list, "Scorm list fetched successfully");
    }

    public function getScos(ScormListRequest $request): JsonResponse
    {
        $columns = [
            "id",
            "scorm_id",
            "uuid",
            "entry_url",
            "identifier",
            "title",
            "sco_parameters"
        ];

        $list = $this->scormService->listScoModels($columns);
        return $this->sendResponse($list, "Scos list fetched successfully");
    }

    public function delete(ScormDeleteRequest $request, ScormModel $scormModel): JsonResponse
    {
        $this->scormService->deleteScormData($scormModel);
        return $this->sendSuccess("Scorm Package deleted successfully");
    }
    public function playPost(Request $request)
    {
        return response()->json($request->all());
    }
}
