<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\ProjectFiscalYearProcess;
use App\Repositories\Repository\Admin\DepartmentRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase ProjectFiscalYearController
 * @package App\Http\Controllers\Business\Planning
 */
class ProjectFiscalYearController extends Controller
{
    /**
     * @var ProjectFiscalYearProcess
     */
    protected $projectFiscalYearProcess;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * Constructor de PrioritizationController.
     *
     * @param ProjectFiscalYearProcess $projectFiscalYearProcess
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(
        ProjectFiscalYearProcess $projectFiscalYearProcess, DepartmentRepository  $departmentRepository
    ) {
        $this->projectFiscalYearProcess = $projectFiscalYearProcess;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Desplegar lista de proyectos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $fiscalYear = $this->projectFiscalYearProcess->nextFiscalYear();

            $response['view'] = view('business.planning.projects.index', [
                'year' => $fiscalYear ? $fiscalYear->year : Carbon::now()->addYear()->year,
                'responsibleUnits' => $this->departmentRepository->findAll()
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesa la petición ajax de datatables
     *
     * @return string
     */
    public function data(Request $request)
    {
        try {
            return $this->projectFiscalYearProcess->data($request->unitId);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para cambiar de estado un proyecto.
     *
     * @param int $id
     * @param int $project_fiscal_year_id
     *
     * @return JsonResponse
     */
    public function status(int $id, int $project_fiscal_year_id)
    {
        try {
            $entity = $this->projectFiscalYearProcess->status($project_fiscal_year_id);
            $fiscalYear = $this->projectFiscalYearProcess->nextFiscalYear();
            $response = [
                'view' => view('business.planning.projects.index', ['year' => $fiscalYear->year])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('projects.messages.success.status_updated', ['status' => trans('projects.status.' . strtolower($entity->status))])
                ]
            ];

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Muestra modal con el listado de rechazos de un proyecto
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function rejectionsLog(Request $request)
    {
        try {
            $data = $this->projectFiscalYearProcess->rejectionsLog($request);

            $response['modal'] = view('business.planning.partials.rejections.rejections', $data)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Genera la estructura de datatable de rechazos
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function rejectionsLogData(Request $request)
    {
        try {
            return $this->projectFiscalYearProcess->rejectionsLogData($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }

    }
}