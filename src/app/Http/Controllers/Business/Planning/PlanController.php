<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Models\Business\Plan;
use App\Processes\Business\Planning\PlanProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase PlanController
 * @package App\Http\Controllers\Business\Planning
 */
class PlanController extends Controller
{

    /**
     * @var PlanProcess
     */
    protected $planProcess;

    /**
     * Constructor PlanController.
     *
     * @param PlanProcess $planProcess
     */
    public function __construct(
        PlanProcess $planProcess
    ) {
        $this->planProcess = $planProcess;
    }

    /**
     * Mostrar lista de planes.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $response = $this->planProcess->index();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }


    /**
     * Mostrar formulario de creación de plan
     *
     * @param string $scope
     *
     * @return JsonResponse
     */
    public function create(string $scope)
    {
        try {
            $response = $this->planProcess->create($scope);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }


    /**
     * Almacenar nuevo plan
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {

            $response = $this->planProcess->store($request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }


    /**
     * Mostrar formulario de edición de un plan
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {

            $response = $this->planProcess->edit($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Actualizar un plan
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {

            $response = $this->planProcess->update($request, $id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Elimina un plan.
     *
     * @param Request $request
     * @param int $id
     *
     * @return mixed
     */
    public function destroy(Request $request, int $id)
    {
        try {
            $response = $this->planProcess->destroy($request, $id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Verifica si un tipo de plan esta activo
     *
     * @param Request $request
     *
     * @return string
     */
    public function checkType(Request $request)
    {
        $result = $this->planProcess->checkType($request);
        return json_encode(!$result);
    }

    /**
     * Verifica si el año de inicio de un PDOT o PEI es mayor al año de fin del plan anterior
     *
     * @param Request $request
     *
     * @return string
     */
    public function checkStartYear(Request $request)
    {
        $result = $this->planProcess->checkStartYear($request);
        return json_encode(!$result);
    }

    /**
     * Carga la estructura del plan en formato de arbol
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function loadStructure(int $id, Request $request)
    {
        try {
            $response = $this->planProcess->loadStructure($id, $request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);

    }

    /**
     * Mostrar un plan para su verificación o aprobación
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function approve(int $id, Request $request)
    {
        try {

            $response = $this->planProcess->approve($id, $request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Cambiar estado de un plan luego de su aprobación o verificación
     *
     * @param int $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function changeStatus(int $id, Request $request)
    {
        try {

            $response = $this->planProcess->changeStatus($id, $request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return $response;
    }

    /**
     * Duplicar objetivos e indicadores de PEI anterior
     *
     * @param Plan $plan
     * @param string $type
     *
     * @return JsonResponse
     */
    public function replicate(Plan $plan, string $type)
    {
        try {

            if ($type == Plan::TYPE_PEI) {
                $this->planProcess->replicatePEI($plan);
            } elseif ($type == Plan::TYPE_PDOT) {
                $this->planProcess->replicatePDYOT($plan);
            }
            $response = $this->planProcess->edit($plan->id);
            $response['message'] = [
                'type' => 'success',
                'text' => trans('plans.messages.success.replicated')
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
