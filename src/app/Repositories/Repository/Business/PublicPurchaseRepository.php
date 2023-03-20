<?php

namespace App\Repositories\Repository\Business;

use App\Models\Business\BudgetItem;
use App\Models\Business\PublicPurchase;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase PublicPurchaseRepository
 * @package App\Repositories\Repository\Business
 */
class PublicPurchaseRepository extends Repository
{
    /**
     * Constructor de PublicPurchaseRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * Nombre del modelo de la clase
     *
     * @return mixed|string
     */
    function model()
    {
        return PublicPurchase::class;
    }

    /**
     * Actualizar en la BD la información de una compra pública
     *
     * @param array $data
     * @param PublicPurchase $entity
     *
     * @return PublicPurchase|null
     */
    public function updateFromArray(array $data, PublicPurchase $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva compra pública
     *
     * @param array $data
     * @param BudgetItem $budgetItem
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->create($data);
    }

    /**
     * Elimina una compra pública
     *
     * @param Model $entity
     *
     * @return mixed
     */
    public function delete(Model $entity)
    {
        $entity->budgetPlannings()->delete();

        return self::destroy($entity->id);
    }

    /**
     * Actualiza a cero los montos de las compras públicas de las partidas presupuestarias seleccionadas
     *
     * @param Collection $budgetItems
     */
    public function resetAmount(Collection $budgetItems)
    {
        $this->model::whereIn('budget_item_id', $budgetItems)
            ->update(['amount' => 0, 'amount_no_vat' => 0]);
    }
}