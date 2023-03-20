<?php

namespace App\Processes\Business\Tracking;

use App\Models\Business\Plan;
use App\Processes\Business\Execution\IndicatorProgressProcess;
use App\Processes\Business\Planning\PlanElementProcess;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\OperationalGoalsRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

/**
 * Clase OperationalGoalsTrackingProcess
 * @package App\Processes\Business\Tracking
 */
class OperationalGoalsTrackingProcess
{
    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var PlanElementRepository
     */
    private $planElementRepository;

    /**
     * @var PlanElementProcess
     */
    private $planElementProcess;

    /**
     * @var OperationalGoalsRepository
     */
    private $operationalGoalsRepository;

    /**
     * @var IndicatorProgressProcess
     */
    private $indicatorProgressProcess;

    /**
     * Constructor de OperationalGoalsTrackingProcess.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     * @param PlanElementRepository $planElementRepository
     * @param PlanElementProcess $planElementProcess
     * @param IndicatorProgressProcess $indicatorProgressProcess
     */
    public function __construct(
        FiscalYearRepository $fiscalYearRepository,
        PlanElementRepository $planElementRepository,
        PlanElementProcess $planElementProcess,
        IndicatorProgressProcess $indicatorProgressProcess,
        OperationalGoalsRepository $operationalGoalsRepository
    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->planElementRepository = $planElementRepository;
        $this->planElementProcess = $planElementProcess;
        $this->indicatorProgressProcess = $indicatorProgressProcess;
        $this->operationalGoalsRepository = $operationalGoalsRepository;
    }

    /**
     * Carga la información necesaria para mostrar los objetivos operacionales.
     *
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function index(Request $request)
    {
        $years = $this->indicatorProgressProcess->getYears(Plan::TYPE_PEI);
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        if ($currentFiscalYear) {
            $objectives = $this->planElementRepository->dataOperationalGoalsTracking($currentFiscalYear);

            $operationalGoals = collect();

            $objectives->each(function ($objective) use (&$operationalGoals) {
                if ($objective->operationalGoals->isNotEmpty()) {
                    $objective->operationalGoals->each(function ($operationalGoal) use (&$operationalGoals) {
                        $operationalGoals->push($operationalGoal);
                    });
                }
            });

            $thresholdsIndicators = $this->planElementProcess->thresholdsIndicators($operationalGoals);

            $indicators = $thresholdsIndicators[0];
            $elements = $thresholdsIndicators[3]->keyBy('id');

        } else {
            $indicators = collect();
            $elements = collect();
        }

        return [
            'years' => $years,
            'currentFiscalYear' => $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year,
            'indicators' => $indicators,
            'elements' => $elements
        ];
    }

    /**
     * Obtiene los indicadores de un objetivo operativo.
     *
     * @param int $id
     * @param string $year
     *
     * @return array
     * @throws Exception
     */
    public function indicators(int $id, string $year)
    {
        $objective = $this->operationalGoalsRepository->find($id);

        if (!$objective) {
            throw new Exception(trans('operational_goals.messages.exceptions.not_found'));
        }

        $indicators = $this->planElementProcess->chartIndicators($objective, $year);

        return [
            'indicators' => $indicators,
            'objective' => $objective,
            'type' => 'operational_goals',
            'elementType' => 'objective',
            'backRoute' => null
        ];
    }
}