<?php

namespace App\Processes\Business\Execution;

use App\Models\Business\Plan;
use App\Models\Business\PlanIndicator;
use App\Models\Business\PlanIndicatorGoal;
use App\Processes\Business\Planning\BudgetAdjutmentProcess;
use App\Processes\Business\Planning\ComponentProcess;
use App\Processes\Business\Planning\OperationalGoalsProcess;
use App\Processes\Business\Planning\PlanElementProcess;
use App\Processes\Business\Planning\ProjectProcess;
use App\Repositories\Repository\Admin\ThresholdRepository;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use App\Repositories\Repository\Business\ComponentRepository;
use App\Repositories\Repository\Business\IndicatorGoalsRepository;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\OperationalGoalsRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\PlanRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Clase IndicatorProgressProcess
 * @package App\Processes\Business\Progress
 */
class IndicatorProgressProcess
{
    /**
     * @var ProjectFiscalYearRepository
     */
    protected $projectFiscalYearRepository;

    /**
     * @var PlanIndicatorRepository
     */
    protected $planIndicatorRepository;

    /**
     * @var PlanRepository
     */
    protected $planRepository;

    /**
     * @var PlanElementRepository
     */
    protected $planElementRepository;

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var ThresholdRepository
     */
    protected $thresholdRepository;

    /**
     * @var IndicatorGoalsRepository
     */
    protected $indicatorGoalsRepository;

    /**
     * @var MeasureUnitRepository
     */
    protected $measureUnitRepository;

    /**
     * @var OperationalGoalsRepository
     */
    protected $operationalGoalsRepository;

    /**
     * @var ProjectRepository
     */
    protected $projectRepository;

    /**
     * @var ComponentRepository
     */
    protected $componentRepository;

    /**
     * Constructor de IndicatorProgressProcess.
     *
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param PlanIndicatorRepository $planIndicatorRepository
     * @param PlanRepository $planRepository
     * @param PlanElementRepository $planElementRepository
     * @param ThresholdRepository $thresholdRepository
     * @param IndicatorGoalsRepository $indicatorGoalsRepository
     * @param MeasureUnitRepository $measureUnitRepository
     * @param OperationalGoalsRepository $operationalGoalsRepository
     * @param ProjectRepository $projectRepository
     * @param ComponentRepository $componentRepository
     */
    public function __construct(
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        FiscalYearRepository $fiscalYearRepository,
        PlanIndicatorRepository $planIndicatorRepository,
        PlanRepository $planRepository,
        PlanElementRepository $planElementRepository,
        ThresholdRepository $thresholdRepository,
        IndicatorGoalsRepository $indicatorGoalsRepository,
        MeasureUnitRepository $measureUnitRepository,
        OperationalGoalsRepository $operationalGoalsRepository,
        ProjectRepository $projectRepository,
        ComponentRepository $componentRepository
    ) {
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->planIndicatorRepository = $planIndicatorRepository;
        $this->planRepository = $planRepository;
        $this->planElementRepository = $planElementRepository;
        $this->thresholdRepository = $thresholdRepository;
        $this->indicatorGoalsRepository = $indicatorGoalsRepository;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->operationalGoalsRepository = $operationalGoalsRepository;
        $this->projectRepository = $projectRepository;
        $this->componentRepository = $componentRepository;
    }

    /**
     * Devuelve los años del plan hasta el actual
     *
     * @param string $type
     *
     * @return array
     */
    public function getYears(string $type)
    {
        $years = [];
        $plan = $this->planRepository->getPlans($type)->first();
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $fiscalYear = $fiscalYear ? $fiscalYear->year : Carbon::now()->year;

        if (is_null($plan)) {
            array_push($years, $fiscalYear);
        } else {
            $top = $plan->end_year;
            if ($fiscalYear < $top) {
                $top = $fiscalYear;
            }
            for ($i = $top; $i >= $plan->start_year; $i--) {
                array_push($years, $i);
            }
        }
        return $years;
    }

