<?php

namespace App\Processes\Business\Planning;

use App\Events\ProgramAreaChanged;
use App\Models\Business\Planning\CurrentExpenditureElement;
use App\Models\Business\Planning\OperationalActivity;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\Catalogs\AreaRepository;
use App\Repositories\Repository\Business\Planning\CurrentExpenditureElementRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\OperationalActivityRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Reports\TrackingReportsRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Throwable;

/**
 * Clase CurrentExpenditureElementProcess
 * @package App\Processes\Business\Planning
 */
class CurrentExpenditureElementProcess
{
    /**
     * @var CurrentExpenditureElementRepository
     */
    protected $currentExpenditureElementRepository;

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var OperationalActivityRepository
     */
    protected $operationalActivityRepository;

    /**
     * @var DepartmentRepository
     */
    protected $departmentRepository;

    /**
     * @var AreaRepository
     */
    protected $areaRepository;

    /**
     * @var BudgetAdjutmentProcess
     */
    protected $budgetAdjutmentProcess;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var TrackingReportsRepository
     */
    private $trackingReportsRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * Constructor de CurrentExpenditureElementProcess.
     *
     * @param CurrentExpenditureElementRepository $currentExpenditureElementRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param OperationalActivityRepository $operationalActivityRepository
     * @param DepartmentRepository $departmentRepository
     * @param AreaRepository $areaRepository
     * @param BudgetAdjutmentProcess $budgetAdjutmentProcess
     * @param BudgetItemRepository $budgetItemRepository
     * @param TrackingReportsRepository $trackingReportsRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     */
    public function __construct(
        CurrentExpenditureElementRepository $currentExpenditureElementRepository,
        FiscalYearRepository $fiscalYearRepository,
        OperationalActivityRepository $operationalActivityRepository,
        DepartmentRepository $departmentRepository,
        AreaRepository $areaRepository,
        BudgetAdjutmentProcess $budgetAdjutmentProcess,
        BudgetItemRepository $budgetItemRepository,
        TrackingReportsRepository $trackingReportsRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository
    ) {
        $this->currentExpenditureElementRepository = $currentExpenditureElementRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->operationalActivityRepository = $operationalActivityRepository;
        $this->departmentRepository = $departmentRepository;
        $this->areaRepository = $areaRepository;
        $this->budgetAdjutmentProcess = $budgetAdjutmentProcess;
        $this->budgetItemRepository = $budgetItemRepository;
        $this->trackingReportsRepository = $trackingReportsRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
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

        $income = $fiscal_year ? $this->budgetAdjutmentProcess->incomes($fiscal_year) : 0;
        $projectsValue = $fiscal_year ? $this->budgetAdjutmentProcess->investmentExpenses($fiscal_year) : 0;
        $currentExpenses = $fiscal_year ? $this->budgetAdjutmentProcess->currentExpenses($fiscal_year) : 0;
        $totalSpends = $projectsValue + $currentExpenses;
        $balance = $income - $totalSpends;

        $replicate = true;
        $entity = $this->currentExpenditureElementRepository->findCurrentProgram($fiscal_year);
        if (isset($entity)) {
            $replicate = false;
        }

        return [
            'fiscalYear' => $fiscal_year ? $fiscal_year->year : Carbon::now()->addYear()->year,
            'starValue' => number_format($income, 2, '.', ','),
            'totalSpends' => number_format($totalSpends, 2, '.', ','),
            'balance' => number_format($balance, 2, '.', ','),
            'replicate' => $replicate
        ];
    }

    /**
     * Carga la estructura inicial del árbol de gasto corriente.
     *
     * @return mixed
     * @throws Throwable
     */
    public function loadStructure()
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        $currentExpenditureStructure = collect([]);

        if ($fiscalYear) {
            $entity = $this->currentExpenditureElementRepository->findCurrentProgram($fiscalYear);

            if (isset($entity)) {
                // Get the current expenditure structure using eager loading
                $currentExpenditureStructure = $currentExpenditureStructure->push($this->currentExpenditureElementRepository->getCurrentExpenditureStructure($entity));
            }
        }

