<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Models\Business\BudgetItem;
use App\Models\Business\Catalogs\BudgetClassifier;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Clase BudgetClassifierRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class BudgetClassifierRepository extends Repository
{
    /**
     * Constructor de BudgetClassifierRepository.
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
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return BudgetClassifier::class;
    }

    /**
     * Buscar en la BD los clasificadores presupuestarios habilitados.
     *
     * @return mixed
     */
    public function findEnabled()
    {
        return $this->model->where('enabled', 1)->orderBy('code')->get();
    }

    /**
     * Obtener de la BD una colección de todos los clasificadores presupuestarios ordenados por código.
     *
     * @return mixed
     */
    public function findAllOrdered()
    {
        return $this->model->orderBy('full_code', 'ASC');
    }

    /**
     * Actualizar en la BD la información de clasificador presupuestario.
     *
     * @param array $data
     * @param BudgetClassifier $entity
     * @param bool $updateCode
     *
     * @return BudgetClassifier|null
     */
    public function updateFromArray(array $data, BudgetClassifier $entity, bool $updateCode)
    {
        DB::transaction(function () use (&$data, &$entity, $updateCode) {
            $entity->fill($data);
            $entity->save();

            if ($entity->children()->count() && $updateCode) {
                $query = "WITH RECURSIVE cte(id, parent_id, code, full_code, level) AS
                           (
                               SELECT id, parent_id, code, full_code, level
                               from budget_classifier_spendings where id = :id
                               UNION ALL
                               SELECT bcs.id, bcs.parent_id, bcs.code,
                                      CASE
                                          WHEN bcs.level = :level THEN CONCAT(cte.full_code, '.', cte.code, bcs.code)
                                          else CONCAT(cte.full_code, '.', bcs.code)
                                          END,
                                      bcs.level
                               from budget_classifier_spendings bcs
                                        inner join cte on bcs.parent_id = cte.id
                           )
                            UPDATE budget_classifier_spendings bcs, (select * from cte) r
                            SET bcs.full_code=r.full_code
                            WHERE bcs.id = r.id;";
                DB::update($query, ['id' => $entity->id, 'level' => BudgetClassifier::LEVEL_2]);
            }

        }, 5);

        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo clasificador presupuestario.
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
     * Eliminar de la BD un clasificador presupuestario.
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(Model $entity)
    {
        return $entity->delete();
    }

    /**
     * Modificar en la BD el estado de un clasificador presupuestario.
     *
     * @param BudgetClassifier $entity
     *
     * @return BudgetClassifier|null
     */
    public function changeStatus(BudgetClassifier $entity)
    {
        $entity->enabled = !$entity->enabled;
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Obtiene los clasificadores presupuestarios de nivel 4 según los códigos de los clasificadores de nivel 1
     *
     * @param array $codes
     * @param array $exclude
     *
     * @return Collection
     */
    public function findLeafChildrenNodes(array $codes = [], array $exclude = [])
    {

        $bindingsStringCodes = trim(str_repeat('?,', count($codes)), ',');
        if ($bindingsStringCodes === "") {
            $bindingsStringCodes = "''";
        }
        $bindingsStringExclude = trim(str_repeat('?,', count($exclude)), ',');
        if ($bindingsStringExclude === "") {
            $bindingsStringExclude = "''";
        }
        $query = "WITH RECURSIVE cte(id, parent_id, code, full_code, level, title, description) AS
                   (
                       SELECT id, parent_id, code, code, level, title, description
                       from budget_classifier_spendings
                       where parent_id is null and code in ( {$bindingsStringCodes} )
                       UNION ALL
                       SELECT bcs.id,
                              bcs.parent_id,
                              bcs.code,
                              bcs.full_code,
                              bcs.level,
                              bcs.title,
                              bcs.description
                       from budget_classifier_spendings bcs
                                inner join cte on bcs.parent_id = cte.id
                   )
                   select *
                   from cte where level = ?
                   and id not in ( {$bindingsStringExclude} );";

        $response = DB::select($query, array_merge($codes, [BudgetClassifier::LEVEL_4], $exclude));

        return BudgetClassifier::hydrate($response);
    }

    /**
     * Obtiene los clasificadore de nivel 4 que están relacionados a partidas de ingreso ó gasto
     *
     * @param $classifier_id
     *
     * @return array
     */
    public function findLeafChildrenNotInUse($classifier_id)
    {
        $query = "WITH RECURSIVE cte(id, parent_id, code, full_code, level, title, description) AS
                   (
                       SELECT id, parent_id, code, code, level, title, description
                       from budget_classifier_spendings
                       where id = :id
                       UNION ALL
                       SELECT bcs.id,
                              bcs.parent_id,
                              bcs.code,
                              bcs.full_code,
                              bcs.level,
                              bcs.title,
                              bcs.description
                       from budget_classifier_spendings bcs
                                inner join cte on bcs.parent_id = cte.id
                   )
                   select *
                   from cte where level = :level
                   and id in (select bi.budget_classifier_id 
                   from budget_items bi 
                   union 
                   select i.budget_classifier_id 
                   from incomes i)";

        return DB::select($query, ['id' => $classifier_id, 'level' => BudgetClassifier::LEVEL_4]);
    }
}