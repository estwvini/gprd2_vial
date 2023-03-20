<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Processes\Admin\DepartmentProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase DepartmentController
 * @package App\Http\Controllers\Admin
 */
class DepartmentController extends Controller
{
    /**
     * @var DepartmentProcess
     */
    protected $departmentProcess;

    /**
     * Constructor de DepartmentController.
     *
     * @param DepartmentProcess $departmentProcess
     */
    public function __construct(
        DepartmentProcess $departmentProcess
    ) {
        $this->departmentProcess = $departmentProcess;
    }

    /**
     * Desplegar lista de departamentos.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $response['view'] = view('admin.department.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables
     *
     * @return JsonResponse
     */
    public function data()
    {
        try {
            return $this->departmentProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Mostrar el formulario para crear un nuevo departamento.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            return $this->departmentProcess->create();
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Almacenar un departamento creado en la BD.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            return $this->departmentProcess->store($request->all());
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Mostar el departamento seleccionado.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            return $this->departmentProcess->show($id);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Mostrar el formulario para la edición del departamento.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit(int $id)
    {
        try {
            return $this->departmentProcess->edit($id);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Actualizar el departamento seleccionado en la BD.
     *
     * @param Request $request
     * @param int $id
     *
     * @return array|JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            return $this->departmentProcess->update($request->all(), $id);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Remover el departamento seleccionado de la BD.
     *
     * @param int $id
     *
     * @return array|JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            return $this->departmentProcess->destroy($id);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Actualizar el estado del departamento.
     *
     * @param int $id
     *
     * @return Response
     */
    public function status(int $id)
    {
        try {
            return $this->departmentProcess->status($id);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }
}
