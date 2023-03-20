<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\Planning\BudgetAdjustment;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\Prioritization;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Tracking\Operation;
use App\Models\Business\Tracking\Proforma;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\Planning\BudgetAdjustmentRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\IncomeRepository;
use App\Repositories\Repository\Business\Planning\PrioritizationRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Tracking\LocalOperationDetailsRepository;
use App\Repositories\Repository\Business\Tracking\LocalOperationsRepository;
use App\Repositories\Repository\Business\Tracking\LocalProformaRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\SFGPROV\ProformaRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase BudgetAdjutmentProcess
 * @package App\Processes\Business\Planning
 */
class BudgetAdjutmentProcess
{
    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var BudgetAdjustmentRepository
     */
    private $budgetAdjustmentRepository;

    /**
     * @var PrioritizationRepository
     */
    private $prioritizationRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var IncomeRepository
     */
    private $incomesRepository;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var LocalProformaRepository
     */
    private $localProformaRepository;

    /**
     * @var LocalOperationsRepository
     */
    private $localOperationsRepository;

    /**
     * @var LocalOperationDetailsRepository
     */
    private $localOperationDetailsRepository;

    /**
     * @var ProformaRepository
     */
    private $proformaRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * Constructor de BudgetAdjutmentProcess.
     *
     * @param BudgetAdjustmentRepository $budgetAdjustmentRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param PrioritizationRepository $priorizationRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param IncomeRepository $incomesRepository
     * @param BudgetItemRepository $budgetItemRepository
     * @param SettingRepository $settingRepository
     * @param LocalProformaRepository $localProformaRepository
     * @param LocalOperationsRepository $localOperationsRepository
     * @param LocalOperationDetailsRepository $localOperationDetailsRepository
     * @param ProformaRepository $proformaRepository
     */
    public function __construct(
        BudgetAdjustmentRepository $budgetAdjustmentRepository,
        FiscalYearRepository $fiscalYearRepository,
        PrioritizationRepository $priorizationRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        IncomeRepository $incomesRepository,
        BudgetItemRepository $budgetItemRepository,
        SettingRepository $settingRepository,
        LocalProformaRepository $localProformaRepository,
        LocalOperationsRepository $localOperationsRepository,
        LocalOperationDetailsRepository $localOperationDetailsRepository,
        ProformaRepository $proformaRepository
    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->budgetAdjustmentRepository = $budgetAdjustmentRepository;
        $this->prioritizationRepository = $priorizationRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->incomesRepository = $incomesRepository;
        $this->budgetItemRepository = $budgetItemRepository;
        $this->settingRepository = $settingRepository;
        $this->localProformaRepository = $localProformaRepository;
        $this->localOperationsRepository = $localOperationsRepository;
        $this->localOperationDetailsRepository = $localOperationDetailsRepository;
        $this->proformaRepository = $proformaRepository;
    }

    /**
     * Busca el ajuste de presupuesto para el año fiscal actual
     *
     * @return mixed
     * @throws Exception
     */
    public function findBudgetAdjutmentForCurrentFiscalYear()
    {
        $year = $this->fiscalYearRepository->findCurrentFiscalYear();
        if (!$year) {
            throw new Exception(trans('budget_item.messages.exceptions.no_current_fiscal_year_info'), 1000);
        }

        return $this->budgetAdjustmentRepository->findBudgetAdjutmentForFiscalYear($year->id);
    }

    /**
     * Busca el ajuste de presupuesto para el año fiscal siguiente
     *
     * @return mixed
     * @throws Exception
     */
    public function findBudgetAdjutmentForNextFiscalYear()
    {
        $year = $this->fiscalYearRepository->findNextFiscalYear();
        if (!$year) {
            throw new Exception(trans('budget_item.messages.exceptions.no_next_fiscal_year_info'), 1000);
        }

        return $this->budgetAdjustmentRepository->findBudgetAdjutmentForFiscalYear($year->id);
    }

