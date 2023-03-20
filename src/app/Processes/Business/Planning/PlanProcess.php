<?php

namespace App\Processes\Business\Planning;

use App\Http\Controllers\Business\Planning\PlanController;
use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Project;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\PlanRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

/**
 * Clase PlanProcess
 * @package App\Processes\Business\Planning
 */
class PlanProcess
{

    /**
     * @var PlanRepository
     */
    protected $planRepository;

    /**
     * @var PlanElementRepository
     */
    protected $planElementRepository;

    /**
     * Constructor de PlanProcess.
     *
     * @param PlanRepository $planRepository
     * @param PlanElementRepository $planElementRepository
     */
    public function __construct(
        PlanRepository $planRepository,
        PlanElementRepository $planElementRepository
    ) {
        $this->planRepository = $planRepository;
        $this->planElementRepository = $planElementRepository;
    }


    /**
     * Obtener la clase de PlanProcess
     *
     * @return PlanProcess
     */
    public function process()
    {
        return PlanProcess::class;
    }


    /**
     * Mostrar listado de planes
     *
     * @return mixed
     * @throws Throwable
     */
    public function index()
    {
        $plans = $this->planRepository->findAll();

        collect($plans)->each(function ($plan) use (&$plans) {
            $statusPos = 0;

            $countElements = $this->planRepository->countPlanElements($plan);

            foreach ($countElements as $key => $element) {
                if ($key != 'additionalInfo' && $element > 0) {
                    $statusPos = 1;
                }
            }

            if ($statusPos == 1 && $countElements['additionalInfo']['OBJECTIVES_WITHOUT_INDICATORS'] == 0) {
                $statusPos = 2;

                if ($plan->scope == Plan::SCOPE_INSTITUTIONAL && (!$countElements['PROJECT'] || $countElements['additionalInfo']['OBJECTIVES_WITHOUT_PROJECTS'] || $countElements['additionalInfo']['PROGRAM_SUBPROGRAM_WITHOUT_PROJECTS'])) {
                    $statusPos = 1;
                }
            }

            if (in_array($plan->status, [Plan::STATUS_VERIFIED, Plan::STATUS_APPROVED]) && $countElements['additionalInfo']['NO_LINKED_INDICATORS']) {
                $statusPos = 1;
            }

            $plan->completness = Plan::STATUS_COLOR[$statusPos];
            $plan->elements = $countElements;

            //Set the confirm message for delete or archive
            $plan->confirmMessage = trans('plans.messages.confirm.archivePlan');

            if ($plan->type == Plan::TYPE_OTHER) {
                $plan->confirmMessage = trans('plans.messages.confirm.deleteOther');
            } elseif ($plan->type == Plan::TYPE_SECTORAL) {
                $plan->confirmMessage = trans('plans.messages.confirm.deleteSectoralPlan');
            }

        });

        $response['view'] = view('business.planning.plan.index', [
            'plans' => $plans
        ])->render();

        return $response;
    }

    /**
     * Mostrar el formulario de creación de un plan
     *
     * @param string $scope
     *
     * @return mixed
     * @throws Throwable
     */
    public function create(string $scope)
    {

        $planName = self::getPlanName($scope);
        $planAlreadyExists = false;

        if ($scope == Plan::SCOPE_INSTITUTIONAL) {
            $plan = $this->planRepository->findBy('type', Plan::TYPE_PEI);
            $planAlreadyExists = $plan ? true : false;
        } elseif ($scope == Plan::SCOPE_TERRITORIAL) {
            $plan = $this->planRepository->findBy('type', Plan::TYPE_PDOT);
            $planAlreadyExists = $plan ? true : false;
        }

        $now = Carbon::now();

        $response['view'] = view('business.planning.plan.create', [
            'scope' => $scope,
            'planName' => $planName,
            'planAlreadyExists' => $planAlreadyExists,
            'startYear' => $planAlreadyExists ? $plan->end_year + 1 : $now->year + 1
        ])->render();

        return $response;
    }