    /**
     * Carga la pantalla de registro de avance de indicadores de objetivos operativos
     *
     * @return array
     */
    public function operationalGoals()
    {
        $checkPEI = $this->planRepository->getPlans(Plan::TYPE_PEI);

        $budgetAdjustmentProcess = resolve(BudgetAdjutmentProcess::class);
        $checkBudgetAdjustment = $budgetAdjustmentProcess->isApproved($budgetAdjustmentProcess->findBudgetAdjutmentForCurrentFiscalYear());

        return [
            'years' => self::getYears(Plan::TYPE_PEI),
            'measuringFrequencies' => PlanIndicator::measuringFrequenciesChartsProgress(),
            'checkPEI' => $checkPEI->count(),
            'checkBudgetAdjustment' => $checkBudgetAdjustment
        ];
    }

    /**
     * Obtiene información de los objetivos e indicadores
     *
     * @param Request $request
     *
     * @return array
     */
    public function operationalGoalsData(Request $request)
    {
        $filters = $request->all();

        $data = collect([]);
        $index = 0;

        $fiscalYear = $this->fiscalYearRepository->findBy('year', $filters['year']);
        $thresholds = $this->thresholdRepository->findAll();

        $operationalGoals = $this->operationalGoalsRepository->getOperationalGoalsWithIndicators($filters, $fiscalYear ? $fiscalYear->id : null);

        $operationalGoals->each(function ($operationalGoal) use (&$data, &$index, $filters) {

            $parent = $index;
            $objectiveGoalRow = [
                'id' => $index,
                'primaryId' => $operationalGoal->id,
                'name' => $operationalGoal->name,
                'parent' => null,
                'indent' => 0,
                'editable' => false
            ];

            $data->push($objectiveGoalRow);
            $index++;

            if (count($operationalGoal->indicators)) {

                $operationalGoal->indicators->each(function ($indicator) use (&$data, &$index, $parent, $filters) {
                    if ($indicator->planIndicatorGoals->count()) {
                        $indicatorRow = self::buildIndicatorRow($indicator, $index, $parent);

                        $data->push($indicatorRow);
                        $index++;
                    }
                });
            }
        });

        return [
            'thresholds' => json_encode($thresholds, JSON_HEX_APOS | JSON_HEX_QUOT),
            'data' => json_encode($data->toArray(), JSON_HEX_APOS | JSON_HEX_QUOT),
            'type' => $filters['type']
        ];
    }

    /**
     * Carga la pantalla de registro de avance de indicadores del pdot
     *
     * @return array
     */
    public function pdot()
    {
        $checkPDOT = $this->planRepository->getPlans(Plan::TYPE_PDOT);

        return [
            'years' => self::getYears(Plan::TYPE_PDOT),
            'checkPDOT' => $checkPDOT->count()
        ];
    }

    /**
     * Carga la pantalla de registro de avance de indicadores del pei
     *
     * @return array
     */
    public function pei()
    {
        $checkPEI = $this->planRepository->getPlans(Plan::TYPE_PEI);

        $budgetAdjustmentProcess = resolve(BudgetAdjutmentProcess::class);
        $checkBudgetAdjustment = $budgetAdjustmentProcess->isApproved($budgetAdjustmentProcess->findBudgetAdjutmentForCurrentFiscalYear());

        return [
            'years' => self::getYears(Plan::TYPE_PEI),
            'measuringFrequencies' => PlanIndicator::measuringFrequenciesChartsProgress(),
            'checkPEI' => $checkPEI->count(),
            'checkBudgetAdjustment' => $checkBudgetAdjustment
        ];
    }

