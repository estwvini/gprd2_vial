<?php

namespace App\Processes\Business\Execution;

use App\Models\Business\BudgetItem;
use App\Models\Business\PublicPurchase;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\Catalogs\CPCRepository;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use App\Repositories\Repository\Business\Catalogs\ProcedureRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\PublicPurchaseRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\DataTables;

/**
 * Clase PublicPurchaseProcess
 * @package App\Processes\Business\Execution
 */
class PublicPurchaseProcess
{
    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var CPCRepository
     */
    private $cpcRepository;

    /**
     * @var MeasureUnitRepository
     */
    private $measureUnitRepository;

    /**
     * @var PublicPurchaseRepository
     */
    private $publicPurchaseRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    private $activityProjectFiscalYearRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var ProcedureRepository
     */
    private $procedureRepository;

    /**
     * Constructor de PublicPurchaseProcess.
     *
     * @param PublicPurchaseRepository $publicPurchaseRepository
     * @param BudgetItemRepository $budgetItemRepository
     * @param CPCRepository $cpcRepository
     * @param MeasureUnitRepository $measureUnitRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param SettingRepository $settingRepository
     * @param ProcedureRepository $procedureRepository
     */
    public function __construct(
        PublicPurchaseRepository $publicPurchaseRepository,
        BudgetItemRepository $budgetItemRepository,
        CPCRepository $cpcRepository,
        MeasureUnitRepository $measureUnitRepository,
        FiscalYearRepository $fiscalYearRepository,
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        SettingRepository $settingRepository,
        ProcedureRepository $procedureRepository
    ) {
        $this->budgetItemRepository = $budgetItemRepository;
        $this->cpcRepository = $cpcRepository;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->publicPurchaseRepository = $publicPurchaseRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->settingRepository = $settingRepository;
        $this->procedureRepository = $procedureRepository;
    }

    /**
     * Obtiene información para mostrar listado de compras públicas
     *
     * @param int $budgetItemId
     *
     * @return int
     * @throws Exception
     */
    public function dataIndex(int $budgetItemId)
    {
        $budgetItem = $this->budgetItemRepository->find($budgetItemId);

        if (!$budgetItem) {
            throw new Exception(trans('public_purchases.messages.exceptions.not_found'), 1000);
        }

        if ($budgetItem->activityProjectFiscalYear) {
            $activity = $budgetItem->activityProjectFiscalYear;

            $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

            if (!$fiscalYear) {
                throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
            }

            $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscalYear->id, $activity->component->project_id);

            if (!$projectFiscalYear) {
                throw new Exception(trans('budget_item.messages.exceptions.project_fiscal_year_not_found'), 1000);
            }

            $activities = $this->activityProjectFiscalYearRepository->findByProjectWithItems($projectFiscalYear->id);
            $totalAmount = 0;
            $activities->each(function ($activity) use (&$totalAmount) {
                $totalAmount += $activity->budgetItems->sum('amount');
            });

            return $projectFiscalYear->referential_budget - $totalAmount;
        }

