<?php

namespace App\Http\Controllers\Business\Catalogs;

use App\Http\Controllers\Controller;
use App\Processes\Business\Catalogs\CPCProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase CPCController
 * @package App\Http\Controllers\Business\Catalogs
 */
class CPCController extends Controller
{
    /**
     * @var CPCProcess
     */
    protected $cpcProcess;

    /**
     * Constructor de CPCController.
     *
     * @param CPCProcess $cpcProcess
     */
    public function __construct(CPCProcess $cpcProcess)
    {
        $this->cpcProcess = $cpcProcess;
    }

    /**
     * Mostrar vista de listado de compras públicas.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.catalogs.cpc.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de compra pública.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->cpcProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de compra pública.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['view'] = view('business.catalogs.cpc.create')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nueva compra pública.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->cpcProcess->store($request->all());

            $response = [
                'view' => view('business.catalogs.cpc.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('cpc.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de compra pública.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.catalogs.cpc.update',
                $this->cpcProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de compra pública.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->cpcProcess->update($request->all(), $id);

            $response = [
                'view' => view('business.catalogs.cpc.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('cpc.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar una compra pública.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->cpcProcess->destroy($id);

            $response = [
                'view' => view('business.catalogs.cpc.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('cpc.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para cambiar de estado una compra pública.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function status(int $id)
    {
        try {
            $entity = $this->cpcProcess->status($id);

            $response['message'] = [
                'type' => 'success',
                'text' => ($entity->enabled) ? trans('cpc.messages.success.status_on') : trans('cpc.messages.success.status_off')
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
