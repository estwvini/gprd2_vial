<?php

namespace App\Processes\Business\Planning;

use App\Http\Controllers\Business\Planning\PlanController;
use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Project;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\ThresholdRepository;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\PlanRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Throwable;

/**
 * Clase PlanElementProcess
 * @package App\Processes\Business\Planning
 */
class PlanElementProcess
{

    /**
     * @var PlanElementRepository
     */
    protected $planElementRepository;

    /**
     * @var ThresholdRepository
     */
    protected $thresholdRepository;

    /**
     * @var PlanController
     */
    protected $planController;

    /**
     * @var PlanIndicatorProcess
     */
    protected $indicatorProcess;

    /**
     * @var PlanIndicatorRepository
     */
    protected $indicatorRepository;

    /**
     * @var PlanRepository
     */
    protected $planRepository;

    /**
     * @var ProjectProcess
     */
    protected $projectProcess;

    /**
     * @var ProjectRepository
     */
    protected $projectRepository;

    /**
     * @var MeasureUnitRepository
     */
    protected $measureUnitRepository;

    /**
     * @var DepartmentRepository
     */
    protected $departmentRepository;

    /**
     * Constructor de PlanElementProcess.
     *
     * @param PlanElementRepository $planElementRepository
     * @param PlanController $planController
     * @param PlanIndicatorProcess $indicatorProcess
     * @param PlanIndicatorRepository $indicatorRepository
     * @param PlanRepository $planRepository
     * @param ProjectProcess $projectProcess
     * @param ProjectRepository $projectRepository
     * @param MeasureUnitRepository $measureUnitRepository
     * @param ThresholdRepository $thresholdRepository
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(
        PlanElementRepository $planElementRepository,
        PlanController $planController,
        PlanIndicatorProcess $indicatorProcess,
        PlanIndicatorRepository $indicatorRepository,
        PlanRepository $planRepository,
        ProjectProcess $projectProcess,
        ProjectRepository $projectRepository,
        MeasureUnitRepository $measureUnitRepository,
        ThresholdRepository $thresholdRepository,
        DepartmentRepository $departmentRepository
    ) {
        $this->planElementRepository = $planElementRepository;
        $this->planController = $planController;
        $this->indicatorProcess = $indicatorProcess;
        $this->indicatorRepository = $indicatorRepository;
        $this->planRepository = $planRepository;
        $this->projectProcess = $projectProcess;
        $this->projectRepository = $projectRepository;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->thresholdRepository = $thresholdRepository;
        $this->departmentRepository = $departmentRepository;
    }


    /**
     * Obtener la clase de PlanElementProcess
     *
     * @return string
     */
    public function process()
    {
        return PlanElementProcess::class;
    }

