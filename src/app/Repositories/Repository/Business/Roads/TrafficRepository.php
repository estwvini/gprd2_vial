<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\Traffic;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase TrafficRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class TrafficRepository extends Repository
{
    /**
     * Constructor de TrafficRepository.
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
        return Traffic::class;
    }

    /**
     * Obtener de la BD una colección de todos los tráficos de la via.
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
     * Obtener de la BD todos los tráficos de la via.
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
     * Obtener de la BD un tráfico por gid.
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
     * Actualizar en la BD un tráfico.
     *
     * @param array $data
     * @param Traffic $entity
     *
     * @return Traffic|null
     */
    public function updateFromArray(array $data, Traffic $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo tráfico.
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