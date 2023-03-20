<?php

namespace App\Processes\Business\Tracking;

use App\Models\Business\BudgetItem;
use App\Models\Business\Catalogs\GeographicLocation;
use App\Repositories\Repository\Business\Catalogs\GeographicLocationRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Tracking\BudgetProjectTrackingRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase BudgetProjectTrackingProcess
 * @package App\Processes\Business\Tracking
 */
class BudgetProjectTrackingProcess
{
    /**
     * @var ProjectFiscalYearRepository
     */
    protected $projectFiscalYearRepository;

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var BudgetProjectTrackingRepository
     */
    private $budgetProjectTrackingRepository;

    /**
     * @var GeographicLocationRepository
     */
    private $geographicLocationRepository;

    /**
     * Constructor de BudgetProjectTrackingProcess.
     *
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param BudgetProjectTrackingRepository $budgetProjectTrackingRepository
     * @param GeographicLocationRepository $geographicLocationRepository
     */
    public function __construct(
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        FiscalYearRepository $fiscalYearRepository,
        BudgetProjectTrackingRepository $budgetProjectTrackingRepository,
        GeographicLocationRepository $geographicLocationRepository
    ) {
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->budgetProjectTrackingRepository = $budgetProjectTrackingRepository;
        $this->geographicLocationRepository = $geographicLocationRepository;
    }

    /**
     * Crear un datatable con información de proyectos.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function data(int $id)
    {

        $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_project_tracking.messages.exceptions.project_fiscal_year_not_found'));
        }

        $budget_items = $this->budgetProjectTrackingRepository->findByProjectFiscalYearMonthly([$projectFiscalYear->id], $projectFiscalYear->fiscalYear);

        $totals = [
            'encoded' => 0,
            'accrued' => 0,
            'budget_execution' => 0,
            'months' => [
                'accrued' => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
            ]
        ];

        $projects = $this->budgetProjectTrackingRepository->getProjectBudgetProgress(new Collection([$projectFiscalYear]),
            [$projectFiscalYear->project->getProgramSubProgramCode()], $projectFiscalYear->fiscalYear->year);

        if (count($projects)) {
            $totals['encoded'] = $projects->get(0)->assigned + $projects->get(0)->reforms;
            $totals['accrued'] = $projects->get(0)->accrued;
            $totals['budget_execution'] = $projects->get(0)->budgetProgress;
        }

        $budget_items->each(function ($item) use (&$totals) {
            $totals['months']['accrued'][0] += $item->jan_accrued;
            $totals['months']['accrued'][1] += $item->feb_accrued;
            $totals['months']['accrued'][2] += $item->mar_accrued;
            $totals['months']['accrued'][3] += $item->apr_accrued;
            $totals['months']['accrued'][4] += $item->may_accrued;
            $totals['months']['accrued'][5] += $item->jun_accrued;
            $totals['months']['accrued'][6] += $item->jul_accrued;
            $totals['months']['accrued'][7] += $item->aug_accrued;
            $totals['months']['accrued'][8] += $item->sep_accrued;
            $totals['months']['accrued'][9] += $item->oct_accrued;
            $totals['months']['accrued'][10] += $item->nov_accrued;
            $totals['months']['accrued'][11] += $item->dec_accrued;
        });

        return DataTables::of($budget_items)
            ->setRowId('id')
            ->addColumn('activity', function (BudgetItem $entity) {
                return $entity->activityProjectFiscalYear->name;
            })
            ->addColumn('budget_item', function (BudgetItem $entity) {
                return $entity->name ? $entity->name . "<br>" . $entity->code : $entity->budgetClassifier->title . "<br>" . $entity->code;
            })
            ->addColumn('jan_accrued', function (BudgetItem $entity) {
                return number_format($entity->jan_accrued, 2);
            })
            ->addColumn('feb_accrued', function (BudgetItem $entity) {
                return number_format($entity->feb_accrued, 2);
            })
            ->addColumn('mar_accrued', function (BudgetItem $entity) {
                return number_format($entity->mar_accrued, 2);
            })
            ->addColumn('apr_accrued', function (BudgetItem $entity) {
                return number_format($entity->apr_accrued, 2);
            })
            ->addColumn('may_accrued', function (BudgetItem $entity) {
                return number_format($entity->may_accrued, 2);
            })
            ->addColumn('jun_accrued', function (BudgetItem $entity) {
                return number_format($entity->jun_accrued, 2);
            })
            ->addColumn('jul_accrued', function (BudgetItem $entity) {
                return number_format($entity->jul_accrued, 2);
            })
            ->addColumn('aug_accrued', function (BudgetItem $entity) {
                return number_format($entity->aug_accrued, 2);
            })
            ->addColumn('sep_accrued', function (BudgetItem $entity) {
                return number_format($entity->sep_accrued, 2);
            })
            ->addColumn('oct_accrued', function (BudgetItem $entity) {
                return number_format($entity->oct_accrued, 2);
            })
            ->addColumn('nov_accrued', function (BudgetItem $entity) {
                return number_format($entity->nov_accrued, 2);
            })
            ->addColumn('dec_accrued', function (BudgetItem $entity) {
                return number_format($entity->dec_accrued, 2);
            })
            ->addColumn('encoded', function (BudgetItem $entity) {
                return number_format($entity->assigned + $entity->reform, 2);
            })
            ->addColumn('accrued_aggregated', function (BudgetItem $entity) {
                if($entity->total_amount_accrued > 0){
                    $url = route('index.location.budget.progress.project_tracking.execution', ['id' => $entity->id]);
                    $class = ($entity->total_amount_accrued - $entity->total_budget_location) != 0 ? 'text-danger':'text-success';
                    return "<a href='{$url}' class='ajaxify text-underline {$class}'>" . number_format($entity->total_amount_accrued, 2) . "</a>";
                }
                return 0.00;
            })
            ->addColumn('budget_execution', function (BudgetItem $entity) {
                return ($entity->assigned + $entity->reform) > 0 ? number_format((($entity->total_amount_accrued * 100) / (($entity->assigned + $entity->reform))), 2) :
                    number_format(0, 2);
            })
            ->rawColumns(['budget_item', 'accrued_aggregated'])
            ->with('totals', $totals)
            ->make(true);
    }

    /**
     * Obtiene la información necesaria para exportar el avance presupuestario en excel.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function dataExport(int $id)
    {
        $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('budget_project_tracking.messages.exceptions.project_fiscal_year_not_found'));
        }

        $rows = self::data($id)->getData();
        setlocale(LC_TIME, 'es_ES.utf8');
        return [
            'rows' => $rows->data,
            'projectName' => $projectFiscalYear->project->name,
            'date' => strtoupper(now()->formatLocalized('%B')) . ' - ' . now()->year
        ];
    }

    public function getLocations()
    {
        return $this->geographicLocationRepository->findByType(GeographicLocation::TYPE_CANTON);
    }

    public function getItemAccrued(BudgetItem $budgetItem)
    {
        $items = Collection::make([$budgetItem]);
        return $this->budgetProjectTrackingRepository->remoteTotalsBudgetItem($items, $this->fiscalYearRepository->findCurrentFiscalYear())->first();
    }
}
