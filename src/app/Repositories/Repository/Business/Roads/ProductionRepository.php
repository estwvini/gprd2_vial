<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\Production;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase ProductionRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class ProductionRepository extends Repository
{
    /**
     * Constructor de ProductionRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws \App\Repositories\Library\Exceptions\RepositoryException
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
        return Production::class;
    }

    /**
     * Obtener de la BD una colección de todas las producciónes de una vía.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function findByCode(string $code)
    {
        return $this->model->where('codigo', $code)->get();
    }

    /**
     * Obtener de la BD todas las producciónes de una vía.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function findByCodeDataTable(string $code)
    {
        return $this->model->where('codigo', $code);
    }

    /**
     * Obtener de la BD una producción por gid.
     *
     * @param $gid
     *
     * @return mixed
     */
    public function findByGid(string $gid)
    {
        return $this->model->where('gid', $gid)->first();
    }

    /**
     * Actualizar en la BD la información de una producción.
     *
     * @param array $data
     * @param Production $entity
     *
     * @return Production|null
     */
    public function updateFromArray(array $data, Production $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva producción.
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
}