<?php

namespace App\Http\ViewComposers;

use App\Processes\Business\Tracking\ProjectTrackingProcess;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use PDOException;
use Throwable;

/**
 * Clase PlanningDashboardComposer
 * @package App\Http\ViewComposers
 */
class PlanningDashboardComposer
{
    /**
     * @var ProjectTrackingProcess
     */
    protected $projectTrackingProcess;

    /**
     * Constructor de PlanningDashboardComposer.
     *
     * @param ProjectTrackingProcess $projectTrackingProcess
     */
    public function __construct(
        ProjectTrackingProcess $projectTrackingProcess
    ) {
        $this->projectTrackingProcess = $projectTrackingProcess;
    }

    /**
     * Enlazar datos a la vista.
     *
     * @param View $view
     *
     * @throws Exception
     */
    public function compose(View $view)
    {
        try {
            $data = $this->projectTrackingProcess->projectsDashboard();

            $view->with([
                'projectFiscalYears' => $data['projectFiscalYears'],
                'encoded' => $data['encoded'],
                'accrued' => $data['accrued'],
                'percent' => $data['percent'],
                'delayedTasks' => $data['delayedTasks'],
                'tasks' => $data['tasks'],
                'budgetMonthly' => $data['budgetMonthly'],
                'budgetByResponsibleUnits' => $data['budgetByResponsibleUnits'],
                'quantityProjectsAtRisk' => $data['quantityProjectsAtRisk'],
                'quantityProjectsInTime' => $data['quantityProjectsInTime'],
                'projectsByStatus' => $data['projectsByStatus'],
                'sfgprovException' => false,
                'exception' => false
            ]);

        } catch (PDOException $e) {
            $view->with([
                'sfgprovException' => true
            ]);
        } catch (Throwable $e) {
            $view->with([
                'sfgprovException' => false,
                'exception' => true
            ]);
        }


    }
}