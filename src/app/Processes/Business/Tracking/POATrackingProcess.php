<?php

namespace App\Processes\Business\Tracking;

use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectSchedule;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ScheduleRepository;
use App\Repositories\Repository\Business\Reports\DashboardRepository;
use App\Repositories\Repository\Business\Tracking\POATrackingRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

/**
 * Clase POATrackingProcess
 * @package App\Processes\Business\Planning
 */
class POATrackingProcess
{

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var POATrackingRepository
     */
    private $POATrackingRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var DashboardRepository
     */
    private $dashboardRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * Constructor de POATrackingProcess.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     * @param POATrackingRepository $POATrackingRepository
     * @param SettingRepository $settingRepository
     * @param DashboardRepository $dashboardRepository
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(
        FiscalYearRepository $fiscalYearRepository,
        POATrackingRepository $POATrackingRepository,
        SettingRepository $settingRepository,
        DashboardRepository $dashboardRepository,
        DepartmentRepository $departmentRepository
    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->POATrackingRepository = $POATrackingRepository;
        $this->settingRepository = $settingRepository;
        $this->dashboardRepository = $dashboardRepository;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Carga información del proyecto para mostrar en el index
     *
     * @return array
     * @throws Exception
     */
    public function index()
    {
        $years = $this->fiscalYearRepository->all();

        if (!$years->count()) {
            throw  new Exception(trans('reports.exceptions.no_info'), 1000);
        }

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $currentYear = $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year;
        $gadInfo = $this->settingRepository->findByKey('gad')->value;
        $gad = trans('reports.labels.gad') . ' ' . $gadInfo['province'];
        $executingUnits = $this->departmentRepository->findEnabled();

        return compact('years', 'currentYear', 'currentFiscalYear', 'gad', 'executingUnits');
    }

    /**
     * Cargar información del POA.
     *
     * @param Request $request
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function data(Request $request)
    {

        $data = $request->all();

        $fiscalYear = $this->fiscalYearRepository->find($data['fiscalYearId']);

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }

        $poaData = $this->POATrackingRepository->data($fiscalYear->id, $data['executingUnitId'] ?? 0);
        $date = date_format(Carbon::now(), 'Y-m-d');
        $activityBudget = collect([]);
        if (api_available()) {
            $activityBudget = $this->POATrackingRepository->activitiesBudget($fiscalYear->year, $date);
        }

        return DataTables::of($poaData)
            ->addColumn('physical_progress', function (ActivityProjectFiscalYear $entity) {
                return $entity->getProgress() . ' %';
            })
            ->addColumn('budget_progress', function (ActivityProjectFiscalYear $entity) use ($activityBudget) {
                $act = $activityBudget->firstWhere('cuenta', $entity->getProgrammaticCode());
                return $act ? number_format($act->porciento_ejecucion, 2) . ' %' : '0.00 %';

            })
            ->addColumn('codificado', function (ActivityProjectFiscalYear $entity) use ($activityBudget) {
                $act = $activityBudget->firstWhere('cuenta', $entity->getProgrammaticCode());
                return $act ? number_format($act->codificado, 2) : '0.00';
            })
            ->addColumn('por_comprometer', function (ActivityProjectFiscalYear $entity) use ($activityBudget) {
                $act = $activityBudget->firstWhere('cuenta', $entity->getProgrammaticCode());
                return $act ? number_format($act->por_comprometer, 2) : '0.00';
            })
            ->make(true);
    }

    /**
     * Cargar información del POA para exportar a excel.
     *
     * @param int $fiscalYearId
     * @param int $executingUnitId
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function poaPhysicalBudgetExport(int $fiscalYearId, int $executingUnitId)
    {

        $fiscalYear = $this->fiscalYearRepository->find($fiscalYearId);
        $executingUnit = $this->departmentRepository->find($executingUnitId);

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }

        $poaData = $this->POATrackingRepository->data($fiscalYear->id, $executingUnitId);
        $date = date_format(Carbon::now(), 'Y-m-d');
        $activityBudget = $this->POATrackingRepository->activitiesBudget($fiscalYear->year, $date);

        $poaData->each(function (&$item) use ($activityBudget) {
            $item->physical_progress = $item->getProgress() . ' %';
            $act = $activityBudget->firstWhere('cuenta', $item->getProgrammaticCode());
            $item->budget_progress = $act ? number_format($act->porciento_ejecucion, 2) : 0;
            $item->codificado = $act ? number_format($act->codificado, 2) : 0;
            $item->por_comprometer = $act ? number_format($act->por_comprometer, 2) : 0;
        });

        return [
            'year' => $fiscalYear->year,
            'executingUnit' => $executingUnit->name ?? trans('app.labels.all'),
            'rows' => $poaData
        ];
    }
}
