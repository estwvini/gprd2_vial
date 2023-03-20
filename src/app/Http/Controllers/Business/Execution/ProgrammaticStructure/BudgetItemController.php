<?php

namespace App\Http\Controllers\Business\Execution\ProgrammaticStructure;

use App\Http\Controllers\Controller;
use App\Models\Business\BudgetItem;
use App\Processes\Business\Execution\BudgetItemProcess;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PDOException;
use Throwable;

/**
 * Clase BudgetItemController
 * @package App\Http\Controllers\Execution\ProgrammaticStructure
 */
class BudgetItemController extends Controller
{
    /**
     * @var BudgetItemProcess
     */
    private $budgetItemProcess;

    /**
     * Constructor de BudgetItemController.
     *
     * @param BudgetItemProcess $budgetItemProcess
     */
    public function __construct(BudgetItemProcess $budgetItemProcess)
    {
        $this->budgetItemProcess = $budgetItemProcess;
    }

    /**
     * Llamada al proceso para mostrar vista de partidas presupuestarias.
     *
     * @param int $activityId
     *
     * @return JsonResponse
     */
    public function index(int $activityId)
    {
        try {
            $response['view'] = view('business.execution.programmatic_structure.current_expenditure.budget_items.show',
                $this->budgetItemProcess->index($activityId)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Retorna el formulario para crear una partida presupuestaria.
     *
     * @param int $activityId
     * @param string $activityType
     *
     * @return JsonResponse
     */
    public function create(int $activityId, string $activityType = BudgetItem::ACTIVITY_TYPE_PROJECT)
    {
        try {
            $data = $this->budgetItemProcess->dataCreate($activityId, $activityType);
            $response['modal'] = view('business.execution.programmatic_structure.activities.budget_items.create', $data)->render();

            return response()->json($response);

        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Llamada al proceso para almacenar una partida presupuestaria.
     *
     * @param Request $request
     * @param int $activityId
     * @param string $activityType
     *
     * @return JsonResponse
     */
    public function store(Request $request, int $activityId, string $activityType = BudgetItem::ACTIVITY_TYPE_PROJECT)
    {
        try {
            $this->budgetItemProcess->store($request, $activityId, $activityType);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('budget_item.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Retorna el formulario para editar una partida presupuestaria.
     *
     * @param int $budgetItemId
     * @param string $activityType
     *
     * @return JsonResponse
     */
    public function edit(int $budgetItemId, string $activityType = BudgetItem::ACTIVITY_TYPE_PROJECT)
    {
        try {
            $data = $this->budgetItemProcess->dataEdit($budgetItemId, $activityType);
            $response['modal'] = view('business.execution.programmatic_structure.activities.budget_items.update', $data)->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Actualiza una partida presupuestaria
     *
     * @param Request $request
     * @param int $budgetItemId
     * @param string $activityType
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $budgetItemId, string $activityType = BudgetItem::ACTIVITY_TYPE_PROJECT)
    {
        try {
            $this->budgetItemProcess->update($request, $budgetItemId, $activityType);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('budget_item.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Eliminar partidas presupuestarias
     *
     * @param int $budgetItemId
     *
     * @return JsonResponse
     */
    public function destroy(int $budgetItemId)
    {
        try {
            $this->budgetItemProcess->destroy($budgetItemId);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('budget_item.messages.success.delete')
                ]
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Llamada al proceso para cargar información de partidas presupuestarias.
     *
     * @param int $activityId
     * @param Request $request
     *
     * @return mixed|string
     */
    public function data(Request $request, int $activityId = null)
    {
        try {
            $data = $request->all();
            return $this->budgetItemProcess->data($activityId, $data['activityType'] ?? BudgetItem::ACTIVITY_TYPE_PROJECT);
        } catch (PDOException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

}