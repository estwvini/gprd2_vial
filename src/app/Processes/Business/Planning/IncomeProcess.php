<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\BudgetItem;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\Income;
use App\Models\Business\Tracking\Proforma;
use App\Repositories\Repository\Business\Catalogs\BudgetClassifierRepository;
use App\Repositories\Repository\Business\Catalogs\FinancingSourceRepository;
use App\Repositories\Repository\Business\Catalogs\InstitutionRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\IncomeRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\SFGPROV\ProformaRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

/**
 * Clase IncomeProcess
 * @package App\Processes\Business\Planning
 */
class IncomeProcess
{
    /**
     * @var IncomeRepository
     */
    protected $planRepository;

    /**
     * @var BudgetClassifierRepository
     */
    protected $budgetClassifierRepository;

    /**
     * @var FinancingSourceRepository
     */
    protected $financingSourceRepository;

    /**
     * @var InstitutionRepository
     */
    protected $institutionRepository;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var BudgetAdjutmentProcess
     */
    protected $budgetAdjutmentProcess;

    /**
     * @var ProformaRepository
     */
    protected $proformaRepository;

    /**
     * Constructor de IncomeProcess.
     *
     * @param IncomeRepository $incomeRepository
     * @param BudgetClassifierRepository $budgetClassifierRepository
     * @param FinancingSourceRepository $financingSourceRepository
     * @param InstitutionRepository $institutionRepository
     * @param SettingRepository $settingRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param BudgetAdjutmentProcess $budgetAdjutmentProcess
     * @param ProformaRepository $proformaRepository
     */
    public function __construct(
        IncomeRepository $incomeRepository,
        BudgetClassifierRepository $budgetClassifierRepository,
        FinancingSourceRepository $financingSourceRepository,
        InstitutionRepository $institutionRepository,
        SettingRepository $settingRepository,
        FiscalYearRepository $fiscalYearRepository,
        BudgetAdjutmentProcess $budgetAdjutmentProcess,
        ProformaRepository $proformaRepository
    ) {
        $this->incomeRepository = $incomeRepository;
        $this->budgetClassifierRepository = $budgetClassifierRepository;
        $this->financingSourceRepository = $financingSourceRepository;
        $this->institutionRepository = $institutionRepository;
        $this->settingRepository = $settingRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->budgetAdjutmentProcess = $budgetAdjutmentProcess;
        $this->proformaRepository = $proformaRepository;
    }

    /**
     * Obtener la clase de IncomeProcess
     *
     * @return string
     */
    public function process()
    {
        return IncomeProcess::class;
    }

    /**
     * Carga información para mostrar en el index
     *
     * @param string $module
     *
     * @return array
     * @throws Exception
     */
    public function index(string $module)
    {
        $replicate = false;
        switch ($module) {
            case Income::MODULE['BUDGET']:
                $routes = [
                    'create' => route('create.income.budget.plans_management'),
                    'data' => route('data.index.income.budget.plans_management')
                ];

                $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
                $year = $fiscalYear ? $fiscalYear->year : Carbon::now()->addYear()->year;
                $replicate = count($this->incomeRepository->findAll(Income::MODULE['BUDGET'])) ? false : true;
                break;
            case Income::MODULE['PROGRAMMATIC_STRUCTURE']:
                $routes = [
                    'create' => route('create.income.programmatic_structure.execution'),
                    'data' => route('data.index.income.programmatic_structure.execution')
                ];

                $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
                $year = $fiscalYear ? $fiscalYear->year : Carbon::now()->year;
                $replicate = false;
                break;
        }

        return [
            'fiscal_year' => $year,
            'routes' => $routes,
            'module' => $module,
            'replicate' => $replicate
        ];
    }

