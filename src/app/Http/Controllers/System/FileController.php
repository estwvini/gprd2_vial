<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Processes\Business\Planning\JustificationProcess;
use App\Processes\System\FileProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\Repository\System\FileRepository;
use App\Repositories\Repository\Business\Planning\OperationalGoalsRepository;
use Throwable;

/**
 * Clase FileController
 * @package App\Http\Controllers\System
 */
class FileController extends Controller
{
    /**
     * @var FileProcess
     */
    protected $fileProcess;

    /**
     * @var JustificationProcess
     */
    protected $justificationProcess;

    /**
     * @var OperationalGoalsRepository
     */
    protected $operationalGoalsRepository;

    /**
     * @var FileRepository
     */
    protected $fileRepository;

    /**
     * Constructor de FileController.
     *
     * @param FileProcess $fileProcess
     */
    public function __construct(
        FileProcess $fileProcess,
        JustificationProcess $justificationProcess,
        OperationalGoalsRepository $operationalGoalsRepository,
        FileRepository $fileRepository
    )
    {
        $this->fileProcess = $fileProcess;
        $this->justificationProcess = $justificationProcess;
        $this->operationalGoalsRepository = $operationalGoalsRepository;
        $this->fileRepository = $fileRepository;
    }

    /**
     * Mostrar vista de listado de archivos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('system.files.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar vista de Planes.
     *
     * @return JsonResponse
     */
    public function indexPlans()
    {
        try {
            $response['view'] = view('system.files.plans',
                $this->fileProcess->documentsRepository()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar vista de Proyectos.
     *
     * @return JsonResponse
     */
    public function indexProjects()
    {
        try {
            $response['view'] = view('system.files.projects',
                $this->fileProcess->documentsRepository()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Mostrar vista de Seguimiento.
     *
     * @return JsonResponse
     */
    public function indexTracking()
    {
        try {
            $response['view'] = view('system.files.tracking',
                $this->fileProcess->documentsRepository()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de archivos documentos de planes.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function dataPlans(Request $request)
    {
        try {
            return $this->fileProcess->dataPlans($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para cargar información de archivos documentos de proyectos.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function dataProjects(Request $request)
    {
        try {
            return $this->fileProcess->dataProjects($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para cargar información de archivos documentos de seguimiento.
     *
     * @param Request $request
     *
     * @return mixed|string
     */
    public function dataTracking(Request $request)
    {
        try {
            return $this->fileProcess->dataTracking($request);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para descargar un archivo de justificación.
     *
     * @param int $id
     *
     * @return JsonResponse|mixed
     */
    public function downloadJustifications(int $id)
    {
        try {
            return $this->justificationProcess->download($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para descargar un archivo de reforma.
     *
     * @param int $id
     *
     * @return JsonResponse|mixed
     */
    public function downloadReforms(int $id)
    {
        try {
            $entity = $this->fileRepository->find($id);
            return $this->fileProcess->downloadByName($entity->name, 'reforms');
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Buscar objetivos operacionales por año
     *
     * @param Request $request
     *
     * @return JsonResponse|mixed
     */
    public function searchOperationalObjectives(Request $request)
    {
        try {
            return $this->fileProcess->searchOperationalObjectives($request->year);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Buscar proyectos por año
     *
     * @param Request $request
     *
     * @return JsonResponse|mixed
     */
    public function searchProjects(Request $request)
    {
        try {
            return $this->fileProcess->searchProjects($request->year);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Buscar Objetivos Operativos
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function searchOperationalGoalsPlans(Request $request)
    {
        try {
            return response()->json(
                $this->operationalGoalsRepository->findByField('plan_element_id', $request->ObjectiveId)
            );
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }
}