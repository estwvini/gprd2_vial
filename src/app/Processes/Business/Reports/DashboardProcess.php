<?php

namespace App\Processes\Business\Reports;

use App\Repositories\Repository\Business\AdminActivityRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Reports\DashboardRepository;
use App\Repositories\Repository\Business\Tracking\BudgetProjectTrackingRepository;
use Carbon\Carbon;
use Exception;

/**
 * Clase DashboardProcess
 * @package App\Processes\Business\Reports
 */
class DashboardProcess
{
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var DashboardRepository
     */
    private $dashboardRepository;

    /**
     * @var $currentFiscalYear
     */
    private $currentFiscalYear;

    /**
     * @var AdminActivityRepository
     */
    private $adminActivityRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var BudgetProjectTrackingRepository
     */
    private $budgetProjectTrackingRepository;

    /**
     * Constructor de DashboardProcess.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     * @param DashboardRepository $dashboardRepository
     * @param AdminActivityRepository $adminActivityRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     *
     * @throws Exception
     */
    public function __construct(
        FiscalYearRepository $fiscalYearRepository,
        DashboardRepository $dashboardRepository,
        AdminActivityRepository $adminActivityRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        BudgetProjectTrackingRepository $budgetProjectTrackingRepository
    ) {

        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->dashboardRepository = $dashboardRepository;

        $this->adminActivityRepository = $adminActivityRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->budgetProjectTrackingRepository = $budgetProjectTrackingRepository;
    }

    /**
     * Retorna los detalles del presupuesto de ingresos
     *
     * @param int $type
     *
     * @return string[]
     * @throws Exception
     */
    public function detailsBudget(int $type)
    {
        $date = date_format(Carbon::now(), 'Y-m-d');
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $result = $this->dashboardRepository->totalsBudgetByType($currentFiscalYear->year, $date, $type);
        return [
            'assigned' => $result[0]->asig_ini ?? 0.00,
            'reform' => $result[0]->reformas ?? 0.00,
            'encoded' => $result[0]->codificado ?? 0.00,
            'accrued' => $result[0]->devengado ?? 0.00,
            'porComprometer' => $result[0]->por_comprometer ?? 0.00,
            'porDevengar' => $result[0]->por_devengar ?? 0.00,
            'percent' => $result[0]->porciento_ejecucion ?? 0.00,
            'type' => $type
        ];
    }

    /**
     * Retorna data para gráfica de presupuesto por fuente de financiamiento
     *
     * @param int $type
     *
     * @param string $category
     *
     * @return mixed
     */
    public function budgetByCategory(int $type, string $category)
    {
        $date = date_format(Carbon::now(), 'Y-m-d');
        if ($type == 2) { // incomes
            if ($category == 'source') {
                $from = 12;
                $length = 3;
                $level = 5;
            } else { // classifier type
                $from = 1;
                $length = 1;
                $level = 1;
            }
        } else {
            switch ($category) {
                case 'source':
                    $from = 58;
                    $length = 3;
                    $level = 19;
                    break;
                case 'unit':
                    $from = 14;
                    $length = 3;
                    $level = 5;
                    break;
                case 'classifierType':
                    $from = 22;
                    $length = 1;
                    $level = 7;
            }
        }
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        return $this->dashboardRepository->budgetByCategory($currentFiscalYear->year, $date, $from, $length, $level, $type);
    }

    /**
     * Retorna la ejecución del presupuesto por mes
     *
     * @return mixed
     */
    public function budgetMonthlyExecution()
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        return $this->dashboardRepository->budgetMonthlyExecution($currentFiscalYear->year);
    }

    /**
     * Retorna data para gráfica de estados de actividad
     *
     * @return mixed
     */
    public function adminActByStatus()
    {
        $user = currentUser();
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        return $this->adminActivityRepository->findGroupByStatus($fiscalYear, true, $user->id, null);
    }

    /**
     * Retorna data para gráfica de prioridad de actividad
     *
     * @return mixed
     */
    public function adminActByPriority()
    {
        $user = currentUser();
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        return $this->adminActivityRepository->findGroupByPriority($fiscalYear, true, $user->id, null);
    }

    /**
     *  Obtiene data para gráfica de actividades por usuario
     *
     * @return mixed
     */
    public function adminActByResponsibleUnit()
    {
        $user = currentUser();
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        return $this->adminActivityRepository->findGroupByResponsibleUnit($fiscalYear, true, $user->id, true, null);
    }

    /**
     * Retorna los detalles de los proyectos de inversion
     *
     * @param int $type
     *
     * @return string[]
     * @throws Exception
     */
    public function detailsProject(int $type)
    {
        $date = date_format(Carbon::now(), 'Y-m-d');
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $result = $this->dashboardRepository->totalsProjectByType($currentFiscalYear->year, $date, $type);
        return [
            'assigned' => $result[0]->asig_ini ?? 0.00,
            'reform' => $result[0]->reformas ?? 0.00,
            'encoded' => $result[0]->codificado ?? 0.00,
            'percent' => $result[0]->porciento_ejecucion ?? 0.00,
            'type' => $type
        ];
    }
}