    /**
     * Mostrar el formulario de creación de un elemento de un plan.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $route = '';

        if (isset($data['parent_id'])) {
            self::getRoute($data['parent_id'], $route);

            if (in_array($data['element_type'], [PlanElement::TYPE_PROGRAM, PlanElement::TYPE_SUBPROGRAM])) {
                $code = $this->planElementRepository->generateCode($data['plan_id'], $data['element_type'], $data['parent_id']);
            }
        }

        $response['view'] = view('business.planning.plan_element.create', [
            'data' => $request->all(),
            'route' => $route ?? '',
            'justifiable' => isJustifiable($this->planRepository->find($data['plan_id'])),
            'code' => $code ?? '',
            'type' => $data['element_type'],
            'isPei' => $data['planType'] === Plan::TYPE_PEI,
            'dimensions' => PlanElement::DIMENSION
        ])->render();

        return response()->json($response);
    }

    /**
     * Almacenar un nuevo elemento de un plan
     *
     * @param Request $request
     *
     * @return array
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $data = $request->all();

        if (in_array($data['type'], [PlanElement::TYPE_PROGRAM, PlanElement::TYPE_SUBPROGRAM])) {
            $data['code'] = $this->planElementRepository->generateCode($data['plan_id'], $data['type'], $data['parent_id']);
        }

        $entity = $this->planElementRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        $data = $request->all();

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple']) {
            $entity->justifications()->save(storeJustification($data, $entity, true));
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('plan_elements.messages.success.created',
                    ['element' => trans('plan_elements.labels.' . $entity->type)])
            ]
        ];

        return $response;
    }

    /**
     * Muestra un elemento de un plan en específico
     *
     * @param Request $request
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function show(int $id, Request $request)
    {

        $entity = $this->planElementRepository->find($id);
        $data = $request->all();

        if (!$entity) {
            throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }

        $route = '';

        if ($entity->parent_id) {
            self::getRoute($entity->parent_id, $route);
        }

        $response['view'] = view('business.planning.plan_element.show', [
            'entity' => $entity,
            'route' => $route,
            'type' => $entity->type,
            'isPei' => $data['planType'] === Plan::TYPE_PEI,
            'dimensions' => PlanElement::DIMENSION
        ])->render();

        return $response;
    }

    /**
     * Mostrar formulario de edición de un elemento de un plan
     *
     * @param int $id
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function edit(int $id, Request $request)
    {

        $entity = $this->planElementRepository->find($id);
        $data = $request->all();

        if (!$entity) {
            throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }

        $route = '';

        if ($entity->parent_id) {
            self::getRoute($entity->parent_id, $route);
        }

        $response['view'] = view('business.planning.plan_element.update', [
            'entity' => $entity,
            'data' => $data,
            'route' => $route,
            'justifiable' => isJustifiable($this->planRepository->find($data['plan_id'])),
            'type' => $data['element_type'],
            'isPei' => $data['planType'] === Plan::TYPE_PEI,
            'dimensions' => PlanElement::DIMENSION
        ])->render();

        return $response;
    }

    /**
     * Actualizar un elemento de un plan
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function update(int $id, Request $request)
    {
        $entity = $this->planElementRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();
        $justification = null;

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple']) {
            $justification = storeJustification($data, $entity, true);
        }

        if (in_array($data['type'], [PlanElement::TYPE_PROGRAM, PlanElement::TYPE_SUBPROGRAM])) {
            unset($data['code']);
        }

        $entity = $this->planElementRepository->updateFromArray($data, $entity);

        if (!$entity) {
            throw new Exception(trans('plan_elements.messages.errors.update'), 1000);
        }

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple']) {
            $entity->justifications()->save($justification);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('plan_elements.messages.success.updated',
                    ['element' => trans('plan_elements.labels.' . $entity->type)])
            ]
        ];

        return $response;

    }

    /**
     * Eliminar un elemento de un plan
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function destroy(int $id, Request $request)
    {
        $entity = $this->planElementRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();
        $justification = null;

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple']) {
            $justification = storeJustification($data, $entity, true);
        }

        $type = $entity->type;

        if ($entity->children->isNotEmpty() or $entity->projects->isNotEmpty()) {
            throw new Exception(trans('plan_elements.messages.exceptions.has_children', ['element' => trans('plan_elements.labels.' . $type)]), 1000);
        }

        if (!$this->planElementRepository->delete($entity)) {
            throw new Exception(trans('plan_elements.messages.errors.delete'), 1000);
        }

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple'] && isset($justification)) {
            $entity->justifications()->save($justification);
        }

        return [
            'message' => [
                'type' => 'success',
                'text' => trans('plan_elements.messages.success.deleted',
                    ['element' => trans('plan_elements.labels.' . $type)])
            ]
        ];
    }

    /**
     * Mostrar el formulario de creación de un indicador reducido.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function createSmallIndicator(Request $request)
    {
        $data = $request->all();

        $route = '';

        self::getRoute($data['planElementId'], $route);

        $response['view'] = view('business.planning.plan_element.small_indicator.create', [
            'planElementId' => $data['planElementId'],
            'planId' => $data['planId'],
            'route' => $route
        ])->render();

        return $response;
    }

    /**
     * Mostrar el formulario completo de creación de un indicador.
     *
     * @param Request $request
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function createFullIndicator(Request $request)
    {
        $data = $request->all();
        $entity = $this->planElementRepository->find($data['planElementId']);

        $route = '';
        $url = 'update.edit.full_indicator.logic_frame.projects.plans_management';

        self::getRoute($data['planElementId'], $route);

        $response['view'] = view('business.planning.plan_element.full_indicator.create', [
            'measuringUnits' => $this->measureUnitRepository->findEnabled(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'planElementId' => $data['planElementId'],
            'planId' => $data['planId'],
            'route' => $route,
            'url' => $url,
            'yearMeasurement' => date("Y"),
            'startYear' => $entity->plan->start_year,
            'planType' => $entity->plan->type,
            'yearPlanning' => $entity->plan->end_year,
            'justifiable' => isJustifiable($this->planRepository->find($data['planId'])),
            'indicatorable' => PlanIndicator::INDICATORABLE_PLAN
        ])->render();

        return $response;
    }

    /**
     * Almacena un indicador reducido
     *
     * @param Request $request
     *
     * @return array
     * @throws Throwable
     */
    public function storeSmallIndicator(Request $request)
    {
        $data = $request->all();

        $planElement = $this->planElementRepository->find($data['planElementId']);

        $indicator = $this->indicatorProcess->storeSmallIndicator($request, $planElement);

        if (!$indicator) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        return $indicator;
    }

