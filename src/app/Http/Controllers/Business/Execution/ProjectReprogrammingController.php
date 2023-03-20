<?php

namespace App\Http\Controllers\Business\Execution;

use App\Http\Controllers\Controller;
use App\Models\Business\Plan;
use App\Models\Business\PlanIndicator;
use App\Processes\Business\Execution\ProjectProcess;
use App\Processes\Business\Planning\ActivityProjectFiscalYearProcess;
use App\Processes\Business\Planning\ComponentProcess;
use App\Processes\Business\Planning\ProjectProcess as PlanningProjectProcess;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase ProjectReprogrammingController
 * @package App\Http\Controllers\Business\Execution
 */
class ProjectReprogrammingController extends Controller
{

    /**
     * @var ActivityProjectFiscalYearProcess
     */
    private $activityProcess;

    /**
     * @var ProjectProcess
     */
    private $projectProcess;

    /**
     * @var ComponentProcess
     */
    protected $componentProcess;

    /**
     * @var MeasureUnitRepository
     */
    private $measureUnitRepository;

    /**
     * @var PlanningProjectProcess
     */
    private $planningProjectProcess;

    /**
     * Constructor de ProjectReprogrammingController.
     *
     * @param ActivityProjectFiscalYearProcess $activityProcess
     * @param PlanningProjectProcess $planningProjectProcess
     * @param ProjectProcess $projectProcess
     * @param ComponentProcess $componentProcess
     * @param MeasureUnitRepository $measureUnitRepository
     */
    public function __construct(
        ActivityProjectFiscalYearProcess $activityProcess,
        PlanningProjectProcess $planningProjectProcess,
        ProjectProcess $projectProcess,
        ComponentProcess $componentProcess,
        MeasureUnitRepository $measureUnitRepository
    ) {
        $this->activityProcess = $activityProcess;
        $this->projectProcess = $projectProcess;
        $this->componentProcess = $componentProcess;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->planningProjectProcess = $planningProjectProcess;
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
            $this->activityProcess->storeBudgetPlanning($projectId, $request->all(), false, false);
            $response['message'] = [
                'type' => 'success',
                'text' => trans('projects.messages.success.updated')
            ];
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
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * LLamada al proceso para buscar los usuarios de un departamento
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
     * Retorna el formulario para crear un nuevo componente.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function createComponent(int $projectId)
    {
        try {
            $response['view'] = view('business.planning.projects.logic_frame.components.create', [
                'urlStoreComponent' => route('store.create.components.logic_frame.project.programmatic_structure.execution', ['projectId' => $projectId])
            ])->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Almacena un componente en la BD.
     *
     * @param Request $request
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function storeComponent(Request $request, int $projectId)
    {
        try {
            $project = $this->componentProcess->store($request, $projectId);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.index', [
                    'components' => $project->components,
                    'urlEditComponent' => 'edit.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlShowComponent' => 'show.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlDeleteComponent' => 'destroy.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'addOrDelete' => 1,
                    'structureModule' => 1
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('components.messages.success.created')
                ]
            ];
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
                'urlEditComponent' => 'edit.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlUpdateComponent' => 'update.edit.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlDeleteComponent' => 'destroy.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlCreateComponentIndicator' => 'build.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlDeleteComponentIndicator' => 'delete.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'addOrDelete' => 1,
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
                    'urlEditComponent' => 'edit.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlShowComponent' => 'show.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlDeleteComponent' => 'destroy.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'addOrDelete' => 1,
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
                'urlShowComponent' => 'show.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlDeleteComponentIndicator' => 'delete.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'addOrDelete' => 0,
                'structureModule' => 0
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar lógicamente un componente.
     *
     * @param int $componentId
     *
     * @return JsonResponse
     */
    public function destroyComponent(int $componentId)
    {
        try {
            $entity = $this->componentProcess->destroy($componentId);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.index', [
                    'components' => $entity->components,
                    'urlDeleteComponent' => 'destroy.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlEditComponent' => 'edit.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlShowComponent' => 'show.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'addOrDelete' => 1,
                    'structureModule' => 0
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('components.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Muestra formulario completo de un indicador
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function createFullIndicator(int $projectId)
    {
        try {
            $entity = $this->planningProjectProcess->createFullIndicator($projectId);
            $response['view'] = view('business.planning.projects.full_indicator.create', [
                'measuringUnits' => $this->measureUnitRepository->findEnabled(),
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'projectId' => $projectId,
                'planId' => $projectId,
                'route' => '',
                'url' => 'store.create.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'yearMeasurement' => date("Y"),
                'startYear' => date("Y", strtotime($entity->date_init)),
                'planType' => Plan::TYPE_PEI,
                'yearPlanning' => date("Y", strtotime($entity->date_end)),
                'justifiable' => false,
                'indicatorable' => PlanIndicator::INDICATORABLE_PROJECT
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Almacena un indicador completo.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeFullIndicator(Request $request)
    {
        try {
            $entity = $this->planningProjectProcess->storeFullIndicator($request);
            $response = [
                'view' => view('business.planning.projects.full_indicator.index', [
                    'indicators' => $entity->indicators,
                    'urlShowFullIndicator' => 'show.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlDeleteFullIndicator' => 'delete.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'addOrDelete' => 1
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('indicators.messages.success.created')
                ]
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Eliminar lógicamente un indicador
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function destroyIndicator(int $id, Request $request)
    {
        try {
            $entity = $this->planningProjectProcess->destroyIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.full_indicator.index',
                    [
                        'indicators' => $entity->indicators,
                        'urlShowFullIndicator' => 'show.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                        'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                        'urlDeleteFullIndicator' => 'delete.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                        'addOrDelete' => 1
                    ]
                )->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('indicators.messages.success.deleted')
                ]
            ];
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
                'url' => 'update.edit.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
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
     * @return JsonResponse
     */
    public function updateFullIndicator(Request $request, int $id)
    {
        try {
            $entity = $this->planningProjectProcess->updateFullIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.full_indicator.index', [
                    'indicators' => $entity->indicators,
                    'urlShowFullIndicator' => 'show.full_indicator.logic_frame.reprogramming.reforms_reprogramming.execution',
                    'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.reprogramming.reforms_reprogramming.execution',
                    'urlDeleteFullIndicator' => 'delete.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'addOrDelete' => 1
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
     * @return JsonResponse
     */
    public function updateComponentIndicator(int $id, Request $request)
    {
        try {
            $entity = $this->componentProcess->updateIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.indicators.index', [
                    'indicators' => $entity->indicators,
                    'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlDeleteComponentIndicator' => 'delete.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'addOrDelete' => 1
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
     * Muestra formulario completo de un indicador
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function createComponentIndicator(int $projectId)
    {
        try {
            $entity = $this->componentProcess->createIndicator($projectId);
            $response['modal'] = view('business.planning.projects.logic_frame.components.indicators.create', [
                'measuringUnits' => $this->measureUnitRepository->findEnabled(),
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'componentId' => $projectId,
                'planId' => $projectId,
                'url' => 'update.edit.full_indicator.logic_frame.projects.plans_management',
                'yearMeasurement' => date("Y"),
                'startYear' => date("Y", strtotime($entity->project->date_init)),
                'planType' => Plan::TYPE_PEI,
                'yearPlanning' => date("Y", strtotime($entity->project->date_end)),
                'justifiable' => false,
                'indicatorable' => PlanIndicator::INDICATORABLE_COMPONENT,
                'urlStoreComponentIndicator' => 'store.build.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution'
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Almacena un indicador completo.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function storeComponentIndicator(Request $request)
    {
        try {
            $entity = $this->componentProcess->storeIndicator($request);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.indicators.index', [
                    'indicators' => $entity->indicators,
                    'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'urlDeleteComponentIndicator' => 'delete.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                    'addOrDelete' => 1
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('indicators.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Eliminar lógicamente un indicador de Componente
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function deleteComponentIndicator(int $id, Request $request)
    {
        try {
            $component = $this->componentProcess->destroyIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.indicators.index',
                    [
                        'indicators' => $component->indicators,
                        'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                        'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                        'urlDeleteComponentIndicator' => 'delete.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                        'addOrDelete' => 1
                    ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('indicators.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
