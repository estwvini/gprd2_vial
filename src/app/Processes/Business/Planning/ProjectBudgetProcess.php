<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\BudgetItem;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
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
use Yajra\DataTables\DataTables;

/**
 * Clase BudgetItemProcess
 * @package App\Processes\Business\Planning
 */
class ProjectBudgetProcess
{

    /**
     * @var BudgetClassifierRepository
     */
    private $budgetClassifierRepository;

    /**
     * @var GeographicLocationRepository
     */
    private $geographicLocationRepository;

    /**
     * @var FinancingSourceRepository
     */
    private $financingSourceRepository;

    /**
     * @var SpendingGuideRepository
     */
    private $spendingGuideRepository;

    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var OperationalActivityRepository
     */
    private $operationalActivityRepository;

    /**
     * @var BudgetAdjutmentProcess
     */
    protected $budgetAdjutmentProcess;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    private $activityProjectFiscalYearRepository;

    /**
     * @var BudgetAdjustmentRepository
     */
    private $budgetAdjustmentRepository;

    /**
     * @var CompetenceRepository
     */
    private $competenceRepository;

    /**
     * @var BudgetItemProcess
     */
    private $budgetItemProcess;

    /**
     * @var TrackingReportsRepository
     */
    private $trackingReportsRepository;

    /**
     * Constructor de BudgetItemProcess.
     *
     * @param BudgetItemRepository $budgetItemRepository
     * @param BudgetClassifierRepository $budgetClassifierRepository
     * @param GeographicLocationRepository $geographicLocationRepository
     * @param FinancingSourceRepository $financingSourceRepository
     * @param SpendingGuideRepository $spendingGuideRepository
     * @param InstitutionRepository $institutionRepository
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     * @param SettingRepository $settingRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param BudgetAdjutmentProcess $budgetAdjutmentProcess
     * @param BudgetAdjustmentRepository $budgetAdjustmentRepository
     * @param CompetenceRepository $competenceRepository
     * @param BudgetItemProcess $budgetItemProcess
     * @param TrackingReportsRepository $trackingReportsRepository
     */
    public function __construct(
        BudgetItemRepository $budgetItemRepository,
        BudgetClassifierRepository $budgetClassifierRepository,
        GeographicLocationRepository $geographicLocationRepository,
        FinancingSourceRepository $financingSourceRepository,
        SpendingGuideRepository $spendingGuideRepository,
        InstitutionRepository $institutionRepository,
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        SettingRepository $settingRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        FiscalYearRepository $fiscalYearRepository,
        BudgetAdjutmentProcess $budgetAdjutmentProcess,
        BudgetAdjustmentRepository $budgetAdjustmentRepository,
        CompetenceRepository $competenceRepository,
        BudgetItemProcess $budgetItemProcess,
        TrackingReportsRepository $trackingReportsRepository
    ) {
        $this->budgetItemRepository = $budgetItemRepository;
        $this->budgetClassifierRepository = $budgetClassifierRepository;
        $this->geographicLocationRepository = $geographicLocationRepository;
        $this->financingSourceRepository = $financingSourceRepository;
        $this->spendingGuideRepository = $spendingGuideRepository;
        $this->institutionRepository = $institutionRepository;
        $this->settingRepository = $settingRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->budgetAdjutmentProcess = $budgetAdjutmentProcess;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->budgetAdjustmentRepository = $budgetAdjustmentRepository;
        $this->competenceRepository = $competenceRepository;
        $this->budgetItemProcess = $budgetItemProcess;
        $this->trackingReportsRepository = $trackingReportsRepository;
    }

    /**
     * Carga información para mostrar en el index.
     *
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return array
     */
    public function index(ProjectFiscalYear $projectFiscalYear)
    {
        $fiscal_year = $this->fiscalYearRepository->findNextFiscalYear();
        $projectFiscalYear->load('project');
        return [
            'fiscalYear' => $fiscal_year ? $fiscal_year->year : Carbon::now()->addYear()->year,
            'replicate' => $this->budgetItemRepository->findByProjectFiscalYear($projectFiscalYear->id)->isEmpty(),
            'entity' => $projectFiscalYear->project,
            'projectFiscalYear' => $projectFiscalYear,
            'budget' => true
        ];
    }