    /**
     * Almacena un indicador completo
     *
     * @param Request $request
     *
     * @return array
     * @throws Throwable
     */
    public function storeFullIndicator(Request $request)
    {
        $data = $request->all();
        $frequency = 1;

        $planElement = $this->planElementRepository->find($data['planElementId']);

        if (isset($data['measurement_frequency_per_year'])) {
            $frequency = $data['measurement_frequency_per_year'];
        }

        $goalsCount = ($planElement->Plan->end_year - $planElement->Plan->start_year) * $frequency;
        if ($frequency > 1) {
            $goalsCount += 1;
        }
        $indicator = $this->indicatorProcess->storeFullIndicator($request, $planElement, $goalsCount, $planElement->Plan->start_year);

        if (!$indicator) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        return $indicator;
    }

    /**
     * Muestra un indicador reducido
     *
     * @param int $id
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function showSmallIndicator(int $id, Request $request)
    {
        $data = $request->all();
        $entity = $this->indicatorRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('indicators.messages.exceptions.not_found'), 1000);
        }

        $route = '';

        self::getRoute($data['planElementId'], $route);

        $response['view'] = view('business.planning.plan_element.small_indicator.show', [
            'entity' => $entity,
            'route' => $route
        ])->render();


        return $response;
    }

    /**
     * Muestra un indicador completo
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function showFullIndicator(int $id)
    {
        $entity = $this->indicatorRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('indicators.messages.exceptions.not_found'), 1000);
        }

        $route = '';

        if (!is_null($entity->measurement_frequency_per_year)) {
            $measuring_frequency = ($entity->indicatorable->plan->end_year - $entity->indicatorable->plan->start_year) * $entity->measurement_frequency_per_year;
        } else {
            $measuring_frequency = 0;
        }

        if (!is_null($entity->type)) {
            $type = PlanIndicator::types()[$entity->type];
        } else {
            $type = '';
        }

        if (!is_null($entity->goal_type)) {
            $goal_type = PlanIndicator::goalTypes()[$entity->goal_type];
        } else {
            $goal_type = '';
        }

        self::getRoute($entity->indicatorable_id, $route);

        return [

            'measuringUnit' => isset($entity->measureUnit) ? $entity->measureUnit->name : '',
            'type' => $type,
            'goal_type' => $goal_type,
            'measuring_frequency' => $measuring_frequency,
            'entity' => $entity,
            'route' => $route,
            'yearPlanning' => $entity->indicatorable->plan->end_year,
            'measuringUnits' => $this->measureUnitRepository->findEnabled(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'planId' => $entity->indicatorable->plan->id,
            'planElementId' => $entity->indicatorable_id,
            'yearMeasurement' => date("Y"),
            'startYear' => $entity->indicatorable->plan->start_year,
            'planType' => $entity->indicatorable->plan->type,
            'status' => $entity->indicatorable->plan->status,
            'indicatorable' => PlanIndicator::INDICATORABLE_PLAN,
            'indicatorId' => $id

        ];
    }

    /**
     * Mostrar formulario de edición de un indicador reducido
     *
     * @param int $id
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function editSmallIndicator(int $id, Request $request)
    {

        $entity = $this->indicatorRepository->find($id);
        $data = $request->all();

        if (!$entity) {
            throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }

        $route = '';

        self::getRoute($data['planElementId'], $route);

        $response['view'] = view('business.planning.plan_element.small_indicator.update', [
            'entity' => $entity,
            'data' => $data,
            'route' => $route,
            'planElementId' => $data['planElementId'],
            'planId' => $data['planId'],
        ])->render();

        return $response;
    }

    /**
     * Mostrar formulario de edición de un indicador completo
     *
     * @param int $id
     * @param Request $request
     * @param string $url
     *
     * @return mixed
     * @throws Throwable
     */
    public function editFullIndicator(int $id, Request $request, string $url)
    {

        $entity = $this->indicatorRepository->find($id);
        $data = $request->all();

        if (!$entity) {
            throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }

        $route = '';

        self::getRoute($data['planElementId'], $route);

        $response['view'] = view('business.planning.plan_element.full_indicator.update', [
            'measuringUnits' => $this->measureUnitRepository->findEnabled(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'entity' => $entity,
            'route' => $route,
            'planId' => $data['planId'],
            'url' => $url,
            'planElementId' => $data['planElementId'],
            'yearMeasurement' => date("Y"),
            'startYear' => $entity->indicatorable->plan->start_year,
            'planType' => $entity->indicatorable->plan->type,
            'yearPlanning' => $entity->indicatorable->plan->end_year,
            'justifiable' => isJustifiable($this->planRepository->find($data['planId'])),
            'status' => $entity->indicatorable->plan->status,
            'indicatorable' => PlanIndicator::INDICATORABLE_PLAN

        ])->render();

        return $response;
    }

    /**
     * Actualiza un indicador reducido
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Throwable
     */
    public function updateSmallIndicator(int $id, Request $request)
    {
        $indicator = $this->indicatorProcess->updateSmallIndicator($id, $request);

        if (!$indicator) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('plan_elements.messages.success.updated',
                    ['element' => trans('plan_elements.labels.INDICATOR')])
            ]
        ];

