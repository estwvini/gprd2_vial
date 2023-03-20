<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\OperationalGoal;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\OperationalGoalsRepository;
use App\Repositories\Repository\Business\PlanRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Throwable;

/**
 * Clase OperationalGoalsProcess
 * @package App\Processes\Business\Planning
 */
class OperationalGoalsProcess
{
    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var PlanElementRepository
     */
    protected $planElementRepository;

    /**
     * @var OperationalGoalsRepository
     */
    protected $operationalGoalsRepository;

    /**
     * @var MeasureUnitRepository
     */
    protected $measureUnitRepository;

    /**
     * @var PlanIndicatorProcess
     */
    protected $planIndicatorProcess;

    /**
     * @var PlanIndicatorRepository
     */
    protected $planIndicatorRepository;

    /**
     * @var PlanRepository
     */
    protected $planRepository;

    /**
     * Constructor de OperationalGoalsProcess.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     * @param PlanElementRepository $planElementRepository
     * @param OperationalGoalsRepository $operationalGoalsRepository
     * @param MeasureUnitRepository $measureUnitRepository
     * @param PlanIndicatorProcess $planIndicatorProcess
     * @param PlanIndicatorRepository $planIndicatorRepository
     * @param PlanRepository $planRepository
     */
    public function __construct(
        FiscalYearRepository $fiscalYearRepository,
        PlanElementRepository $planElementRepository,
        OperationalGoalsRepository $operationalGoalsRepository,
        MeasureUnitRepository $measureUnitRepository,
        PlanIndicatorProcess $planIndicatorProcess,
        PlanIndicatorRepository $planIndicatorRepository,
        PlanRepository $planRepository
    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->planElementRepository = $planElementRepository;
        $this->operationalGoalsRepository = $operationalGoalsRepository;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->planIndicatorProcess = $planIndicatorProcess;
        $this->planIndicatorRepository = $planIndicatorRepository;
        $this->planRepository = $planRepository;
    }

    /**
     * Carga información para mostrar en el index
     *
     * @return array
     * @throws Exception
     */
    public function index()
    {
        $fiscal_year = $this->fiscalYearRepository->findNextFiscalYear();
        $checkPEI = $this->planRepository->getPlans(Plan::TYPE_PEI);
        $replicate = count(OperationalGoal::where('fiscal_year_id', $fiscal_year->id)->get()) ? false : true;

        return [
            'fiscalYear' => $fiscal_year ? $fiscal_year->year : Carbon::now()->addYear()->year,
            'checkPEI' => $checkPEI->count(),
            'replicate' => $replicate
        ];
    }

    /**
     * Carga la estructura inicial del árbol de objetivos operativos.
     *
     * @return mixed
     * @throws Throwable
     */
    public function loadStructure()
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        $peiObjectives = $this->planElementRepository->getOperationalGoalsStructure($fiscalYear);

        $user = currentUser();

        $permissions = [
            'create.operational_goals.plans_management' => $user->can('create.operational_goals.plans_management'),
            'show.operational_goals.plans_management' => $user->can('show.operational_goals.plans_management'),
            'edit.operational_goals.plans_management' => $user->can('edit.operational_goals.plans_management'),
            'destroy.operational_goals.plans_management' => $user->can('destroy.operational_goals.plans_management')
        ];

        $treeStructure = self::generateTreeStructure($peiObjectives, $permissions, $fiscalYear, [PlanElement::TYPE_OBJECTIVE]);

        $response['view'] = view('business.planning.operational_goals.load_structure', [
            'json' => str_replace("\u0022", "\\\\\"", json_encode($treeStructure, JSON_HEX_APOS | JSON_HEX_QUOT))
        ])->render();

