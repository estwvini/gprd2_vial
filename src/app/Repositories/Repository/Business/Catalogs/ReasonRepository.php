<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Models\Business\Catalogs\Reason;
use App\Repositories\Library\Eloquent\Repository;

/**
 * Clase ReasonRepository
 *
 * @package App\Repositories\Repository\Business\Catalogs
 */
class ReasonRepository extends Repository
{

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return Reason::class;
    }

    /**
     * Actualizar en la BD la información del motivo.
     *
     * @param array $data
     * @param Reason $entity
     *
     * @return Reason|null
     */
    public function updateFromArray(array $data, Reason $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo motivo.
     *
     * @param array $data
     *
     * @return Reason
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->create($data);
    }
}