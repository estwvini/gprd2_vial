<?php

namespace App\Http\Controllers\Business\Execution\Reform;

use App\Http\Controllers\Controller;
use App\Processes\Business\Execution\ReformProcess;
use App\Processes\Business\Planning\ActivityProjectFiscalYearProcess;
use App\Processes\Business\Planning\ComponentProcess;
use App\Processes\Business\Planning\ProjectProcess;
use App\Processes\System\FileProcess;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PDOException;
use Throwable;

/**
 * Clase ReformController
 * @package App\Http\Controllers\Business\Execution\Reform
 */
class ReformController extends Controller
{
    /**
     * @var ReformProcess
     */
    protected $reformProcess;

    /**
     * @var ActivityProjectFiscalYearProcess
     */
    private $activityProcess;

    /**
     * @var ProjectProcess
     */
    private $projectProcess;

    /**
     * @var ComponentProcess
     */
    private $componentProcess;

    /**
     * @var MeasureUnitRepository
     */
    private $measureUnitRepository;

    /**
     * @var FileProcess
     */
    private $fileProcess;

    /**
     * Constructor de ReformController.
     *
     * @param ReformProcess $reformProcess
     * @param ActivityProjectFiscalYearProcess $activityProcess
     * @param ProjectProcess $projectProcess
     * @param ComponentProcess $componentProcess
     * @param MeasureUnitRepository $measureUnitRepository
     * @param FileProcess $fileProcess
     */
    public function __construct(
        ReformProcess $reformProcess,
        ActivityProjectFiscalYearProcess $activityProcess,
        ProjectProcess $projectProcess,
        ComponentProcess $componentProcess,
        MeasureUnitRepository $measureUnitRepository,
        FileProcess $fileProcess
    ) {
        $this->reformProcess = $reformProcess;
        $this->activityProcess = $activityProcess;
        $this->projectProcess = $projectProcess;
        $this->componentProcess = $componentProcess;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->fileProcess = $fileProcess;
    }

    /**
     * Llamada al proceso para mostrar vista de reformas presupuestarias.
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function index()
    {
        try {
            $response['view'] = view('business.execution.reforms.index', $this->reformProcess->index())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesa la petición ajax de datatables.
     *
     * @param Request $request
     *
     * @return string
     */
    public function data(Request $request)
    {
        try {
            return $this->reformProcess->data($request->all());
        } catch (QueryException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar vista de creación de reformas presupuestarias.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['view'] = view('business.execution.reforms.create', $this->reformProcess->create())->render();
        } catch (PDOException $e) {
            $response = defaultCatchHandler(new Exception(trans('app.messages.exceptions.sfgprov_not_available'), 1000));
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar vista de edición de reformas presupuestarias.
     *
     * @param string $companyCode
     * @param int $year
     * @param string $operationType
     * @param int $operationNumber
     *
     * @return JsonResponse
     */
    public function edit(string $companyCode, int $year, string $operationType, int $operationNumber)
    {
        try {
            $response['view'] = view('business.execution.reforms.create', $this->reformProcess->edit($companyCode, $year, $operationType, $operationNumber))->render();
        } catch (PDOException $e) {
            $response = defaultCatchHandler(new Exception(trans('app.messages.exceptions.sfgprov_not_available'), 1000));
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar una reformas presupuestaria.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $this->reformProcess->update($request->all());
            $response = [
                'view' => view('business.execution.reforms.index', $this->reformProcess->index())->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('reforms.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Retorna una lista de proyectos por unidad ejecutora
     *
     * @param string $executingUnitId
     *
     * @return JsonResponse
     */
    public function loadProjects(string $executingUnitId)
    {
        try {
            return response()->json($this->reformProcess->projectsByExecutingUnit($executingUnitId));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Retorna una lista de proyectos por unidad ejecutora
     *
     * @param string $projectId
     *
     * @return JsonResponse
     */
    public function loadActivities(string $projectId)
    {
        try {
            return response()->json($this->reformProcess->activitiesByProject($projectId));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Procesa la petición ajax de datatables.
     *
     * @param Request $request
     *
     * @return string
     */
    public function dataBudgetItems(Request $request)
    {
        try {
            return $this->reformProcess->dataBudgetItems($request->all());
        } catch (QueryException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar la información de reforma presupuestaria.
     *
     * @param string $companyCode
     * @param int $year
     * @param string $operationType
     * @param int $operationNumber
     *
     * @return JsonResponse
     */
    public function show(string $companyCode, int $year, string $operationType, int $operationNumber)
    {
        try {
            $data = $this->reformProcess->show($companyCode, $year, $operationType, $operationNumber);
            $response['modal_xl'] = view('business.execution.reforms.show', $data)->render();
        } catch (PDOException $e) {
            $response = defaultCatchHandler(new Exception(trans('app.messages.exceptions.sfgprov_not_available'), 1000));
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para buscar una partida
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function search(string $code)
    {
        try {
            $response = [
                'success' => true,
                'item' => $this->reformProcess->searchItem($code)
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e, false);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para desaprobar una reforma presupuestaria.
     *
     * @param string $companyCode
     * @param int $year
     * @param string $operationType
     * @param int $operationNumber
     *
     * @return JsonResponse
     */
    public function disapprove(string $companyCode, int $year, string $operationType, int $operationNumber)
    {
        try {
            $response = $this->reformProcess->disapprove($companyCode, $year, $operationType, $operationNumber);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para aprobar una reforma presupuestaria.
     *
     * @param Request $request
     * @param string $companyCode
     * @param int $year
     * @param string $operationType
     * @param int $operationNumber
     *
     * @return JsonResponse
     */
    public function approve(Request $request, string $companyCode, int $year, string $operationType, int $operationNumber)
    {
        try {
            $response = $this->reformProcess->approve($companyCode, $year, $operationType, $operationNumber, $request->all());
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para descargar un archivo.
     *
     * @param string $name
     *
     * @return JsonResponse|mixed
     */
    public function download(string $name)
    {
        try {
            return $this->fileProcess->downloadByName($name, 'reforms');
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
}
