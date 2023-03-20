<?php

namespace App\Http\Controllers\App\Api;

use App\Http\Controllers\App\Resources\ProjectResource;
use App\Processes\App\HistoryProcess;
use App\Processes\App\ProjectProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    /**
     * @var ProjectProcess
     */
    private $projectProcess;

    /**
     * @var HistoryProcess
     */
    private $historyProcess;

    /**
     * @param ProjectProcess $projectProcess
     * @param HistoryProcess $historyProcess
     */
    public function __construct(ProjectProcess $projectProcess, HistoryProcess $historyProcess)
    {
        $this->projectProcess = $projectProcess;
        $this->historyProcess = $historyProcess;
    }

    /**
     * Retrieve a collection of departments.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $year = $request->get('year') ?? now()->year;

        if ($request->get('department')) {
            $department = $request->get('department') ?? '';
            if ($year >= 2020) {
                return $this->jsonResource(ProjectResource::collection($this->projectProcess->getProjects($year, $department)));
            }
            return $this->jsonResource(ProjectResource::collection($this->historyProcess->getProjects($year, $department)));
        }

        if ($request->get('location')) {
            $location = $request->get('location') ?? '';
            if ($year >= 2020) {
                return $this->jsonResource(ProjectResource::collection($this->projectProcess->getProjectsByLocation($year, $location)));
            }
            return $this->jsonResource(ProjectResource::collection($this->historyProcess->getProjectsByLocation($year, $location)));
        }

        return $this->response([]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $project
     *
     * @return JsonResponse
     */
    public function show(Request $request, int $project): JsonResponse
    {
        $year = $request->get('year') ?? now()->year;
        if ($year >= 2020) {
            $project = $this->projectProcess->show($project, $year);
        } else {
            $project = \App\Models\App\History\Project::find($project);
        }
        return $this->jsonResource(new ProjectResource($project));
    }
}
