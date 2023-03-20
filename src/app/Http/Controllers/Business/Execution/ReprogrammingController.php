<?php

namespace App\Http\Controllers\Business\Execution;

use App\Http\Controllers\Controller;
use App\Models\Business\Project;
use App\Processes\Business\Execution\ProjectProcess;
use App\Processes\Business\Execution\ReprogrammingProcess;
use App\Processes\Business\Planning\ProjectProcess as PlanningProjectProcess;
use App\Processes\System\FileProcess;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PDOException;
use Throwable;

/**
 * Clase ReprogrammingController
 * @package App\Http\Controllers\Business\Execution
 */
class ReprogrammingController extends Controller
{

    /**
     * @var ReprogrammingProcess
     */
    private $reprogrammingProcess;

    /**
     * @var ProjectProcess
     */
    private $projectProcess;

    /**
     * @var PlanningProjectProcess
     */
    private $planningProjectProcess;

    /**
     * @var FileProcess
     */
    private $fileProcess;

    /**
     * Constructor de ReprogrammingController.
     *
     * @param ReprogrammingProcess $reprogrammingProcess
     * @param ProjectProcess $projectProcess
     * @param PlanningProjectProcess $planningProjectProcess
     * @param FileProcess $fileProcess
     */
    public function __construct(
        ReprogrammingProcess $reprogrammingProcess,
        ProjectProcess $projectProcess,
        PlanningProjectProcess $planningProjectProcess,
        FileProcess $fileProcess
    ) {
        $this->reprogrammingProcess = $reprogrammingProcess;
        $this->projectProcess = $projectProcess;
        $this->planningProjectProcess = $planningProjectProcess;
        $this->fileProcess = $fileProcess;
    }

    /**
     * Llamada al proceso para mostrar listado de proyectos.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.execution.reprogramming.index', $this->reprogrammingProcess->index())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesa la petición ajax de datatables.
     *
     * @return string
     */
    public function data()
    {
        try {
            return $this->reprogrammingProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de una reprogramación.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $data = $this->reprogrammingProcess->create();
            $response['view'] = view('business.execution.reprogramming.create', [
                'code' => $data[0],
                'projects' => $data[1]
            ])->render();
        } catch (PDOException $e) {
            $response = defaultCatchHandler(new Exception(trans('app.messages.exceptions.sfgprov_not_available'), 1000));
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nueva reprogramación.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $reprogramming = $this->reprogrammingProcess->store($request->all());

            $data = $this->projectProcess->reprogrammingIndexData($request->all()['project_fiscal_year_id']);
            $dataProfile = $this->planningProjectProcess->editProfile($data[0]->id);

            $response['view'] = view('business.execution.reprogramming.project.update', [
                'entity' => $data[0],
                'project' => $data[0],
                'fiscal_year' => $data[2]->year,
                'executingUnits' => $dataProfile[1],
                'users' => $dataProfile[2],
                'leader' => $dataProfile[3],
                'operationalGoals' => $data[4],
                'type' => trans('reprogramming.labels.physical'),
                'budgetPlanning' => json_encode($data[1], JSON_HEX_APOS | JSON_HEX_QUOT),
                'currentMonth' => Carbon::now()->month,
                'projectFiscalYear' => $data[3],
                'projectPhases' => Project::PROJECT_PHASES,
                'urlLoadUsers' => 'loadusers.edit.profile.project.reprogramming.reforms_reprogramming.execution',
                'urlCreateFullIndicator' => 'create.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlShowFullIndicator' => 'show.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlDeleteFullIndicator' => 'delete.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlDeleteComponent' => 'destroy.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlCreateComponentIndicator' => 'build.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'projectDates' => $this->projectProcess->checkProjectDates($data[3]),
                'reprogrammingId' => $reprogramming->id
            ])->render();
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de una reprogramación.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $data = $this->reprogrammingProcess->edit($id);
            $response['view'] = view('business.execution.reprogramming.update', [
                'entity' => $data[0],
                'projects' => $data[1]
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de detalles de una reprogramación.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {
            $entity = $this->reprogrammingProcess->show($id);
            $response['modal'] = view('business.execution.reprogramming.show', [
                'entity' => $entity
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar una reprogramación.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $reprogramming = $this->reprogrammingProcess->update($request, $id);
            $data = $this->projectProcess->reprogrammingIndexData($request->all()['project_fiscal_year_id']);
            $dataProfile = $this->planningProjectProcess->editProfile($data[0]->id);

            $response['view'] = view('business.execution.reprogramming.project.update', [
                'entity' => $data[0],
                'project' => $data[0],
                'fiscal_year' => $data[2]->year,
                'executingUnits' => $dataProfile[1],
                'users' => $dataProfile[2],
                'leader' => $dataProfile[3],
                'operationalGoals' => $data[4],
                'type' => trans('reprogramming.labels.physical'),
                'budgetPlanning' => json_encode($data[1], JSON_HEX_APOS | JSON_HEX_QUOT),
                'currentMonth' => Carbon::now()->month,
                'projectFiscalYear' => $data[3],
                'projectPhases' => Project::PROJECT_PHASES,
                'urlLoadUsers' => 'loadusers.edit.profile.project.reprogramming.reforms_reprogramming.execution',
                'urlCreateFullIndicator' => 'create.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlShowFullIndicator' => 'show.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlDeleteFullIndicator' => 'delete.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlDeleteComponent' => 'destroy.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlCreateComponentIndicator' => 'build.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'projectDates' => $this->projectProcess->checkProjectDates($data[3]),
                'reprogrammingId' => $reprogramming->id
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cambiar de estado una reprogramación.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function status(int $id)
    {
        try {
            $this->reprogrammingProcess->status($id);

            $response['view'] = view('business.execution.reprogramming.index', $this->reprogrammingProcess->index())->render();
            $response['message'] = [
                'type' => 'success',
                'text' => trans('reprogramming.messages.success.updated')
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para descargar un archivo.
     *
     * @param int $id
     *
     * @return JsonResponse|mixed
     */
    public function download(int $id)
    {
        try {
            return $this->fileProcess->download($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar vista de reprogramación de proyectos
     *
     * @param int $id
     * @param int $projectFiscalYearId
     *
     * @return JsonResponse
     */
    public function projectIndex(int $id, int $projectFiscalYearId)
    {
        try {
            $data = $this->projectProcess->reprogrammingIndexData($projectFiscalYearId);
            $dataProfile = $this->planningProjectProcess->editProfile($data[0]->id);

            $response['view'] = view('business.execution.reprogramming.project.update', [
                'entity' => $data[0],
                'project' => $data[0],
                'fiscal_year' => $data[2]->year,
                'executingUnits' => $dataProfile[1],
                'users' => $dataProfile[2],
                'leader' => $dataProfile[3],
                'operationalGoals' => $data[4],
                'type' => trans('reprogramming.labels.physical'),
                'budgetPlanning' => json_encode($data[1], JSON_HEX_APOS | JSON_HEX_QUOT),
                'currentMonth' => Carbon::now()->month,
                'projectFiscalYear' => $data[3],
                'projectPhases' => Project::PROJECT_PHASES,
                'urlLoadUsers' => 'loadusers.edit.profile.project.reprogramming.reforms_reprogramming.execution',
                'urlCreateFullIndicator' => 'create.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlShowFullIndicator' => 'show.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlDeleteFullIndicator' => 'delete.full_indicator.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlDeleteComponent' => 'destroy.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'urlCreateComponentIndicator' => 'build.indicator.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
                'projectDates' => $this->projectProcess->checkProjectDates($data[3]),
                'reprogrammingId' => $id
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
