<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\Ditch;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;


/**
 * Clase DitchRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class DitchRepository extends Repository
{
    /**
     * Constructor de DitchRepository.
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
        return Ditch::class;
    }

    /**
     * Obtener de la BD una colección de las cunetas de una vía.
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
     * Obtener de la BD todas las cunetas de una vía.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function findByCodeDataTable(string $code)
    {
        return $this->model->where('codigo', $code)->get();
    }

    /**
     * Obtener de la BD una cuneta por gid.
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
     * Actualizar en la BD una cuneta.
     *
     * @param array $data
     * @param Ditch $entity
     *
     * @return Ditch|null
     */
    public function updateFromArray(array $data, Ditch $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva cuneta.
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