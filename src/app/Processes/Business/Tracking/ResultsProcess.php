<?php

namespace App\Processes\Business\Tracking;

use App\Models\Business\Plan;
use App\Processes\Business\Execution\IndicatorProgressProcess;
use App\Processes\Business\Planning\PlanElementProcess;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Clase ResultsProcess
 * @package App\Processes\Business\Tracking
 */
class ResultsProcess
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
     * @var IndicatorProgressProcess
     */
    private $indicatorProgressProcess;

    /**
     * @var PlanElementProcess
     */
    private $planElementProcess;

    /**
     * @var PlanElementRepository
     */
    private $planElementRepository;

    /**
     * Constructor de ResultsProcess.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     * @param PlanElementRepository $planElementRepository
     * @param IndicatorProgressProcess $indicatorProgressProcess
     * @param PlanElementProcess $planElementProcess
     */
    public function __construct(
        FiscalYearRepository $fiscalYearRepository,
        PlanElementRepository $planElementRepository,
        IndicatorProgressProcess $indicatorProgressProcess,
        PlanElementProcess $planElementProcess
    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->planElementRepository = $planElementRepository;
        $this->indicatorProgressProcess = $indicatorProgressProcess;
        $this->planElementProcess = $planElementProcess;
    }

    /**
     * Carga la información necesaria para mostrar el seguimiento de resultados del PEI.
     *
     * @param Request $request
     *
     * @return array
     */
    public function indexPEI(Request $request)
    {
        $years = $this->indicatorProgressProcess->getYears(Plan::TYPE_PEI);
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        if ($currentFiscalYear) {
            $objectives = $this->planElementRepository->dataObjectivesTrackingPEI($currentFiscalYear->year);
        } else {
            $objectives = collect([]);
        }
        $thresholdsIndicators = $this->planElementProcess->thresholdsIndicators($objectives);

        return [
            'years' => $years,
            'currentFiscalYear' => $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year,
            'indicators' => $thresholdsIndicators[0],
            'elements' => $thresholdsIndicators[3]->keyBy('id')
        ];
    }

    /**
     * Carga la información necesaria para mostrar el seguimiento de resultados del PDOT.
     *
     * @param Request $request
     *
     * @return array
     */
    public function indexPDOT(Request $request)
    {
        $years = $this->indicatorProgressProcess->getYears(Plan::TYPE_PDOT);
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        if ($currentFiscalYear) {
            $objectives = $this->planElementRepository->dataObjectivesTrackingPDOT($currentFiscalYear->year);
        } else {
            $objectives = collect([]);
        }
        $thresholdsIndicators = $this->planElementProcess->thresholdsIndicators($objectives);

        return [
            'years' => $years,
            'currentFiscalYear' => $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year,
            'indicators' => $thresholdsIndicators[0],
            'elements' => $thresholdsIndicators[3]->keyBy('id')
        ];
    }

    /**
     * Carga la información necesaria para mostrar los indicadores de resultados del PEI.
     *
     * @param int $id
     * @param string $year
     *
     * @return array
     */
    public function indicatorsPEI(int $id, string $year)
    {
        $objective = $this->planElementRepository->find($id);

        $indicators = $this->planElementProcess->chartIndicators($objective, $year);

        return [
            'indicators' => $indicators,
            'objective' => $objective,
            'type' => 'results_pei',
            'elementType' => 'objective',
            'backRoute' => null
        ];
    }

    /**
     * Carga la información necesaria para mostrar los indicadores de resultados del PDOT.
     *
     * @param int $id
     * @param string $year
     *
     * @return array
     */
    public function indicatorsPDOT(int $id, string $year)
    {
        $objective = $this->planElementRepository->find($id);
        $indicators = $this->planElementProcess->chartIndicators($objective, $year);

        return [
            'indicators' => $indicators,
            'objective' => $objective,
            'type' => 'results_pdot',
            'elementType' => 'objective',
            'backRoute' => null
        ];
    }
}