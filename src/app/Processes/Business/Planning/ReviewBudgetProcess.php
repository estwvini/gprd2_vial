<?php

namespace App\Processes\Business\Planning;

use App\Models\Admin\Department;
use App\Models\Business\BudgetItem;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\BudgetAdjustment;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\Catalogs\BudgetClassifierRepository;
use App\Repositories\Repository\Business\Catalogs\CompetenceRepository;
use App\Repositories\Repository\Business\Catalogs\FinancingSourceRepository;
use App\Repositories\Repository\Business\Catalogs\GeographicLocationRepository;
use App\Repositories\Repository\Business\Catalogs\InstitutionRepository;
use App\Repositories\Repository\Business\Catalogs\SpendingGuideRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\BudgetAdjustmentRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\OperationalActivityRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Reports\TrackingReportsRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Clase ReviewBudgetProcess
 * @package App\Processes\Business\Planning
 */
class ReviewBudgetProcess
{

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var BudgetAdjutmentProcess
     */
    protected $budgetAdjutmentProcess;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * Constructor de BudgetItemProcess.
     *
     * @param BudgetItemRepository $budgetItemRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(
        BudgetItemRepository $budgetItemRepository,
        FiscalYearRepository $fiscalYearRepository,
        DepartmentRepository $departmentRepository
    ) {
        $this->budgetItemRepository = $budgetItemRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Carga información para mostrar en el index.
     *
     * @return array
     */
    public function index(): array
    {
        $executingUnits = $this->departmentRepository->all();
        return [
            'executingUnits' => $executingUnits
        ];
    }

    /**
     * Crear un datatable con la información pertinente de partidas presupuestarias.
     *
     * @return mixed
     * @throws Exception
     */
    public function data(array $data)
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $items = $this->budgetItemRepository->getAllByYear($fiscalYear->id, $data);
        $total = $items->sum('amount');

        $expenseByType = $this->budgetItemRepository->getByExpenseType($fiscalYear->id, $data);

        return DataTables::of($items)
            ->setRowId('id')
            ->addColumn('bulk_action', function (BudgetItem $entity) {
                return "<input type='checkbox' name='table_records' class='bulk check-one' value='{$entity->id}'/>";
            })
            ->addColumn('code', function (BudgetItem $entity) {
                $url = route('edit.budget_review.plans_management', ['budgetItem' => $entity->id]);
                return "<a href='{$url}' class='blue ajaxify'>{$entity->code}</a>";
            })
            ->addColumn('name', function (BudgetItem $entity) {
                return $entity->name;
            })
            ->editColumn('activity', function (BudgetItem $entity) {
                return $entity->activityProjectFiscalYear ? $entity->activityProjectFiscalYear->name : $entity->operationalActivity->name;
            })
            ->editColumn('amount', function (BudgetItem $entity) {
                return number_format($entity->amount, 2);
            })
            ->with('total', number_format($total, 2))
            ->with('expenseByType', $expenseByType)
            ->rawColumns(['code', 'bulk_action'])
            ->make(true);
    }

    /**
     * Cambiar estado del proyecto
     *
     * @param array $ids
     * @param string $status
     *
     * @return array
     */
    public function bulkChange(array $ids, string $status): array
    {
        $entities = $this->budgetItemRepository->findIn('id', $ids);

        foreach ($entities as $entity) {
            $this->budgetItemRepository->updateFromArray(['status' => $status], $entity);
        }

        $response['message'] = [
            'type' => 'success',
            'text' => trans('budget_item.messages.success.updated_bulk')
        ];

        return $response;
    }

    /**
     * @throws Exception
     */
    public function all(array $data)
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $departmentName = '';
        if (isset($data['executing_unit'])) {
            $departmentName = $this->departmentRepository->find($data['executing_unit'])->name;
        }

        return [$this->budgetItemRepository->getAllByYear($fiscalYear->id, $data)->get(), $departmentName];
    }
}