<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Models\Business\Catalogs\CPC;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Clase CPCRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class CPCRepository extends Repository
{
    /**
     * Constructor de CPCRepository.
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
        return CPC::class;
    }

    /**
     * Buscar en la BD las compras públicas habilitadas.
     *
     * @return mixed
     */
    public function findEnabled()
    {
        return $this->model->where('enabled', 1)->orderBy('code')->get();
    }

    /**
     * Obtener de la BD una colección de todas las compras públicas.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->orderBy('code');
    }

    /**
     * Obtener de la BD la cantidad de compras públicas.
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Actualizar en la BD la información de compra pública.
     *
     * @param array $data
     * @param CPC $entity
     *
     * @return CPC|null
     */
    public function updateFromArray(array $data, CPC $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva compra pública.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->create($data);
    }

    /**
     * Eliminar de la BD una compra pública.
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
     * Modificar en la BD el estado de una compra pública.
     *
     * @param CPC $entity
     *
     * @return CPC|null
     */
    public function changeStatus(CPC $entity)
    {
        $entity->enabled = !$entity->enabled;
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Obtiene los cpc que no están en la lista
     *
     * @param array $ids
     *
     * @return mixed
     */
    public function findNotIn(array $ids = [])
    {
        return $this->model->where('enabled', 1)->whereNotIn('id', $ids)->orderBy('code')->get();
    }

    /**
     * Buscar cpc
     *
     * @param array $exclude
     * @param string $query
     *
     * @return mixed
     */
    public function search(array $exclude = [], string $query = '')
    {
        return $this->model->when(!empty($query), function ($q) use ($query) {
            $searchWildcard = '%' . $query . '%';
            $q->orWhere('code', 'LIKE', $searchWildcard);
            $q->orWhere('description', 'LIKE', $searchWildcard);
        })->whereNotIn('id', $exclude)->limit(20)->get();
    }
}