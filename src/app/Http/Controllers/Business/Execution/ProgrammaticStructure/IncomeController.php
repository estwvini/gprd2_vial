<?php

namespace App\Http\Controllers\Business\Execution\ProgrammaticStructure;

use App\Http\Controllers\Controller;
use App\Models\Business\Planning\Income;
use App\Processes\Business\Planning\IncomeProcess;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PDOException;
use Throwable;

/**
 * Clase IncomeController
 * @package App\Http\Controllers\Execution\ProgrammaticStructure
 */
class IncomeController extends Controller
{

    /**
     * @var IncomeProcess
     */
    protected $incomeProcess;

    /**
     * Constructor IncomeController.
     *
     * @param IncomeProcess $incomeProcess
     */
    public function __construct(
        IncomeProcess $incomeProcess
    ) {
        $this->incomeProcess = $incomeProcess;
    }

    /**
     * Mostrar lista de ingresos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $params = $this->incomeProcess->index(Income::MODULE['PROGRAMMATIC_STRUCTURE']);
            $response['view'] = view('business.planning.income.index', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de ingresos.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->incomeProcess->data(Income::MODULE['PROGRAMMATIC_STRUCTURE']);
        } catch (PDOException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar formulario de creación de ingresos
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $params = $this->incomeProcess->create(Income::MODULE['PROGRAMMATIC_STRUCTURE']);
            $response['modal'] = view('business.planning.income.create', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Almacenar nuevo ingreso
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->incomeProcess->store($request);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('income.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar formulario de edición de un ingreso
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $params = $this->incomeProcess->edit($id, Income::MODULE['PROGRAMMATIC_STRUCTURE']);
            $response['modal'] = view('business.planning.income.update', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualizar un ingreso
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $this->incomeProcess->update($request, $id);
            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('income.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Mostrar información de un ingreso
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            $params = $this->incomeProcess->show($id);
            $response['modal'] = view('business.planning.income.show', $params)->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Elimina un ingreso
     *
     * @param int $id
     *
     * @return mixed
     */
    public function destroy(int $id)
    {
        try {
            $this->incomeProcess->destroy($id, Income::MODULE['PROGRAMMATIC_STRUCTURE']);
            $params = $this->incomeProcess->index(Income::MODULE['PROGRAMMATIC_STRUCTURE']);
            $response = [
                'view' => view('business.planning.income.index', $params)->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('income.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }
}