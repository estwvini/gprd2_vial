<?php

namespace App\Http\Controllers\Business\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * Clase ReportsController
 * @package App\Http\Controllers\Business\Reports
 */
class ReportsController extends Controller
{
    /**
     * Mostrar listado de todos los reportes.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.reports.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
