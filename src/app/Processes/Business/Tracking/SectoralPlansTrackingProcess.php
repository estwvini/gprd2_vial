<?php

namespace App\Processes\Business\Tracking;

use App\Models\Business\Plan;
use App\Processes\Business\Execution\IndicatorProgressProcess;
use App\Processes\Business\Planning\PlanElementProcess;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\OperationalGoalsRepository;
use App\Repositories\Repository\Business\PlanRepository;
use Exception;

/**
 * Clase SectoralPlansTrackingProcess
 * @package App\Processes\Business\Tracking
 */
class SectoralPlansTrackingProcess
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
     * @var IndicatorProgressProcess
     */
    private $indicatorProgressProcess;

    /**
     * @var PlanRepository
     */
    private $planRepository;

    /**
     * Constructor de SectoralPlansTrackingProcess.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     * @param PlanRepository $planRepository
     * @param PlanElementProcess $planElementProcess
     * @param PlanElementRepository $planElementRepository
     * @param IndicatorProgressProcess $indicatorProgressProcess
     */
    public function __construct(
        FiscalYearRepository $fiscalYearRepository,
        PlanRepository $planRepository,
        PlanElementProcess $planElementProcess,
        PlanElementRepository $planElementRepository,
        IndicatorProgressProcess $indicatorProgressProcess
    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->planRepository = $planRepository;
        $this->planElementProcess = $planElementProcess;
        $this->planElementRepository = $planElementRepository;
        $this->indicatorProgressProcess = $indicatorProgressProcess;
    }

    /**
     * Carga la información necesaria para mostrar la vista de seguimiento de planes sectoriales.
     *
     * @return array
     * @throws Exception
     */
    public function index()
    {
        $plans = $this->planRepository->getPlans(Plan::TYPE_SECTORAL);

        return [
            'plans' => $plans
        ];
    }

    /**
     * Carga la información necesaria para mostrar los objetivos de un plan sectorial.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function data(int $id)
    {
        $years = $this->indicatorProgressProcess->sectoralGetYears($id);

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear()->year;
        if ($currentFiscalYear) {
            $objectives = $this->planElementRepository->dataObjectivesTrackingSectoral($id, $currentFiscalYear);
        } else {
            throw new Exception(trans('operational_goals.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $thresholdsIndicators = $this->planElementProcess->thresholdsIndicators($objectives);

        return [
            'years' => $years,
            'currentFiscalYear' => $currentFiscalYear,
            'indicators' => $thresholdsIndicators[0],
            'elements' => $thresholdsIndicators[3]->keyBy('id'),
            'type' => 'sectoral_tracking',
            'elementType' => 'objective',
            'route' => route('indicators.data.index.sectoral.tracking', ['id' => '__ID__', 'year' => '__YEAR__']),
        ];
    }

    /**
     * Obtiene los indicadores de un objetivo del plan sectorial.
     *
     * @param int $id
     * @param string $year
     *
     * @return array
     * @throws Exception
     */
    public function indicators(int $id, string $year)
    {
        $objective = $this->planElementRepository->find($id);

        if (!$objective) {
            throw new Exception(trans('sectoral_tracking.messages.exceptions.not_found'));
        }

        $indicators = $this->planElementProcess->chartIndicators($objective, $year);

        return [
            'indicators' => $indicators,
            'objective' => $objective,
            'type' => 'sectoral_tracking',
            'elementType' => 'objective',
            'backRoute' => null
        ];
    }
}