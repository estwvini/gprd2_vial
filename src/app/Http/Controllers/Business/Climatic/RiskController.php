<?php

namespace App\Http\Controllers\Business\Climatic;

use App\Processes\Business\Climatic\RiskProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Throwable;
/**
 * Clase RiskController
 * @package App\Http\Controllers\Business\Climatic
 */
class RiskController extends Controller
{
      /**
     * @var RiskProcess
     */
    protected $riskProcess;

    /**
     * Constructor riskController.
     * @param RiskProcess $riskProcess
     */
    public function __construct(
        RiskProcess $riskProcess
    )
    {
        $this->riskProcess = $riskProcess;
    }
    /**
     * Llamada al proceso para ubicar coordenadas
     *
     * @return mixed|string
     */
    public function locale(Request $request)
    {
        try {
            return $this->riskProcess->locale($request->all()['filters']);
        } catch (Throwable $e) {
            return defaultCatchHandler($e);
        }
    }

    /**
     * Llamada al proceso para obtener y marcar las capas
     *
     * @return JsonResponse
     */
    public function execute(Request $request)
    {        
        try {
            return $this->riskProcess->execute($request->all()['filters']);          
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }        
    }

     /**
     * Llamada al proceso para descargar un documento.
     *
     * @param int $id
     *
     * @return JsonResponse|mixed
     */
    public function generate(int $id)
    {
        try {
            return $this->riskProcess->generate($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
  
}