        return $response;
    }

    /**
     * Actualiza un indicador completo
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Throwable
     */
    public function updateFullIndicator(int $id, Request $request)
    {
        $entity = $this->indicatorRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('plan_elements.messages.errors.not_found'), 1000);
        }

        $frequency = $entity->measurement_frequency_per_year;
        $data = $request->all();
        if (isset($data['measurement_frequency_per_year'])) {
            $frequency = $data['measurement_frequency_per_year'];
        }

        $goalsCount = ($entity->indicatorable->plan->end_year - $entity->indicatorable->plan->start_year) * $frequency;
        if ($frequency > 1) {
            $goalsCount += 1;
        }
        $indicator = $this->indicatorProcess->update($request, $id, $goalsCount, $entity->indicatorable->plan->start_year);

        if (!$indicator) {
            throw new Exception(trans('plan_elements.messages.errors.update'), 1000);
        }

        return $indicator;
    }

    /**
     * Elimina un indicador de la base de datos
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function destroyIndicator(int $id, Request $request)
    {
        $this->indicatorProcess->destroy($id, $request);

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('plan_elements.messages.success.deleted',
                    ['element' => trans('plan_elements.labels.INDICATOR')])
            ]
        ];

        return $response;
    }

    /**
     * Construye la ruta de un elemento de un plan
     *
     * @param int $parentId
     * @param string|null $route
     *
     * @throws Exception
     */
    public function getRoute(int $parentId, string &$route = null)
    {
        $element = $this->planElementRepository->find($parentId);

        if (!$element) {
            throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }

        $text = trans('plan_elements.labels.' . $element->type) . ' - ' . Str::limit($element->code, 3, '...');

        if (!$route) {
            $route = $text . ' <i class="glyphicon glyphicon-chevron-down"></i> ';
        } else {
            $route = $text . ' <i class="glyphicon glyphicon-chevron-right"></i> ' . $route;
        }

        if ($element->parent_id) {
            self::getRoute($element->parent_id, $route);
        }
    }

    /**
     * Mostrar el formulario de un proyecto.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function createProject(Request $request)
    {
        $data = $request->all();

        $route = '';

        self::getRoute($data['planElementId'], $route);

        $cup = $this->planElementRepository->generateProjectCode($data['planElementId']);

        $plan = $this->planRepository->find($data['planId']);

        if (!$plan) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $minDate = "01-01-{$plan->start_year}";
        $maxDate = "31-12-{$plan->end_year}";

        $response['view'] = view('business.planning.plan_element.project.create', [
            'planElementId' => $data['planElementId'],
            'planId' => $data['planId'],
            'route' => $route,
            'justifiable' => isJustifiable($plan),
            'cup' => $cup,
            'responsibleUnits' => $this->departmentRepository->findAll(),
            'minDate' => $minDate,
            'maxDate' => $maxDate
        ])->render();

        return $response;
    }

    /**
     * Almacena un proyecto
     *
     * @param Request $request
     *
     * @return Project
     * @throws ModelException
     */
    public function storeProject(Request $request)
    {
        $request->merge(['cup' => $this->planElementRepository->generateProjectCode($request->plan_element_id)]);

        $project = $this->projectProcess->store($request);

        if (!$project) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        return $project;
    }

    /**
     * Mostrar formulario de edición de un proyecto
     *
     * @param int $id
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function editProject(int $id, Request $request)
    {

        $entity = $this->projectRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();
        $route = '';

        self::getRoute($data['planElementId'], $route);

        $plan = $this->planRepository->find($data['planId']);

        if (!$plan) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $minDate = "01-01-{$plan->start_year}";
        $maxDate = "31-12-{$plan->end_year}";

        $inProgress = $entity->isInProgress();
        $currentYear = currentFiscalYear()->year;
        $endDateDisable = false;

        $response['view'] = view('business.planning.plan_element.project.update', [
            'entity' => $entity,
            'planElementId' => $data['planElementId'],
            'planId' => $data['planId'],
            'route' => $route,
            'justifiable' => isJustifiable($this->planRepository->find($data['planId'])),
            'responsibleUnits' => $this->departmentRepository->findAll(),
            'minDate' => $inProgress ? "31-12-{$currentYear}" : $minDate,
            'maxDate' => $maxDate,
            'inProgress' => $inProgress,
            'endDateDisable' => $endDateDisable
        ])->render();

        return $response;
    }

    /**
     * Actualiza un proyecto
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Throwable
     */
    public function updateProject(int $id, Request $request)
    {
        $project = $this->projectProcess->update($id, $request);

        if (!$project) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        return $project;
    }

    /**
     * Carga campos para ingreso de presupuestos anuales.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function loadAnnualBudgets(Request $request)
    {
        $data = $request->all();

        $annualBudgets = [];
        if (isset($data['project_id'])) {
            $project = $this->projectRepository->find($data['project_id']);
            $annualBudgets = $project->fiscalYears->toArray();
        }

        $response['view'] = view('business.planning.plan_element.project.annual_budgets', [
            'years' => $data['years'],
            'annualBudgets' => $annualBudgets,
            'values' => isset($data['values']) ? $data['values'] : [],
            'inProgress' => isset($data['inProgress']) ? $data['inProgress'] : 0,
            'newYears' => isset($data['newYears']) ? $data['newYears'] : -1
        ])->render();

        return $response;
    }

    /**
     * Mostrar detalles de un proyecto
     *
     * @param int $id
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function showProject(int $id, Request $request)
    {

        $entity = $this->projectRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();
        $route = '';

        $annualBudgets = $entity->fiscalYears->toArray();

        self::getRoute($data['planElementId'], $route);

        $response['view'] = view('business.planning.plan_element.project.show', [
            'entity' => $entity,
            'route' => $route,
            'annualBudgets' => $annualBudgets,
            'responsibleUnits' => $this->departmentRepository->findAll()
        ])->render();

        return $response;
    }

    /**
     * Elimina lógicamente un proyecto de la base de datos
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function destroyProject(int $id, Request $request)
    {
        $response = $this->projectProcess->destroy($id, $request);

        return $response;
    }

    /**
     * Obtener el número de indicadores por umbrales
     *
     * @param Collection $objectives
     *
     * @return array
     */
    public function thresholdsIndicators(Collection $objectives)
    {
        $indicators = 0;
        $objectives_indicators = collect([]);
        $objectives_name_array = collect([]);
        $objectives_array = collect([]);
        $count_warning_array = collect([]);
        $count_success_array = collect([]);
        $count_danger_array = collect([]);
        foreach ($objectives as $objective) {
            $indicators += count($objective->indicators);
            $totalGoal = 0;
            $totalActualValue = 0;
            $count_danger = 0;
            $count_warning = 0;
            $count_success = 0;
            $toleranceMin = 0;
            $toleranceMax = 0;
            $objectives_array->push($objective->code);
            $objectives_name_array->push([$objective->description]);
            foreach ($objective->indicators as $indicator) {
                if ($indicator->planIndicatorGoals->count()) {
                    if ($indicator->type === PlanIndicator::TYPE_ASCENDING) {
                        if ($indicator->goal_type === PlanIndicator::TYPE_DISCREET) {
                            $indicatorGoals = $indicator->planIndicatorGoals->where('year', '<=', Carbon::now()->year);
                            foreach ($indicatorGoals as $indicatorGoal) {
                                $totalGoal += floatval($indicatorGoal->goal_value);
                                if ($indicatorGoal->actual_value) {
                                    $totalActualValue += floatval($indicatorGoal->actual_value);
                                } else {
                                    $totalActualValue = 0;
                                }
                            }
                            if ($totalActualValue > 0 && $totalGoal > 0) {
                                $percentage = floatval(($totalActualValue * 100) / $totalGoal);
                                $thresholds = $this->thresholdRepository->getThreshold($percentage, PlanIndicator::TYPE_ASCENDING);
                                if ($thresholds === PlanIndicator::TYPE_WARNING) {
                                    $count_warning++;
                                } else {
                                    if ($thresholds === PlanIndicator::TYPE_SUCCESS) {
                                        $count_success++;
                                    } else {
                                        $count_danger++;
                                    }
                                }
                            } else {
                                $count_danger++;
                            }
                        } else {
                            $indicatorGoals = $indicator->planIndicatorGoals->where('year', '=', Carbon::now()->year);
                            foreach ($indicatorGoals as $indicatorGoal) {
                                $totalGoal = floatval($indicatorGoal->goal_value);
                                if ($indicatorGoal->actual_value) {
                                    $totalActualValue = floatval($indicatorGoal->actual_value);
                                } else {
                                    $totalActualValue = 0;
                                }
                            }
                            if ($totalActualValue > 0 && $totalGoal > 0) {
                                $percentage = floatval(($totalActualValue * 100) / $totalGoal);
                                $thresholds = $this->thresholdRepository->getThreshold($percentage, PlanIndicator::TYPE_ASCENDING);
                                if ($thresholds === PlanIndicator::TYPE_WARNING) {
                                    $count_warning++;
                                } else {
                                    if ($thresholds === PlanIndicator::TYPE_SUCCESS) {
                                        $count_success++;
                                    } else {
                                        $count_danger++;
                                    }
                                }
                            } else {
                                $count_danger++;
                            }
                        }
                    } elseif ($indicator->type === PlanIndicator::TYPE_DESCENDING) {
                        if ($indicator->goal_type === PlanIndicator::TYPE_DISCREET) {
                            $indicatorGoals = $indicator->planIndicatorGoals->where('year', '<=', Carbon::now()->year);
                            foreach ($indicatorGoals as $indicatorGoal) {
                                $totalGoal += floatval($indicatorGoal->actual_value);
                                if ($indicatorGoal->actual_value) {
                                    $totalActualValue += floatval($indicatorGoal->goal_value);
                                } else {
                                    $totalActualValue = 0;
                                }
                            }
                            if ($totalActualValue > 0) {
                                $percentage = floatval(($indicatorGoal->baseLine - ($indicatorGoal->baseLine - $totalActualValue)) / (($indicatorGoal->baseLine - ($indicatorGoal->baseLine - $totalGoal))) * 100);
                                $thresholds = $this->thresholdRepository->getThreshold($percentage, PlanIndicator::TYPE_DESCENDING);
                                if ($thresholds === PlanIndicator::TYPE_WARNING) {
                                    $count_warning++;
                                } else {
                                    if ($thresholds === PlanIndicator::TYPE_SUCCESS) {
                                        $count_success++;
                                    } else {
                                        $count_danger++;
                                    }
                                }
                            } else {
                                $count_danger++;
                            }
                        } else {
                            $indicatorGoals = $indicator->planIndicatorGoals->where('year', '=', Carbon::now()->year);
                            foreach ($indicatorGoals as $indicatorGoal) {
                                if ($indicatorGoal->actual_value) {
                                    $totalActualValue = floatval($indicatorGoal->actual_value);
                                } else {
                                    $totalActualValue = 0;
                                }
                                $totalGoal = floatval($indicatorGoal->goal_value);
                            }
                            if ($totalActualValue > 0) {
                                $percentage = floatval((($indicatorGoal->baseLine - $totalActualValue) / ($indicatorGoal->baseLine - $totalGoal)) * 100);
                                $thresholds = $this->thresholdRepository->getThreshold($percentage, PlanIndicator::TYPE_DESCENDING);
                                if ($thresholds === PlanIndicator::TYPE_WARNING) {
                                    $count_warning++;
                                } else {
                                    if ($thresholds === PlanIndicator::TYPE_SUCCESS) {
                                        $count_success++;
                                    } else {
                                        $count_danger++;
                                    }
                                }
                            } else {
                                $count_danger++;
                            }
                        }
                    } else {
                        $indicatorGoals = $indicator->planIndicatorGoals->where('year', '=', Carbon::now()->year);
                        foreach ($indicatorGoals as $indicatorGoal) {
                            if ($indicatorGoal->actual_value) {
                                $totalActualValue = floatval($indicatorGoal->actual_value);
                            } else {
                                $totalActualValue = 0;
                            }
                            $toleranceMin = floatval($indicatorGoal->min);
                            $toleranceMax = floatval($indicatorGoal->max);
                        }
                        if ($totalActualValue > 0) {


                            if ($totalActualValue >= $toleranceMin && $totalActualValue <= $toleranceMax) {
                                $percentage = 0;
                            } else {
                                $percentage_max = floatval($totalActualValue * 100 / $toleranceMax);
                                $percentage_min = floatval($totalActualValue * 100 / $toleranceMin);
                                $deviation_percentage_max = abs($percentage_max - 100);
                                $deviation_percentage_min = abs($percentage_min - 100);

                                $measurement_value = $deviation_percentage_max;
                                if ($deviation_percentage_max > $deviation_percentage_min) {
                                    $measurement_value = floatval($deviation_percentage_min);
                                }
                                $percentage = floatval($measurement_value);
                            }
                            if ($percentage === 0) {

                            } else {
                                $thresholds = $this->thresholdRepository->getThreshold($percentage, PlanIndicator::TYPE_TOLERANCE);
                                if ($thresholds === PlanIndicator::TYPE_WARNING) {
                                    $count_warning++;
                                } else {
                                    if ($thresholds === PlanIndicator::TYPE_SUCCESS) {
                                        $count_success++;
                                    } else {
                                        $count_danger++;
                                    }
                                }
                            }
                        } else {
                            $count_danger++;
                        }
                    }
                }
            }
            $objective->success += $count_success;
            $objective->danger += $count_danger;
            $objective->warning += $count_warning;
            $count_danger_array->push($count_danger);
            $count_warning_array->push($count_warning);
            $count_success_array->push($count_success);
        }
        $objectives_indicators->push([
            'labels' => $objectives_array,
            'datasets' => array(
                [
                    'label' => trans('results_pei.labels.danger'),
                    'backgroundColor' => trans('results_pei.labels.color_danger'),
                    'data' => $count_danger_array
                ],
                [
                    'label' => trans('results_pei.labels.warning'),
                    'backgroundColor' => trans('results_pei.labels.color_warning'),
                    'data' => $count_warning_array
                ],
                [
                    'label' => trans('results_pei.labels.success'),
                    'backgroundColor' => trans('results_pei.labels.color_success'),
                    'data' => $count_success_array
                ]
            )
        ]);
        return [
            $indicators,
            $objectives_indicators,
            $objectives_name_array,
            $objectives
        ];
    }

    /**
     * Obtener data para crear los charts de indicadores
     *
     * @param Model $entity
     * @param string $year
     *
     * @return Collection
     */
    public function chartIndicators(Model $entity, string $year)
    {
        $indicators = $entity->indicators;
        $indicatorsData = collect([]);
        foreach ($indicators as $indicator) {
            if ($indicator->planIndicatorGoals->count()) {
                $indicatorsGoals = collect([]);
                $indicatorsActual = collect([]);
                $indicators_labels = collect([]);
                $indicatorsMin = collect([]);
                $indicatorsMax = collect([]);
                if ($indicator->type === PlanIndicator::TYPE_ASCENDING) {
                    if ($indicator->goal_type === PlanIndicator::TYPE_DISCREET) {
                        $indicatorGoals = $indicator->planIndicatorGoals->where('year', '<=', $year);
                        foreach ($indicatorGoals as $indicatorGoal) {
                            $indicatorsGoals->push(floatval($indicatorGoal->goal_value));
                            if ($indicatorGoal->actual_value) {
                                $indicatorsActual->push(floatval($indicatorGoal->actual_value));
                            } else {
                                $indicatorsActual->push(0);
                            }
                            $indicators_labels->push($indicatorGoal->year);
                        }
                    } else {
                        $indicatorGoals = $indicator->planIndicatorGoals->where('year', '<=', $year);
                        foreach ($indicatorGoals as $indicatorGoal) {
                            $indicatorsGoals->push(floatval($indicatorGoal->goal_value));
                            if ($indicatorGoal->actual_value) {
                                $indicatorsActual->push(floatval($indicatorGoal->actual_value));
                            } else {
                                $indicatorsActual->push(0);
                            }
                            $indicators_labels->push($indicatorGoal->year);
                        }
                    }
                    $thresholds = $this->thresholdRepository->findByType(PlanIndicator::TYPE_ASCENDING);
                } elseif ($indicator->type === PlanIndicator::TYPE_DESCENDING) {
                    if ($indicator->goal_type === PlanIndicator::TYPE_DISCREET) {
                        $indicatorGoals = $indicator->planIndicatorGoals->where('year', '<=', $year);
                        foreach ($indicatorGoals as $indicatorGoal) {
                            $indicatorsGoals->push(floatval($indicatorGoal->goal_value));
                            if ($indicatorGoal->actual_value) {
                                $indicatorsActual->push(floatval($indicatorGoal->actual_value));
                            } else {
                                $indicatorsActual->push(0);
                            }
                            $indicators_labels->push($indicatorGoal->year);
                        }
                    } else {
                        $indicatorGoals = $indicator->planIndicatorGoals->where('year', '<=', $year);
                        foreach ($indicatorGoals as $indicatorGoal) {
                            if ($indicatorGoal->actual_value) {
                                $indicatorsActual->push(floatval($indicatorGoal->actual_value));
                            } else {
                                $indicatorsActual->push(0);
                            }
                            $indicatorsGoals->push(floatval($indicatorGoal->goal_value));
                            $indicators_labels->push($indicatorGoal->year);
                        }
                    }
                    $thresholds = $this->thresholdRepository->findByType(PlanIndicator::TYPE_DESCENDING);
                } else {
                    $indicatorGoals = $indicator->planIndicatorGoals->where('year', '<=', $year);
                    foreach ($indicatorGoals as $indicatorGoal) {
                        if ($indicatorGoal->actual_value) {
                            $indicatorsActual->push(floatval($indicatorGoal->actual_value));
                        } else {
                            $indicatorsActual->push(0);
                        }
                        $indicatorsMin->push(floatval($indicatorGoal->min));
                        $indicatorsMax->push(floatval($indicatorGoal->max));
                        $indicators_labels->push($indicatorGoal->year);
                    }
                    $thresholds = $this->thresholdRepository->findByType(PlanIndicator::TYPE_TOLERANCE);
                }
                $indicatorsData->push([
                    'indicator_name' => $indicator->name,
                    'indicator_type' => $indicator->type,
                    'indicator_goal_type' => $indicator->goal_type,
                    'indicator_base_line' => $indicator->base_line,
                    'indicator_goal_description' => $indicator->goal_description,
                    'goal_values' => $indicatorsGoals,
                    'actual_values' => $indicatorsActual,
                    'indicators_labels' => $indicators_labels,
                    'thresholds' => $thresholds,
                    'min_values' => $indicatorsMin,
                    'max_values' => $indicatorsMax
                ]);
            }
        }
        return $indicatorsData;
    }

}
