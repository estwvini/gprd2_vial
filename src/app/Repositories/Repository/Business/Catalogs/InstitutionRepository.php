<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Models\Business\Catalogs\Institution;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase InstitutionRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class InstitutionRepository extends Repository
{
    /**
     * Constructor de InstitutionRepository.
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
        return Institution::class;
    }

    /**
     * Buscar en la BD las institucion habilitadas.
     *
     * @return mixed
     */
    public function findEnabled()
    {
        return $this->model->where('enabled', 1)->orderBy('name')->get();
    }

    /**
     * Obtener de la BD una colección de todas las institucion.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->orderBy('name');
    }

    /**
     * Obtener de la BD la cantidad de institucion.
     *
     * @return mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Actualizar en la BD la información de institucion.
     *
     * @param array $data
     * @param Institution $entity
     *
     * @return Institution|null
     */
    public function updateFromArray(array $data, Institution $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva institucion.
     *
     * @param array $data
     *
     * @return Institution
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->create($data);
    }

    /**
     * Eliminar de la BD una institucion.
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function delete(Model $entity)
    {
        return $entity->delete();
    }

    /**
     * Modificar en la BD el estado de una institucion.
     *
     * @param Institution $entity
     *
     * @return Institution|null
     */
    public function changeStatus(Institution $entity)
    {
        $entity->enabled = !$entity->enabled;
        $entity->save();
        return $entity->fresh();
    }
}