<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Filters\Library\Builder\EloquentBuilder;
use App\Models\Business\Catalogs\SpendingGuide;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Clase SpendingGuideRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class SpendingGuideRepository extends Repository
{
    /**
     * @var EloquentBuilder
     */
    private $eloquentBuilder;

    /**
     * Constructor de SpendingGuideRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param EloquentBuilder $eloquentBuilder
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection, EloquentBuilder $eloquentBuilder)
    {
        parent::__construct($app, $collection);
        $this->eloquentBuilder = $eloquentBuilder;
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return SpendingGuide::class;
    }

    /**
     * Buscar en la BD las orientación de gastos.
     *
     * @return mixed
     */
    public function findEnabled()
    {
        return $this->model->where('enabled', 1)->orderBy('code')->get();
    }

    /**
     * Obtener de la BD una colección de todas las orientaciones de gastos.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Obtener de la BD una colección de todas las orientaciones de gastos ordenados por código.
     *
     * @param int|null $parent_id
     *
     * @return mixed
     */
    public function findAllOrdered(int $parent_id = null)
    {
        return $this->model->when($parent_id, function ($q) use ($parent_id){
            $q->where('parent_id', $parent_id);
        })->orderBy('full_code', 'ASC');
    }

    /**
     * Aplica filtros al modelo
     *
     * @param array $filters
     *
     * @return $this
     */
    public function filters(array $filters)
    {
        $this->model = $this->eloquentBuilder->to($this->model(), $filters);

        return $this;
    }

    /**
     * Obtener de la BD la cantidad de orientación de gastos.
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Actualizar en la BD la información de orientación de gasto.
     *
     * @param array $data
     * @param SpendingGuide $entity
     * @param bool $updateCode
     *
     * @return SpendingGuide|null
     */
    public function updateFromArray(array $data, SpendingGuide $entity, bool $updateCode)
    {
        DB::transaction(function () use (&$data, &$entity, $updateCode) {
            $entity->fill($data);
            $entity->save();

            if ($entity->children()->count() && $updateCode) {
                $query = "WITH RECURSIVE cte(id, parent_id, code, full_code, level) AS
                           (
                               SELECT id, parent_id, code, full_code, level
                               from guide_spending_classifiers where id = :id
                               UNION ALL
                               SELECT bcs.id, bcs.parent_id, bcs.code,
                                      CONCAT(cte.full_code, '.', bcs.code),
                                      bcs.level
                               from guide_spending_classifiers bcs
                                        inner join cte on bcs.parent_id = cte.id
                           )
                            UPDATE guide_spending_classifiers bcs, (select * from cte) r
                            SET bcs.full_code=r.full_code
                            WHERE bcs.id = r.id;";
                DB::update($query, ['id' => $entity->id]);
            }

        }, 5);
        return $entity->fresh();
    }

    /**
     * Obtiene los clasificadores de nivel 4 que están relacionados a partidas de gasto
     *
     * @param $id
     *
     * @return array
     */
    public function findLeafChildrenNotInUse($id)
    {
        $query = "WITH RECURSIVE cte(id, parent_id, code, full_code, level) AS
                   (
                       SELECT id, parent_id, code, full_code, level
                       from guide_spending_classifiers
                       where id = :id
                       UNION ALL
                       SELECT bcs.id,
                              bcs.parent_id,
                              bcs.code,
                              bcs.full_code,
                              bcs.level
                       from guide_spending_classifiers bcs
                                inner join cte on bcs.parent_id = cte.id
                   )
                   select *
                   from cte where level = :level
                   and id in (select bi.guide_spending_id 
                   from budget_items bi)";

        return DB::select($query, ['id' => $id, 'level' => SpendingGuide::LEVEL_4]);
    }

    /**
     * Almacenar en la BD una nueva orientación de gasto.
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
     * Eliminar de la BD una orientación de gasto.
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
     * Modificar en la BD el estado de una orientación de gasto.
     *
     * @param SpendingGuide $entity
     *
     * @return SpendingGuide|null
     */
    public function changeStatus(SpendingGuide $entity)
    {
        $entity->enabled = !$entity->enabled;
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Obtener el nivel máximo actual de la BD.
     *
     * @return int
     */
    public function maxLevel()
    {
        return (int)($this->model->max('level'));
    }
}