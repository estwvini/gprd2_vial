<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Processes\Business\Planning\ProjectFiscalYearProcess;
use App\Processes\Business\Planning\ProjectsReviewProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase ProjectReviewController
 * @package App\Http\Controllers\Business\Planning
 */
class ProjectReviewController extends Controller
{
    /**
     * @var ProjectsReviewProcess
     */
    protected $projectsReviewProcess;

    /**
     * @var ProjectFiscalYearProcess
     */
    protected $projectsFiscalYears;

    /**
     * Constructor de ProjectReviewController.
     *
     * @param ProjectsReviewProcess $projectsReviewProcess
     * @param ProjectFiscalYearProcess $projectsFiscalYears
     */
    public function __construct(
        ProjectsReviewProcess $projectsReviewProcess,
        ProjectFiscalYearProcess $projectsFiscalYears
    ) {
        $this->projectsReviewProcess = $projectsReviewProcess;
        $this->projectsFiscalYears = $projectsFiscalYears;
    }

    /**
     * Desplegar lista de proyectos.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $response['view'] = view('business.planning.project_review.index', $this->projectsReviewProcess->index())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesa la petición ajax de datatables
     *
     * @return JsonResponse
     */
    public function data()
    {
        try {
            return $this->projectsReviewProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para cambiar de estado un proyecto.
     *
     * @param int $id
     * @param int $project_fiscal_year_id
     *
     * @return JsonResponse
     */
    public function status(int $id, int $project_fiscal_year_id)
    {
        try {
            $entity = $this->projectsFiscalYears->status($project_fiscal_year_id);

            $response = [
                'view' => view('business.planning.project_review.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('projects.messages.success.status_updated', ['status' => trans('projects.status.' . strtolower($entity->status))])
                ]
            ];

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Retorna formulario para marco logico
     *
     * @param int $id
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function editLogicFrame(int $id)
    {
        try {
            $data = $this->projectsReviewProcess->editLogicFrame($id);
            $response = [
                'view' => view('business.planning.project_review.logic_frame.logic_frame', [
                    'entity' => $data[0],
                    'entity_status' => $data[1]
                ])->render()
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Retorna formulario para editar la ficha de proyecto
     *
     * @param int $id
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function editProfile(int $id)
    {
        try {
            $data = $this->projectsReviewProcess->editProfile($id);
            $response = [
                'view' => view('business.planning.project_review.profile', [
                    'entity' => $data[0],
                    'executingUnits' => $data[1],
                    'users' => $data[2],
                    'leader' => $data[3],
                    'entity_status' => $data[4],
                    'operationalGoals' => $data[5]

                ])->render()
            ];

            return response()->json($response);

        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Muestra formulario de edición de un indicador completo.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function showFullIndicator(int $projectId)
    {
        try {
            $response = $this->projectsReviewProcess->showFullIndicator($projectId);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Cambia el estado a aprobado  de todos los proyectos seleccionados
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function bulkApprove(Request $request)
    {
        try {
            $response = $this->projectsReviewProcess->bulkChange($request, ProjectFiscalYear::STATUS_REVIEWED);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Cambia el estado a rechazado  de todos los proyectos seleccionados
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function bulkReverse(Request $request)
    {
        try {
            $response = $this->projectsReviewProcess->bulkChange($request, ProjectFiscalYear::STATUS_REJECTED);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra modal de confirmación de rechazo de un proyecto
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function observationsReverse(Request $request)
    {
        try {
            $response['modal_st'] = view('business.planning.partials.rejections.form', [
                'data' => $request->all()
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra modal con el listado de rechazos de un proyecto
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function rejectionsLog(Request $request)
    {
        try {
            $data = $this->projectsFiscalYears->rejectionsLog($request);

            $response['modal'] = view('business.planning.partials.rejections.rejections', $data)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Genera la estructura de datatable de rechazos
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function rejectionsLogData(Request $request)
    {
        try {
            return $this->projectsFiscalYears->rejectionsLogData($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }

    }
}
