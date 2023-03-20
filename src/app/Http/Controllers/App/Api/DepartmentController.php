<?php

namespace App\Http\Controllers\App\Api;

use App\Http\Controllers\App\Resources\DepartmentResource;
use App\Processes\App\DepartmentProcess;
use App\Processes\App\HistoryProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    /**
     * @var DepartmentProcess
     */
    private $departmentProcess;

    /**
     * @var HistoryProcess
     */
    private $historyProcess;

    /**
     * @param DepartmentProcess $departmentProcess
     * @param HistoryProcess $historyProcess
     */
    public function __construct(DepartmentProcess $departmentProcess, HistoryProcess $historyProcess)
    {
        $this->departmentProcess = $departmentProcess;
        $this->historyProcess = $historyProcess;
    }

    /**
     * Retrieve a collection of departments.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $year = $request->get('year') ?? now()->year;
        if ($year >= 2020) {
            return $this->jsonResource(DepartmentResource::collection($this->departmentProcess->getDepartmentsTotals($year)));
        }
        return $this->jsonResource(DepartmentResource::collection($this->historyProcess->getDepartmentsTotals($year)));
    }
}
