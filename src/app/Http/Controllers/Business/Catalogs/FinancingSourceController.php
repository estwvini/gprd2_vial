<?php
declare(strict_types=1);

namespace App\Http\Controllers\Business\Catalogs;

use App\Http\Controllers\Controller;
use App\Processes\Business\Catalogs\FinancingSourceProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase FinancingSourceController
 * @package App\Http\Controllers\Business\Catalogs
 */
class FinancingSourceController extends Controller
{
    /**
     * @var FinancingSourceProcess
     */
    protected $financingSourceProcess;

    /**
     * Constructor de FinancingSourceController.
     *
     * @param FinancingSourceProcess $financingSourceProcess
     */
    public function __construct(FinancingSourceProcess $financingSourceProcess)
    {
        $this->financingSourceProcess = $financingSourceProcess;
    }

    /**
     * Mostrar vista de listado de fuentes de financiamiento de ingresos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.catalogs.financing_source.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de fuente de financiamiento.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->financingSourceProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de fuente de financiamiento.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['view'] = view('business.catalogs.financing_source.create')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nueva fuente de financiamiento.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->financingSourceProcess->store($request->all());

            $response = [
                'view' => view('business.catalogs.financing_source.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('financing_sources.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de fuente de financiamiento.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.catalogs.financing_source.update',
                $this->financingSourceProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de fuente de financiamiento.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->financingSourceProcess->update($request->all(), $id);
            $response = [
                'view' => view('business.catalogs.financing_source.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('financing_sources.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = $id;
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar una fuente de financiamiento.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->financingSourceProcess->destroy($id);

            $response = [
                'view' => view('business.catalogs.financing_source.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('financing_sources.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para cambiar de estado una fuente de financiamiento.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function status(int $id)
    {
        try {
            if ($this->financingSourceProcess->status($id)) {

                $response['message'] = [
                    'type' => 'success',
                    'text' => trans('financing_sources.messages.success.enabled')
                ];
            } else {
                $response['message'] = [
                    'type' => 'success',
                    'text' => trans('financing_sources.messages.success.disabled')
                ];
            }
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
