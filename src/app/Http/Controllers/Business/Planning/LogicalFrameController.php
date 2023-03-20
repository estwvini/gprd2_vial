<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Models\Business\Plan;
use App\Models\Business\PlanIndicator;
use App\Processes\Business\Planning\ComponentProcess;
use App\Processes\Business\Planning\ProjectProcess;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase LogicalFrameController
 * @package App\Http\Controllers\Business\Planning
 */
class LogicalFrameController extends Controller
{
    /**
     * @var ProjectProcess
     */
    protected $projectProcess;

    /**
     * @var MeasureUnitRepository
     */
    private $measureUnitRepository;

    /**
     * @var ComponentProcess
     */
    protected $componentProcess;

    /**
     * Constructor de LogicalFrameController.
     *
     * @param ProjectProcess $projectProcess
     * @param MeasureUnitRepository $measureUnitRepository
     * @param ComponentProcess $componentProcess
     */
    public function __construct(
        ProjectProcess $projectProcess,
        MeasureUnitRepository $measureUnitRepository,
        ComponentProcess $componentProcess
    ) {
        $this->projectProcess = $projectProcess;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->componentProcess = $componentProcess;
    }

    /**
     * Retorna el formulario para crear un nuevo componente.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function create(int $projectId)
    {
        try {
            $response['view'] = view('business.planning.projects.logic_frame.components.create', [
                'urlStoreComponent' => route('store.create.components.logic_frame.projects.plans_management', ['projectId' => $projectId])
            ])->render();
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
    public function logicFrameShow(int $componentId)
    {
        try {
            $entity = $this->componentProcess->edit($componentId);
            $response['view'] = view('business.planning.projects.logic_frame.components.show', [
                'component' => $entity,
                'urlShowComponent' => 'show.components.logic_frame.projects.plans_management',
                'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.projects.plans_management',
                'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.projects.plans_management',
                'addOrDelete' => 1,
                'structureModule' => 0
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Retorna el formulario para editar un nuevo componente.
     *
     * @param int $componentId
     *
     * @return JsonResponse
     */
    public function edit(int $componentId)
    {
        try {
            $entity = $this->componentProcess->edit($componentId);
            $response['view'] = view('business.planning.projects.logic_frame.components.update', [
                'component' => $entity,
                'urlEditComponent' => 'edit.components.logic_frame.projects.plans_management',
                'urlUpdateComponent' => 'update.edit.components.logic_frame.projects.plans_management',
                'urlDeleteComponent' => 'destroy.components.logic_frame.projects.plans_management',
                'urlCreateComponentIndicator' => 'build.indicator.components.logic_frame.projects.plans_management',
                'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.projects.plans_management',
                'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.projects.plans_management',
                'urlDeleteComponentIndicator' => 'delete.indicator.components.logic_frame.projects.plans_management',
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
    public function update(Request $request, int $componentId)
    {
        try {
            $project = $this->componentProcess->update($request, $componentId);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.index', [
                    'components' => $project->components,
                    'urlCreateComponentIndicator' => 'build.indicator.components.logic_frame.projects.plans_management',
                    'urlEditComponent' => 'edit.components.logic_frame.projects.plans_management',
                    'urlShowComponent' => 'show.components.logic_frame.projects.plans_management',
                    'urlDeleteComponent' => 'destroy.components.logic_frame.projects.plans_management',
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
     * Almacena un componente en la BD.
     *
     * @param Request $request
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function store(Request $request, int $projectId)
    {
        try {
            $project = $this->componentProcess->store($request, $projectId);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.index', [
                    'components' => $project->components,
                    'urlCreateComponentIndicator' => 'build.indicator.components.logic_frame.projects.plans_management',
                    'urlEditComponent' => 'edit.components.logic_frame.projects.plans_management',
                    'urlShowComponent' => 'show.components.logic_frame.projects.plans_management',
                    'urlDeleteComponent' => 'destroy.components.logic_frame.projects.plans_management',
                    'addOrDelete' => 1,
                    'structureModule' => 0
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
     * Llamada al proceso para eliminar lógicamente un componente.
     *
     * @param int $componentId
     *
     * @return JsonResponse
     */
    public function destroy(int $componentId)
    {
        try {
            $entity = $this->componentProcess->destroy($componentId);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.index', [
                    'components' => $entity->components,
                    'urlCreateComponentIndicator' => 'build.indicator.components.logic_frame.projects.plans_management',
                    'urlEditComponent' => 'edit.components.logic_frame.projects.plans_management',
                    'urlShowComponent' => 'show.components.logic_frame.projects.plans_management',
                    'urlDeleteComponent' => 'destroy.components.logic_frame.projects.plans_management',
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
            $entity = $this->projectProcess->createFullIndicator($projectId);
            $url = 'store.create.full_indicator.logic_frame.projects.plans_management';
            $response['view'] = view('business.planning.projects.full_indicator.create', [
                'measuringUnits' => $this->measureUnitRepository->findEnabled(),
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'projectId' => $projectId,
                'planId' => $projectId,
                'route' => '',
                'url' => $url,
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
            $entity = $this->projectProcess->storeFullIndicator($request);
            $response = [
                'view' => view('business.planning.projects.full_indicator.index', [
                    'indicators' => $entity->indicators,
                    'urlShowFullIndicator' => 'show.full_indicator.logic_frame.projects.plans_management',
                    'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.projects.plans_management',
                    'urlDeleteFullIndicator' => 'delete.full_indicator.logic_frame.projects.plans_management',
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
     * Muestra formulario de edición de un indicador completo.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function editFullIndicator(int $projectId)
    {
        try {
            $entity = $this->projectProcess->editFullIndicator($projectId);
            $response['view'] = view('business.planning.projects.full_indicator.update', [
                'measuringUnits' => $this->measureUnitRepository->findEnabled(),
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'entity' => $entity,
                'route' => '',
                'planId' => $entity->indicatorable->id,
                'url' => 'update.edit.full_indicator.logic_frame.projects.plans_management',
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
    public function updateFullIndicator(int $id, Request $request)
    {
        try {
            $entity = $this->projectProcess->updateFullIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.full_indicator.index', [
                    'indicators' => $entity->indicators,
                    'urlShowFullIndicator' => 'show.full_indicator.logic_frame.projects.plans_management',
                    'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.projects.plans_management',
                    'urlDeleteFullIndicator' => 'delete.full_indicator.logic_frame.projects.plans_management',
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
            $entity = $this->projectProcess->destroyIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.full_indicator.index',
                    [
                        'indicators' => $entity->indicators,
                        'urlShowFullIndicator' => 'show.full_indicator.logic_frame.projects.plans_management',
                        'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.projects.plans_management',
                        'urlDeleteFullIndicator' => 'delete.full_indicator.logic_frame.projects.plans_management',
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
     * Muestra formulario completo de un indicador
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function createIndicator(int $projectId)
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
                'urlStoreComponentIndicator' => 'store.build.indicator.components.logic_frame.projects.plans_management'
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
    public function storeIndicator(Request $request)
    {
        try {
            $entity = $this->componentProcess->storeIndicator($request);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.indicators.index', [
                    'indicators' => $entity->indicators,
                    'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.projects.plans_management',
                    'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.projects.plans_management',
                    'urlDeleteComponentIndicator' => 'delete.indicator.components.logic_frame.projects.plans_management',
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
     * Muestra formulario de edición de un indicador completo.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function editIndicator(int $projectId)
    {
        try {
            $entity = $this->componentProcess->editIndicator($projectId);

            if (!$entity) {
                throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
            }

            $response['modal'] = view('business.planning.projects.logic_frame.components.indicators.update', [
                'measuringUnits' => $this->measureUnitRepository->findEnabled(),
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'entity' => $entity,
                'route' => '',
                'planId' => $entity->indicatorable->id,
                'url' => 'update.edit.indicator.components.logic_frame.projects.plans_management',
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
     * Muestra formulario de edición de un indicador completo.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function editIndicatorShow(int $projectId)
    {
        try {
            $entity = $this->componentProcess->editIndicatorShow($projectId, 'update.edit.full_indicator.logic_frame.projects.plans_management');

            if (!$entity) {
                throw  new Exception(trans('components.messages.errors.not_found'), 1000);
            }
            $response['modal'] = view('business.planning.project_review.logic_frame.components.indicators.update', [
                'measuringUnits' => $this->measureUnitRepository->findEnabled(),
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'entity' => $entity,
                'route' => '',
                'planId' => $entity->indicatorable->id,
                'url' => 'update.edit.full_indicator.logic_frame.projects.plans_management',
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
    public function updateIndicator(int $id, Request $request)
    {
        try {
            $entity = $this->componentProcess->updateIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.indicators.index', [
                    'indicators' => $entity->indicators,
                    'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.projects.plans_management',
                    'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.projects.plans_management',
                    'urlDeleteComponentIndicator' => 'delete.indicator.components.logic_frame.projects.plans_management',
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
     * Eliminar lógicamente un indicador de Componente
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function destroyIndicatorComponent(int $id, Request $request)
    {
        try {
            $component = $this->componentProcess->destroyIndicator($id, $request);
            $response = [
                'view' => view('business.planning.projects.logic_frame.components.indicators.index',
                    [
                        'indicators' => $component->indicators,
                        'urlShowComponentIndicator' => 'show.indicator.components.logic_frame.projects.plans_management',
                        'urlEditComponentIndicator' => 'edit.indicator.components.logic_frame.projects.plans_management',
                        'urlDeleteComponentIndicator' => 'delete.indicator.components.logic_frame.projects.plans_management',
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

    /**
     * Retorna el formulario para ver un componente.
     *
     * @param int $activityId
     *
     * @return JsonResponse
     */
    public function editShow(int $activityId)
    {
        try {
            $entity = $this->componentProcess->edit($activityId);

            $response['view'] = view('business.planning.project_review.logic_frame.components.update', [
                'component' => $entity
            ])->render();
            return response()->json($response);

        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }
}
