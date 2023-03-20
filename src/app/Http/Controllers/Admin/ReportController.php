<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Processes\Admin\ReportProcess;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

/**
 * Clase ReportController
 * @package App\Http\Controllers\Admin
 */
class ReportController extends Controller
{
    /**
     * @var ReportProcess
     */
    protected $reportProcess;

    /**
     * ReportController constructor.
     *
     * @param ReportProcess $reportProcess
     */
    public function __construct(ReportProcess $reportProcess)
    {
        $this->reportProcess = $reportProcess;
    }

    /**
     * Muestra reporte de usuarios
     *
     * @return JsonResponse
     */
    public function usersIndex()
    {
        try {
            $response['view'] = view('admin.reports.users.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables
     *
     * @return string
     */
    public function usersData()
    {
        try {
            return $this->reportProcess->usersData();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra reporte de proyectos
     *
     * @return JsonResponse
     */
    public function projectIndex()
    {
        try {
            $response['view'] = view('admin.reports.projects.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables
     *
     * @return string
     */
    public function projectData()
    {
        try {
            return $this->reportProcess->projectData();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Muestra reporte de actividades de usuarios
     *
     * @return JsonResponse
     */
    public function auditIndex()
    {
        try {
            $response['view'] = view('admin.reports.audits.index', $this->reportProcess->auditIndex())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables
     *
     * @param Request $request
     *
     * @return string
     */
    public function auditData(Request $request)
    {
        try {
            return $this->reportProcess->auditData($request->all()['filters']);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta las actividades de usuarios en un documento PDF
     *
     * @param Request $request
     *
     * @return string|BinaryFileResponse
     */
    public function auditExport(Request $request)
    {
        try {
            $data = $this->reportProcess->auditDataExport($request->all()['filters']);
            $pdf = PDF::loadView('admin/reports/audits/audit_table', $data)->setPaper('a4', 'landscape');
            return $pdf->download(trans('reports.config.audit.title') . '.pdf');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Procesar la respuesta ajax de datatables
     *
     * @param int $id
     *
     * @return string
     */
    public function auditDetails(int $id)
    {
        try {
            $response['modal_xl'] = view('admin.reports.audits.details', $this->reportProcess->auditDetail($id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
