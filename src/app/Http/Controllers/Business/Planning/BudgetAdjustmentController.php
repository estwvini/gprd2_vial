<?php

namespace App\Http\Controllers\Business\Planning;

use App\Http\Controllers\Controller;
use App\Models\Business\Planning\BudgetAdjustment;
use App\Processes\Business\Planning\ActivityProjectFiscalYearProcess;
use App\Processes\Business\Planning\BudgetAdjutmentProcess;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase BudgetAdjustmentController
 * @package App\Http\Controllers\Business\Planning
 */
class BudgetAdjustmentController extends Controller
{
    /**
     * @var BudgetAdjutmentProcess
     */
    protected $budgetAdjutmentProcess;

    /**
     * @var ActivityProjectFiscalYearProcess
     */
    protected $activityProjectFiscalYearProcess;

    /**
     * Constructor de BudgetAdjustmentController.
     *
     * @param BudgetAdjutmentProcess $budgetAdjutmentProcess
     * @param ActivityProjectFiscalYearProcess $activityProjectFiscalYearProcess
     * @param SettingRepository $settingRepository
     */
    public function __construct(
        BudgetAdjutmentProcess $budgetAdjutmentProcess,
        ActivityProjectFiscalYearProcess $activityProjectFiscalYearProcess,
        SettingRepository $settingRepository
    ) {
        $this->budgetAdjutmentProcess = $budgetAdjutmentProcess;
        $this->activityProjectFiscalYearProcess = $activityProjectFiscalYearProcess;
    }

    /**
     * Mostrar la pantalla de ajuste.
     *
     * @param array|null $message
     *
     * @return JsonResponse
     */
    public function index(array $message = null)
    {
        try {

            $budgetAdjustment = $this->budgetAdjutmentProcess->findBudgetAdjutmentForNextFiscalYear();

            if (!$budgetAdjustment->count()) {
                $budgetAdjustment = new Collection();
            }
            $approved = $this->budgetAdjutmentProcess->isApproved($budgetAdjustment);

            $budgetSummary = $this->budgetAdjutmentProcess->loadBudgetSummary();

            $fiscalYearRepository = resolve(FiscalYearRepository::class);
            $fiscalYear = $fiscalYearRepository->findNextFiscalYear();

            $synched = $this->budgetAdjutmentProcess->isBudgetAdjustmentSynched($fiscalYear);

            $response['view'] = view('business.planning.budget_adjustment.index',
                array_merge([
                    'year' => $fiscalYear->year,
                    'synched' => $synched,
                    'approved' => $approved
                ], $budgetSummary))->render();

            if (isset($message)) {
                $response['message'] = $message['message'];
            }
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables.
     *
     * @return JsonResponse
     */
    public function dataPrioritized()
    {
        try {
            return $this->budgetAdjutmentProcess->dataPrioritized();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Guarda los proyectos en ajuste
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function edit(Request $request)
    {
        try {
            return $this->index($this->budgetAdjutmentProcess->update($request, BudgetAdjustment::STATUS_DRAFT));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Guarda y aprueba los proyectos en ajuste
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function approve(Request $request)
    {
        try {
            return $this->index($this->budgetAdjutmentProcess->update($request, BudgetAdjustment::STATUS_APPROVED));
        } catch (Throwable $e) {
            return $this->index(defaultCatchHandler($e));
        }
    }

    /**
     * Vista previa de los proyectos en ajuste
     *
     * @return JsonResponse
     */
    public function afterPreviewProforma()
    {
        try {
            $response['view'] = view('business.planning.budget_adjustment.proforma_preview',
                $this->budgetAdjutmentProcess->previewProforma()
            )->render();
        } catch (Throwable $e) {
            return self::index(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Sincronizar la proforma al sistema SFGPROV.
     *
     * @return JsonResponse
     */
    public function syncProforma()
    {
        try {
            return $this->index($this->budgetAdjutmentProcess->syncProforma());
        } catch (Throwable $e) {
            return $this->index(defaultCatchHandler($e));
        }
    }

    /**
     * Mostrar vista de listado Proforma Presupuestaria.
     *
     * @return JsonResponse
     */
    public function previewProforma()
    {
        try {
            $response['view'] = view('business.planning.budget_adjustment.proforma', $this->budgetAdjutmentProcess->previewProforma())->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de Proforma Presupuestaria.
     *
     * @return mixed|string
     */
    public function previewProformaData()
    {
        try {
            return $this->budgetAdjutmentProcess->previewProformaData();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para cargar información de Proforma Presupuestaria.
     *
     * @return mixed|string
     */
    public function afterPreviewProformaData()
    {
        try {
            return $this->budgetAdjutmentProcess->afterPreviewProformaData();
        } catch (QueryException $e) {
            return datatableEmptyResponse(new Exception(trans('app.messages.exceptions.sfgprov_not_available')), $e);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Desplegar lista de actividades para planificación.
     *
     * @param int $projectId
     *
     * @return JsonResponse
     */
    public function activityIndex(int $projectId)
    {
        try {
            $data = $this->activityProjectFiscalYearProcess->index($projectId);
            $response['view'] = view('business.planning.projects.activities.index', [
                'entity' => $data[0],
                'flag' => $data[0]->executingUnit ? 1 : 0,
                'fiscalYear' => $data[1],
                'budgetPlanning' => json_encode($data[2], JSON_HEX_APOS | JSON_HEX_QUOT),
                'referential_budget' => $data[3],
                'entity_status' => $data[4],
                'from_budget_adjustment' => true,
                'activity' => true,
                'projectFiscalYear' => $data[5]
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

}