    /**
     * Almacenar un nuevo plan
     *
     * @param Request $request
     *
     * @return array
     * @throws Throwable
     */
    public function store(Request $request)
    {

        $data = $request->all();

        if (!isset($data['type_check'])) {
            if ($data['scope'] == Plan::SCOPE_TERRITORIAL) {
                $data['type'] = Plan::TYPE_SECTORAL;
            } elseif ($data['scope'] == Plan::SCOPE_INSTITUTIONAL) {
                $data['type'] = Plan::TYPE_PEI;
            } else {
                $data['type'] = Plan::TYPE_OTHER;
            }
        } else {
            $plan = $this->planRepository->findBy('type', $data['type']);

            if ($plan) {
                $data['incoming_plan'] = 1;
            }

        }

        $entity = $this->planRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('plans.messages.errors.create'), 1000);
        }

        $response = [
            'view' => view('business.planning.plan.update', [
                'entity' => $entity,
                'scope' => $entity->scope,
                'planName' => self::getPlanName($entity->scope),
                'fixedPlans' => Plan::FIXED_PLANS,
                'justifiable' => isJustifiable($entity),
                'draftPlan' => 0
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('plans.messages.success.created')
            ]
        ];


        return $response;
    }


    /**
     * Mostrar formulario de edición de un plan
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function edit(int $id)
    {
        $entity = $this->planRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $draftPlan = $this->planRepository->findByFields(['type' => $entity->type, 'incoming_plan' => 1])->first();

        if ($draftPlan && $draftPlan->id != $entity->id) {
            $draftPlan = 1;
        } else {
            $draftPlan = 0;
        }

        $response['view'] = view('business.planning.plan.update', [
            'entity' => $entity,
            'scope' => $entity->scope,
            'planName' => self::getPlanName($entity->scope),
            'fixedPlans' => Plan::FIXED_PLANS,
            'justifiable' => isJustifiable($entity),
            'draftPlan' => $draftPlan
        ])->render();

        return $response;
    }

    /**
     * Actualizar un plan
     *
     * @param Request $request
     * @param int $id
     *
     * @return array
     * @throws Throwable
     */
    public function update(Request $request, int $id)
    {
        $entity = $this->planRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();
        $justification = null;

        if (isset($data['justifiable']) && $data['justifiable']) {
            $justification = storeJustification($data, $entity);
        }

        if ($entity->status != Plan::STATUS_DRAFT && in_array($entity->type, [Plan::TYPE_PEI, Plan::TYPE_PDOT, Plan::TYPE_SECTORAL])) {
            unset($data['start_year']);
        }

        $entity = $this->planRepository->updateFromArray($data, $entity);

        if (!$entity) {
            throw new Exception(trans('plans.messages.errors.update'), 1000);
        }

        if (isset($data['justifiable']) && $data['justifiable'] && isset($justification)) {
            $entity->justifications()->save($justification);
        }

        $planController = resolve(PlanController::class);
        $response = $planController->index();

        $response->setData([
            'view' => $response->getData()->view,
            'message' => [
                'type' => 'success',
                'text' => trans('plans.messages.success.updated')
            ]
        ]);

        return $response;
    }

    /**
     * Eliminar un plan
     *
     * @param Request $request
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function destroy(Request $request, int $id)
    {
        $entity = $this->planRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $message = trans('plans.messages.success.archived');

        if (in_array($entity->type, [Plan::TYPE_OTHER, Plan::TYPE_SECTORAL])) {
            $message = trans('plans.messages.success.deleted');
        }

        DB::transaction(function () use ($request, $id, $entity) {

            if (!in_array($entity->type, [Plan::TYPE_OTHER, Plan::TYPE_SECTORAL])) {
                $entity = $this->planRepository->updateFromArray(['status' => Plan::STATUS_ARCHIVED], $entity);

                $this->planRepository->changeDraftPlanToMain($entity);
            }

            $data = $request->all();
            $justification = null;

            if (isset($data['justifiable']) && $data['justifiable']) {
                $justification = storeJustification($data, $entity);
            }

            if (!$this->planRepository->delete($entity)) {
                throw new Exception(trans('plans.messages.errors.delete'), 1000);
            }

            if (isset($data['justifiable']) && $data['justifiable'] && isset($justification)) {
                $entity->justifications()->save($justification);
            }

        }, 5);

        $planController = resolve(PlanController::class);
        $response = $planController->index();

        $response->setData([
            'view' => $response->getData()->view,
            'message' => [
                'type' => 'success',
                'text' => $message
            ]
        ]);

        return $response;
    }

    /**
     * Retorna el nombre del plan principal según su alcance
     *
     * @param $scope
     *
     * @return mixed
     */
    public function getPlanName($scope)
    {
        $planByScope = [
            Plan::SCOPE_SUPRANATIONAL => Plan::TYPE_ODS,
            Plan::SCOPE_NATIONAL => Plan::TYPE_PND,
            Plan::SCOPE_TERRITORIAL => Plan::TYPE_PDOT,
            Plan::SCOPE_INSTITUTIONAL => Plan::TYPE_PEI
        ];

        return $planByScope[$scope];
    }


    /**
     * Verifica si un tipo de plan esta activo
     *
     * @param Request $request
     *
     * @return string
     */
    public function checkType(Request $request)
    {
        $data = $request->all();

        if ($data['type_check'] === 'false') {
            return false;
        }
        $plans = $this->planRepository->findByFields(['type' => $data['type'], 'incoming_plan' => 0]);
        $draftPlan = $this->planRepository->findByFields(['type' => $data['type'], 'incoming_plan' => 1]);

        if ($draftPlan->count()) {
            return true;
        } elseif ($plans->count()) {
            $now = Carbon::now();

            $plan = $plans->first();

            if ($plan->end_year <= $now->year && in_array($plan->status, [Plan::STATUS_APPROVED, Plan::STATUS_VERIFIED])) {
                return false;
            }

            return true;

        } else {
            return false;
        }
    }

    /**
     * Verifica si el año de inicio de un PDOT o PEI es mayor al año de fin del plan anterior
     *
     * @param Request $request
     *
     * @return string
     */
    public function checkStartYear(Request $request)
    {
        $data = $request->all();

        if ($data['type_check'] === 'false') {
            return false;
        }

        $plan = $this->planRepository->findBy('type', $data['type']);

        if ($plan) {

            if ((int)$data['year'] == $plan->end_year + 1) {
                return false;
            }

            return true;

        } else {
            return false;
        }
    }

    /**
     * Carga la estructura inicial del árbol de un plan
     *
     * @param int $id
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function loadStructure(int $id, Request $request)
    {
        $data = $request->all();

        $entity = $this->planRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $routeName = $request->route()->getName();

        // Get the plan structure using eager loading
        $planStructure = $this->planRepository->getPlanStructure($entity);

        $user = currentUser();

        $permissions = [
            'create.plan_elements.plans.plans_management' => $user->can('create.plan_elements.plans.plans_management'),
            'show.plan_elements.plans.plans_management' => $user->can('show.plan_elements.plans.plans_management'),
            'edit.plan_elements.plans.plans_management' => $user->can('edit.plan_elements.plans.plans_management'),
            'destroy.plan_elements.plans.plans_management' => $user->can('destroy.plan_elements.plans.plans_management')
        ];

        $treeStructure = self::generateTreeStructure($planStructure->planElements, $entity, $permissions, [Plan::INITIAL_ELEMENT[$entity->scope][$entity->type]], $routeName);

        $response['view'] = view('business.planning.plan.load_structure', [
            'permission' => $routeName,
            'scope' => $entity->scope,
            'data' => $data,
            'json' => str_replace("\u0022", "\\\\\"", json_encode($treeStructure, JSON_HEX_APOS | JSON_HEX_QUOT))
        ])->render();

        return $response;
    }

    /**
     * Genera recursivamente los elementos de la estructura del árbol
     *
     * @param Collection $planStructure
     * @param Plan $plan
     * @param array $permissions
     * @param array $categories
     * @param string $routeName
     * @param PlanElement|null $parentElement
     *
     * @return array
     */
    private function generateTreeStructure(Collection $planStructure, Plan $plan, array $permissions, array $categories, string $routeName, PlanElement $parentElement = null)
    {
        $result = collect([]);

        foreach ($categories as $category) {

            // If it is projects category and is not institutional scope
            if ($category == PlanElement::TYPE_PROJECT && $plan->scope != Plan::SCOPE_INSTITUTIONAL) {
                continue;
            }

            $actions = [];
            $icon = [];

            if ($permissions['create.plan_elements.plans.plans_management'] && $routeName == 'loadstructure.edit.plans.plans_management') {

                $url = route('create.plan_elements.plans.plans_management', [
                    'element_type' => $category,
                    'parent_id' => $parentElement ? $parentElement->id : null,
                    'plan_id' => $plan->id,
                    'planType' => $plan->type
                ]);

                // If it is indicator category
                if ($category == PlanElement::TYPE_INDICATOR) {
                    $route = 'create.small.indicator.plan_elements.plans.plans_management';

                    // If the plan is PDOT SECTORAL or PEI
                    if ($plan->scope != Plan::SCOPE_NATIONAL && $plan->scope != Plan::SCOPE_SUPRANATIONAL) {
                        $route = 'create.full.indicator.plan_elements.plans.plans_management';
                    }

                    $url = route($route, ['planId' => $plan->id, 'planElementId' => $parentElement->id]);

                } elseif ($category == PlanElement::TYPE_PROJECT) { // If it is a project
                    $url = route('create.project.plan_elements.plans.plans_management', ['planElementId' => $parentElement->id, 'planId' => $plan->id]);
                }

                array_push($actions, [
                    'tooltip' => trans('app.labels.new'),
                    'icon' => 'glyphicon glyphicon-plus-sign green',
                    'action' => 'create',
                    'clickAction' => "$('html, body').animate({scrollTop: 455}, 500);",
                    'url' => $url,
                    'method' => 'GET',
                    'token' => csrf_token(),
                    'target' => '#load-area'
                ]);
            }

            if ($parentElement) {

                // Remove elements based on plan scope
                if ($parentElement->type == PlanElement::TYPE_OBJECTIVE && !in_array($category, PlanElement::OBJECTIVE_FILTER[$plan->scope])) {
                    continue;
                }

                if ($category == PlanElement::TYPE_INDICATOR) {
                    // Get objective indicators
                    $elements = $parentElement->indicators;

                } elseif ($category == PlanElement::TYPE_PROJECT) {
                    // Get subprogram projects
                    $elements = $parentElement->projects;

                } else {
                    // Get plan element children
                    $elements = $parentElement->children->where('type', $category);

                }
            } else {
                $elements = $planStructure;
            }

            if (!$elements->count() && !in_array($category,
                    [PlanElement::TYPE_THRUST, PlanElement::TYPE_RISK, PlanElement::TYPE_POLICY, PlanElement::TYPE_STRATEGY, PlanElement::TYPE_GOAL])) {
                $icon['class'] = 'glyphicon glyphicon-alert orange';
                $icon['tooltip'] = trans('plan_elements.messages.warning.empty.' . $category);
            } else {
                switch ($category) {
                    case PlanElement::TYPE_OBJECTIVE:
                        $icon = self::checkObjectivesWarnings($plan, $elements);
                        break;
                    case PlanElement::TYPE_PROGRAM:
                        $icon = self::checkProgramsWarnings($elements);
                        break;
                    case PlanElement::TYPE_SUBPROGRAM:
                        $icon = self::checkSubprogramsWarnings($elements);
                        break;
                }
            }

            $childrenStructure = self::getChildrenStructure($elements, $plan, $permissions, $category, $routeName, $parentElement);

            if (($plan->scope === Plan::SCOPE_NATIONAL || $plan->scope === Plan::SCOPE_SUPRANATIONAL) && $category === PlanElement::TYPE_INDICATOR) {
                $text = '<b>' . trans('plan_elements.labels.scope_national_supranational') . '</b>';
            } else {
                $text = '<b>' . trans('plan_elements.titles.' . $category) . '</b>';
            }

            if ($category == PlanElement::TYPE_PROJECT) {
                $text = $text . ' <i role="button" data-toggle="tooltip" data-placement="top"' .
                    'data-original-title="' . trans('plans.labels.projectsTooltip') .
                    '" class="fa fa-info-circle blue"></i>';
            }

            $structure = [
                'icon' => $icon,
                'text' => $text,
                'id' => $category,
                'actions' => $actions,
                'status' => [
                    'open' => ($category == PlanElement::TYPE_THRUST || $category == PlanElement::TYPE_OBJECTIVE) ? true : false
                ],
                'children' => $childrenStructure
            ];

            $result->push($structure);
        }

        return $result->toArray();

    }

    /**
     * Obtener estructura de nodos hijos de cada elemento de un plan
     *
     * @param Collection $elements
     * @param Plan $plan
     * @param array $permissions
     * @param string $category
     * @param string $routeName
     * @param PlanElement $parentElement
     *
     * @return array
     */
    private function getChildrenStructure(
        Collection $elements,
        Plan $plan,
        array $permissions,
        string $category,
        string $routeName,
        PlanElement $parentElement = null
    ) {
        return $elements->map(function ($element) use ($category, $plan, $parentElement, $permissions, $routeName) {

            $actions = [];
            $icon = [];

            if ($permissions['destroy.plan_elements.plans.plans_management'] && $routeName == 'loadstructure.edit.plans.plans_management') {

                $url = route('destroy.plan_elements.plans.plans_management', ['id' => $element->id]);

                // If the element is not an indicator
                if ($element instanceof PlanIndicator) {
                    $route = 'destroy.small.indicator.plan_elements.plans.plans_management';

                    // If the plan is PDOT SECTORAL or PEI
                    if ($plan->scope != Plan::SCOPE_NATIONAL && $plan->scope != Plan::SCOPE_SUPRANATIONAL) {
                        $route = 'destroy.full.indicator.plan_elements.plans.plans_management';
                    }

                    $url = route($route, ['id' => $element->id]);
                } elseif ($element instanceof Project) {
                    $url = route('destroy.project.plan_elements.plans.plans_management', ['id' => $element->id]);
                }

                $confirmMessage = trans('plan_elements.messages.confirm.deleteNoIndicators', ['element' => trans('plan_elements.labels.' . $category)]);

                if ($element instanceof PlanIndicator || ($element instanceof PlanElement && ($element->type == PlanElement::TYPE_THRUST || $element->type == PlanElement::TYPE_OBJECTIVE))) {
                    $confirmMessage = trans('plan_elements.messages.confirm.delete', ['element' => trans('plan_elements.labels.' . $category)]);
                }

                $options = [
                    'tooltip' => trans('app.labels.delete'),
                    'icon' => 'glyphicon glyphicon-minus-sign red',
                    'action' => 'destroy',
                    'url' => $url,
                    'method' => 'POST',
                    'confirm' => $confirmMessage,
                    'postAction' => "$('#load-area').empty();",
                    'reload' => [
                        'url' => route('loadstructure.edit.plans.plans_management', ['id' => $plan->id]),
                        'method' => 'GET',
                        'target' => '#load-tree'
                    ],
                    'token' => csrf_token(),
                    'target' => '#load-area'
                ];

                if (isJustifiable($plan)) {
                    $options['message'] = $options['confirm'];
                    $options['justify'] = true;
                    $options['description'] = trans('justifications.actions.delete');
                    unset($options['confirm']);
                }

                array_push($actions, $options);
            }

            if ($permissions['edit.plan_elements.plans.plans_management'] && $routeName == 'loadstructure.edit.plans.plans_management') {

                $url = route('edit.plan_elements.plans.plans_management', [
                    'id' => $element->id,
                    'element_type' => $category,
                    'parent_id' => $parentElement ? $parentElement->id : null,
                    'plan_id' => $plan->id,
                    'planType' => $plan->type
                ]);

                // If the element is not an indicator
                if ($element instanceof PlanIndicator) {
                    $route = 'edit.small.indicator.plan_elements.plans.plans_management';

                    // If the plan is PDOT SECTORAL or PEI
                    if ($plan->scope != Plan::SCOPE_NATIONAL && $plan->scope != Plan::SCOPE_SUPRANATIONAL) {
                        $route = 'edit.full.indicator.plan_elements.plans.plans_management';
                    }

                    $url = route($route, [
                        'id' => $element->id,
                        'planElementId' => $parentElement->id,
                        'planId' => $plan->id
                    ]);
                } elseif ($element instanceof Project) {
                    $url = route('edit.project.plan_elements.plans.plans_management', ['id' => $element->id, 'planElementId' => $parentElement->id, 'planId' => $plan->id]);
                }

                array_push($actions, [
                    'tooltip' => trans('app.labels.edit'),
                    'icon' => 'fa fa-edit orange',
                    'action' => 'edit',
                    'clickAction' => "$('html, body').animate({scrollTop: 455}, 500);",
                    'url' => $url,
                    'method' => 'GET',
                    'token' => csrf_token(),
                    'target' => '#load-area'
                ]);
            }

            if ($permissions['show.plan_elements.plans.plans_management']) {

                $url = route('show.plan_elements.plans.plans_management', [
                    'id' => $element->id,
                    'planType' => $plan->type
                ]);

                // If the element is not an indicator
                if ($element instanceof PlanIndicator) {
                    $route = 'show.small.indicator.plan_elements.plans.plans_management';

                    // If the plan is PDOT SECTORAL or PEI
                    if ($plan->scope != Plan::SCOPE_NATIONAL && $plan->scope != Plan::SCOPE_SUPRANATIONAL) {
                        $route = 'show.full.indicator.plan_elements.plans.plans_management';
                    }

                    $url = route($route, [
                        'id' => $element->id,
                        'planElementId' => $parentElement->id
                    ]);
                } elseif ($element instanceof Project) {
                    $url = route('show.project.plan_elements.plans.plans_management', ['id' => $element->id, 'planElementId' => $parentElement->id]);
                }

                array_push($actions, [
                    'tooltip' => trans('app.labels.details'),
                    'icon' => 'fa fa-search blue',
                    'action' => 'show',
                    'clickAction' => "$('html, body').animate({scrollTop: 455}, 500);",
                    'url' => $url,
                    'method' => 'GET',
                    'token' => csrf_token(),
                    'target' => '#load-area'
                ]);
            }

            if ($element instanceof PlanIndicator) {
                if ($plan->scope === Plan::SCOPE_NATIONAL || $plan->scope === Plan::SCOPE_SUPRANATIONAL) {
                    $text = trans('plan_elements.labels.scope_national_supranational') . ' - ' . $element->name . ' - ' . $element->description;
                } else {
                    $text = trans('plan_elements.labels.INDICATOR') . ' - ' . $element->name . ' - ' . $element->description;
                }
            } elseif ($element instanceof Project) {
                $text = trans('plan_elements.labels.PROJECT') . ' - ' . $element->cup . ' - ' . $element->name;
            } else {
                $text = trans('plan_elements.labels.' . $element->type) . ' - ' . Str::limit($element->code, 3, '...') . ' - ' . $element->description;
            }

            switch ($category) {
                case PlanElement::TYPE_OBJECTIVE:
                    $icon = self::checkObjectiveWarnings($element);
                    break;
                case PlanElement::TYPE_PROGRAM:
                    $icon = self::checkProgramWarnings($element);
                    break;
                case PlanElement::TYPE_SUBPROGRAM:
                    $icon = self::checkSubprogramWarnings($element);
                    break;
            }

            return [
                'text' => preg_replace('/\s+/', ' ', trim($text)),
                'icon' => $icon,
                'tooltip' => preg_replace('/\s+/', ' ', trim($text)),
                'id' => $element->id,
                'actions' => $actions,
                'status' => [
                    'open' => ($category == PlanElement::TYPE_THRUST) ? true : false
                ],
                'children' => ($element instanceof PlanIndicator || $element instanceof Project) ? [] : self::generateTreeStructure(collect([]), $plan, $permissions,
                    PlanElement::NEXT_ELEMENT[$category], $routeName, $element)
            ];
        })->values()->toArray();

    }

    /**
     * Mapea toda la estructura del plan para encontrar alertas
     *
     * @param Plan $plan
     * @param Collection $objectives
     *
     * @return array
     */
    private function checkObjectivesWarnings(Plan $plan, Collection &$objectives)
    {
        $noIndicator = false;
        $noProject = false;

        $objectives->each(function ($objective) use (&$noIndicator, &$noProject, $plan) {

            if (!$objective->indicators->count()) {
                $noIndicator = true;
                $objective->noIndicator = true;
            }

            if ($plan->scope == Plan::SCOPE_INSTITUTIONAL) {
                if ($objective->children->where('type', PlanElement::TYPE_PROGRAM)->count()) {
                    $objective->children->where('type', PlanElement::TYPE_PROGRAM)->each(function ($program) use (&$noProject, &$objective) {
                        if ($program->children->count()) {
                            $program->children->each(function ($subprogram) use (&$noProject, &$program, &$objective) {
                                if (!$subprogram->projects->count()) {
                                    $noProject = true;
                                    $program->noProject = true;
                                    $subprogram->noProject = true;
                                    $objective->noProject = true;
                                }
                            });
                        } else {
                            $noProject = true;
                            $program->noProject = true;
                            $objective->noProject = true;
                        }
                    });
                } else {
                    $noProject = true;
                    $objective->noProject = true;
                }
            }

        });

        if ($noIndicator && $noProject) {
            return [
                'class' => 'glyphicon glyphicon-alert orange',
                'tooltip' => trans('plan_elements.messages.warning.noIndicatorsProjectsGeneral')
            ];
        } elseif ($noIndicator) {
            return [
                'class' => 'glyphicon glyphicon-alert orange',
                'tooltip' => trans('plan_elements.messages.warning.noIndicatorsGeneral')
            ];
        } elseif ($noProject) {
            return [
                'class' => 'glyphicon glyphicon-alert orange',
                'tooltip' => trans('plan_elements.messages.warning.noProjectsGeneral', ['element' => trans('plan_elements.titles.OBJECTIVE')])
            ];
        } else {
            return [
                'class' => 'glyphicon glyphicon-ok green',
                'tooltip' => null
            ];
        }
    }

    /**
     * Verifica alertas de la categoría programas
     *
     * @param Collection $programs
     *
     * @return array
     */
    private function checkProgramsWarnings(Collection $programs)
    {
        if ($programs->where('noProject', true)->count()) {
            return [
                'class' => 'glyphicon glyphicon-alert orange',
                'tooltip' => trans('plan_elements.messages.warning.noProjectsGeneral', ['element' => trans('plan_elements.titles.PROGRAM')])
            ];
        } else {
            return [
                'class' => 'glyphicon glyphicon-ok green',
                'tooltip' => null
            ];
        }
    }

    /**
     * Verifica alertas de la categoría Subprogramas
     *
     * @param Collection $subprograms
     *
     * @return array
     */
    private function checkSubprogramsWarnings(Collection $subprograms)
    {
        if ($subprograms->where('noProject', true)->count()) {
            return [
                'class' => 'glyphicon glyphicon-alert orange',
                'tooltip' => trans('plan_elements.messages.warning.noProjectsGeneral', ['element' => trans('plan_elements.titles.SUBPROGRAM')])
            ];
        } else {
            return [
                'class' => 'glyphicon glyphicon-ok green',
                'tooltip' => null
            ];
        }
    }

    /**
     * Verifica las alertas de un Objetivo
     *
     * @param PlanElement $objective
     *
     * @return array
     */
    private function checkObjectiveWarnings(PlanElement $objective)
    {
        if ($objective->noIndicator && $objective->noProject) {
            return [
                'class' => 'glyphicon glyphicon-alert orange',
                'tooltip' => trans('plan_elements.messages.warning.noIndicatorsProjectsIndividual')
            ];
        } elseif ($objective->noIndicator) {
            return [
                'class' => 'glyphicon glyphicon-alert orange',
                'tooltip' => trans('plan_elements.messages.warning.noIndicatorsIndividual')
            ];
        } elseif ($objective->noProject) {
            return [
                'class' => 'glyphicon glyphicon-alert orange',
                'tooltip' => trans('plan_elements.messages.warning.noProjectsIndividual', ['element' => trans('plan_elements.labels.OBJECTIVE')])
            ];
        } else {
            return [
                'class' => 'glyphicon glyphicon-ok green',
                'tooltip' => null
            ];
        }
    }

    /**
     * Verifica las alertas de un Programa
     *
     * @param PlanElement $program
     *
     * @return array
     */
    private function checkProgramWarnings(PlanElement $program)
    {
        if ($program->noProject) {
            return [
                'class' => 'glyphicon glyphicon-alert orange',
                'tooltip' => trans('plan_elements.messages.warning.noProjectsProgram')
            ];
        } else {
            return [
                'class' => 'glyphicon glyphicon-ok green',
                'tooltip' => null
            ];
        }
    }

    /**
     * Verifica las alertas de un Subprograma
     *
     * @param PlanElement $subprogram
     *
     * @return array
     */
    private function checkSubprogramWarnings(PlanElement $subprogram)
    {
        if ($subprogram->noProject) {
            return [
                'class' => 'glyphicon glyphicon-alert orange',
                'tooltip' => trans('plan_elements.messages.warning.noProjectsIndividual', ['element' => trans('plan_elements.labels.SUBPROGRAM')])
            ];
        } else {
            return [
                'class' => 'glyphicon glyphicon-ok green',
                'tooltip' => null
            ];
        }
    }

    /**
     * Mostrar un plan para su verificación o aprobación
     *
     * @param int $id
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function approve(int $id, Request $request)
    {
        $data = $request->all();

        $entity = $this->planRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $allowApproval = false;
        $approvalType = Plan::STATUS_APPROVED;

        if ($entity->scope == Plan::SCOPE_TERRITORIAL) {
            $approvalType = Plan::STATUS_VERIFIED;

            if (isset($data['no_indicators']) && $data['no_indicators'] == 0) {
                $allowApproval = true;
            }
        } elseif ($entity->scope == Plan::SCOPE_INSTITUTIONAL) {
            if ((isset($data['no_indicators']) && $data['no_indicators'] == 0) && (isset($data['projects']) && $data['projects'] > 0)) {
                $allowApproval = true;
            }
        }

        $response['view'] = view('business.planning.plan.approve', [
            'entity' => $entity,
            'scope' => $entity->scope,
            'allowApproval' => $allowApproval,
            'approvalType' => $approvalType
        ])->render();

        return $response;
    }

    /**
     * Cambiar estado de un plan luego de su aprobación o verificación
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     * @throws Exception
     */
    public function changeStatus(int $id, Request $request)
    {
        $data = $request->all();

        $entity = $this->planRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $justification = storeJustification($data, $entity);

        $entity = $this->planRepository->updateFromArray($data, $entity);

        if (!$entity) {
            throw new Exception(trans('plans.messages.errors.update'), 1000);
        }

        if (isset($justification)) {
            $entity->justifications()->save($justification);
        }

        $planController = resolve(PlanController::class);
        $response = $planController->index();

        $response->setData([
            'view' => $response->getData()->view,
            'message' => [
                'type' => 'success',
                'text' => trans('plans.messages.success.' . $data['status'])
            ]
        ]);

        return $response;
    }

    /**
     * Duplica objetivos e indicadores de un PEI anterior
     *
     * @param Plan $plan
     */
    public function replicatePEI(Plan $plan)
    {
        $oldPei = Plan::where([
            ['type', '=', Plan::TYPE_PEI],
            ['status', '=', Plan::STATUS_APPROVED],
            ['end_year', '<', $plan->start_year],
        ])->orderBy('end_year', 'desc')->first();

        if ($oldPei) {
            $objectives = $oldPei->planElements()->where('type', PlanElement::TYPE_OBJECTIVE)->with('indicators.planIndicatorGoals')->get();

            $objectives->each(function ($objective) use ($plan) {
                $newObj = $objective->replicate();
                $newObj->plan_id = $plan->id;
                $newObj->save();
                $newObj = $newObj->fresh();

                $objective->indicators->each(function ($indicator) use ($newObj) {
                    $newIndicator = $indicator->replicate();
                    $newIndicator->indicatorable_id = $newObj->id;
                    $newIndicator->save();
                });
            });
        }
    }

    /**
     * Duplica objetivos e indicadores de un PDOT anterior
     *
     * @param Plan $plan
     */
    public function replicatePDYOT(Plan $plan)
    {
        $oldPlan = Plan::where([
            ['type', '=', Plan::TYPE_PDOT],
            ['status', '=', Plan::STATUS_VERIFIED],
            ['end_year', '<', $plan->start_year],
        ])->orderBy('end_year', 'desc')->first();

        if ($oldPlan) {
            $thrusts = $oldPlan->planElements()->where('type', PlanElement::TYPE_THRUST)->with([
                'children' => function ($q) {
                    $q->where('type', PlanElement::TYPE_OBJECTIVE);
                    $q->with('indicators.planIndicatorGoals');
                }
            ])->get();

            $thrusts->each(function ($thrust) use ($plan) {
                $newThrust = $thrust->replicate();
                $newThrust->plan_id = $plan->id;
                $newThrust->save();
                $newThrust = $newThrust->fresh();

                $thrust->children->each(function ($objective) use ($newThrust) {
                    $newObj = $objective->replicate();
                    $newObj->parent_id = $newThrust->id;
                    $newObj->save();
                    $newObj = $newObj->fresh();

                    $objective->indicators->each(function ($indicator) use ($newObj) {
                        $newIndicator = $indicator->replicate();
                        $newIndicator->indicatorable_id = $newObj->id;
                        $newIndicator->save();
                    });
                });
            });
        }
    }
}
