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
     * Mostrar vista de riesgo climático.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.climaterisk.index',
            $this->riskProcess->indexRisk()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

     /**
     * Mostrar vista de consulta en shapes.
     *
     * @return JsonResponse
     */
    public function shapeQuery(Request $request)
    {
        try {
            return $this->riskProcess->shapeQuery($request->all()['filters']);
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

      /**
     * Llamada al proceso para cargar las parroquias dado un cantón.
     *
     * @param string $name
     *
     * @return JsonResponse|mixed
     */
    public function loadParishes(string $name)
    {
        try {
            return str_replace("\u0022", "\\\\\"", json_encode($this->riskProcess->getParishes($name), JSON_HEX_APOS | JSON_HEX_QUOT));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }
  
}
