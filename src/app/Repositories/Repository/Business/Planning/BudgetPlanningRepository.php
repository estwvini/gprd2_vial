<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\Planning\BudgetPlanning;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\PublicPurchaseRepository;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase BudgetPlanningRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class BudgetPlanningRepository extends Repository
{
    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var PublicPurchaseRepository
     */
    private $publicPurchaseRepository;

    /**
     * Constructor de BudgetPlanningRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param BudgetItemRepository $budgetItemRepository
     * @param PublicPurchaseRepository $publicPurchaseRepository
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection, BudgetItemRepository $budgetItemRepository, PublicPurchaseRepository $publicPurchaseRepository)
    {
        parent::__construct($app, $collection);
        $this->budgetItemRepository = $budgetItemRepository;
        $this->publicPurchaseRepository = $publicPurchaseRepository;
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return BudgetPlanning::class;
    }

    /**
     * Almacenar en la BD una planificación presupuestaria
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        $entity = $entity->create($data);
        return $entity->fresh();
    }

    /**
     * Almacena en BD varias planificaciones de los presupuestos mensuales
     *
     * @param array $data
     * @param bool $isPlanning
     */
    public function createMany(array $data, bool $isPlanning)
    {
        $items = collect($data['items'] ?? []);
        $items->each(function ($item) use ($isPlanning) {
            switch ($item['indent']) {// (indent = 0 => Actividades) (indent = 1 => Partidas Presupuestarias) (indent = 2 => Compras Públicas)
                case 1:
                    DB::transaction(function () use ($item, $isPlanning) {
                        $budgetItem = $this->budgetItemRepository->find($item['primaryId']);
                        if (!$budgetItem) {
                            throw new Exception(trans('budget_item.messages.exceptions.not_found'), 1000);
                        }
                        $budgetItem->budgetPlannings()->delete();

                        $plannings = [];

                        foreach ($item as $key => $value) {
                            if (array_key_exists($key, BudgetPlanning::MONTH) and $value) {
                                $plannings[] = [
                                    'month' => BudgetPlanning::MONTH[$key],
                                    'assigned' => $value,
                                    'budget_item_id' => $budgetItem->id
                                ];
                            }
                        }

                        $budgetItem->budgetPlannings()->createMany($plannings);
                        //Update total budget item in planning
                        if ($isPlanning) {
                            $budgetItem->amount = $item['total'];
                        } else {
                            $budgetItem->last_total_reform = $item['last_total_reform'];
                        }
                        $budgetItem->save();
                    }, 5);
                    break;
                case 2:
                    DB::transaction(function () use ($item) {
                        $purchase = $this->publicPurchaseRepository->find($item['primaryId']);

                        if (!$purchase) {
                            throw new Exception(trans('public_purchases.messages.exceptions.not_found'), 1000);
                        }
                        $purchase->budgetPlannings()->delete();
                        $plannings = [];
                        $c1 = '';
                        $c2 = '';
                        $c3 = '';

                        foreach ($item as $key => $value) {
                            if (array_key_exists($key, BudgetPlanning::MONTH) and $value) {
                                $plannings[] = [
                                    'month' => BudgetPlanning::MONTH[$key],
                                    'assigned' => $value,
                                    'public_purchase_id' => $purchase->id
                                ];
                                if (BudgetPlanning::MONTH[$key] <= 4) {
                                    $c1 = 'S';
                                } elseif (BudgetPlanning::MONTH[$key] > 4 and BudgetPlanning::MONTH[$key] <= 8) {
                                    $c2 = 'S';
                                } else {
                                    $c3 = 'S';
                                }
                            }
                        }
                        $purchase->budgetPlannings()->createMany($plannings);

                        $purchase->c1 = $c1;
                        $purchase->c2 = $c2;
                        $purchase->c3 = $c3;
                        $purchase->quantity = $item['quantity'] ?? $purchase->quantity;
                        $purchase->save();
                    }, 5);
            }
        });
    }

    /**
     * Elimina la planificación presupuestaria para las partidas seleccionadas
     *
     * @param Collection $budgetItems
     */
    public function removePlanning(Collection $budgetItems)
    {
        DB::transaction(function () use ($budgetItems) {
            $publicPurchases = collect([]);
            $budgetItems->where('is_public_purchase', 1)->each(function ($item) use (&$publicPurchases) {
                $publicPurchases = $publicPurchases->merge($item->publicPurchases()->pluck('id'));
            });
            $this->model::whereIn('budget_item_id', $budgetItems->pluck('id'))
                ->orWhereIn('public_purchase_id', $publicPurchases)->delete();
        }, 5);
    }
}