<?php

namespace App\Http\Controllers\Business\Tracking;

use App\Http\Controllers\Controller;
use App\Processes\Business\Tracking\POATrackingProcess;
use Exception;
use Illuminate\Http\Response;
use PDOException;
use Throwable;

/**
 * Clase POATrackingController
 * @package App\Http\Controllers\Business\Tracking
 */
class POATrackingController extends Controller
{

    /**
     * @var POATrackingProcess
     */
    protected $POATrackingProcess;

    /**
     * Constructor POATrackingController.
     *
     * @param POATrackingProcess $POATrackingProcess
     */
    public function __construct(
        POATrackingProcess $POATrackingProcess
    ){
        $this->POATrackingProcess = $POATrackingProcess;
    }

    /**
     * Mostrar lista de departamentos con sus proyectos.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $params = $this->POATrackingProcess->index();
            $response['view'] = view('business.tracking.operational.index', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información del POA.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->POATrackingProcess->data();
        } catch (PDOException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

}