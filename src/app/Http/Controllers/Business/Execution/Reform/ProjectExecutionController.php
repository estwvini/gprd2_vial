<?php

namespace App\Http\Controllers\Business\Execution\Reform;

use App\Http\Controllers\Controller;
use App\Models\Business\Plan;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Project;
use App\Processes\Business\Execution\ProjectProcess;
use App\Processes\Business\Planning\ActivityProjectFiscalYearProcess;
use App\Processes\Business\Planning\ComponentProcess;
use App\Processes\Business\Planning\ProjectProcess as PlanningProjectProcess;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDOException;
use Throwable;

/**
 * Clase ProjectExecutionController
 * @package App\Http\Controllers\Execution\Reform
 */
class ProjectExecutionController extends Controller
{

    /**
     * @var ProjectProcess
     */
    protected $projectProcess;

    /**
     * @var PlanningProjectProcess
     */
    protected $planningProjectProcess;

    /**
     * @var ComponentProcess
     */
    protected $componentProcess;

    /**
     * @var ActivityProjectFiscalYearProcess
     */
    private $activityProjectFiscalYearProcess;

    /**
     * @var MeasureUnitRepository
     */
    private $measureUnitRepository;

    /**
     * Constructor ProjectExecutionController.
     *
     * @param ProjectProcess $projectProcess
     * @param PlanningProjectProcess $planningProjectProcess
     * @param ComponentProcess $componentProcess
     * @param ActivityProjectFiscalYearProcess $activityProjectFiscalYearProcess
     * @param MeasureUnitRepository $measureUnitRepository
     */
    public function __construct(
        ProjectProcess $projectProcess,
        PlanningProjectProcess $planningProjectProcess,
        ComponentProcess $componentProcess,
        ActivityProjectFiscalYearProcess $activityProjectFiscalYearProcess,
        MeasureUnitRepository $measureUnitRepository
    ) {
        $this->projectProcess = $projectProcess;
        $this->planningProjectProcess = $planningProjectProcess;
        $this->componentProcess = $componentProcess;
        $this->activityProjectFiscalYearProcess = $activityProjectFiscalYearProcess;
        $this->measureUnitRepository = $measureUnitRepository;
    }

