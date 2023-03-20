<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Processes\Admin\ThresholdProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase class ThresholdController extends Controller
 * @package App\Http\Controllers\Admin
 */
class ThresholdController extends Controller
{
    /**
     * @var $thresholdProcess
     */
    protected $thresholdProcess;

    /**
     * Constructor de ThresholdController.
     *
     * @param ThresholdProcess $thresholdProcess
     */
    public function __construct(
        ThresholdProcess $thresholdProcess
    ) {
        $this->thresholdProcess = $thresholdProcess;
    }

    /**
     * Mostrar formulario de edición de un indicador del plan.
     *
     * @return JsonResponse
     */
    public function edit()
    {
        try {
            return response()->json($this->thresholdProcess->edit());
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Actualizar umbral.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        try {
            return response()->json($this->thresholdProcess->update($request->all()));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }
}