        $user = currentUser();

        $permissions = [
            'create.current_expenditure_elements.budget.plans_management' => $user->can('create.current_expenditure_elements.budget.plans_management'),
            'edit.current_expenditure_elements.budget.plans_management' => $user->can('edit.current_expenditure_elements.budget.plans_management'),
            'destroy.current_expenditure_elements.budget.plans_management' => $user->can('destroy.current_expenditure_elements.budget.plans_management'),
            'show.current_expenditure_elements.budget.plans_management' => $user->can('show.current_expenditure_elements.budget.plans_management'),
            'index.items.operational_activities.current_expenditure_elements.budget.plans_management' => $user->can('index.items.operational_activities.current_expenditure_elements.budget.plans_management'),
            'index.budget_planning.current_expenditure_elements.budget.plans_management' => $user->can('index.budget_planning.current_expenditure_elements.budget.plans_management')
        ];

        $treeStructure = self::generateTreeStructure($currentExpenditureStructure, $entity ?? new CurrentExpenditureElement(), $permissions,
            CurrentExpenditureElement::INITIAL_ELEMENT);

        $response['view'] = view('business.planning.current_expenditure.load_structure', [
            'json' => str_replace("\u0022", "\\\\\"", json_encode($treeStructure, JSON_HEX_APOS | JSON_HEX_QUOT))
        ])->render();

