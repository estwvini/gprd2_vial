<?php

namespace App\Http\Controllers\Business\Planning;

use App\Exports\DefaultReportExport;
use App\Http\Controllers\Controller;
use App\Imports\Projects\BudgetItems;
use App\Models\Business\BudgetItem;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Processes\Business\Planning\BudgetItemProcess;
use App\Processes\Business\Planning\ProjectBudgetProcess;
use App\Repositories\Repository\Business\BudgetItemRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

/**
 * Clase ProjectBudgetController
 *
 * @package App\Http\Controllers\Business\Planning
 */
class ProjectBudgetController extends Controller
{
    /**
     * @var ProjectBudgetProcess
     */
    private $projectBudgetProcess;

    /**
     * @var BudgetItemProcess
     */
    private $budgetItemProcess;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * Constructor de BudgetItemController.
     *
     * @param ProjectBudgetProcess $projectBudgetProcess
     * @param BudgetItemProcess $budgetItemProcess
     * @param BudgetItemRepository $budgetItemRepository
     */
    public function __construct(ProjectBudgetProcess $projectBudgetProcess, BudgetItemProcess $budgetItemProcess, BudgetItemRepository $budgetItemRepository)
    {
        $this->projectBudgetProcess = $projectBudgetProcess;
        $this->budgetItemProcess = $budgetItemProcess;
        $this->budgetItemRepository = $budgetItemRepository;
    }

    /**
     * Llamada al proceso para mostrar vista de partidas presupuestarias.
     *
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return JsonResponse
     */
    public function index(ProjectFiscalYear $projectFiscalYear)
    {
        try {
            $response['view'] = view('business.planning.projects.budget.index',
                $this->projectBudgetProcess->index($projectFiscalYear)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Retorna el formulario para crear una partida presupuestaria.
     *
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return JsonResponse
     */
    public function create(ProjectFiscalYear $projectFiscalYear)
    {
        try {

            $projectFiscalYear->load('activitiesProjectFiscalYear');
            $response['modal'] = view('business.planning.projects.budget.create', array_merge(
                ['projectFiscalYear' => $projectFiscalYear],
                $this->budgetItemProcess->classifiers()
            ))->render();
            return response()->json($response);

        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Llamada al proceso para almacenar una partida presupuestaria.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->budgetItemProcess->store($request, $request->input('activity_id'), BudgetItem::ACTIVITY_TYPE_PROJECT);
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
     * @param BudgetItem $budgetItem
     *
     * @return JsonResponse
     */
    public function edit(BudgetItem $budgetItem)
    {
        try {
            $budgetItem->load('activityProjectFiscalYear.projectFiscalYear');
            $response['modal'] = view('business.planning.projects.budget.update',
                array_merge([
                    'budgetItem' => $budgetItem,
                    'projectFiscalYear' => $budgetItem->activityProjectFiscalYear->projectFiscalYear
                ], $this->budgetItemProcess->classifiers())
            )->render();
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
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $budgetItemId)
    {
        try {
            $this->budgetItemProcess->update($request, $budgetItemId, BudgetItem::ACTIVITY_TYPE_PROJECT);
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
     * @param Request $request
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return mixed|string
     */
    public function data(Request $request, ProjectFiscalYear $projectFiscalYear)
    {
        try {
            return $this->projectBudgetProcess->data($projectFiscalYear, $request->all());
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para replicar el presupuesto del proyecto.
     *
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return JsonResponse
     */
    public function replicate(ProjectFiscalYear $projectFiscalYear)
    {
        try {
            $this->projectBudgetProcess->replicateBudgetLastYear($projectFiscalYear);
            return self::index($projectFiscalYear);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Importar presupuesto desde archivo excel
     *
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return JsonResponse
     */
    public function importModal(ProjectFiscalYear $projectFiscalYear)
    {
        try {
            $response['modal'] = view('business.planning.projects.budget.import',
                ['projectFiscalYear' => $projectFiscalYear]
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Importar presupuesto desde archivo excel
     *
     * @param Request $request
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function import(Request $request, ProjectFiscalYear $projectFiscalYear)
    {
        try {

            $this->budgetItemProcess->destroyAllByProjectFiscalYear($projectFiscalYear->id);

            $import = new BudgetItems;
            $import->import($request->file('file'));

            $projectFiscalYear->load('project');
            $response['view'] = view('business.planning.projects.budget.index',
                [
                    'entity' => $projectFiscalYear->project,
                    'projectFiscalYear' => $projectFiscalYear,
                    'budget' => true,
                    'replicate' => $this->budgetItemRepository->findByProjectFiscalYear($projectFiscalYear->id)->isEmpty()
                ]
            )->render();
            return response()->json($response);
        } catch (ValidationException $e) {
            $projectFiscalYear->load('project');
            $response['view'] = view('business.planning.projects.budget.index',
                array_merge([
                    'failures' => collect($e->failures())
                ], [
                    'entity' => $projectFiscalYear->project,
                    'projectFiscalYear' => $projectFiscalYear,
                    'budget' => true,
                    'replicate' => $this->budgetItemRepository->findByProjectFiscalYear($projectFiscalYear->id)->isEmpty()
                ])
            )->render();
            return response()->json($response);
        } catch (Throwable $e) {
            return defaultCatchHandler($e);
        }
    }

    /**
     * Descarga el prespuesto de ingresos.
     *
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return mixed|string
     */
    public function download(ProjectFiscalYear $projectFiscalYear)
    {
        try {
            $data = $this->budgetItemRepository->findByProject($projectFiscalYear->id);
            $view = view('business.planning.projects.budget.export', ['rows' => $data]);

            return Excel::download(new DefaultReportExport($view), trans('projects.import.file') . '.xlsx');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }
}
