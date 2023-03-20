<?php

namespace App\Http\Controllers\Business\Catalogs;

use App\Http\Controllers\Controller;
use App\Processes\Business\Catalogs\SpendingGuideProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase SpendingGuideController
 * @package App\Http\Controllers\Business\Catalogs
 */
class SpendingGuideController extends Controller
{
    /**
     * @var SpendingGuideProcess
     */
    protected $spendingGuideProcess;

    /**
     * Constructor de SpendingGuideController.
     *
     * @param SpendingGuideProcess $spendingGuideProcess
     */
    public function __construct(SpendingGuideProcess $spendingGuideProcess)
    {
        $this->spendingGuideProcess = $spendingGuideProcess;
    }

    /**
     * Mostrar vista de listado de orientación de gastos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.catalogs.spending_guide.index', [
                'orientations' => $this->spendingGuideProcess->byLevels(1)
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de orientación de gasto.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function data(Request $request)
    {
        try {
            return $this->spendingGuideProcess->data($request->all());
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de orientación de gasto.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $response['view'] = view('business.catalogs.spending_guide.create',
                $this->spendingGuideProcess->create($request->id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nueva orientación de gasto.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $entity = $this->spendingGuideProcess->store($request->all());

            $response = [
                'view' => view('business.catalogs.spending_guide.index', [
                    'orientations' => $this->spendingGuideProcess->byLevels(1)
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('spending_guide.messages.success.created', ['type' => trans('spending_guide.labels.level_' . $entity->level)])
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de orientación de gasto.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.catalogs.spending_guide.update',
                $this->spendingGuideProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de orientación de gasto.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $entity = $this->spendingGuideProcess->update($request->all(), $id);

            $response = [
                'view' => view('business.catalogs.spending_guide.index', [
                    'orientations' => $this->spendingGuideProcess->byLevels(1)
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('spending_guide.messages.success.updated', ['type' => trans('spending_guide.labels.level_' . $entity->level)])
                ]
            ];
        } catch (Throwable $e) {
            $response = $e;
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar una orientación de gasto.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $level = $this->spendingGuideProcess->destroy($id);

            $response = [
                'view' => view('business.catalogs.spending_guide.index', [
                    'orientations' => $this->spendingGuideProcess->byLevels(1)
                ])->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('spending_guide.messages.success.deleted', ['type' => trans('spending_guide.labels.level_' . $level)])
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para cambiar de estado una orientación de gasto.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function status(int $id)
    {
        try {
            $entity = $this->spendingGuideProcess->status($id);

            $response['message'] = [
                'type' => 'success',
                'text' => ($entity->enabled) ? trans('spending_guide.messages.success.status_on', ['type' => trans('spending_guide.labels.level_' . $entity->level)])
                    : trans('spending_guide.messages.success.status_off', ['type' => trans('spending_guide.labels.level_' . $entity->level)])
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Retorna una lista segun el nivel
     *
     * @param int $level
     *
     * @return JsonResponse
     */
    public function loadByLevels(int $level)
    {
        try {
            return response()->json($this->spendingGuideProcess->byLevels($level));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Retorna una lista por el parent_id
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function loadByParent(int $id)
    {
        try {
            return response()->json($this->spendingGuideProcess->byParent($id));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }
}
