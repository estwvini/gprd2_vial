<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Models\Business\Catalogs\ActivityType;
use App\Repositories\Library\Eloquent\Repository;

/**
 * Clase ActivityTypeRepository
 *
 * @package App\Repositories\Repository\Business\Catalogs
 */
class ActivityTypeRepository extends Repository
{

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return ActivityType::class;
    }

    /**
     * Actualizar en la BD la información del tipo de actividad.
     *
     * @param array $data
     * @param ActivityType $entity
     *
     * @return ActivityType|null
     */
    public function updateFromArray(array $data, ActivityType $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo tipo de actividad.
     *
     * @param array $data
     *
     * @return ActivityType
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->create($data);
    }
}