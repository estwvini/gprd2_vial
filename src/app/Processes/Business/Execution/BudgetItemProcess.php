<?php

namespace App\Processes\Business\Execution;

use App\Models\Business\BudgetItem;
use App\Models\Business\Catalogs\GeographicLocation;
use App\Models\Business\Catalogs\SpendingGuide;
use App\Models\Business\Planning\OperationalActivity;
use App\Models\Business\Tracking\Proforma;
use App\Processes\Business\Planning\BudgetAdjutmentProcess;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\Catalogs\BudgetClassifierRepository;
use App\Repositories\Repository\Business\Catalogs\CompetenceRepository;
use App\Repositories\Repository\Business\Catalogs\FinancingSourceRepository;
use App\Repositories\Repository\Business\Catalogs\GeographicLocationRepository;
use App\Repositories\Repository\Business\Catalogs\InstitutionRepository;
use App\Repositories\Repository\Business\Catalogs\SpendingGuideRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\OperationalActivityRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\Criteria\GeographicLocation\GeographicLocationEnabledTrue;
use App\Repositories\Repository\Criteria\SpendingGuide\SpendingGuideEnabledTrue;
use App\Repositories\Repository\SFGPROV\ProformaRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

/**
 * Clase BudgetItemProcess
 * @package App\Processes\Business\Execution
 */
