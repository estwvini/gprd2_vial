<?php

namespace App\Http\Controllers\Business\Catalogs;

use App\Http\Controllers\Controller;
use App\Processes\Business\Catalogs\BudgetClassifierProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase BudgetClassifierController
 * @package App\Http\Controllers\Business\Catalogs
 */
class BudgetClassifierController extends Controller
{
    /**
     * @var BudgetClassifierProcess
     */
    protected $budgetClassifierProcess;

    /**
     * Constructor de BudgetClassifierController.
     *
     * @param BudgetClassifierProcess $budgetClassifierProcess
     */
    public function __construct(BudgetClassifierProcess $budgetClassifierProcess)
    {
        $this->budgetClassifierProcess = $budgetClassifierProcess;
    }

    /**
     * Mostrar vista de listado de clasificadores presupuestarios.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.catalogs.budget_classifier.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de clasificadores presupuestarios.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->budgetClassifierProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de clasificadores presupuestarios.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $response['view'] = view('business.catalogs.budget_classifier.create',
                $this->budgetClassifierProcess->create($request->id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nuevo clasificador presupuestario.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $entity = $this->budgetClassifierProcess->store($request);
            $message = ($entity->level > 3) ? trans('budget_classifiers.messages.success.created', ['type' => trans('budget_classifiers.labels.level_default')])
                : trans('budget_classifiers.messages.success.created', ['type' => trans('budget_classifiers.labels.level_' . $entity->level)]);

            $response = [
                'view' => view('business.catalogs.budget_classifier.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => $message
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar la información de clasificador presupuestario.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            $response['modal_st'] = view('business.catalogs.budget_classifier.show',
                $this->budgetClassifierProcess->show($id)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de clasificador presupuestario.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['view'] = view('business.catalogs.budget_classifier.update',
                $this->budgetClassifierProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de clasificador presupuestario.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $entity = $this->budgetClassifierProcess->update($request->all(), $id);
            $message = ($entity->level > 3) ? trans('budget_classifiers.messages.success.updated', ['type' => trans('budget_classifiers.labels.level_default')])
                : trans('budget_classifiers.messages.success.updated', ['type' => trans('budget_classifiers.labels.level_' . $entity->level)]);

            $response = [
                'view' => view('business.catalogs.budget_classifier.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => $message
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar un clasificador presupuestario.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $level = $this->budgetClassifierProcess->destroy($id);
            $message = ($level > 3) ? trans('budget_classifiers.messages.success.deleted', ['type' => trans('budget_classifiers.labels.level_default')])
                : trans('budget_classifiers.messages.success.deleted', ['type' => trans('budget_classifiers.labels.level_' . $level)]);

            $response = [
                'view' => view('business.catalogs.budget_classifier.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => $message
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para cambiar de estado un clasificador presupuestario.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function status(int $id)
    {
        try {
            $entity = $this->budgetClassifierProcess->status($id);
            $level = ($entity->level > 3) ? trans('budget_classifiers.labels.level_default') : trans('budget_classifiers.labels.level_' . $entity->level);
            $message = ($entity->enabled) ? trans('budget_classifiers.messages.success.status_on', ['type' => $level])
                : trans('budget_classifiers.messages.success.status_off', ['type' => $level]);

            $response['message'] = [
                'type' => 'success',
                'text' => $message
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
