<?php

namespace App\Http\Controllers\Scorm;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Scorm\Swagger\ScormTrackControllerContract;
use App\Http\Requests\scorm\GetScormTrackRequest;
use App\Http\Requests\scorm\SetScormTrackRequest;
use App\Services\Contracts\ScormTrackServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScormTrackController extends Controller implements ScormTrackControllerContract
{
    private $scormTrackService;

    public function __construct(ScormTrackServiceContract $scormTrackService)
    {
        $this->scormTrackService = $scormTrackService;
    }

    private function sendSuccess($message = '', $code = 200)
    {
        return response()->json($message);
        // return $this->sendResponse(null, $message, $code);
    }

    public function set(SetScormTrackRequest $request, $uuid)
    {
        $this->scormTrackService->updateScoTracking(
            $uuid,
            auth()->id(),
            $request->input('cmi')
        );
        return $this->sendSuccess();
    }

    public function get(GetScormTrackRequest $request, $scoId, $key)
    {
        $data = $this->scormTrackService->getUserResultSpecifiedValue($key, $scoId, $request->user()->getKey());
        return new JsonResponse($data);
    }
}
