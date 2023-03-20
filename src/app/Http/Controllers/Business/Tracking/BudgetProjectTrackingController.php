<?php

namespace App\Http\Controllers\Business\Tracking;

use App\Exports\DefaultReportExport;
use App\Http\Controllers\Controller;
use App\Models\Business\BudgetItem;
use App\Models\Business\BudgetItemLocation;
use App\Processes\Business\Tracking\BudgetProjectTrackingProcess;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

/**
 * Clase BudgetProjectTrackingController
 * @package App\Http\Controllers\Business\Tracking
 */
class BudgetProjectTrackingController extends Controller
{
    /**
     * @var BudgetProjectTrackingProcess
     */
    private $budgetProjectTrackingProcess;

    /**
     * Constructor de ProjectTracking.
     *
     * @param BudgetProjectTrackingProcess $budgetProjectTrackingProcess
     */
    public function __construct(BudgetProjectTrackingProcess $budgetProjectTrackingProcess)
    {
        $this->budgetProjectTrackingProcess = $budgetProjectTrackingProcess;
    }

    /**
     * Llamada al proceso para mostrar vista de seguimiento de proyectos.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function index(int $id)
    {
        try {
            setlocale(LC_TIME, 'es_ES.utf8');
            $response['view'] = view('business.tracking.projects.budget.index', [
                'projectId' => $id,
                'currentMonth' => strtoupper(now()->formatLocalized('%B'))
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesa la petición ajax de datatables.
     *
     * @param int $id
     *
     * @return string
     */
    public function data(int $id)
    {
        try {
            return $this->budgetProjectTrackingProcess->data($id);
        } catch (QueryException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Exporta el avance presupuestario a excel.
     *
     * @param int $id
     *
     * @return mixed|string
     */
    public function dataExport(int $id)
    {
        try {

            $data = $this->budgetProjectTrackingProcess->dataExport($id);

            $view = view('business.tracking.projects.budget.table', $data);

            return Excel::download(new DefaultReportExport($view), trans('budget_project_tracking.labels.file_name') . '.xlsx');
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    public function indexLocation(BudgetItem $item)
    {
        try {
            $locations = $this->budgetProjectTrackingProcess->getLocations();
            $item = $this->budgetProjectTrackingProcess->getItemAccrued($item);
            $item->load('budgetLocations');

            $response['modal'] = view('business.tracking.projects.budget.locations', [
                'item' => $item,
                'geographicLocations' => $locations,
                'max' => $item->total_accrued - $item->total_budget_location
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    public function storeLocation(Request $request, BudgetItem $item)
    {
        try {

            $budgetLocation = new BudgetItemLocation();
            $budgetLocation->fill($request->all());

            $item->budgetLocations()->save($budgetLocation);

            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('budget_project_tracking.messages.success.budget_location_created')
                ]
            ];

            return response()->json($response);

        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }
}