    /**
     * Obtiene información de los objetivos e indicadores
     *
     * @param Request $request
     *
     * @return array
     */
    public function planData(Request $request)
    {
        $filters = $request->all();

        $data = collect([]);
        $index = 0;

        if ($filters['plan_type'] === Plan::TYPE_SECTORAL) {
            $plan = $this->planRepository->find($filters['plan_id']);
        } else {
            $plan = $this->planRepository->getPlans($filters['plan_type'])->first();
        }

        $thresholds = $this->thresholdRepository->findAll();

        if ($plan) {

            if ($filters['plan_type'] === Plan::TYPE_PDOT || $filters['plan_type'] === Plan::TYPE_SECTORAL) {
                $filters['frequency'] = PlanIndicator::FILTER_ANNUAL;
            }

            $objectives = $this->planElementRepository->getObjectivesWithIndicators($filters, $plan->id);


            $objectives->each(function ($objective) use (&$data, &$index, $filters) {

                $parent = $index;
                $objectiveRow = [
                    'id' => $index,
                    'primaryId' => $objective->id,
                    'name' => $objective->description,
                    'parent' => null,
                    'indent' => 0,
                    'editable' => false
                ];

                $data->push($objectiveRow);
                $index++;

                if (count($objective->indicators)) {

                    $objective->indicators->each(function ($indicator) use (&$data, &$index, $parent, $filters) {

                        if ($indicator->planIndicatorGoals->count()) {
                            $indicatorRow = self::buildIndicatorRow($indicator, $index, $parent);

                            $data->push($indicatorRow);
                            $index++;
                        }
                    });
                }
            });

        }

        return [
            'thresholds' => json_encode($thresholds, JSON_HEX_APOS | JSON_HEX_QUOT),
            'data' => json_encode($data->toArray(), JSON_HEX_APOS | JSON_HEX_QUOT),
            'type' => $filters['type']
        ];
    }

    /**
     * Carga la pantalla de registro de avance de indicadores de un plan sectorial
     *
     * @return array
     */
    public function sectoral()
    {
        $checkSECTORAL = $this->planRepository->getPlans(Plan::TYPE_SECTORAL);

        return [
            'years' => self::getYears(Plan::TYPE_SECTORAL),
            'plans' => $checkSECTORAL,
            'checkSECTORAL' => $checkSECTORAL->count()
        ];
    }

    /**
     * Obtiene los años diponibles para un plan sectorial
     *
     * @param int $id
     *
     * @return array
     */
    public function sectoralGetYears(int $id)
    {
        $years = [];
        $plan = $this->planRepository->find($id);
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $fiscalYear = $fiscalYear ? $fiscalYear->year : Carbon::now()->year;

        if (is_null($plan)) {
            array_push($years, $fiscalYear);
        } else {
            $top = $plan->end_year;
            if ($fiscalYear < $top) {
                $top = $fiscalYear;
            }
            for ($i = $top; $i >= $plan->start_year; $i--) {
                array_push($years, $i);
            }
        }
        return $years;
    }

    /**
     * Carga la pantalla de registro de avance de indicadores de proyectos
     *
     * @return array
     */
    public function projects()
    {
        $checkPEI = $this->planRepository->getPlans(Plan::TYPE_PEI);

        $budgetAdjustmentProcess = resolve(BudgetAdjutmentProcess::class);
        $checkBudgetAdjustment = $budgetAdjustmentProcess->isApproved($budgetAdjustmentProcess->findBudgetAdjutmentForCurrentFiscalYear());

        return [
            'years' => self::getYears(Plan::TYPE_PEI),
            'measuringFrequencies' => PlanIndicator::measuringFrequenciesChartsProgress(),
            'checkPEI' => $checkPEI->count(),
            'checkBudgetAdjustment' => $checkBudgetAdjustment
        ];
    }

    /**
     * Obtiene información de los objetivos e indicadores
     *
     * @param Request $request
     *
     * @return array
     */
    public function projectsData(Request $request)
    {
        $filters = $request->all();

        $data = collect([]);
        $index = 0;

        $thresholds = $this->thresholdRepository->findAll();

        $user = currentUser();

        $departmentsFilter = $user->departments->map(function ($item, $key) {
            return $item->id;
        })->toArray();

        $projects = $this->projectRepository->getProjectsWithIndicators($filters, $departmentsFilter);

        $projects->each(function ($project) use (&$data, &$index, $filters) {

            $parent = $index;
            $projectRow = [
                'id' => $index,
                'primaryId' => $project->id,
                'name' => $project->name,
                'parent' => null,
                'indent' => 0,
                'editable' => false
            ];

            $data->push($projectRow);
            $index++;

            if (count($project->indicators)) {

                $project->indicators->each(function ($indicator) use (&$data, &$index, $parent, $filters) {

                    if ($indicator->planIndicatorGoals->count()) {
                        $indicatorRow = self::buildIndicatorRow($indicator, $index, $parent);

                        $data->push($indicatorRow);
                        $index++;
                    }
                });
            }
        });

        return [
            'thresholds' => json_encode($thresholds, JSON_HEX_APOS | JSON_HEX_QUOT),
            'data' => json_encode($data->toArray(), JSON_HEX_APOS | JSON_HEX_QUOT),
            'type' => $filters['type']
        ];
    }