        return $response;
    }

    /**
     * Genera la estructura base de categorias del árbol
     *
     * @param Collection $parents
     * @param array $permissions
     * @param FiscalYear $fiscalYear
     * @param array $categories
     * @param null $child
     *
     * @return array
     */
    public function generateTreeStructure(Collection $parents, array $permissions, FiscalYear $fiscalYear, array $categories, $child = null)
    {
        $result = collect([]);

        foreach ($categories as $category) {

            $actions = [];
            $children = collect([]);

            if ($child) {
                switch ($category) {
                    case OperationalGoal::TYPE_OPERATIONAL_GOAL:

                        if ($permissions['create.operational_goals.plans_management']) {

                            $url = route('create.operational_goals.plans_management', ['plan_element_id' => $child->id, 'fiscal_year_id' => $fiscalYear->id]);
                            $actions = [
                                [
                                    'tooltip' => trans('app.labels.new'),
                                    'icon' => 'glyphicon glyphicon-plus-sign green',
                                    'action' => 'create',
                                    'clickAction' => "$('html, body').animate({scrollTop: 0}, 500);",
                                    'url' => $url,
                                    'method' => 'GET',
                                    'token' => csrf_token(),
                                    'target' => '#load-area'
                                ]
                            ];
                        }

                        $children = $child->operationalGoals;
                        break;
                    case PlanElement::TYPE_INDICATOR:

                        $url = route('create.indicator.operational_goals.plans_management', ['operational_goal_id' => $child->id]);

                        $actions = [
                            [
                                'tooltip' => trans('app.labels.new'),
                                'icon' => 'glyphicon glyphicon-plus-sign green',
                                'action' => 'create',
                                'clickAction' => "$('html, body').animate({scrollTop: 0}, 500);",
                                'url' => $url,
                                'method' => 'GET',
                                'token' => csrf_token(),
                                'target' => '#load-area'
                            ]
                        ];

                        $children = $child->indicators;
                        break;
                }
            } else {
                $children = $parents;
            }

            $structure = [
                'icon' => [],
                'text' => '<b>' . trans('operational_goals.labels.' . $category) . '</b>',
                'id' => $category,
                'actions' => $actions,
                'status' => [
                    'open' => $category != PlanElement::TYPE_INDICATOR ? true : false
                ],
                'children' => self::getChildrenStructure($children, $category, $permissions, $fiscalYear)
            ];

            $result->push($structure);
        }

        return $result->toArray();
    }

    /**
     * Genera la estructura de elementos hijo de cada categoría del árbol
     *
     * @param Collection $children
     * @param string $category
     * @param array $permissions
     * @param FiscalYear $fiscalYear
     *
     * @return array
     */
    public function getChildrenStructure(Collection $children, string $category, array $permissions, FiscalYear $fiscalYear)
    {

        return $children->map(function ($child) use ($category, $permissions, $fiscalYear) {

            if ($child instanceof PlanElement) {
                $text = trans('operational_goals.titles.' . $category) . ' - ' . Str::limit($child->code, 3, '...') . ' - ' . $child->description;
            } elseif ($child instanceof OperationalGoal) {
                $confirmMessage = trans('operational_goals.messages.confirm.delete',
                    [
                        'type' => trans('operational_goals.titles.' . $category),
                        'warning' => trans('operational_goals.messages.confirm.delete_operational_goal')
                    ]
                );
                $text = trans('operational_goals.titles.' . $category) . ' - ' . Str::limit($child->code, 3, '...') . ' - ' . $child->name;
            } elseif ($child instanceof PlanIndicator) {
                $confirmMessage = trans('operational_goals.messages.confirm.delete',
                    [
                        'type' => trans('operational_goals.titles.' . $category),
                        'warning' => ''
                    ]
                );
                $text = trans('operational_goals.titles.' . $category) . ' - ' . Str::limit($child->name, 3, '...') . ' - ' . $child->description;
            }

            $actions = collect([]);

            if (!$child instanceof PlanElement) {

                $access = true;

                if ($child instanceof OperationalGoal && $permissions['destroy.operational_goals.plans_management']) {
                    $url = route('destroy.operational_goals.plans_management', ['id' => $child->id]);
                } elseif ($child instanceof PlanIndicator) {
                    $url = route('destroy.indicator.operational_goals.plans_management', ['id' => $child->id]);
                } else {
                    $access = false;
                }

                if ($access) {
                    $actions->push([
                        'tooltip' => trans('app.labels.delete'),
                        'icon' => 'glyphicon glyphicon-minus-sign red',
                        'action' => 'destroy',
                        'url' => $url,
                        'method' => 'DELETE',
                        'confirm' => $confirmMessage,
                        'postAction' => "$('#load-area').empty();",
                        'reload' => [
                            'url' => route('loadstructure.operational_goals.plans_management'),
                            'method' => 'GET',
                            'target' => '#load-tree'
                        ],
                        'token' => csrf_token(),
                        'target' => '#load-area'
                    ]);
                }

                $access = true;

                if ($child instanceof OperationalGoal && $permissions['edit.operational_goals.plans_management']) {
                    $url = route('edit.operational_goals.plans_management',
                        ['id' => $child->id, 'plan_element_id' => $child->plan_element_id, 'fiscal_year_id' => $fiscalYear->id]);
                } elseif ($child instanceof PlanIndicator) {
                    $url = route('edit.indicator.operational_goals.plans_management', ['id' => $child->id]);
                } else {
                    $access = false;
                }

                if ($access) {
                    $actions->push([
                        'tooltip' => trans('app.labels.edit'),
                        'icon' => 'fa fa-edit orange',
                        'action' => 'edit',
                        'clickAction' => "$('html, body').animate({scrollTop: 0}, 500);",
                        'url' => $url,
                        'method' => 'GET',
                        'token' => csrf_token(),
                        'target' => '#load-area'
                    ]);
                }

                $access = true;

                if ($child instanceof OperationalGoal && $permissions['show.operational_goals.plans_management']) {
                    $url = route('show.operational_goals.plans_management', ['id' => $child->id]);
                } elseif ($child instanceof PlanIndicator) {
                    $url = route('show.indicator.operational_goals.plans_management', ['id' => $child->id]);
                } else {
                    $access = false;
                }

                if ($access) {
                    $actions->push([
                        'tooltip' => trans('app.labels.details'),
                        'icon' => 'fa fa-search blue',
                        'action' => 'show',
                        'clickAction' => "$('html, body').animate({scrollTop: 0}, 500);",
                        'url' => $url,
                        'method' => 'GET',
                        'token' => csrf_token(),
                        'target' => '#load-area'
                    ]);
                }
            }

            return [
                'text' => preg_replace('/\s+/', ' ', trim($text)),
                'icon' => [],
                'tooltip' => preg_replace('/\s+/', ' ', trim($text)),
                'id' => $child->id,
                'actions' => $actions->toArray(),
                'status' => [
                    'open' => ($child instanceof PlanElement) ? true : false
                ],
                'children' => self::generateTreeStructure(collect([]), $permissions, $fiscalYear,
                    $child instanceof PlanIndicator ? [] : PlanElement::NEXT_ELEMENT_OPERATIONAL[$category], $child)
            ];

        })->values()->toArray();

    }

    /**
     * Mostrar el formulario de creación de un objetivo operativo
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function create(Request $request)
    {
        $data = $request->all();

        $response['view'] = view('business.planning.operational_goals.create', [
            'data' => $request->all(),
            'route' => '',
            'fiscal_year_id' => $data['fiscal_year_id'],
            'plan_element_id' => $data['plan_element_id']
        ])->render();

        return $response;
    }

    /**
     * Almacenar un nuevo objetivo operativo
     *
     * @param Request $request
     *
     * @return array
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $entity = $this->operationalGoalsRepository->createFromArray($request->all());

        if (!$entity) {
            throw new Exception(trans('operational_goals.messages.errors.create'), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('operational_goals.messages.success.created')
            ]
        ];

        return $response;
    }

    /**
     * Muestra un objetivo operativo
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function show(int $id)
    {
        $entity = $this->operationalGoalsRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('operational_goals.messages.exceptions.not_found'), 1000);
        }

        $response['view'] = view('business.planning.operational_goals.show', [
            'entity' => $entity,
            'route' => ''
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

        $entity = $this->operationalGoalsRepository->find($id);
        $data = $request->all();

        if (!$entity) {
            throw  new Exception(trans('operational_goals.messages.exceptions.not_found'), 1000);
        }

        $response['view'] = view('business.planning.operational_goals.update', [
            'entity' => $entity,
            'data' => $data,
            'route' => '',
            'fiscal_year_id' => $data['fiscal_year_id'],
            'plan_element_id' => $data['plan_element_id']
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
        $entity = $this->operationalGoalsRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('operational_goals.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();

        $entity = $this->operationalGoalsRepository->updateFromArray($data, $entity);

        if (!$entity) {
            throw new Exception(trans('operational_goals.messages.errors.update'), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('operational_goals.messages.success.updated')
            ]
        ];

        return $response;

    }

    /**
     * Eliminar un objetivo operativo
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->operationalGoalsRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('operational_goals.messages.exceptions.not_found'), 1000);
        }

        if (!$this->operationalGoalsRepository->delete($entity)) {
            throw new Exception(trans('operational_goals.messages.errors.delete'), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('operational_goals.messages.success.deleted')
            ]
        ];

        return $response;
    }

    /**
     * Mostrar el formulario completo de creación de un indicador.
     *
     * @param int $operational_goal_id
     *
     * @return mixed
     * @throws Throwable
     */
    public function createFullIndicator(int $operational_goal_id)
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        return [
            'measuringUnits' => $this->measureUnitRepository->findEnabled(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'operationalGoalId' => $operational_goal_id,
            'route' => '',
            'url' => 'update.edit.indicator.operational_goals.plans_management',
            'yearMeasurement' => date("Y"),
            'startYear' => $fiscalYear ? $fiscalYear->year : Carbon::now()->addYear()->year,
            'planType' => Plan::TYPE_PEI,
            'yearPlanning' => $fiscalYear ? $fiscalYear->year : Carbon::now()->addYear()->year,
            'justifiable' => false,
            'indicatorable' => PlanIndicator::INDICATORABLE_OPERATIONAL_GOAL
        ];
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
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
        $operational_goal = $this->operationalGoalsRepository->find($data['operational_goal_id']);

        if (isset($data['measurement_frequency_per_year'])) {
            $frequency = $data['measurement_frequency_per_year'];
        }

        $goalsCount = (date($fiscalYear->year) - date($fiscalYear->year)) * $frequency;
        if ($frequency > 1) {
            $goalsCount += 1;
        }
        $indicator = $this->planIndicatorProcess->storeFullIndicator($request, $operational_goal, $goalsCount, date($fiscalYear->year));

        if (!$indicator) {
            throw new Exception(trans('operational_goals.messages.errors.create_indicator'), 1000);
        }

        return $indicator;
    }

    /**
     * Mostrar formulario de edición de un indicador completo
     *
     * @param int $id
     *
     * @return array
     * @throws Throwable
     */
    public function editFullIndicator(int $id)
    {

        $entity = $this->planIndicatorRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('operational_goals.messages.exceptions.not_found_indicator'), 1000);
        }
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        return [
            'measuringUnits' => $this->measureUnitRepository->findEnabled(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'entity' => $entity,
            'route' => '',
            'url' => 'update.edit.indicator.operational_goals.plans_management',
            'yearMeasurement' => date("Y"),
            'startYear' => $fiscalYear ? $fiscalYear->year : Carbon::now()->addYear()->year,
            'planType' => Plan::TYPE_PEI,
            'yearPlanning' => $fiscalYear ? $fiscalYear->year : Carbon::now()->addYear()->year,
            'justifiable' => false,
            'status' => $entity->indicatorable->status,
            'indicatorable' => PlanIndicator::INDICATORABLE_OPERATIONAL_GOAL

        ];
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
        $entity = $this->planIndicatorRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('operational_goals.messages.exceptions.not_found_indicator'), 1000);
        }
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        $frequency = $entity->measurement_frequency_per_year;
        $data = $request->all();
        if (isset($data['measurement_frequency_per_year'])) {
            $frequency = $data['measurement_frequency_per_year'];
        }

        $goalsCount = (date($fiscalYear->year) - date($fiscalYear->year)) * $frequency;
        if ($frequency > 1) {
            $goalsCount += 1;
        }
        $indicator = $this->planIndicatorProcess->update($request, $id, $goalsCount, date($fiscalYear->year));

        if (!$indicator) {
            throw new Exception(trans('operational_goals.messages.errors.create_indicator'), 1000);
        }

        return $indicator;
    }

    /**
     * Muestra un indicador completo
     *
     * @param int $id
     *
     * @return array
     * @throws Throwable
     */
    public function showFullIndicator(int $id)
    {
        $entity = $this->planIndicatorRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('indicators.messages.exceptions.not_found'), 1000);
        }

        if (!is_null($entity->measurement_frequency_per_year)) {
            $measuring_frequency = (date("Y", strtotime($entity->indicatorable->date_end)) - date("Y",
                        strtotime($entity->indicatorable->date_init))) * $entity->measurement_frequency_per_year;
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

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        return [
            'measuringUnit' => isset($entity->measureUnit) ? $entity->measureUnit->name : '',
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'type' => $type,
            'goal_type' => $goal_type,
            'measuring_frequency' => $measuring_frequency,
            'entity' => $entity,
            'route' => '',
            'measuringUnits' => $this->measureUnitRepository->findEnabled(),
            'yearMeasurement' => date("Y"),
            'startYear' => $fiscalYear ? $fiscalYear->year : Carbon::now()->addYear()->year,
            'planType' => Plan::TYPE_PEI,
            'yearPlanning' => $fiscalYear ? $fiscalYear->year : Carbon::now()->addYear()->year,
            'justifiable' => false,
            'status' => $entity->indicatorable->status,
            'indicatorable' => PlanIndicator::INDICATORABLE_OPERATIONAL_GOAL,
            'indicatorId' => $id
        ];

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
        $this->planIndicatorProcess->destroy($id, $request);

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('operational_goals.messages.success.deletedIndicator')
            ]
        ];

        return $response;
    }

    /**
     * Duplicar objetivos operativos
     */
    public function replicate()
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $nextFiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        $objectives = OperationalGoal::where('fiscal_year_id', $fiscalYear->id)->with('indicators.planIndicatorGoals')->get();

        foreach ($objectives as $objective) {
            $newObj = $objective->replicate();
            $newObj->fiscal_year_id = $nextFiscalYear->id;
            $newObj->save();
            $newObj = $newObj->fresh();

            $indicators = $objective->getRelations()['indicators'];

            foreach ($indicators as $indicator) {
                $newIndicator = $indicator->replicate();
                $newIndicator->indicatorable_id = $newObj->id;
                $newIndicator->save();
                $newIndicator = $newIndicator->fresh();

                $goals = $indicator->getRelations()['planIndicatorGoals'];

                foreach ($goals as $goal) {
                    $newGoal = $goal->replicate();
                    $newGoal->plan_indicator_id = $newIndicator->id;
                    $newGoal->save();
                }
            }
        }
    }
}
