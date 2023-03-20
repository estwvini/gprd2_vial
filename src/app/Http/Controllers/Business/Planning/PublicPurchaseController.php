<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Models\Business\BudgetItem;
use App\Processes\Business\Planning\PublicPurchaseProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase PublicPurchaseController
 * @package App\Http\Controllers\Business\Planning
 */
class PublicPurchaseController extends Controller
{
    /**
     * @var PublicPurchaseProcess
     */
    private $publicPurchaseProcess;

    /**
     * Constructor de PublicPurchaseController.
     *
     * @param PublicPurchaseProcess $publicPurchaseProcess
     */
    public function __construct(PublicPurchaseProcess $publicPurchaseProcess)
    {
        $this->publicPurchaseProcess = $publicPurchaseProcess;
    }

    /**
     * Mostrar lista de compras públicas
     *
     * @param int $budgetItemId
     * @param string $activityType
     *
     * @return JsonResponse
     */
    public function index(int $budgetItemId, string $activityType = BudgetItem::ACTIVITY_TYPE_PROJECT)
    {
        try {
            $data = $this->publicPurchaseProcess->dataIndex($budgetItemId);
            $response = [
                'view' => view('business.planning.projects.activities.public_purchases.index', [
                    'budgetItemId' => $budgetItemId,
                    'difference' => $data,
                    'activityType' => $activityType
                ])->render()
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Mostrar lista de compras públicas
     *
     * @param int $budgetItemId
     *
     * @return JsonResponse
     */
    public function indexShow(int $budgetItemId)
    {
        try {
            $response = [
                'view' => view('business.planning.project_review.activities.public_purchases.index', [
                    'budgetItemId' => $budgetItemId
                ])->render()
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de compras públicas
     *
     * @param int $budgetItemId
     * @param string $activityType
     *
     * @return mixed|string
     */
    public function data(int $budgetItemId, string $activityType = BudgetItem::ACTIVITY_TYPE_PROJECT)
    {
        try {
            return $this->publicPurchaseProcess->data($budgetItemId, $activityType);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para cargar información de compras públicas
     *
     * @param int $budgetItemId
     *
     * @return mixed|string
     */
    public function dataShow(int $budgetItemId)
    {
        try {
            return $this->publicPurchaseProcess->dataShow($budgetItemId);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Retorna el formulario para crear una compra pública
     *
     * @param int $budgetItemId
     * @param string $activityType
     *
     * @return JsonResponse
     */
    public function create(int $budgetItemId, string $activityType = BudgetItem::ACTIVITY_TYPE_PROJECT)
    {
        try {
            $data = $this->publicPurchaseProcess->dataCreate($budgetItemId, $activityType);
            $response['modal'] = view('business.planning.projects.activities.public_purchases.create', $data)->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Llamada al proceso para almacenar una compra pública.
     *
     * @param Request $request
     * @param int $budgetItemId
     *
     * @return JsonResponse
     */
    public function store(Request $request, int $budgetItemId)
    {
        try {
            $this->publicPurchaseProcess->store($request, $budgetItemId);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('public_purchases.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Retorna el formulario para editar una compra pública
     *
     * @param int $purchaseId
     * @param string $activityType
     *
     * @return JsonResponse
     */
    public function edit(int $purchaseId, string $activityType = BudgetItem::ACTIVITY_TYPE_PROJECT)
    {
        try {
            $data = $this->publicPurchaseProcess->dataEdit($purchaseId, $activityType);
            $response['modal'] = view('business.planning.projects.activities.public_purchases.update', $data)->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Llamada al proceso para actualizar una compra pública.
     *
     * @param Request $request
     * @param int $purchaseId
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $purchaseId)
    {
        try {
            $this->publicPurchaseProcess->update($request, $purchaseId);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('public_purchases.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Eliminar compras públicas
     *
     * @param int $purchaseId
     *
     * @return JsonResponse
     */
    public function destroy(int $purchaseId)
    {
        try {
            $this->publicPurchaseProcess->destroy($purchaseId);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('public_purchases.messages.success.deleted')
                ]
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Retorna el formulario para ver detalles de una compra pública
     *
     * @param int $purchaseId
     *
     * @return JsonResponse
     */
    public function show(int $purchaseId)
    {
        try {
            $purchase = $this->publicPurchaseProcess->show($purchaseId);
            $response['modal'] = view('business.planning.project_review.activities.public_purchases.show', [
                'purchase' => $purchase
            ])->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Buscar en el catálogo de compras públicas
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function cpcSearch(Request $request)
    {
        try {
            return response()->json($this->publicPurchaseProcess->cpcSearch($request->all()));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Buscar procedimientos de compras públicas
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function searchProcedures(Request $request)
    {
        try {
            return response()->json($this->publicPurchaseProcess->searchProcedures($request->all()));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }
}
