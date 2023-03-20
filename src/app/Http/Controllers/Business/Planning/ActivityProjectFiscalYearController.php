<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\ActivityProjectFiscalYearProcess;
use App\Processes\Business\Planning\ProjectFiscalYearProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase ActivityProjectFiscalYearController
 * @package App\Http\Controllers\Business\Planning
 */
class ActivityProjectFiscalYearController extends Controller
{

    /**
     * @var ProjectFiscalYearProcess
     */
    protected $projectFiscalYearProcess;

    /**
     * @var ActivityProjectFiscalYearProcess
     */
    private $activityProjectFiscalYearProcess;

    /**
     * Constructor de ActivityProjectFiscalYearController.
     *
     * @param ActivityProjectFiscalYearProcess $activityProjectFiscalYearProcess
     * @param ProjectFiscalYearProcess $projectFiscalYearProcess
     */
    public function __construct(ActivityProjectFiscalYearProcess $activityProjectFiscalYearProcess, ProjectFiscalYearProcess $projectFiscalYearProcess)
    {
        $this->projectFiscalYearProcess = $projectFiscalYearProcess;
        $this->activityProjectFiscalYearProcess = $activityProjectFiscalYearProcess;
    }

    /**
     * Desplegar lista de actividades para planificación.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function index(int $projectId)
    {
        try {
            $data = $this->activityProjectFiscalYearProcess->index($projectId);
            $response['view'] = view('business.planning.projects.activities.index', [
                'entity' => $data[0],
                'flag' => $data[0]->executingUnit ? 1 : 0,
                'fiscalYear' => $data[1],
                'budgetPlanning' => json_encode($data[2], JSON_HEX_APOS | JSON_HEX_QUOT),
                'referential_budget' => $data[3],
                'entity_status' => $data[4],
                'activity' => true,
                'projectFiscalYear' => $data[5]
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Retorna el formulario para crear una nueva actividad.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function create(int $projectId)
    {
        try {
            $data = $this->activityProjectFiscalYearProcess->create($projectId);
            $response['modal'] = view('business.planning.projects.activities.create', [
                'projectFiscalYearId' => $data[0]->id,
                'areas' => $data[1],
                'components' => $data[2]
            ])->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Almacena una actividad en la BD.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->activityProjectFiscalYearProcess->store($request);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('activities.messages.success.created')
                ]
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Retorna el formulario para editar una nueva actividad.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $entity = $this->activityProjectFiscalYearProcess->edit($id);
            $response['modal'] = view('business.planning.projects.activities.update', [
                'entity' => $entity,
                'components' => $entity->component->project->components,
                'areas' => $this->activityProjectFiscalYearProcess->areas()
            ])->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Almacena una actividad en la BD.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->activityProjectFiscalYearProcess->update($request, $id);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('activities.messages.success.updated')
                ]
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Llamada al proceso para eliminar lógicamente una actividad.
     *
     * @param int $activityId
     *
     * @return JsonResponse
     */
    public function destroy(int $activityId)
    {
        try {
            $response = $this->activityProjectFiscalYearProcess->destroy($activityId);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra formulario de una actividad
     *
     * @param int $activityId
     * @param Request $request
     *
     * @return JsonResponse|mixed
     */
    public function budgetItems(int $activityId, Request $request)
    {
        try {
            $data = $this->activityProjectFiscalYearProcess->budgetItems($activityId);
            $response['view'] = view('business.planning.projects.activities.show', [
                'project' => $data[0],
                'activity' => $data[1],
                'fiscalYear' => $data[2],
                'referentialBudget' => number_format($data[3], 2),
                'planningBudget' => number_format($data[4], 2),
                'difference' => number_format($data[3] - $data[4], 2),
                'from_budget_adjustment' => $request->from_budget_adjustment ?: false
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Desplegar lista de actividades para planificación dentro de Gasto Corriente.
     *
     * @param int $subprogramId
     *
     * @return Response
     */
    public function currentExpenditurePlanningIndex(int $subprogramId)
    {
        try {
            $response['view'] = view('business.planning.current_expenditure.planning',
                $this->activityProjectFiscalYearProcess->currentExpenditurePlanningIndex($subprogramId)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Desplegar lista de actividades para planificación.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function indexShow(int $projectId)
    {
        try {
            $data = $this->activityProjectFiscalYearProcess->index($projectId);
            $response['view'] = view('business.planning.project_review.activities.index', [
                'project' => $data[0],
                'fiscalYear' => $data[1],
                'budgetPlanning' => json_encode($data[2], JSON_HEX_APOS | JSON_HEX_QUOT),
                'referential_budget' => $data[3],
                'entity_status' => $data[4]
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Muestra formulario de una actividad
     *
     * @param int $activityId
     *
     * @return JsonResponse|mixed
     */
    public function showBudgetItems(int $activityId)
    {
        try {
            $data = $this->activityProjectFiscalYearProcess->budgetItems($activityId);
            $response['view'] = view('business.planning.project_review.activities.show', [
                'project' => $data[0],
                'activity' => $data[1],
                'fiscalYear' => $data[2],
                'referentialBudget' => number_format($data[3], 2),
                'planningBudget' => number_format($data[4], 2),
                'difference' => number_format($data[3] - $data[4], 2)
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de actividades.
     *
     * @param int $projectId
     * @param Request $request
     *
     * @return mixed|string
     */
    public function data(int $projectId, Request $request)
    {
        try {
            return $this->activityProjectFiscalYearProcess->data($projectId, $request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para almacenar las planificaciones mensuales del presupuesto
     *
     * @param Request $request
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function storeBudgetPlanning(Request $request, int $projectId)
    {
        try {
            $data = $request->all();
            $this->activityProjectFiscalYearProcess->storeBudgetPlanning($projectId, $data, true,
                (isset($data['currentExpenditure']) && $data['currentExpenditure']) ? false : true);
            $fiscalYear = $this->projectFiscalYearProcess->nextFiscalYear();
            if (isset($data['currentExpenditure']) && $data['currentExpenditure']) {
                $response['message'] = [
                    'type' => 'success',
                    'text' => trans('activities.messages.success.planning_created')
                ];
            } elseif (isset($data['fromBudgetAdjustment']) && $data['fromBudgetAdjustment']) {
                $budgetAdjustmentController = resolve(BudgetAdjustmentController::class);
                $response = $budgetAdjustmentController->index();

                $response->setData([
                    'view' => $response->getData()->view,
                    'message' => [
                        'type' => 'success',
                        'text' => trans('activities.messages.success.planning_created')
                    ]
                ]);
            } else {
                $response['view'] = view('business.planning.projects.index', ['year' => $fiscalYear->year])->render();
            }
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        if (isset($data['fromBudgetAdjustment']) && $data['fromBudgetAdjustment']) {
            return $response;
        } else {
            return response()->json($response);
        }
    }

    /**
     * Llamada al proceso para cargar información de actividades.
     *
     * @param int $projectId
     *
     * @return mixed|string
     */
    public function dataShow(int $projectId)
    {
        try {
            return $this->activityProjectFiscalYearProcess->dataShow($projectId);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }
}