    /**
     * Cargar información de ingresos.
     *
     * @param string $module
     *
     * @return mixed
     * @throws Exception
     */
    public function data(string $module)
    {
        $user = currentUser();
        $actions = [];
        $codified = [];
        $incomes = $this->incomeRepository->findAll($module);
        $totalAmount = 0;

        if ($incomes->count()) {
            switch ($module) {
                case Income::MODULE['BUDGET']:
                    $routes = [
                        'show' => 'show.income.budget.plans_management',
                        'edit' => 'edit.income.budget.plans_management',
                        'destroy' => 'destroy.income.budget.plans_management'
                    ];

                    $totalAmount = $incomes->sum('value');
                    break;
                case Income::MODULE['PROGRAMMATIC_STRUCTURE']:
                    $routes = [
                        'show' => 'show.income.programmatic_structure.execution',
                        'edit' => 'edit.income.programmatic_structure.execution',
                        'destroy' => 'destroy.income.programmatic_structure.execution'
                    ];

                    $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
                    $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
                    $codified = $this->proformaRepository->getCodifiedIncomes($fiscalYear, $sfgprov->company_code);

                    // Calculate codified total
                    $incomes->each(function ($item) use (&$totalAmount, $codified) {
                        $codifiedExpense = $codified->where('cuenta', $item->code);

                        if ($codifiedExpense->count()) {
                            $amount = (float)$codifiedExpense->first()->codified;
                            $totalAmount += $amount;
                        } else {
                            $totalAmount += $item->amount;
                        }
                    });

                    break;
            }

            if ($user->can('show.income.budget.plans_management|show.income.programmatic_structure.execution')) {
                $actions['search'] = [
                    'route' => $routes['show'],
                    'tooltip' => trans('income.labels.details')
                ];
            }

            if ($user->can('edit.income.budget.plans_management|edit.income.programmatic_structure.execution')) {
                $actions['edit'] = [
                    'route' => $routes['edit'],
                    'tooltip' => trans('income.labels.update')
                ];
            }

            if ($user->can('destroy.income.budget.plans_management|destroy.income.programmatic_structure.execution')) {
                $actions['trash'] = [
                    'route' => $routes['destroy'],
                    'tooltip' => trans('income.labels.delete'),
                    'confirm_message' => trans('income.messages.confirm.delete'),
                    'method' => 'delete',
                    'btn_class' => 'btn-danger'
                ];
            }
        }
        return DataTables::of($incomes)
            ->setRowId('id')
            ->addColumn('code', function (Income $entity) {
                return $entity->code;
            })
            ->addColumn('name', function (Income $entity) {
                return $entity->budget_classifier->title;
            })
            ->addColumn('budget_classifier', function (Income $entity) {
                return $entity->budget_classifier->full_code;
            })
            ->addColumn('financing_source', function (Income $entity) {
                return $entity->financing_source->code;
            })
            ->addColumn('institution', function (Income $entity) {
                return $entity->institution ? $entity->institution->code : null;
            })
            ->addColumn('value', function (Income $entity) use ($module, $codified) {

                if ($module === Income::MODULE['PROGRAMMATIC_STRUCTURE']) {
                    $codifiedIncome = $codified->where('cuenta', $entity->code)->first();
                    if ($codifiedIncome) {
                        return '$ ' . number_format($codifiedIncome->codified, 2, '.', ',');
                    }
                }

                return '$ ' . number_format($entity->value, 2, '.', ',');
            })
            ->addColumn('actions', function (Income $entity) use ($actions, $module, $codified) {

                if ($module === Income::MODULE['PROGRAMMATIC_STRUCTURE']) {
                    if ($codified->where('cuenta', $entity->code)->count()) {

                        return view('layout.partial.actions_tooltip', [
                            'entity' => $entity,
                            'actions' => []
                        ]);
                    }
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions', 'name', 'code', 'budget_classifier', 'financing_source', 'institution', 'value'])
            ->with('totalIncome', number_format($totalAmount, 2, '.', ','))
            ->make(true);
    }

    /**
     * Muestra el formulario de ingresos
     *
     * @param string $module
     *
     * @return array
     */
    public function create(string $module)
    {
        $budgetClassifierSettings = $this->settingRepository->findByKey('budget_classifier')->value;

        $budgetClassifiers = $this->budgetClassifierRepository->findLeafChildrenNodes(
            [
                $budgetClassifierSettings['current_income'],
                $budgetClassifierSettings['capital_income'],
                $budgetClassifierSettings['financing_income']
            ]
        );

        $alreadyTakenLoansBudgetClassifier = $this->incomeRepository->findAll($module)->pluck('budget_classifier_id')->toArray();

        $loansBudgetClassifiers = $this->budgetClassifierRepository->findLeafChildrenNodes(
            [
                $budgetClassifierSettings['financing_income']
            ], $alreadyTakenLoansBudgetClassifier);

        switch ($module) {
            case Income::MODULE['BUDGET']:
                $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
                $routes = [
                    'store' => route('store.create.income.budget.plans_management', ['module' => $module])
                ];
                break;
            case Income::MODULE['PROGRAMMATIC_STRUCTURE']:
                $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
                $routes = [
                    'store' => route('store.create.income.programmatic_structure.execution', ['module' => $module])
                ];
                break;
        }

        return [
            'budgetClassifiers' => $budgetClassifiers,
            'financingSources' => $this->financingSourceRepository->findByField('enabled', 1),
            'institutions' => $this->institutionRepository->findEnabled(),
            'loans' => $loansBudgetClassifiers,
            'fiscal_year' => $fiscalYear,
            'routes' => $routes,
            'module' => $module
        ];
    }

    /**
     * Almacenar un nuevo ingreso
     *
     * @param Request $request
     *
     * @return void
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if ($data['module'] == Income::MODULE['PROGRAMMATIC_STRUCTURE']) {
            $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        }

        $budgetClassifier = $this->budgetClassifierRepository->find($data['budget_classifier_id']);

        if (!$budgetClassifier) {
            throw new Exception(trans('budget_classifiers.messages.exceptions.not_found'), 1000);
        }

        $financingSource = $this->financingSourceRepository->find($data['financing_source_id']);

        if (!$financingSource) {
            throw new Exception(trans('financing_sources.messages.exceptions.not_found'), 1000);
        }

        $institutionCode = BudgetItem::CODE_9999999;
        if (isset($data['institution_id'])) {
            $institution = $this->institutionRepository->find($data['institution_id']);
            if ($institution) {
                $institutionCode = $institution->cleanCode();
            }
        }

        $data['code'] = "{$budgetClassifier->full_code}.{$financingSource->code}.{$data['distributor_code']}.{$institutionCode}";

        if ($this->incomeRepository->findByFields(['code' => $data['code'], 'fiscal_year_id' => $fiscalYear->id])->count()) {
            throw new Exception(trans('financing_sources.messages.exceptions.exist'), 1000);
        }

        $entity = $this->incomeRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('income.messages.errors.created'), 1000);
        }
    }

    /**
     * Muestra formulario de edición de un ingreso
     *
     * @param int $id
     * @param string $module
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id, string $module)
    {
        $entity = $this->incomeRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('income.messages.exceptions.not_found'), 1000);
        }

        $budgetClassifierSettings = $this->settingRepository->findByKey('budget_classifier')->value;

        $budgetClassifiers = $this->budgetClassifierRepository->findLeafChildrenNodes(
            [
                $budgetClassifierSettings['current_income'],
                $budgetClassifierSettings['capital_income'],
                $budgetClassifierSettings['financing_income']
            ]
        );

        $loansBudgetClassifiers = $this->budgetClassifierRepository->findLeafChildrenNodes(
            [
                $budgetClassifierSettings['financing_income']
            ], []);

        switch ($module) {
            case Income::MODULE['BUDGET']:
                $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
                $routes = [
                    'update' => route('update.edit.income.budget.plans_management', ['id' => $entity->id, 'module' => $module])
                ];
                break;
            case Income::MODULE['PROGRAMMATIC_STRUCTURE']:
                $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
                $routes = [
                    'update' => route('update.edit.income.programmatic_structure.execution', ['id' => $entity->id, 'module' => $module])
                ];
                break;
        }

        return [
            'entity' => $entity,
            'budgetClassifiers' => $budgetClassifiers,
            'financingSources' => $this->financingSourceRepository->findByField('enabled', 1),
            'institutions' => $this->institutionRepository->findEnabled(),
            'loans' => $loansBudgetClassifiers,
            'fiscal_year' => $fiscalYear,
            'routes' => $routes,
            'module' => $module
        ];

    }

    /**
     * Actualiza un ingreso en la BD
     *
     * @param Request $request
     * @param int $id
     *
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $entity = $this->incomeRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('income.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if ($data['module'] == Income::MODULE['PROGRAMMATIC_STRUCTURE']) {
            $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        }

        $budgetClassifier = $this->budgetClassifierRepository->find($data['budget_classifier_id']);

        if (!$budgetClassifier) {
            throw new Exception(trans('budget_classifiers.messages.exceptions.not_found'), 1000);
        }

        $financingSource = $this->financingSourceRepository->find($data['financing_source_id']);

        if (!$financingSource) {
            throw new Exception(trans('financing_sources.messages.exceptions.not_found'), 1000);
        }

        $institutionCode = BudgetItem::CODE_9999999;
        if (isset($data['institution_id'])) {
            $institution = $this->institutionRepository->find($data['institution_id']);
            if ($institution) {
                $institutionCode = $institution->cleanCode();
            }
        }

        $data['code'] = "{$budgetClassifier->full_code}.{$financingSource->code}.{$data['distributor_code']}.{$institutionCode}";

        if ($entity->code != $data['code'] && $this->incomeRepository->findByFields(['code' => $data['code'], 'fiscal_year_id' => $fiscalYear->id])->count()) {
            throw new Exception(trans('financing_sources.messages.exceptions.exist'), 1000);
        }

        $entity = $this->incomeRepository->updateFromArray($data, $entity);

        if (!$entity) {
            throw new Exception(trans('income.messages.errors.updated'), 1000);
        }

    }

    /**
     * Muestra los detalles de un ingreso
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function show(int $id)
    {
        $entity = $this->incomeRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('income.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity
        ];

    }

    /**
     * Elimina (lógicamente) un ingreso de la BD
     *
     * @param int $id
     * @param string $module
     *
     * @throws Exception
     */
    public function destroy(int $id, string $module)
    {

        $entity = $this->incomeRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('income.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->incomeRepository->customDestroy($entity->id, $module);

        if (!$entity) {
            throw new Exception(trans('income.messages.errors.updated'), 1000);
        }

    }

    /**
     * Construye la estructura del nuevo ingreso
     *
     * @param Income $income
     * @param FiscalYear $fiscalYear
     *
     * @return Collection
     */
    public function buildNewIncomeStructure(Income $income, FiscalYear $fiscalYear)
    {
        $currentLevel = Proforma::INCOME_LEVELS;
        $parentCode = getParentCode($income->code);
        $budgetClassifier = $income->budget_classifier;
        $source = $income->financing_source;

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        // Get all incomes structure from financial system database
        $proformaIncomes = $this->proformaRepository->getProformaIncomes($fiscalYear, $sfgprov->company_code);
        $incomesStructure = collect([]);

        $description = $income->justification ? $income->justification : $budgetClassifier->title;

        // Insert incomes into proforma
        $incomesStructure->push([
            'company_code' => $sfgprov->company_code,
            'year' => $fiscalYear->year,
            'code' => $income->code,
            'type' => Proforma::TYPE_INCOME,
            'description' => $description,
            'last_level' => Proforma::LAST_LEVEL,
            'level' => $currentLevel--,
            'parent_code' => $parentCode,
            'created_by' => $sfgprov->user_code
        ]);

        while ($currentLevel > 0) {

            // Validate if parent codes already exists in financial system database
            if ($proformaIncomes->where('cuenta', $parentCode)->count()) {
                break;
            }

            $description = '';

            switch ($currentLevel) {
                case '6': // Distribuidor
                    $description = $income->distributor_name;
                    break;
                case '5': // Fuente Financiamiento
                    $description = $source->description;
                    break;
                case '4':// Budget classifier element code
                case '3':// Budget classifier element code
                case '2':// Budget classifier element code
                case '1':// Budget classifier element code
                    $description = $budgetClassifier->title;
                    if ($budgetClassifier->parent) {
                        $budgetClassifier = $budgetClassifier->parent;
                    }
                    break;
            }
            // Insert tree into proforma
            $incomesStructure->push([
                'company_code' => $sfgprov->company_code,
                'year' => $fiscalYear->year,
                'code' => $parentCode,
                'type' => Proforma::TYPE_INCOME,
                'description' => $description,
                'last_level' => Proforma::NOT_LAST_LEVEL,
                'level' => $currentLevel--,
                'parent_code' => $parentCode = getParentCode($parentCode),
                'created_by' => $sfgprov->user_code
            ]);
        }

        return $incomesStructure;
    }

    /**
     * Duplicar presupuesto de ingresos
     */
    public function replicate()
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $nextFiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        $incomes = Income::where('fiscal_year_id', $fiscalYear->id)->get();

        foreach ($incomes as $income) {
            $newIncome = $income->replicate();
            $newIncome->fiscal_year_id = $nextFiscalYear->id;
            $newIncome->save();
        }
    }

    /**
     * Elimina todas las partidas de ingreso para el año fiscal que se está planificando
     */
    public function removeAll()
    {
        $nextFiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
        $incomes = Income::where('fiscal_year_id', $nextFiscalYear->id)->get();

        foreach ($incomes as $income) {
            $income->delete();
        }
    }

}