        return 1; // return greater than zero for current expenditure
    }


    /**
     * Obtiene información para el formulario de creación de compras públicas
     *
     * @param int $budgetItemId
     *
     * @return array
     * @throws Exception
     */
    public function dataCreate(int $budgetItemId)
    {
        $budgetItem = $this->budgetItemRepository->find($budgetItemId);

        if (!$budgetItem) {
            throw new Exception(trans('public_purchases.messages.exceptions.not_found'), 1000);
        }

        $measureUnits = $this->measureUnitRepository->findByCpc();
        $vat = json_decode($this->settingRepository->findByKey('tax'))->value->vat;

        return [
            'budgetItem' => $budgetItem,
            'measureUnits' => $measureUnits,
            'vat' => $vat
        ];
    }

    /**
     * Obtiene información para el formulario de edición de compras públicas
     *
     * @param int $purchaseId
     *
     * @return array
     * @throws Exception
     */
    public function dataEdit(int $purchaseId)
    {
        $purchase = $this->publicPurchaseRepository->find($purchaseId);

        if (!$purchase) {
            throw new Exception(trans('public_purchases.messages.exceptions.not_found'), 1000);
        }

        $purchase->load(['budgetItem', 'cpcClassifier', 'procedure']);
        $data = self::dataCreate($purchase->budgetItem->id);
        $data['procedures'] = $this->procedureRepository->findByFields([
            ['regime_type', '=', $purchase->regime_type],
            ['hiring_type', 'LIKE', '%' . $purchase->hiring_type . '%'],
            ['normalized', '=', $purchase->procedure->normalized]
        ]);
        $data['purchase'] = $purchase;

        return $data;
    }

    /**
     * Almacena nueva compra pública
     *
     * @param Request $request
     * @param int $budgetItemId
     *
     * @throws Exception
     */
    public function store(Request $request, int $budgetItemId)
    {

        $data = $this->processRequest($request->all());
        $data['budget_item_id'] = $budgetItemId;

        $entity = $this->publicPurchaseRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('public_purchases.messages.errors.create'), 1000);
        }
    }

    /**
     * Actualiza nueva compra pública
     *
     * @param Request $request
     * @param int $purchaseId
     *
     * @throws Exception
     */
    public function update(Request $request, int $purchaseId)
    {
        $purchase = $this->publicPurchaseRepository->find($purchaseId);

        if (!$purchase) {
            throw new Exception(trans('public_purchases.messages.exceptions.not_found'), 1000);
        }

        $data = $this->processRequest($request->all());

        $purchase = $this->publicPurchaseRepository->updateFromArray($data, $purchase);

        if (!$purchase) {
            throw new Exception(trans('public_purchases.messages.errors.create'), 1000);
        }
    }

    /**
     * Valida y normaliza los datos de la petición para crear una compra pública.
     *
     * @param array $data Datos de la petición
     *
     * @return array
     * @throws Exception
     */
    private function processRequest(array $data)
    {
        try {

            $data['is_international_fund'] = isset($data['is_international_fund']) ? ($data['is_international_fund'] == 'on' ? 1 : 0) : 0;
            $data['budget_type'] = PublicPurchase::BUDGET_TYPES[1];
            $data['amount'] = 0;

            return $data;
        } catch (Throwable $e) {
            throw new Exception(trans('public_purchases.messages.errors.create'), 1000);
        }
    }

    /**
     * Crear un datatable con la información pertinente de compras públicas.
     *
     * @param int $budgetItemId
     * @param string $activityType
     *
     * @return mixed
     * @throws Exception
     */
    public function data(int $budgetItemId, string $activityType)
    {
        $user = currentUser();
        $actions = [];

        $route = ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) ? 'modify.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution' : 'modify.purchases.items.activities.project.programmatic_structure.execution';

        if ($user->can($route)) {
            $actions['edit'] = [
                'route' => $route,
                'tooltip' => trans('public_purchases.labels.edit'),
                'ajaxify' => '#public_purchases_list',
                'scroll-top' => 0
            ];
        }

        $route = ($activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) ? 'delete.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution' : 'delete.purchases.items.activities.project.programmatic_structure.execution';

        if ($user->can($route)) {
            $actions['trash'] = [
                'route' => $route,
                'tooltip' => trans('public_purchases.labels.delete'),
                'confirm_message' => trans('public_purchases.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete',
                'post_action' => '$("#budget_items_tb").DataTable().draw(); $("#public_purchase_tb").DataTable().draw();',
                'scroll-top' => 0
            ];
        }

        $purchases = $this->publicPurchaseRepository->findByField('budget_item_id', $budgetItemId);
        $totalAmount = $purchases->sum('amount_no_vat');

        $purchases->load('budgetItem.budgetClassifier', 'cpcClassifier', 'measureUnit');

        $dataTable = DataTables::of($purchases)
            ->setRowId('id')
            ->editColumn('budgetClassifier', function (PublicPurchase $entity) {
                return (isset($entity->budgetItem) && isset($entity->budgetItem->budgetClassifier)) ? $entity->budgetItem->budgetClassifier->full_code : "";
            })
            ->editColumn('cpcClassifier', function (PublicPurchase $entity) {
                return isset($entity->cpcClassifier) ? $entity->cpcClassifier->code : "";
            })
            ->editColumn('procedure', function (PublicPurchase $entity) {
                return isset($entity->procedure) ? $entity->procedure->name : "";
            })
            ->addColumn('cpcClassifierDescription', function (PublicPurchase $entity) {
                return isset($entity->cpcClassifier) ? $entity->cpcClassifier->description : "";
            })
            ->editColumn('is_international_fund', function (PublicPurchase $entity) {
                $label = $entity->is_international_fund ? PublicPurchase::YES : PublicPurchase::NO;
                $class = $entity->is_international_fund ? 'success' : 'danger';
                return "<span class='label label-{$class}'>{$label}</span>";
            })
            ->editColumn('measureUnit', function (PublicPurchase $entity) {
                return isset($entity->measureUnit) ? $entity->measureUnit->name : "";
            })
            ->editColumn('amount_no_vat', function (PublicPurchase $entity) {
                return number_format($entity->amount_no_vat, 2);
            })
            ->addColumn('actions', function (PublicPurchase $entity) use ($actions, $activityType) {

                if (isset($actions['edit']) && $activityType === BudgetItem::ACTIVITY_TYPE_OPERATIONAL) {
                    $actions['edit']['params'] = [
                        'activityType' => $activityType
                    ];
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions', 'is_international_fund'])
            ->with('totalAmount', number_format($totalAmount, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Crear un datatable con la información pertinente de compras públicas.
     *
     * @param int $budgetItemId
     *
     * @return mixed
     * @throws Exception
     */
    public function dataShow(int $budgetItemId)
    {
        $actions = [];

        $purchases = $this->publicPurchaseRepository->findByField('budget_item_id', $budgetItemId);
        $totalAmount = $purchases->sum('amount_no_vat');

        $dataTable = DataTables::of($purchases)
            ->setRowId('id')
            ->editColumn('budgetClassifier', function (PublicPurchase $entity) {
                return $entity->budgetItem->budgetClassifier->full_code;
            })
            ->editColumn('cpcClassifier', function (PublicPurchase $entity) {
                return $entity->cpcClassifier->code;
            })
            ->addColumn('cpcClassifierDescription', function (PublicPurchase $entity) {
                return $entity->cpcClassifier->description;
            })
            ->editColumn('is_international_fund', function (PublicPurchase $entity) {
                return $entity->is_international_fund ? PublicPurchase::YES : PublicPurchase::NO;
            })
            ->editColumn('amount_no_vat', function (PublicPurchase $entity) {
                return number_format($entity->amount_no_vat, 2);
            })
            ->addColumn('actions', function (PublicPurchase $entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions'])
            ->with('totalAmount', number_format($totalAmount, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Elimina una compra pública
     *
     * @param int $publicPurchaseId
     *
     * @throws Exception
     */
    public function destroy(int $publicPurchaseId)
    {
        $entity = $this->publicPurchaseRepository->find($publicPurchaseId);

        if (!$entity) {
            throw new Exception(trans('public_purchases.messages.exceptions.not_found'), 1000);
        }

        if (!$this->publicPurchaseRepository->delete($entity)) {
            throw new Exception(trans('public_purchases.messages.errors.delete'), 1000);
        }
    }

    /**
     * Buscar cpc
     *
     * @param array $data
     *
     * @return array|mixed
     */
    public function cpcSearch(array $data)
    {
        $budgetItem = $this->budgetItemRepository->find($data['itemId']);

        $exclude = [];
        $budgetItem->load([
            'publicPurchases.cpcClassifier' => function ($q) use (&$exclude) {
                $exclude = $q->get()->pluck('id')->toArray();
            }
        ]);

        if (isset($data['q']) and !empty($data['q'])) {
            return $this->cpcRepository->search($exclude, $data['q'])->map(function ($item) {
                return ['id' => $item->id, 'text' => $item->code . ' - ' . $item->description];
            });
        }

        return $this->cpcRepository->search()->map(function ($item) {
            return ['id' => $item->id, 'text' => $item->code . ' - ' . $item->description];
        });
    }

    /**
     * Buscar procedimientos de compras públicas
     *
     * @param array $data
     *
     * @return array|mixed
     */
    public function searchProcedures(array $data)
    {
        if (isset($data['regime_type']) and isset($data['hiring_type'])) {

            $normalized = null;
            if (isset($data['normalized'])) {
                $normalized = $data['normalized'];
            }
            return $this->procedureRepository->findByFields([
                ['regime_type', '=', $data['regime_type']],
                ['hiring_type', 'LIKE', '%' . $data['hiring_type'] . '%'],
                ['normalized', '=', $normalized]
            ]);
        }

        return [];
    }
}