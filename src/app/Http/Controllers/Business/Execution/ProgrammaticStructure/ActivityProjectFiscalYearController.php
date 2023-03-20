<?php

namespace App\Http\Controllers\Business\Execution\ProgrammaticStructure;

use App\Http\Controllers\Controller;
use App\Processes\Business\Execution\ActivityProjectFiscalYearProcess;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PDOException;
use Throwable;

/**
 * Clase ActivityProjectFiscalYearController
 * @package App\Http\Controllers\Execution\ProgrammaticStructure
 */
class ActivityProjectFiscalYearController extends Controller
{

    /**
     * @var ActivityProjectFiscalYearProcess
     */
    protected $activityProjectFiscalYearProcess;

    /**
     * Constructor ProjectController.
     *
     * @param ActivityProjectFiscalYearProcess $activityProjectFiscalYearProcess
     */
    public function __construct(
        ActivityProjectFiscalYearProcess $activityProjectFiscalYearProcess
    ) {
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
            $response['view'] = view('business.execution.programmatic_structure.activities.index', [
                'project' => $data[0],
                'flag' => $data[0]->executingUnit ? 1 : 0,
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
        } catch (PDOException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
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
            $response['modal'] = view('business.execution.programmatic_structure.activities.create', [
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
            $response['modal'] = view('business.execution.programmatic_structure.activities.update', [
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
            $response['view'] = view('business.execution.programmatic_structure.activities.show', [
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
}