class BudgetItemProcess
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
     * @var ProformaRepository
     */
    protected $proformaRepository;

    /**
     * @var CompetenceRepository
     */
    private $competenceRepository;

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
     * @param OperationalActivityRepository $operationalActivityRepository
     * @param BudgetAdjutmentProcess $budgetAdjutmentProcess
     * @param ProformaRepository $proformaRepository
     * @param CompetenceRepository $competenceRepository
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
        OperationalActivityRepository $operationalActivityRepository,
        BudgetAdjutmentProcess $budgetAdjutmentProcess,
        ProformaRepository $proformaRepository,
        CompetenceRepository $competenceRepository
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
        $this->operationalActivityRepository = $operationalActivityRepository;
        $this->budgetAdjutmentProcess = $budgetAdjutmentProcess;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->proformaRepository = $proformaRepository;
        $this->competenceRepository = $competenceRepository;
    }

    /**
     * Carga información para mostrar en el index.
     *
     * @param int $activityId
     *
     * @return array
     */
    public function index(int $activityId)
    {
        $activity = $this->operationalActivityRepository->find($activityId);
        $fiscal_year = $this->fiscalYearRepository->findCurrentFiscalYear();
        $incomes = $this->budgetAdjutmentProcess->incomes($fiscal_year);
        $currentExpenses = $this->budgetAdjutmentProcess->currentExpenses($fiscal_year);
        $balance = $incomes - $currentExpenses;
        $percentCurrentExpensesControl = (($currentExpenses * 100) / (($incomes > 0) ? $incomes : 1)) / 100;
        $percentage_of_control = json_decode($this->settingRepository->findByKey('percentage_of_control'))->value->percentage_of_control;

        return [
            'activity' => $activity,
            'activityType' => BudgetItem::ACTIVITY_TYPE_OPERATIONAL,
            'fiscalYear' => $fiscal_year ? $fiscal_year->year : Carbon::now()->addYear()->year,
            'incomes' => $incomes,
            'currentExpenses' => number_format($currentExpenses, 2, '.', ','),
            'balance' => number_format($balance, 2, '.', ','),
            'percentCurrentExpensesControl' => $percentCurrentExpensesControl,
            'percentage_of_control' => $percentage_of_control
        ];
    }

    /**
     * Crear un datatable con la información pertinente de partidas presupuestarias.
     *
     * @param int $activityId
     * @param string $activityType
     *
     * @return mixed
     * @throws Exception
     */
    public function data(int $activityId, string $activityType)
    {
        $user = currentUser();
        $actions = [];

        $route = ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) ? 'index.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution' : 'index.purchases.items.activities.project.programmatic_structure.execution';

        if ($user->can($route)) {
            $actions['check'] = [
                'route' => $route,
                'tooltip' => trans('public_purchases.labels.item_purchase_list'),
                'ajaxify' => '#public_purchases_list',
                'btn_class' => 'btn-warning',
                'post_action' => '$("html, body").animate({ scrollTop: $("#budget_items_tb").offset().top }, 1000);',
                'params' => [
                    'activityType' => $activityType
                ],
                'scroll-top' => 0
            ];
        }

        $route = ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) ? 'edit.items.operational_activities.current_expenditure_elements.programmatic_structure.execution' : 'edit.items.activities.project.programmatic_structure.execution';

        if ($user->can($route)) {
            $actions['edit'] = [
                'route' => $route,
                'tooltip' => trans('budget_item.labels.edit'),
                'post_action' => '$("#public_purchases_list").empty();',
                'scroll-top' => 0
            ];
        }

        $route = ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) ? 'destroy.items.operational_activities.current_expenditure_elements.programmatic_structure.execution' : 'destroy.items.activities.project.programmatic_structure.execution';

        if ($user->can($route)) {
            $actions['trash'] = [
                'route' => $route,
                'tooltip' => trans('budget_item.labels.delete'),
                'confirm_message' => trans('budget_item.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete',
                'post_action' => '$("#public_purchases_list").empty(); $("#budget_items_tb").DataTable().draw();',
                'scroll-top' => 0
            ];
        }

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $codified = collect([]);
        if (api_available()) {
            $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
            $codified = $this->proformaRepository->getCodifiedExpenses($fiscalYear, $sfgprov->company_code);
        }

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        if ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) {
            $activity = $this->operationalActivityRepository->find($activityId);
        } else {
            $activity = $this->activityProjectFiscalYearRepository->find($activityId);
        }

        if (!$activity) {
            throw new Exception(trans('activities.messages.errors.not_found'), 1000);
        }

        if ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) {
            $items = $this->budgetItemRepository->findByField('operational_activity_id', $activity->id);
        } else {
            $items = $this->budgetItemRepository->findByField('activity_project_fiscal_year_id', $activity->id);
        }

        $items->load('budgetClassifier', 'geographicLocation', 'source', 'spendingGuide', 'competence');

        $totalAmount = 0;

        // Calculate codified total
        if (api_available()) {
            $items->each(function ($item) use (&$totalAmount, $codified) {
                $codifiedExpense = $codified->where('cuenta', $item->code);

                if ($codifiedExpense->count()) {
                    $amount = (float)$codifiedExpense->first()->codified;
                    $totalAmount += $amount;
                }
            });
        }

        return DataTables::of($items)
            ->setRowId('id')
            ->editColumn('budgetClassifier', function (BudgetItem $entity) {
                return $entity->budgetClassifier->full_code;
            })
            ->editColumn('geographicLocation', function (BudgetItem $entity) {
                return $entity->geographicLocation->getFullCode();
            })
            ->editColumn('source', function (BudgetItem $entity) {
                return $entity->source ? $entity->source->code : BudgetItem::CODE_000;
            })
            ->editColumn('spendingGuide', function (BudgetItem $entity) {
                return $entity->spendingGuide ? $entity->spendingGuide->full_code : BudgetItem::CODE_999999;
            })
            ->editColumn('is_participatory_budget', function (BudgetItem $entity) {
                $label = $entity->is_participatory_budget ? BudgetItem::YES : BudgetItem::NO;
                $class = $entity->is_participatory_budget ? 'success' : 'danger';
                return "<span class='label label-{$class}'>{$label}</span>";
            })
            ->editColumn('is_public_purchase', function (BudgetItem $entity) {
                $label = $entity->is_public_purchase ? BudgetItem::YES : BudgetItem::NO;
                $class = $entity->is_public_purchase ? 'success' : 'danger';
                return "<span class='label label-{$class}'>{$label}</span>";
            })
            ->editColumn('competence', function (BudgetItem $entity) {
                return $entity->competence ? $entity->competence->code : '';
            })
            ->addColumn('name', function (BudgetItem $entity) {
                return $entity->budgetClassifier->title;
            })
            ->editColumn('amount', function (BudgetItem $entity) use ($codified) {
                $codifiedExpense = $codified->where('cuenta', $entity->code);

                if ($codifiedExpense->count()) {
                    $amount = (float)$codifiedExpense->first()->codified;
                    return number_format($amount, 2);
                }
                return 0.00;
            })
            ->addColumn('actions', function (BudgetItem $entity) use ($actions, $activityType, $codified) {
                if (!$entity->is_public_purchase) {
                    unset($actions['check']);
                }

                if (isset($actions['check']) && $activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) {
                    $actions['edit']['params'] = [
                        'activityType' => $activityType
                    ];
                }

                if (isset($actions['edit']) && $activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) {
                    $actions['edit']['params'] = [
                        'project_fiscal_year_id' => $entity->id,
                        'activityType' => $activityType
                    ];
                }

                if ($codified->where('cuenta', $entity->code)->count()) {

                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => []
                    ]);
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions', 'is_public_purchase', 'is_participatory_budget'])
            ->with('totalAmount', number_format($totalAmount, 2))
            ->make(true);
    }

    /**
     * Crear un datatable con la información pertinente de partidas presupuestarias.
     *
     * @param int $activityId
     *
     * @return mixed
     * @throws Exception
     */
    public function dataShow(int $activityId)
    {
        $user = currentUser();
        $actions = [];

        $route = 'purchases.items.activities.projects_review.plans_management';

        if ($user->can($route)) {
            $actions['check'] = [
                'route' => $route,
                'tooltip' => trans('public_purchases.labels.item_purchase_list'),
                'ajaxify' => '#public_purchases_list',
                'btn_class' => 'btn-warning'
            ];
        }

        $activity = $this->activityProjectFiscalYearRepository->find($activityId);

        if (!$activity) {
            throw new Exception(trans('activities.messages.errors.not_found'), 1000);
        }

        $items = $this->budgetItemRepository->findByField('activity_project_fiscal_year_id', $activity->id);

        $totalAmount = $items->sum('amount');

        $items->load('budgetClassifier', 'geographicLocation', 'source', 'spendingGuide', 'competence');
        $dataTable = DataTables::of($items)
            ->setRowId('id')
            ->editColumn('budgetClassifier', function (BudgetItem $entity) {
                return $entity->budgetClassifier->full_code;
            })
            ->editColumn('geographicLocation', function (BudgetItem $entity) {
                return $entity->geographicLocation->getFullCode();
            })
            ->editColumn('source', function (BudgetItem $entity) {
                return $entity->source ? $entity->source->code : BudgetItem::CODE_000;
            })
            ->editColumn('spendingGuide', function (BudgetItem $entity) {
                return $entity->spendingGuide ? $entity->spendingGuide->full_code : BudgetItem::CODE_999999;
            })
            ->editColumn('is_participatory_budget', function (BudgetItem $entity) {
                return $entity->is_participatory_budget ? BudgetItem::YES : BudgetItem::NO;
            })
            ->editColumn('is_public_purchase', function (BudgetItem $entity) {
                return $entity->is_public_purchase ? BudgetItem::YES : BudgetItem::NO;
            })
            ->editColumn('competence', function (BudgetItem $entity) {
                return $entity->competence ? $entity->competence->code : '';
            })
            ->addColumn('name', function (BudgetItem $entity) {
                return $entity->budgetClassifier->title;
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
            ->rawColumns(['actions'])
            ->with('totalAmount', number_format($totalAmount, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene información para el formulario de creación de partidas presupuestarias
     *
     * @param int $activityId
     * @param string $activityType
     *
     * @return array
     * @throws Exception
     */
    public function dataCreate(int $activityId, string $activityType)
    {
        $activity = $this->activityProjectFiscalYearRepository->find($activityId);

        if ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) {
            $activity = $this->operationalActivityRepository->find($activityId);
        }

        if (!$activity) {
            throw new Exception(trans('activities.messages.exceptions.not_found'), 1000);
        }

        $provinceCode = $this->settingRepository->findByKey('gad')->value['code'];
        $budgetClassifierSettings = $this->settingRepository->findByKey('budget_classifier')->value;

        $investmentExpenseCode = [
            $budgetClassifierSettings['investment_expense'],
            $budgetClassifierSettings['capital_expenditure'],
            $budgetClassifierSettings['current_expenditure'],
            $budgetClassifierSettings['capital_expenditure'],
            $budgetClassifierSettings['financing_application']
        ];

        $budgetClassifier = $this->budgetClassifierRepository->findLeafChildrenNodes($investmentExpenseCode, []);

        $this->geographicLocationRepository->pushCriteria(new GeographicLocationEnabledTrue());
        $geographicLocations = $this->geographicLocationRepository->findByType(GeographicLocation::TYPE_PARISH);

        $financingSources = $this->financingSourceRepository->findByField('enabled', 1);

        $this->spendingGuideRepository->pushCriteria(new SpendingGuideEnabledTrue());
        $guideSpendings = $this->spendingGuideRepository->findByField('level', SpendingGuide::LEVEL_4);

        $institutions = $this->institutionRepository->findEnabled();

        $financingIncomeCode = $this->settingRepository->findByKey('budget_classifier')->value['financing_income'];
        $loans = $this->budgetClassifierRepository->findLeafChildrenNodes([$financingIncomeCode]);
        $fiscal_year = $this->fiscalYearRepository->findCurrentFiscalYear();

        $incomes = $this->budgetAdjutmentProcess->incomes($fiscal_year);
        $totalCurrentExpenses = $this->budgetAdjutmentProcess->currentExpenses($fiscal_year);
        $percentage_of_control = json_decode($this->settingRepository->findByKey('percentage_of_control'))->value->percentage_of_control;
        $percentCurrentExpensesControl = (($totalCurrentExpenses * 100) / (($incomes > 0) ? $incomes : 1)) / 100;

        return [
            'budgetClassifier' => $budgetClassifier,
            'geographicLocations' => $geographicLocations,
            'financingSources' => $financingSources,
            'guideSpendings' => $guideSpendings,
            'institutions' => $institutions,
            'loans' => $loans,
            'activity' => $activity,
            'provinceCode' => $provinceCode,
            'activityType' => $activityType,
            'incomes' => $incomes,
            'totalCurrentExpenses' => $totalCurrentExpenses,
            'percentage_of_control' => $percentage_of_control,
            'percentCurrentExpensesControl' => $percentCurrentExpensesControl,
            'competences' => $this->competenceRepository->all()
        ];
    }

    /**
     * Obtiene información para el formulario de edición de partidas presupuestarias
     *
     * @param int $budgetItemId
     * @param string $activityType
     *
     * @return array
     * @throws Exception
     */
    public function dataEdit(int $budgetItemId, string $activityType)
    {
        $budgetItem = $this->budgetItemRepository->find($budgetItemId);

        if (!$budgetItem) {
            throw new Exception(trans('budget_item.messages.exceptions.not_found'), 1000);
        }

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        $activityId = ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) ? $budgetItem->operational_activity_id : $budgetItem->activityProjectFiscalYear->id;
        $data = self::dataCreate($activityId, $activityType);

        $data['budgetItem'] = $budgetItem;
        $data['activity'] = ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) ? $budgetItem->operationalActivity : $budgetItem->activityProjectFiscalYear;
        $data['activityType'] = $activityType;
        $data['incomes'] = $this->budgetAdjutmentProcess->incomes($fiscalYear);
        $data['totalCurrentExpenses'] = $this->budgetItemRepository->findByFiscalYearCurrentExpensesEdit($budgetItemId, $fiscalYear)->sum('amount');
        $data['percentage_of_control'] = json_decode($this->settingRepository->findByKey('percentage_of_control'))->value->percentage_of_control;

        return $data;
    }

    /**
     * Almacenar nueva partida presupuestaria
     *
     * @param Request $request
     * @param int $activityId
     * @param string $activityType
     *
     * @throws Exception
     */
    public function store(Request $request, int $activityId, string $activityType)
    {
        if ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) {
            $activity = $this->operationalActivityRepository->find($activityId);
        } else {
            $activity = $this->activityProjectFiscalYearRepository->find($activityId);
        }

        if (!$activity) {
            throw new Exception(trans('activities.messages.exceptions.not_found'), 1000);
        }

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        if ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) {
            $projectFiscalYear = null;
        } else {
            $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscalYear->id, $activity->component->project_id);

            if (!$projectFiscalYear) {
                throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
            }
        }

        $data = $this->processRequest($request->all(), $activity);

        if ($this->budgetItemRepository->findByFields(['code' => $data['code'], 'fiscal_year_id' => $fiscalYear->id])->count()) {
            throw new Exception(trans('budget_item.messages.exceptions.exist'), 1000);
        }

        $entity = $this->budgetItemRepository->createFromArray($data, $activity, $projectFiscalYear);

        if (!$entity) {
            throw new Exception(trans('budget_item.messages.errors.create'), 1000);
        }
    }

    /**
     * Actualiza en BD una partida presupuestaria
     *
     * @param Request $request
     * @param int $budgetItemId
     * @param string $activityType
     *
     * @throws Exception
     */
    public function update(Request $request, int $budgetItemId, string $activityType)
    {
        $entity = $this->budgetItemRepository->find($budgetItemId);

        if (!$entity) {
            throw new Exception(trans('budget_item.messages.exceptions.not_found'), 1000);
        }

        $activity = ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) ? $entity->operationalActivity : $entity->activityProjectFiscalYear;

        $data = $this->processRequest($request->all(), $activity, $entity);

        $projectFiscalYear = null;

        if ($activityType === BudgetItem::ACTIVITY_TYPE_PROJECT) {

            $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

            if (!$fiscalYear) {
                throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
            }

            $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscalYear->id, $activity->component->project_id);

            if (!$projectFiscalYear) {
                throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
            }
        }

        if ($entity->code != $data['code'] && $this->budgetItemRepository->findByFields(['code' => $data['code'], 'fiscal_year_id' => $fiscalYear->id])->count()) {
            throw new Exception(trans('budget_item.messages.exceptions.exist'), 1000);
        }

        $entity = $this->budgetItemRepository->updateFromArray($data, $entity, $projectFiscalYear);

        if (!$entity) {
            throw new Exception(trans('budget_item.messages.errors.create'), 1000);
        }
    }

    /**
     * Eliminar una partida presupuestaria.
     *
     * @param int $budgetItemId
     *
     * @throws Exception
     */
    public function destroy(int $budgetItemId)
    {
        $entity = $this->budgetItemRepository->find($budgetItemId);

        if (!$entity) {
            throw new Exception(trans('budget_item.messages.exceptions.not_found'), 1000);
        }

        if ($entity->publicPurchases()->count()) {
            throw new Exception(trans('budget_item.messages.exceptions.has_public_purchase'), 1000);
        }

        if ($entity->budgetPlannings()->count()) {
            throw new Exception(trans('budget_item.messages.exceptions.has_budget_planning'), 1000);
        }

        if (!$this->budgetItemRepository->customDestroy($entity->id, BudgetItem::MODULE['PROGRAMMATIC_STRUCTURE'], currentFiscalYear()->year)) {
            throw new Exception(trans('budget_item.messages.errors.delete'), 1000);
        }
    }

    /**
     * Valida y normaliza los datos de la petición para crear una partida presupuestaria
     *
     * @param array $data Datos de la petición
     * @param Model $activity
     * @param BudgetItem $entity |null
     *
     * @return array
     * @throws Exception
     */
    private function processRequest(array $data, Model $activity, BudgetItem $entity = null)
    {
        $actCode = $activity->code;
        if (!$actCode) {
            throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.activity')]), 1000);
        }

        if ($activity instanceof OperationalActivity) {
            $projCup = BudgetItem::CODE_999;

            $ueCode = $activity->executingUnit->code;
            if (!$ueCode) {
                throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.executingUnit')]), 1000);
            }

            $areaCode = $activity->subprogram->parent->area->code;
            if (!$areaCode) {
                throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.area')]), 1000);
            }

            $subProgCode = $activity->subprogram->code;
            if (!$subProgCode) {
                throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.sub_program')]), 1000);
            }

            $progCode = $activity->subprogram->parent->code;
            if (!$progCode) {
                throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.program')]), 1000);
            }
        } else {
            $projCup = $activity->component->project->cup;
            if (!$projCup) {
                throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.project')]), 1000);
            }

            $ueCode = $activity->component->project->executingUnit->code;
            if (!$ueCode) {
                throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.executingUnit')]), 1000);
            }

            $areaCode = $activity->area->code;
            if (!$areaCode) {
                throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.area')]), 1000);
            }

            $subProgCode = $activity->component->project->subprogram->code;
            if (!$subProgCode) {
                throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.sub_program')]), 1000);
            }

            $progCode = $activity->component->project->subprogram->parent->code;
            if (!$progCode) {
                throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.program')]), 1000);
            }
        }

        $competence = $this->competenceRepository->find($data['competence_id']);
        if (!$competence) {
            throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.competence')]), 1000);
        } else {
            $competenceCode = $competence->code;
        }

        $budgetClassifier = $this->budgetClassifierRepository->find($data['budget_classifier_id']);
        if (!$budgetClassifier) {
            throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.budget_item')]), 1000);
        }

        $spendingGuide = $this->spendingGuideRepository->find($data['guide_spending_id']);
        if (!$spendingGuide) {
            throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.spending_guide')]), 1000);
        } else {
            $dataSpendingGuide = $spendingGuide->full_code;
        }

        if (!isset($data['geographic_location_id'])) {
            $data['geographic_location_id'] = GeographicLocation::NO_PARISH;
        }

        $location = $this->geographicLocationRepository->find($data['geographic_location_id']);
        if (!$location) {
            throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.geographic')]), 1000);
        } else {
            $dataLocation = $location->getFullCode();
        }

        $source = $this->financingSourceRepository->find($data['financing_source_id']);
        if (!$source) {
            throw new Exception(trans('budget_item.messages.validation.create_budget_item', ['message' => trans('budget_item.labels.source')]), 1000);
        } else {
            $dataSource = $source->code;
        }

        $institutionCode = BudgetItem::CODE_9999999;
        if (isset($data['institution_id'])) {
            $institution = $this->institutionRepository->find($data['institution_id']);
            if ($institution) {
                $institutionCode = $institution->cleanCode();
            }
        }

        $data['is_participatory_budget'] = isset($data['is_participatory_budget']) ? ($data['is_participatory_budget'] == 'on' ? 1 : 0) : 0;
        $data['is_public_purchase'] = isset($data['is_public_purchase']) ? ($data['is_public_purchase'] == 'on' ? 1 : 0) : 0;

        $data['amount'] = 0;

        $data['code'] =
            $areaCode . '.' .                          // Área
            $progCode . '.' .                          // Prog
            $subProgCode . '.' .                       // Subp
            $projCup . '.' .                           // Proy
            $ueCode . '.' .                            // UE
            $actCode . '.' .                           // Act
            $budgetClassifier->full_code . '.' .       // Clasificador presupuestario
            $competenceCode . '.' .                    // Fun
            $dataSpendingGuide . '.' .      // Clasificador orientación gasto
            $dataLocation . '.' .           // Clasificador geográfico
            $dataSource . '.' .            // Fuente de financiamiento
            $institutionCode;              // Organismo

        return $data;
    }

    /**
     * Construye la estructura de las partidas presupuestarias
     *
     * @param Collection $budgetItems
     *
     * @return Collection
     */
    public function buildNewBudgetItemsStructure(Collection $budgetItems)
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $budgetItemStructure = collect([]);
        $provinceName = $this->settingRepository->findByKey('gad')->value['province'];

        // Get all incomes structure from financial system database
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $proformaExpenses = $this->proformaRepository->getProformaExpenses($fiscalYear, $sfgprov->company_code);

        foreach ($budgetItems as $count => $budgetItem) {
            $currentLevel = Proforma::EXPENSE_LEVELS;
            $parentCode = getParentCode($budgetItem->code);
            $spendingGuide = $budgetItem->spendingGuide;
            $budgetClassifier = $budgetItem->budgetClassifier;
            $location = $budgetItem->geographicLocation;
            $activity = $description = $budgetItem->operational_activity_id ? $budgetItem->operationalActivity : $budgetItem->activityProjectFiscalYear;
            $source = $budgetItem->source;

            // Validate if code already exists in financial system database
            if ($proformaExpenses->where('cuenta', $budgetItem->code)->count()) {
                continue;
            }

            //budget items in proforma
            $budgetItemStructure->push([
                'company_code' => $sfgprov->company_code,
                'year' => $fiscalYear->year,
                'code' => $budgetItem->code,
                'type' => Proforma::TYPE_EXPENSE,
                'description' => $budgetItem->name,
                'last_level' => Proforma::LAST_LEVEL,
                'level' => $currentLevel--,
                'parent_code' => $parentCode,
                'created_by' => $sfgprov->user_code
            ]);

            while ($currentLevel > 0) {

                // Validate if parent codes already exists in financial system database
                if ($proformaExpenses->where('cuenta', $parentCode)->count()) {
                    break;
                }

                $description = '';

                switch ($currentLevel) {
                    case '19':// Fuente Financiamiento
                        $description = $source->description;
                        break;
                    case '18':// Geographic location code Parish
                    case '17':// Geographic location code Canton
                    case '16':// Geographic location code Province
                        $description = ($currentLevel == 16 && $location->code != GeographicLocation::NO_LOCATION_CODE) ? $provinceName : $location->description;
                        if ($location->parent) {
                            $location = $location->parent;
                        }
                        break;
                    case '15':// Spending guide subcategory code
                    case '14':// Spending guide category code
                    case '13':// Spending guide direction code
                    case '12':// Spending guide orientation code
                        $description = $spendingGuide->description;
                        if ($spendingGuide->parent) {
                            $spendingGuide = $spendingGuide->parent;
                        }
                        break;
                    case '11':// FUN code
                        if ($budgetItem->competence) {
                            $description = $budgetItem->competence->name;
                        } else {
                            $description = BudgetItem::FUN_DESCRIPTION;
                        }
                        break;
                    case '10':// Budget classifier element code
                    case '9':// Budget classifier subgroup code
                    case '8':// Budget classifier group code
                    case '7':// Budget classifier nature code
                        $description = $budgetClassifier->title;
                        if ($budgetClassifier->parent) {
                            $budgetClassifier = $budgetClassifier->parent;
                        }
                        break;
                    case '6':// Activity code
                        $description = $activity->name;
                        break;
                    case '5':// Executing unit code
                        $description = $activity instanceof OperationalActivity ? $activity->executingUnit->name : $activity->component->project->executingUnit->name;
                        break;
                    case '4':// Project fiscal year code
                        $description = $activity instanceof OperationalActivity ? $activity->subprogram->name : $activity->component->project->name;
                        break;
                    case '3':// Subprogram code
                        $description = $activity instanceof OperationalActivity ? $activity->subprogram->name : $activity->component->project->subprogram->description;
                        break;
                    case '2':// Program code
                        $description = $activity instanceof OperationalActivity ? $activity->subprogram->parent->name : $activity->component->project->subprogram->parent->description;
                        break;
                    case '1':// Area code
                        $description = $activity instanceof OperationalActivity ? $activity->subprogram->parent->area->area : $activity->area->area;
                        break;
                }

                //budget items tree in proforma
                $budgetItemStructure->push([
                    'company_code' => $sfgprov->company_code,
                    'year' => $fiscalYear->year,
                    'code' => $parentCode,
                    'type' => Proforma::TYPE_EXPENSE,
                    'description' => $description,
                    'last_level' => Proforma::NOT_LAST_LEVEL,
                    'level' => $currentLevel--,
                    'parent_code' => $parentCode = getParentCode($parentCode),
                    'created_by' => $sfgprov->user_code
                ]);
            }
        }

        // Filter the budget items that already exists
        $uniqueBudgetItems = $budgetItemStructure->unique(function ($item) {
            return $item['company_code'] . $item['year'] . $item['code'] . $item['type'];
        });

        return $uniqueBudgetItems;
    }
}