    /**
     * Llamada al proceso para mostrar vista de proyectos con reformas presupuestarias.
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function index()
    {
        try {
            $response['view'] = view('business.execution.reforms.budgetary.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesa la petición ajax de datatables.
     *
     * @return string
     */
    public function data()
    {
        try {
            return $this->projectProcess->dataBudgetary();
        } catch (PDOException | QueryException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar vista de reprogramación financiera.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {

            $data = $this->projectProcess->reprogrammingIndexData($id);
            $dataProfile = $this->planningProjectProcess->editProfile($data[0]->id);

            $response['view'] = view('business.execution.reforms.budgetary.update', [
                'entity' => $data[0],
                'project' => $data[0],
                'fiscal_year' => $data[2]->year,
                'executingUnits' => $dataProfile[1],
                'users' => $dataProfile[2],
                'leader' => $dataProfile[3],
                'operationalGoals' => $data[4],
                'type' => trans('reprogramming.labels.financing'),
                'budgetPlanning' => json_encode($data[1], JSON_HEX_APOS | JSON_HEX_QUOT),
                'currentMonth' => Carbon::now()->month,
                'projectFiscalYear' => $data[3],
                'projectPhases' => Project::PROJECT_PHASES,
                'urlLoadUsers' => 'loadusers.edit.profile.reforms.reforms_reprogramming.execution',
                'urlShowFullIndicator' => 'show.full_indicator.logic_frame.reforms.reforms_reprogramming.execution',
                'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.reforms.reforms_reprogramming.execution'
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualiza información de un Proyecto
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function updateProjectProfile(Request $request, int $id)
    {
        try {
            $data = $this->planningProjectProcess->update($id, $request);
            $response['message'] = $data['message'];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para buscar los usuarios de un departamento
     *
     * @param int $departmentId
     *
     * @return JsonResponse
     */
    public function loadUsers(int $departmentId)
    {
        try {
            return response()->json($this->planningProjectProcess->usersByExecutingUnit($departmentId));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Actualiza información de un Proyecto
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function updateLogicFrame(Request $request, int $id)
    {
        try {
            $data = $this->planningProjectProcess->update($id, $request);

            $response['message'] = $data['message'];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Retorna el formulario para editar un componente.
     *
     * @param int $componentId
     *
     * @return JsonResponse
     */
    public function editComponent(int $componentId)
    {
        try {
            $entity = $this->componentProcess->edit($componentId);
            $response['view'] = view('business.planning.projects.logic_frame.components.update', [
                'component' => $entity,
                'urlEditComponent' => 'edit.components.logic_frame.reforms.reforms_reprogramming.execution',
                'urlUpdateComponent' => 'update.edit.components.logic_frame.reforms.reforms_reprogramming.execution',
                'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.reforms.reforms_reprogramming.execution',
                'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.reforms.reforms_reprogramming.execution',
                'addOrDelete' => 0,
                'structureModule' => 0
            ])->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Actualiza un componente en la BD.
     *
     * @param Request $request
     * @param int $componentId
     *
     * @return JsonResponse
     */
    public function updateComponent(Request $request, int $componentId)
    {
        try {
            $project = $this->componentProcess->update($request, $componentId);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.index', [
                    'components' => $project->components,
                    'urlEditComponent' => 'edit.components.logic_frame.reforms.reforms_reprogramming.execution',
                    'urlShowComponent' => 'show.components.logic_frame.reforms.reforms_reprogramming.execution',
                    'addOrDelete' => 0,
                    'structureModule' => 0
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('components.messages.success.updated')
                ]
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Muestra un componente
     *
     * @param int $componentId
     *
     * @return JsonResponse|mixed
     */
    public function showComponent(int $componentId)
    {
        try {
            $entity = $this->componentProcess->edit($componentId);
            $response['view'] = view('business.planning.projects.logic_frame.components.show', [
                'component' => $entity,
                'urlShowComponent' => 'show.components.logic_frame.reforms.reforms_reprogramming.execution',
                'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.reforms.reforms_reprogramming.execution',
                'addOrDelete' => 0,
                'structureModule' => 0
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar las planificaciones mensuales del presupuesto
     *
     * @param Request $request
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function updateBudgetPlannings(Request $request, int $projectId)
    {
        try {
            $this->activityProjectFiscalYearProcess->storeBudgetPlanning($projectId, $request->all(), false, true);
            $response['view'] = view('business.execution.reforms.budgetary.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Muestra un indicador completo.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function showFullIndicator(int $id)
    {
        try {
            $response['view'] = view('business.planning.projects.full_indicator.show', $this->projectProcess->showIndicator($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra formulario de edición de un indicador completo.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function editFullIndicator(int $projectId)
    {
        try {
            $entity = $this->planningProjectProcess->editFullIndicator($projectId);
            $response['view'] = view('business.planning.projects.full_indicator.update', [
                'measuringUnits' => $this->measureUnitRepository->findEnabled(),
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'entity' => $entity,
                'route' => '',
                'planId' => $entity->indicatorable->id,
                'url' => 'update.edit.full_indicator.logic_frame.reforms.reforms_reprogramming.execution',
                'planElementId' => $entity->indicatorable->id,
                'yearMeasurement' => date("Y"),
                'startYear' => date("Y", strtotime($entity->indicatorable->date_init)),
                'planType' => Plan::TYPE_PEI,
                'projectId' => $entity->indicatorable->id,
                'yearPlanning' => date("Y", strtotime($entity->indicatorable->date_end)),
                'justifiable' => false,
                'status' => $entity->indicatorable->status,
                'indicatorable' => PlanIndicator::INDICATORABLE_PROJECT,
                'indicatorId' => $projectId
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualiza un indicador completo.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function updateFullIndicator(Request $request, int $id)
    {
        try {
            $entity = $this->planningProjectProcess->updateFullIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.full_indicator.index', [
                    'indicators' => $entity->indicators,
                    'urlShowFullIndicator' => 'show.full_indicator.logic_frame.reforms.reforms_reprogramming.execution',
                    'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.reforms.reforms_reprogramming.execution',
                    'addOrDelete' => 0
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('indicators.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Muestra el indicador en solo lectura
     *
     * @param int $indicatorId
     *
     * @return JsonResponse|mixed
     */
    public function showIndicator(int $indicatorId)
    {
        try {
            $response['modal'] = view('business.planning.projects.logic_frame.components.indicators.show', $this->componentProcess->showIndicator($indicatorId))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Muestra formulario de edición de un indicador completo.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function editComponentIndicator(int $projectId)
    {
        try {
            $entity = $this->componentProcess->editIndicatorShow($projectId, 'update.edit.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution');

            if (!$entity) {
                throw  new Exception(trans('components.messages.errors.not_found'), 1000);
            }
            $response['modal'] = view('business.planning.projects.logic_frame.components.indicators.update', [
                'measuringUnits' => $this->measureUnitRepository->findEnabled(),
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'entity' => $entity,
                'route' => '',
                'planId' => $entity->indicatorable->id,
                'url' => 'update.edit.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'planElementId' => $entity->indicatorable->id,
                'yearMeasurement' => date("Y"),
                'startYear' => date("Y", strtotime($entity->indicatorable->project->date_init)),
                'planType' => Plan::TYPE_PEI,
                'activityId' => $entity->indicatorable->id,
                'yearPlanning' => date("Y", strtotime($entity->indicatorable->project->date_end)),
                'justifiable' => false,
                'status' => $entity->indicatorable->status,
                'indicatorable' => PlanIndicator::INDICATORABLE_COMPONENT,
                'indicatorId' => $projectId

            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualiza un indicador completo.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function updateComponentIndicator(int $id, Request $request)
    {
        try {
            $entity = $this->componentProcess->updateIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.indicators.index', [
                    'indicators' => $entity->indicators,
                    'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.reforms',
                    'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.reforms.reforms_reprogramming.execution',
                    'addOrDelete' => 0
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('indicators.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}