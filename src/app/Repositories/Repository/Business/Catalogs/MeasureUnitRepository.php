<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Models\Business\Catalogs\MeasureUnit;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase MeasureUnitRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class MeasureUnitRepository extends Repository
{
    /**
     * Constructor de MeasureUnitRepository.
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
        return MeasureUnit::class;
    }

    /**
     * Buscar en la BD las unidades de medida habilitadas.
     *
     * @return mixed
     */
    public function findEnabled()
    {
        return $this->model->where('enabled', 1)->orderBy('abbreviation')->get();
    }

    /**
     * Buscar en la BD las unidades de medida habilitadas para compras públicas.
     *
     * @return mixed
     */
    public function findByCpc()
    {
        return $this->model->where(['enabled' => 1, 'is_cpc' => 1])->orderBy('abbreviation')->get();
    }

    /**
     * Obtener de la BD una colección de todas las unidades de medida.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->orderBy('name')->get();
    }

    /**
     * Obtener de la BD la cantidad de unidades de medida.
     *
     * @return mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Actualizar en la BD la información de unidad de medida.
     *
     * @param array $data
     * @param MeasureUnit $entity
     *
     * @return MeasureUnit|null
     */
    public function updateFromArray(array $data, MeasureUnit $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva unidad de medida.
     *
     * @param array $data
     *
     * @return MeasureUnit
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->create($data);
    }

    /**
     * Eliminar de la BD una unidad de medida.
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
     * Modificar en la BD el estado de una unidad de medida.
     *
     * @param MeasureUnit $entity
     *
     * @return MeasureUnit|null
     */
    public function changeStatus(MeasureUnit $entity)
    {
        $entity->enabled = !$entity->enabled;
        $entity->save();
        return $entity->fresh();
    }
}