    /**
     * Carga la pantalla de registro de avance de indicadores de proyectos
     *
     * @return array
     */
    public function components()
    {
        $checkPEI = $this->planRepository->getPlans(Plan::TYPE_PEI);

        $budgetAdjustmentProcess = resolve(BudgetAdjutmentProcess::class);
        $checkBudgetAdjustment = $budgetAdjustmentProcess->isApproved($budgetAdjustmentProcess->findBudgetAdjutmentForCurrentFiscalYear());

        return [
            'years' => self::getYears(Plan::TYPE_PEI),
            'measuringFrequencies' => PlanIndicator::measuringFrequenciesChartsProgress(),
            'checkPEI' => $checkPEI->count(),
            'checkBudgetAdjustment' => $checkBudgetAdjustment
        ];
    }

    /**
     * Obtiene información de los objetivos e indicadores
     *
     * @param Request $request
     *
     * @return array
     */
    public function componentsData(Request $request)
    {
        $filters = $request->all();

        $data = collect([]);
        $index = 0;

        $thresholds = $this->thresholdRepository->findAll();

        $user = currentUser();

        $departmentsFilter = $user->departments->map(function ($item, $key) {
            return $item->id;
        })->toArray();

        $components = $this->componentRepository->getComponentsWithIndicators($filters, $departmentsFilter);

        $components->each(function ($component) use (&$data, &$index, $filters) {

            $parent = $index;
            $componentRow = [
                'id' => $index,
                'primaryId' => $component->id,
                'name' => $component->name,
                'parent' => null,
                'indent' => 0,
                'editable' => false
            ];

            $data->push($componentRow);
            $index++;

            if ($component->indicators->count()) {

                $component->indicators->each(function ($indicator) use (&$data, &$index, $parent, $filters) {

                    if ($indicator->planIndicatorGoals->count()) {
                        $indicatorRow = self::buildIndicatorRow($indicator, $index, $parent);

                        $data->push($indicatorRow);
                        $index++;
                    }
                });
            }
        });

        return [
            'thresholds' => json_encode($thresholds, JSON_HEX_APOS | JSON_HEX_QUOT),
            'data' => json_encode($data->toArray(), JSON_HEX_APOS | JSON_HEX_QUOT),
            'type' => $filters['type']
        ];
    }

