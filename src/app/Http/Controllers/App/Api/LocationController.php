<?php

namespace App\Http\Controllers\App\Api;

use App\Http\Controllers\App\Resources\BudgetLocationResource;
use App\Processes\App\BudgetLocationProcess;
use App\Processes\App\HistoryProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * @var BudgetLocationProcess
     */
    private $budgetLocationProcess;

    /**
     * @var HistoryProcess
     */
    private $historyProcess;


    /**
     * @param BudgetLocationProcess $budgetLocationProcess
     * @param HistoryProcess $historyProcess
     */
    public function __construct(BudgetLocationProcess $budgetLocationProcess, HistoryProcess $historyProcess)
    {
        $this->budgetLocationProcess = $budgetLocationProcess;
        $this->historyProcess = $historyProcess;
    }

    /**
     * Retrieve a collection of locations.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $year = $request->get('year') ?? now()->year;
        if ($year >= 2020) {
            return $this->jsonResource(BudgetLocationResource::collection($this->budgetLocationProcess->getLocationsTotals($year)));
        }
        return $this->jsonResource(BudgetLocationResource::collection($this->historyProcess->getLocationsTotals($year)));
    }
}