    /**
     * Devuelve los gastos de inversion
     *
     * @param FiscalYear $fiscalYear
     *
     * @return int
     * @throws Exception
     */
    public function investmentExpenses(FiscalYear $fiscalYear)
    {
        $entities = $this->findBudgetAdjutmentForNextFiscalYear();

        return $this->budgetAdjustmentRepository->investmentExpenses($fiscalYear->id, $entities->all());
    }

    /**
     * Devuelve los gastos corrientes
     *
     * @param FiscalYear $fiscalYear
     *
     * @return int
     */
    public function currentExpenses(FiscalYear $fiscalYear)
    {
        return $this->budgetAdjustmentRepository->currentExpenses($fiscalYear->id);
    }

    /**
     * Devuelve los ingresos para un año fiscal
     *
     * @param FiscalYear $fiscalYear
     *
     * @return int
     */
    public function incomes(FiscalYear $fiscalYear)
    {
        $incomes = $this->incomesRepository->findByField('fiscal_year_id', $fiscalYear->id);

        return $incomes->sum('value');
    }

    /**
     * Cargar información de priorización de proyectos.
     *
     * @return mixed
     * @throws Exception
     */
    public function dataPrioritized()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('list.activities.projects.budget_adjustment.budget.plans_management')) {
            $actions['puzzle-piece'] = [
                'route' => 'list.activities.projects.budget_adjustment.budget.plans_management',
                'tooltip' => trans('projects.actions.activities'),
                'btn_class' => 'btn-success'
            ];
        }

        $budgets = $this->budgetAdjustmentRepository->findBudgetAdjutmentForFiscalYear($this->fiscalYearRepository->findNextFiscalYear()->id);

        if (!$this->isApproved($budgets)) {
            $entities = $this->prioritizationRepository->findPrioritizationsForFiscalYear($this->fiscalYearRepository->findNextFiscalYear()->id);
        } else {

            $ids = [];
            foreach ($budgets as $budget) {
                array_push($ids, $budget->prioritization_id);
            }
            $entities = $this->prioritizationRepository->findByIds($ids);
            $actions = [];
        }

        $dataTable = DataTables::of($entities)
            ->setRowId('id')
            ->addColumn('bulk_action', function (Prioritization $entity) {
                $disabledClass = $entity->projectFiscalYear->status === ProjectFiscalYear::STATUS_IN_PROGRESS ? 'disabled' : '';

                if (!count($this->budgetAdjustmentRepository->findByField('prioritization_id', $entity->id))) {
                    return "<input type='checkbox' name='table_records' class='bulk check-one' value='{$entity->projectFiscalYear->id}' {$disabledClass}/>";
                } else {
                    return "<input type='checkbox' name='table_records' checked class='bulk check-one' value='{$entity->projectFiscalYear->id}' {$disabledClass}/>";
                }
            })
            ->addColumn('name', function (Prioritization $entity) {
                return $entity->projectFiscalYear->project->name;
            })
            ->addColumn('referential_budget', function (Prioritization $entity) {
                return number_format($entity->projectFiscalYear->referential_budget, 2);
            })
            ->addColumn('value_budget', function (Prioritization $entity) {
                return number_format($this->budgetAdjustmentRepository->investmentExpensesPrioritization($entity->projectFiscalYear->fiscalYear->id, $entity), 2, '.', ',');
            })
            ->addColumn('actions', function (Prioritization $entity) use ($actions, $user) {

                if (isset($actions['puzzle-piece'])) {
                    $actions['puzzle-piece']['params'] = [
                        'projectId' => $entity->projectFiscalYear->project_id
                    ];
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['bulk_action', 'name', 'referential_budget', 'value_budget', 'actions'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Devuelve si el ajuste de presupuesto está o no aprobado
     *
     * @param $budgetAdjustments
     *
     * @return int
     */
    public function isApproved(Collection $budgetAdjustments)
    {
        $value = false;

        if (count($budgetAdjustments)) {
            foreach ($budgetAdjustments as $budgetAdjustment) {
                if ($budgetAdjustment->status == BudgetAdjustment::STATUS_APPROVED) {

                    $value = true;
                    break;
                }
            }
        }

        return $value;
    }

    /**
     * Actualizar el ajuste.
     *
     * @param Request $request
     * @param string $status
     *
     * @return mixed
     * @throws Throwable
     */
    public function update(Request $request, string $status)
    {
        $entities = $this->findBudgetAdjutmentForNextFiscalYear();

        if (!isset($request->ids)) {
            throw new Exception(trans('budget_adjustment.messages.exceptions.undefined_projects'), 1000);
        }

        if ((!isset($request->all()['balance']) || $request->all()['balance'] != 0) && $status == BudgetAdjustment::STATUS_APPROVED) {
            throw new Exception(trans('budget_adjustment.messages.exceptions.balance_not_cero'), 1000);
        }

        if (!is_null($entities)) {

            foreach ($entities as $entity) {

                $entity->delete();
            }
        }

        $this->budgetAdjustmentRepository->bulkCreate($status, $request->ids);

        $response['message'] = [
            'type' => 'success',
            'text' => trans('project_review.messages.success.updated_bulk')
        ];

        if ($status === BudgetAdjustment::STATUS_APPROVED) {
            try {
                $operation = $this->createProforma();

                $justification = storeJustification($request->all(), $operation);

                if (isset($justification)) {
                    $operation->justifications()->save($justification);
                }

            } catch (Exception $ex) {
                $this->adjustmentRollback($request);
                throw new Exception($ex->getMessage(), 1000);
            }

            $this->syncProforma();

            $response['message'] = [
                'type' => 'success',
                'text' => trans('budget_adjustment.messages.success.adjusted')
            ];
        }

        return $response;
    }

    /**
     * Revertir los cambios realizados cuando la aprobación del Ajuste Presupuestario falle.
     *
     * @param Request $request
     *
     * @throws Throwable
     */
    public function adjustmentRollback(Request $request)
    {
        $this->budgetAdjustmentRepository->bulkRollback($request->ids, $this->findBudgetAdjutmentForNextFiscalYear());
    }

    /**
     * Crear la proforma para el año fiscal.
     *
     * @return Operation
     * @throws Exception
     */
    public function createProforma()
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $incomes = $this->incomesRepository->findByFiscalYear($fiscalYear);
        $budgetItems = $this->budgetItemRepository->findByFiscalYear($fiscalYear, BudgetAdjustment::STATUS_APPROVED);

        return $this->budgetAdjustmentRepository->createProforma($incomes, $budgetItems, $fiscalYear);
    }

    /**
     * Crear el array vista previa de la proforma para el año fiscal.
     *
     * @return array
     * @throws Exception
     */
    public function previewProformaArray()
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $incomes = $this->incomesRepository->findByFiscalYear($fiscalYear);
        $budgetItems = $this->budgetItemRepository->findByFiscalYear($fiscalYear, BudgetAdjustment::STATUS_DRAFT);

        return $this->budgetAdjustmentRepository->previewProforma($incomes, $budgetItems, $fiscalYear);
    }

    /**
     * Sincronizar la proforma para el año fiscal con el sistema SFGPROV.
     *
     * @throws Throwable
     */
    public function syncProforma()
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        if (api_available()) { // TODO Call API

            if (!$this->proformaRepository->getFiscalYear($fiscalYear, $sfgprov->company_code)) {
                throw new Exception(trans('budget_adjustment.messages.errors.create_proforma') . ' ' . trans('budget_adjustment.messages.exceptions.undefined_sfgprov_fiscal_year'),
                    1000);
            }

            if ($this->proformaRepository->proformaExists($fiscalYear, $sfgprov->company_code)) {
                throw new Exception(trans('budget_adjustment.messages.exceptions.sync_error') . ' ' . trans('budget_adjustment.messages.exceptions.proforma_exists',
                        ['year' => $fiscalYear->year]), 1000);
            }

            $proformas = $this->localProformaRepository->findByFiscalYear($fiscalYear);
            $operation = $this->localOperationsRepository->findByFiscalYear($fiscalYear)->first();
            $operationDetails = $this->localOperationDetailsRepository->findByFiscalYear($fiscalYear);

            $this->proformaRepository->syncProforma($proformas, $operation, $operationDetails);
        } else {
            $entity = null; // TODO Implementar en repositorio a la base local buscar por $id
        }

        $response['message'] = [
            'type' => 'success',
            'text' => trans('budget_adjustment.messages.success.proforma_synched')
        ];

        return $response;
    }

    /**
     * Verificar si el ajuste presupuestario fue sincronizado con el sistema SFGPROV.
     *
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function isBudgetAdjustmentSynched(FiscalYear $fiscalYear)
    {
        try {
            $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
            if (api_available()) { // TODO call api
                if ($this->proformaRepository->proformaExists($fiscalYear, $sfgprov->company_code)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } catch (Exception $ex) {
            return false;
        }
    }

    /**
     * Cargar información de la Proforma Presupuestaria.
     *
     * @return mixed
     * @throws Exception
     */
    public function previewProformaData()
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $proformaData = $this->localProformaRepository->findReportDataByFiscalYear($fiscalYear);

        $totalIncome = $proformaData->sum('income_amount') ?? 0;
        $totalExpense = $proformaData->sum('expense_amount') ?? 0;

        $dataTable = DataTables::of($proformaData)
            ->editColumn('type', function ($entity) {
                return $entity->type === Proforma::TYPE_INCOME ? trans('app.labels.income') : trans('app.labels.expense');
            })
            ->editColumn('income_amount', function ($entity) {
                return intval($entity->income_amount) === 0 ? '' : number_format($entity->income_amount, 2);
            })
            ->editColumn('expense_amount', function ($entity) {
                return intval($entity->expense_amount) === 0 ? '' : number_format($entity->expense_amount, 2);
            })
            ->rawColumns(['type', 'income_amount', 'expense_amount'])
            ->with('totalIncome', number_format($totalIncome, 2))
            ->with('totalExpense', number_format($totalExpense, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Cargar información de la Proforma Presupuestaria.
     *
     * @return mixed
     * @throws Exception
     */
    public function afterPreviewProformaData()
    {
        $dataPreview = '';

        try {
            $dataPreview = $this->previewProformaArray();
        } catch (Exception $ex) {
            throw new Exception($ex->getMessage(), 1000);
        }

        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $totalIncome = 0;
        $totalExpense = 0;

        foreach ($dataPreview as $dataDetail) {
            foreach ($dataDetail as $count => $value) {
                if ($count === 'expense_amount') {
                    $totalExpense += $value;
                }
                if ($count === 'income_amount') {
                    $totalIncome += $value;
                }
            }
        }

        $dataTable = DataTables::of(collect(array_reverse($dataPreview)))
            ->editColumn('income_amount', function ($entity) {
                return !isset($entity['income_amount']) ? '' : number_format($entity['income_amount'], 2);
            })
            ->editColumn('expense_amount', function ($entity) {
                return !isset($entity['expense_amount']) ? '' : number_format($entity['expense_amount'], 2);
            })
            ->rawColumns(['type', 'income_amount', 'expense_amount'])
            ->with('totalIncome', number_format($totalIncome, 2))
            ->with('totalExpense', number_format($totalExpense, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Retornar la información necesaria para mostrar la vista de proforma presupuestaria.
     *
     * @return array
     */
    public function previewProforma()
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
        return ['fiscalYear' => $fiscalYear->year];
    }

    /**
     * Obtiene los datos presupuestarios
     *
     * @return array
     * @throws Exception
     */
    public function loadBudgetSummary()
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
        $income = $fiscalYear ? $this->incomes($fiscalYear) : 0;
        $projectsValue = $fiscalYear ? $this->investmentExpenses($fiscalYear) : 0;
        $currentExpenses = $fiscalYear ? $this->currentExpenses($fiscalYear) : 0;
        $totalSpends = $projectsValue + $currentExpenses;
        $balance = $income - $totalSpends;

        return [
            'starValue' => number_format($income, 2, '.', ','),
            'totalSpends' => number_format($totalSpends, 2, '.', ','),
            'balance' => number_format($balance, 2, '.', ',')
        ];
    }
}