        return $response;
    }

    /**
     * Genera recursivamente los elementos de la estructura del árbol.
     *
     * @param Collection $currentExpenditureStructure
     * @param CurrentExpenditureElement $element
     * @param array $permissions
     * @param string $category
     * @param CurrentExpenditureElement|null $parentElement
     *
     * @return array
     */
    private function generateTreeStructure(
        Collection $currentExpenditureStructure,
        CurrentExpenditureElement $element,
        array $permissions,
        string $category,
        CurrentExpenditureElement $parentElement = null
    ) {
        $result = collect([]);
        $actions = [];
        $icon = [];

        if ($parentElement) {

            if ($category == CurrentExpenditureElement::TYPE_OPERATIONAL_ACTIVITY) {
                // Get subprogram activities
                $elements = $parentElement->activities;

            } else {
                // Get current expense element children
                $elements = $parentElement->children->where('type', $category);
            }
        } else {
            $elements = $currentExpenditureStructure;
        }

        if ($permissions['create.current_expenditure_elements.budget.plans_management']) {

            $url = route('create.current_expenditure_elements.budget.plans_management', [
                'element_type' => $category,
                'parent_id' => $parentElement ? $parentElement->id : null
            ]);

            if ($category === CurrentExpenditureElement::TYPE_OPERATIONAL_ACTIVITY) {
                $url = route('create.operational_activities.current_expenditure_elements.budget.plans_management', [
                    'element_type' => $category,
                    'current_expenditure_element_id' => $parentElement ? $parentElement->id : null
                ]);
            }

            // Remove creation option for programs if there is one already created
            if ($category === CurrentExpenditureElement::TYPE_PROGRAM) {
                if (!$elements->count()) {
                    array_push($actions, [
                        'tooltip' => 'Agregar',
                        'icon' => 'glyphicon glyphicon-plus-sign green',
                        'action' => 'create',
                        'url' => $url,
                        'method' => 'GET',
                        'target' => '#load-area'
                    ]);
                }
            } else {
                array_push($actions, [
                    'tooltip' => 'Agregar',
                    'icon' => 'glyphicon glyphicon-plus-sign green',
                    'action' => 'create',
                    'url' => $url,
                    'method' => 'GET',
                    'target' => '#load-area'
                ]);
            }
        }

        if (!$elements->count()) {
            $icon['class'] = 'glyphicon glyphicon-alert orange';
            $icon['tooltip'] = trans('current_expenditure.messages.warning.empty.' . $category);
        } else {
            $icon['class'] = 'glyphicon glyphicon-ok green';
            $icon['tooltip'] = null;
        }

        $childrenStructure = self::getChildrenStructure($elements, $element, $permissions, $category, $parentElement);

        $structure = [
            'text' => '<b>' . trans('current_expenditure.titles.' . $category) . '</b>',
            'icon' => $icon,
            'id' => $category,
            'actions' => $actions,
            'status' => [
                'open' => true
            ],
            'children' => $childrenStructure
        ];

        $result->push($structure);

        return $result->toArray();

    }

    /**
     * Obtener estructura de nodos hijos de cada elemento de gasto corriente.
     *
     * @param Collection $elements
     * @param CurrentExpenditureElement $currentExpenditureElement
     * @param array $permissions
     * @param string $category
     * @param CurrentExpenditureElement $parentElement
     *
     * @return array
     */
    private function getChildrenStructure(
        Collection $elements,
        CurrentExpenditureElement $currentExpenditureElement,
        array $permissions,
        string $category,
        CurrentExpenditureElement $parentElement = null
    ) {
        return $elements->map(function ($element) use ($category, $currentExpenditureElement, $parentElement, $permissions) {

            $actions = [];
            $icon = [];

            if ($permissions['destroy.current_expenditure_elements.budget.plans_management']) {

                $url = route('destroy.current_expenditure_elements.budget.plans_management', ['id' => $element->id]);
                $confirmMessage = trans('current_expenditure.messages.confirm.delete', ['element' => trans('current_expenditure.labels.' . $category)]);


                // If the element is an operational activity
                if ($element instanceof OperationalActivity) {
                    $url = route('destroy.operational_activities.current_expenditure_elements.budget.plans_management', ['id' => $element->id]);
                    $confirmMessage = trans('operational_activities.messages.confirm.delete');
                }

                $options = [
                    'tooltip' => 'Eliminar',
                    'icon' => 'glyphicon glyphicon-minus-sign red',
                    'action' => 'destroy',
                    'url' => $url,
                    'method' => 'DELETE',
                    'confirm' => $confirmMessage,
                    'postAction' => "$('#load-area').empty();",
                    'reload' => [
                        'url' => route('loadstructure.current_expenditure_elements.budget.plans_management', ['id' => $currentExpenditureElement->id]),
                        'method' => 'GET',
                        'target' => '#load-tree'
                    ],
                    'token' => csrf_token(),
                    'target' => '#load-area'
                ];

                array_push($actions, $options);
            }

            if ($permissions['edit.current_expenditure_elements.budget.plans_management']) {

                $url = route('edit.current_expenditure_elements.budget.plans_management', [
                    'id' => $element->id,
                    'element_type' => $category,
                    'parent_id' => $parentElement ? $parentElement->id : null
                ]);

                // If the element is an operational activity
                if ($element instanceof OperationalActivity) {
                    $url = route('edit.operational_activities.current_expenditure_elements.budget.plans_management',
                        ['id' => $element->id, 'current_expenditure_element_id' => $parentElement->id]);
                }

                array_push($actions, [
                    'tooltip' => 'Editar',
                    'icon' => 'fa fa-edit orange',
                    'action' => 'edit',
                    'clickAction' => "$('html, body').animate({scrollTop: 0}, 500);",
                    'url' => $url,
                    'method' => 'GET',
                    'token' => csrf_token(),
                    'target' => '#load-area'
                ]);
            }

            if ($permissions['show.current_expenditure_elements.budget.plans_management']) {

                $url = route('show.current_expenditure_elements.budget.plans_management', ['id' => $element->id]);

                // If the element is an operational activity
                if ($element instanceof OperationalActivity) {
                    $url = route('show.operational_activities.current_expenditure_elements.budget.plans_management', ['id' => $element->id]);
                }

                array_push($actions, [
                    'tooltip' => 'Detalles',
                    'icon' => 'fa fa-search blue',
                    'action' => 'show',
                    'clickAction' => "$('html, body').animate({scrollTop: 0}, 500);",
                    'url' => $url,
                    'method' => 'GET',
                    'token' => csrf_token(),
                    'target' => '#load-area'
                ]);
            }

            if ($element instanceof OperationalActivity && $permissions['index.items.operational_activities.current_expenditure_elements.budget.plans_management']) {

                $url = route('index.items.operational_activities.current_expenditure_elements.budget.plans_management', ['activityId' => $element->id]);

                array_push($actions, [
                    'tooltip' => 'Partidas Presupuestarias',
                    'icon' => 'fa fa-money black',
                    'action' => 'items',
                    'clickAction' => "$('#sidebar-left').toggleClass('collapsed');$('#sidebar-right').toggleClass('hidden');$('.page-title').toggleClass('hidden');$('html, body').animate({scrollTop: 0}, 500);",
                    'url' => $url,
                    'method' => 'GET',
                    'token' => csrf_token(),
                    'target' => '#budget-items-area'
                ]);
            }

            // Add budget planning icon in subprogram items that have activities
            if ($element instanceof CurrentExpenditureElement
                && $element->type === CurrentExpenditureElement::TYPE_SUBPROGRAM
                && $permissions['index.budget_planning.current_expenditure_elements.budget.plans_management']
                && $element->activities->count()) {

                $url = route('index.budget_planning.current_expenditure_elements.budget.plans_management', ['subprogramId' => $element->id]);

                array_push($actions, [
                    'tooltip' => 'Planificación Presupuestaria',
                    'icon' => 'fa fa-puzzle-piece black',
                    'action' => 'budget',
                    'clickAction' => "$('#sidebar-left').toggleClass('collapsed');$('#sidebar-right').toggleClass('hidden');$('.page-title').toggleClass('hidden');$('html, body').animate({scrollTop: 0}, 500);",
                    'url' => $url,
                    'method' => 'GET',
                    'token' => csrf_token(),
                    'target' => '#budget-planning-area'
                ]);
            }

            $text = trans('current_expenditure.labels.' . $element->type) . ' - ' . Str::limit($element->code . ' - ' . $element->name);

            if ($element instanceof OperationalActivity) {
                $text = trans('operational_activities.labels.OPERATIONAL_ACTIVITY') . ' - ' . Str::limit($element->code . ' - ' . $element->name);
            }

            return [
                'text' => preg_replace('/\s+/', ' ', trim($text)),
                'icon' => $icon,
                'tooltip' => preg_replace('/\s+/', ' ', trim($text)),
                'id' => $element->id,
                'actions' => $actions,
                'status' => [
                    'open' => true
                ],
                'children' => ($element instanceof OperationalActivity) ? [] : self::generateTreeStructure(collect([]), $currentExpenditureElement, $permissions,
                    CurrentExpenditureElement::NEXT_ELEMENT[$category], $element)
            ];
        })->values()->toArray();
    }

    /**
     * Mostrar el formulario de creación de un elemento de gasto corriente.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function create(Request $request)
    {
        $data = $request->all();
        $route = '';

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        $currentProgram = $this->currentExpenditureElementRepository->findCurrentProgram($fiscalYear);

        if (isset($currentProgram) && $data['element_type'] === CurrentExpenditureElement::TYPE_PROGRAM) {
            throw new Exception(trans('current_expenditure.messages.exceptions.program_exists'), 1000);
        }

        if (isset($data['parent_id'])) {
            self::getRoute($data['parent_id'], $route);
        }

        if ($data['element_type'] === CurrentExpenditureElement::TYPE_PROGRAM) {
            $code = CurrentExpenditureElement::PROGRAM_DEFAULT_CODE;
        } else {
            $code = $this->currentExpenditureElementRepository->generateSubprogramCode($currentProgram->id);
        }

        $fiscal_year = $this->fiscalYearRepository->findNextFiscalYear();

        $response['view'] = view('business.planning.current_expenditure.create', [
            'route' => $route ?? '',
            'code' => $code,
            'type' => $data['element_type'],
            'parent_id' => $data['parent_id'] ?? '',
            'areas' => $this->areaRepository->findAll()->sortBy('code') ?? collect([]),
            'fiscalYear' => $fiscal_year ?: null
        ])->render();

        return $response;
    }

    /**
     * Construye la ruta de un elemento de gasto corriente.
     *
     * @param int $parentId
     * @param string|null $route
     *
     * @throws Exception
     */
    public function getRoute(int $parentId, string &$route = null)
    {
        $element = $this->currentExpenditureElementRepository->find($parentId);

        if (!$element) {
            throw new Exception(trans('current_expenditure.messages.exceptions.parent_not_found'), 1000);
        }

        $text = trans('current_expenditure.labels.' . $element->type) . ' - ' . Str::limit($element->code, 3, '...');

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
     * Almacenar un nuevo elemento de gasto corriente.
     *
     * @param Request $request
     *
     * @return array
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        $currentProgram = $this->currentExpenditureElementRepository->findCurrentProgram($fiscalYear);

        if ($data['type'] === CurrentExpenditureElement::TYPE_PROGRAM) {
            $data['code'] = CurrentExpenditureElement::PROGRAM_DEFAULT_CODE;
        } else {
            $data['code'] = $this->currentExpenditureElementRepository->generateSubprogramCode($currentProgram->id);
        }

        $entity = $this->currentExpenditureElementRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('current_expenditure.messages.errors.create', ['element' => trans('current_expenditure.labels' . $data['type'])]), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('current_expenditure.messages.success.create', ['element' => trans('current_expenditure.labels.' . $entity->type)])
            ]
        ];

        return $response;
    }

    /**
     * Mostrar un elemento especifico de gasto corriente.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function show(int $id)
    {
        $entity = $this->currentExpenditureElementRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('current_expenditure.messages.exceptions.element_not_found'), 1000);
        }

        $route = '';

        if ($entity->current_expenditure_element_id) {
            self::getRoute($entity->current_expenditure_element_id, $route);
        }

        $response['view'] = view('business.planning.current_expenditure.show', [
            'entity' => $entity,
            'route' => $route,
            'areas' => $this->areaRepository->findAll()->sortBy('code') ?? collect([])
        ])->render();

        return $response;
    }

    /**
     * Mostrar formulario de edición de un elemento de gasto corriente.
     *
     * @param int $id
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function edit(int $id, Request $request)
    {
        $entity = $this->currentExpenditureElementRepository->find($id);
        $data = $request->all();

        if (!$entity) {
            throw new Exception(trans('current_expenditure.messages.exceptions.not_found', ['element', trans('current_expenditure.labels' . $data['element_type'])]), 1000);
        }

        $route = '';

        if ($entity->parent_id) {
            self::getRoute($entity->parent_id, $route);
        }

        $response['view'] = view('business.planning.current_expenditure.update', [
            'entity' => $entity,
            'route' => $route,
            'type' => $data['element_type'],
            'parent_id' => $data['parent_id'] ?? '',
            'areas' => $this->areaRepository->findAll()->sortBy('code') ?? collect([])
        ])->render();

        return $response;
    }

    /**
     * Actualizar un elemento de gasto corriente.
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function update(int $id, Request $request)
    {
        $data = $request->all();

        $element = $this->currentExpenditureElementRepository->find($id);

        if (!$element) {
            throw new Exception(trans('current_expenditure.messages.exceptions.not_found', ['element' => trans('current_expenditure.labels' . $data['type'])]), 1000);
        }

        unset($data['code']);

        $entity = $this->currentExpenditureElementRepository->updateFromArray($data, $element);

        if (!$entity) {
            throw new Exception(trans('current_expenditure.messages.errors.update', ['element' => trans('current_expenditure.labels' . $data['type'])]), 1000);
        }

        if (isset($request['area_id']) && key_exists('area_id', $element->getChanges())) {
            event(new ProgramAreaChanged($entity->area->code, nextFiscalYear()->id));
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('current_expenditure.messages.success.update',
                    ['element' => trans('current_expenditure.labels.' . $entity->type)])
            ]
        ];

        return $response;
    }

    /**
     * Eliminar un elemento de gasto corriente.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->currentExpenditureElementRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('current_expenditure.messages.exceptions.not_found', ['element' => trans('current_expenditure.labels.' . $entity->type)]), 1000);
        }

        if ($entity->children()->count()) {
            throw new Exception(trans('current_expenditure.messages.exceptions.has_children', ['element' => trans('current_expenditure.labels.' . $entity->type)]), 1000);
        }

        if ($entity->type === CurrentExpenditureElement::TYPE_SUBPROGRAM && $entity->activities()->count()) {
            throw new Exception(trans('current_expenditure.messages.exceptions.has_activities', ['element' => trans('current_expenditure.labels.' . $entity->type)]), 1000);
        }

        $type = $entity->type;
        if (!$this->currentExpenditureElementRepository->destroy($entity->id)) {
            throw new Exception(trans('current_expenditure.messages.errors.delete'), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('current_expenditure.messages.success.delete', ['element' => trans('current_expenditure.labels.' . $type)])
            ]
        ];

        return $response;
    }

    /**
     * Mostrar el formulario de creación de actividad operativa.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function createOperationalActivity(Request $request)
    {
        $data = $request->all();
        $route = '';
        $code = $this->operationalActivityRepository->generateOperationalActivityCode($data['current_expenditure_element_id'] ?? null);

        if (isset($data['current_expenditure_element_id'])) {
            self::getRoute($data['current_expenditure_element_id'], $route);
        }

        $response['view'] = view('business.planning.current_expenditure.operational_activities.create', [
            'route' => $route ?? '',
            'code' => $code ?? '',
            'current_expenditure_element_id' => $data['current_expenditure_element_id'] ?? '',
            'departments' => $this->departmentRepository->findAll() ?? collect([])
        ])->render();

        return $response;
    }

    /**
     * Almacenar una nueva actividad operativa.
     *
     * @param Request $request
     *
     * @return array
     * @throws Throwable
     */
    public function storeOperationalActivity(Request $request)
    {
        $data = $request->all();
        $data['code'] = $this->operationalActivityRepository->generateOperationalActivityCode($data['current_expenditure_element_id'] ?? null);

        $entity = $this->operationalActivityRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('operational_activities.messages.errors.create'), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('operational_activities.messages.success.create')
            ]
        ];

        return $response;
    }

    /**
     * Mostrar una actividad operativa.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function showOperationalActivity(int $id)
    {
        $entity = $this->operationalActivityRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('operational_activities.messages.exceptions.not_found'), 1000);
        }

        $route = '';

        if ($entity->current_expenditure_element_id) {
            self::getRoute($entity->current_expenditure_element_id, $route);
        }

        $response['view'] = view('business.planning.current_expenditure.operational_activities.show', [
            'entity' => $entity,
            'route' => $route,
            'departments' => $this->departmentRepository->findAll() ?? collect([])
        ])->render();

        return $response;
    }

    /**
     * Mostrar formulario de edición de un elemento de actividad operativa.
     *
     * @param int $id
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function editOperationalActivity(int $id, Request $request)
    {
        $entity = $this->operationalActivityRepository->find($id);
        $data = $request->all();

        if (!$entity) {
            throw new Exception(trans('operational_activities.messages.exceptions.not_found'), 1000);
        }

        $route = '';

        if ($entity->current_expenditure_element_id) {
            self::getRoute($entity->current_expenditure_element_id, $route);
        }

        $response['view'] = view('business.planning.current_expenditure.operational_activities.update', [
            'entity' => $entity,
            'route' => $route,
            'current_expenditure_element_id' => $data['current_expenditure_element_id'] ?? '',
            'departments' => $this->departmentRepository->findAll() ?? collect([])
        ])->render();

        return $response;
    }

    /**
     * Actualizar un elemento de actividad operativa.
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function updateOperationalActivity(int $id, Request $request)
    {
        $data = $request->all();

        $entity = $this->operationalActivityRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('operational_activities.messages.exceptions.not_found'), 1000);
        }

        unset($data['code']);

        $entity = $this->operationalActivityRepository->updateFromArray($data, $entity);

        if (!$entity) {
            throw new Exception(trans('operational_activities.messages.errors.update'), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('operational_activities.messages.success.update')
            ]
        ];

        return $response;
    }

    /**
     * Eliminar un elemento de actividad operativa.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function destroyOperationalActivity(int $id)
    {
        $entity = $this->operationalActivityRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('operational_activities.messages.exceptions.not_found'), 1000);
        }

        if ($entity->budgetItems()->count()) {
            throw new Exception(trans('operational_activities.messages.exceptions.has_children'), 1000);
        }

        if (!$this->operationalActivityRepository->destroy($entity->id)) {
            throw new Exception(trans('operational_activities.messages.errors.delete'), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('operational_activities.messages.success.delete')
            ]
        ];

        return $response;
    }


    /**
     * Duplica el presupuesto de gasto permanente
     *
     * @throws Exception
     */
    public function replicateBudget()
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $nextFiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
        $entity = $this->currentExpenditureElementRepository->findCurrentProgram($fiscalYear);

        $originalProgram = $this->currentExpenditureElementRepository->getCurrentExpenditure($entity);

        $newProgram = $originalProgram->replicate();
        $newProgram->fiscal_year_id = $nextFiscalYear->id;
        $newProgram->save();
        $newProgram = $newProgram->fresh();
        $relations = $originalProgram->getRelations();

        $budgetCard = $this->trackingReportsRepository->budgetCard($fiscalYear->year, Carbon::now()->format('Y-m-d'), 1, 20, '=');

        foreach ($relations as $subPrograms) {
            foreach ($subPrograms as $subProgram) {
                $newSubProgram = $subProgram->replicate();
                $newSubProgram->parent_id = $newProgram->id;
                $newSubProgram->fiscal_year_id = $nextFiscalYear->id;
                $newSubProgram->save();
                $newSubProgram = $newSubProgram->fresh();

                $relations = $subProgram->getRelations();

                foreach ($relations as $activities) {
                    foreach ($activities as $activity) {
                        $newActivity = $activity->replicate();
                        $newActivity->current_expenditure_element_id = $newSubProgram->id;
                        $newActivity->save();
                        $newActivity = $newActivity->fresh();

                        $items = $activity->getRelations()['budgetItems'];

                        foreach ($items as $item) {
                            $encodedItem = $budgetCard->firstWhere('cuenta', $item->code);

                            $newItem = $item->replicate();
                            $newItem->operational_activity_id = $newActivity->id;
                            $newItem->fiscal_year_id = $nextFiscalYear->id;
                            $newItem->amount = $encodedItem ? $encodedItem->codificado : $item->amount;
                            $newItem->save();

                            $purchases = $item->getRelations()['publicPurchases'];
                            $plannings = $item->getRelations()['budgetPlannings'];

                            foreach ($purchases as $purchase) {
                                $newPurchase = $purchase->replicate();
                                $newPurchase->budget_item_id = $newItem->id;
                                $newPurchase->save();
                            }
                            foreach ($plannings as $planning) {
                                $newPlanning = $planning->replicate();
                                $newPlanning->budget_item_id = $newItem->id;
                                $newPlanning->save();
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Retorna la estructura completa del gasto permanente
     *
     * @return mixed
     * @throws Exception
     */
    public function download()
    {
        $nextFiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        return $this->budgetItemRepository->findCurrentExpenditureItems($nextFiscalYear->id);
    }

    /**
     * Elimina la estructura completa del gasto permanente
     *
     * @throws Exception
     */
    public function deleteAll()
    {
        $nextFiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        $program = $this->currentExpenditureElementRepository->findCurrentProgram($nextFiscalYear);

        if ($program) {
            $program->load([
                'children.activities.budgetItems.publicPurchases.budgetPlannings',
                'children.activities.budgetItems.budgetPlannings',
            ]);
            foreach ($program->children as $subProgram) {
                foreach ($subProgram->activities as $act) {
                    foreach ($act->budgetItems as $item) {
                        $item->delete();
                    }
                    $act->delete();
                }
                $subProgram->delete();
            }
            $program->delete();
        }
    }
}
