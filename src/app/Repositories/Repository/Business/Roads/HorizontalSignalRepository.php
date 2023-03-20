<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\HorizontalSignal;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase HorizontalSignalRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class HorizontalSignalRepository extends Repository
{
    /**
     * Constructor de HorizontalSignalRepository.
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
        return HorizontalSignal::class;
    }

    /**
     * Obtener de la BD una colección de todas las senalizaciones horizontales de la via.
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
     * Obtener de la BD todas las senalizaciones horizontales de la via.
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
     * Obtener de la BD una senalización horizontal por gid.
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
     * Actualizar en la BD la información de una senalización horizontal.
     *
     * @param array $data
     * @param HorizontalSignal $entity
     *
     * @return HorizontalSignal|null
     */
    public function updateFromArray(array $data, HorizontalSignal $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva senalización horizontal.
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