    /**
     * Actualiza las metas reales de los indicadores
     *
     * @param array $data
     *
     * @return array
     */
    public function updateIndicator(array $data)
    {
        foreach ($data as $item) {

            if ($item['indent'] == 1) {
                $goalIndicator = $this->indicatorGoalsRepository->find($item['goal_id']);
                $goalIndicator->actual_value = $item['real_goal'];
                $goalIndicator->update();
            }
        }

        return $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('indicator_tracking.messages.success.update')
            ]
        ];
    }

    /**
     * Muestra un indicador completo
     *
     * @param int $id
     * @param string $indicatorType
     *
     * @return mixed
     */
    public function showIndicator(int $id, string $indicatorType)
    {
        switch ($indicatorType) {
            case PlanIndicator::INDICATORABLE_OPERATIONAL_GOAL:
                $operationalGoalProcess = resolve(OperationalGoalsProcess::class);
                return $operationalGoalProcess->showFullIndicator($id);
                break;
            case PlanIndicator::INDICATORABLE_PLAN:
                $planElementProcess = resolve(PlanElementProcess::class);
                return $planElementProcess->showFullIndicator($id);
                break;
            case PlanIndicator::INDICATORABLE_PROJECT:
                $projectProcess = resolve(ProjectProcess::class);
                return $projectProcess->showIndicator($id);
                break;
            case PlanIndicator::INDICATORABLE_COMPONENT:
                $componentProcess = resolve(ComponentProcess::class);
                return $componentProcess->showIndicator($id);
                break;
        }
    }

    /**
     * Construye arreglo con la estructura de un indicador
     *
     * @param PlanIndicator $indicator
     * @param int $index
     * @param int $parent
     *
     * @return array
     */
    private function buildIndicatorRow(PlanIndicator $indicator, int $index, int $parent)
    {
        $indicatorGoal = $indicator->planIndicatorGoals->first();

        if ($indicatorGoal->actual_value === null) {
            $percentage = null;
        } else {
            $percentage = self::calculatePercentage($indicator, $indicatorGoal);

            $value = $this->thresholdRepository->getThreshold($percentage, $indicator->type);
        }

        $file = null;

        if (file_exists(env('INDICATORS_PATH') . '/' . $indicator->technical_file)) {
            $file = $indicator->technical_file;
        }

        return [
            'id' => $index,
            'primaryId' => $indicator->id,
            'name' => $indicator->name,
            'parent' => $parent,
            'indent' => 1,
            'editable' => true,
            'plan_goal' => $indicator->type == PlanIndicator::TYPE_TOLERANCE ? $indicatorGoal->min . ' - ' . $indicatorGoal->max : $indicatorGoal->goal_value,
            'real_goal' => $indicatorGoal->actual_value,
            'percentage' => $percentage,
            'threshold' => isset($value) ? $value : null,
            'goal_id' => $indicatorGoal->id,
            'goal_type' => $indicator->goal_type,
            'type_indicator' => $indicator->type,
            'base_line' => $indicator->base_line,
            'file' => $file,
            'measurement_type' => $indicator->goal_type ? PlanIndicator::goalTypes()[$indicator->goal_type] : ''
        ];
    }

    /**
     * Calcula el porcentaje / desviación alcanzado del indicador
     *
     * @param PlanIndicator $indicator
     * @param PlanIndicatorGoal $indicatorGoal
     *
     * @return float|int
     */
    private function calculatePercentage(PlanIndicator $indicator, PlanIndicatorGoal $indicatorGoal)
    {
        if ($indicatorGoal->goal_value > 0) {
            if ($indicator->type == PlanIndicator::TYPE_DESCENDING) {
                if (($indicator->base_line - $indicatorGoal->goal_value) != 0) {
                    if ($indicator->goal_type === PlanIndicator::TYPE_DISCREET) {
                        $percentage = (($indicator->base_line - ($indicator->base_line - $indicatorGoal->actual_value)) /
                                ($indicator->base_line - ($indicator->base_line - $indicatorGoal->goal_value))) * 100;
                    } else {
                        $percentage = (($indicator->base_line - $indicatorGoal->actual_value) / ($indicator->base_line - $indicatorGoal->goal_value)) * 100;
                    }
                } else {
                    $percentage = 0;
                }
            } else {
                if ($indicator->type == PlanIndicator::TYPE_ASCENDING) {
                    $percentage = $indicatorGoal->actual_value * 100 / $indicatorGoal->goal_value;
                }
            }
        } else {
            if ($indicator->type == PlanIndicator::TYPE_TOLERANCE && !is_null($indicatorGoal->min) && !is_null($indicatorGoal->max) && $indicatorGoal->max > 0 && $indicatorGoal->min > 0) {
                if ($indicatorGoal->actual_value <= $indicatorGoal->max && $indicatorGoal->actual_value >= $indicatorGoal->min) {
                    $percentage = 0;
                } else {
                    $percentage_max = $indicatorGoal->actual_value * 100 / $indicatorGoal->max;
                    $percentage_min = $indicatorGoal->actual_value * 100 / $indicatorGoal->min;
                    $deviation_percentage_max = abs(($percentage_max - 100));
                    $deviation_percentage_min = abs(($percentage_min - 100));
                    $measurement_value = $deviation_percentage_max;
                    if ($deviation_percentage_max > $deviation_percentage_min) {
                        $measurement_value = $deviation_percentage_min;
                    }
                    $percentage = $measurement_value;
                }
            } else {
                $percentage = 0;
            }
        }
        return $percentage;
    }
}