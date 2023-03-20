<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Models\Business\PlanElement;
use App\Models\Business\Project;
use App\Processes\Business\Planning\ProjectsRepositoryProcess;
use App\Repositories\Repository\Business\PlanElementRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use phpDocumentor\Reflection\Element;
use Throwable;

/**
 * Clase ProjectsRepositoryController
 *
 * @package App\Http\Controllers\Business\Planning
 */
class ProjectsRepositoryController extends Controller
{
    /**
     * @var ProjectsRepositoryProcess
     */
    private $projectsRepositoryProcess;

    /**
     * @var PlanElementRepository
     */
    private $planElementRepository;

    /**
     * Constructor de ProjectsRepositoryController.
     *
     * @param ProjectsRepositoryProcess $projectsRepositoryProcess
     * @param PlanElementRepository $planElementRepository
     */
    public function __construct(
        ProjectsRepositoryProcess $projectsRepositoryProcess,
        PlanElementRepository $planElementRepository
    ) {
        $this->projectsRepositoryProcess = $projectsRepositoryProcess;
        $this->planElementRepository = $planElementRepository;
    }

    /**
     * Desplegar lista de proyectos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.planning.projects_repository.index', $this->projectsRepositoryProcess->index())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesa la petición ajax de datatables
     *
     * @param Request $request
     *
     * @return string
     */
    public function data(Request $request)
    {
        try {
            return $this->projectsRepositoryProcess->data($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Desplegar modal para actualizar estado.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function changeStatus(int $id)
    {
        try {
            $response['modal'] = view('business.planning.projects_repository.change_status', $this->projectsRepositoryProcess->changeStatus($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualiza el estado de un proyecto
     *
     * @param int $id
     * @param Request $request
     *
     * @return array|mixed
     */
    public function updateStatus(int $id, Request $request)
    {
        try {
            $this->projectsRepositoryProcess->updateStatus($id, $request);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('projects_repository.messages.success')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Formulario para nuevo Proyecto
     *
     * @param Project $project
     *
     * @return JsonResponse
     */
    public function createProject(Project $project)
    {
        try {
            $response['modal'] = view('business.planning.projects_repository.create', array_merge(
                ['oldProject' => $project],
                $this->projectsRepositoryProcess->createProject()
            ))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Crea un nuevo Proyecto a partir de una referencia
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeProject(Request $request)
    {
        try {
            $this->projectsRepositoryProcess->storeProject($request);
            $response['message'] = [
                'type' => 'success',
                'text' => trans('projects.messages.success.created')
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Buscar elementos del plan
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function structureSearch(int $id)
    {
        try {
            return response()->json($this->planElementRepository->findByField('parent_id', $id, ["id", "code", "description"]));
        } catch (Throwable $e) {
            return response()->json([]);
        }
    }
}