    /**
     * Crear un datatable con la información pertinente de partidas presupuestarias.
     *
     * @param ProjectFiscalYear $projectFiscalYear
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function data(ProjectFiscalYear $projectFiscalYear)
    {

        $actions = [];
        if (currentUser()->can('destroy.items.activities.projects.plans_management')) {
            $actions['trash'] = [
                'route' => 'destroy.items.activities.projects.plans_management',
                'tooltip' => trans('budget_item.labels.delete'),
                'confirm_message' => trans('budget_item.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete',
                'post_action' => '$("#budget_tb").DataTable().draw();',
                'scroll-top' => 0
            ];
        }

        $items = $this->budgetItemRepository->getItemsByProjectFiscalYear($projectFiscalYear->id);
        $totalAmount = $items->sum('amount');

        $items->load('budgetClassifier');
        return DataTables::of($items)
            ->setRowId('id')
            ->addColumn('code', function (BudgetItem $entity) {
                $url = route('edit.index.budget.projects.plans_management', ['budgetItem' => $entity->id]);
                return "<a href='{$url}' class='blue ajaxify'>{$entity->code}</a>";
            })
            ->addColumn('name', function (BudgetItem $entity) {
                return $entity->name;
            })
            ->editColumn('activityProjectFiscalYear', function (BudgetItem $entity) {
                return $entity->activityProjectFiscalYear->name;
            })
            ->editColumn('amount', function (BudgetItem $entity) {
                return number_format($entity->amount, 2);
            })
            ->addColumn('actions', function (BudgetItem $entity) use ($actions) {
                if (!$entity->is_public_purchase) {
                    unset($actions['check']);
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['code', 'actions'])
            ->with('totalAmount', number_format($totalAmount, 2))
            ->make(true);
    }

    /**
     * Duplica el presupuesto del año anterior del proyecto
     *
     * @param ProjectFiscalYear $projectFiscalYear
     */
    public function replicateBudgetLastYear(ProjectFiscalYear $projectFiscalYear)
    {
        $currentFiscalYear = currentFiscalYear();
        $nextFiscalYear = nextFiscalYear();
        $currentProjectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($currentFiscalYear->id, $projectFiscalYear->project->id);

        if (!$currentProjectFiscalYear) {
            return false;
        }

        $items = $this->budgetItemRepository->getItemsByProjectFiscalYear($currentProjectFiscalYear->id);
        try {
            $budgetCard = $this->trackingReportsRepository->budgetCard($currentFiscalYear->year, Carbon::now()->format('Y-m-d'), 1, 20, '=');
        } catch (Exception $e) {
            $budgetCard = collect([]);
        }

        foreach ($items as $item) {

            $newActivity = ActivityProjectFiscalYear::where([
                ['code', $item->activityProjectFiscalYear->code],
                ['project_fiscal_year_id', $projectFiscalYear->id]
            ])->firstOr(function () use ($item, $projectFiscalYear) {
                $act = $item->activityProjectFiscalYear;
                $dateInit = $act->date_init ? Carbon::createFromFormat('d-m-Y', $act->date_init)->addYear(1)->format('Y-m-d') : null;
                $dateEnd = $act->date_end ? Carbon::createFromFormat('d-m-Y', $act->date_end)->addYear(1)->format('Y-m-d') : null;

                $newActivity = $act->replicate()->fill([
                    'project_fiscal_year_id' => $projectFiscalYear->id,
                    'date_init' => $dateInit,
                    'date_end' => $dateEnd,
                ]);
                $newActivity->save();
                $newActivity = $newActivity->fresh();

                if (count($act->responsible)) {
                    $newActivity->responsible()->sync([
                        $act->responsible->first()->id => [
                            'active' => true,
                            'date_init' => Carbon::today()->toDateString()
                        ]
                    ]);
                }
                return $newActivity;
            });

            BudgetItem::where([
                ['code', $item->code],
                ['activity_project_fiscal_year_id', $newActivity->id],
                ['fiscal_year_id', $nextFiscalYear->id]
            ])->firstOr(function () use ($item, $nextFiscalYear, $newActivity, $budgetCard) {
                $encodedItem = $budgetCard->firstWhere('cuenta', $item->code);

                $newItem = $item->replicate()->fill([
                    'activity_project_fiscal_year_id' => $newActivity->id,
                    'fiscal_year_id' => $nextFiscalYear->id,
                    'name' => $item->name ?? $item->budgetClassifier->title,
                    'amount' => $encodedItem ? $encodedItem->codificado : $item->amount
                ]);
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
            });
        }
    }
}