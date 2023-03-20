<?php

namespace App\Http\Controllers\Business\Planning;

use App\Processes\Business\Planning\IndicatorGoalsProcess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class IndicatorGoalsController extends Controller
{
    /**
     * @var IndicatorGoalsProcess
     */
    protected $indicatorGoalsProcess;


    /**
     * Constructor de IndicatorGoalsController.
     *
     * @param IndicatorGoalsProcess $indicatorGoalsProcess
     */
    public function __construct(
        IndicatorGoalsProcess $indicatorGoalsProcess
    ) {
        $this->indicatorGoalsProcess = $indicatorGoalsProcess;
    }

    /**
     * Almacenar metas nuevas en la base de datos.
     *
     * @param  \Illuminate\Http\Request $request
     * @param int $indicatorId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, int $indicatorId)
    {
        try {
            $this->indicatorGoalsProcess->store($request, $indicatorId);
            return response()->json();
        } catch (\Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }


    /**
     * Almacenar metas nuevas en la base de datos.
     *
     * @param  \Illuminate\Http\Request $request
     * @param int $indicatorId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $indicatorId)
    {
        try {
            $this->indicatorGoalsProcess->update($request, null, $indicatorId);
            return response()->json();
        } catch (\Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

}
