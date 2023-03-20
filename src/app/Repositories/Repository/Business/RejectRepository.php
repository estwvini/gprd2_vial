<?php

namespace App\Repositories\Repository\Business;

use App\Models\Business\Reject;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase RejectRepository
 * @package App\Repositories\Repository\Business
 */
class RejectRepository extends Repository
{
    /**
     * Constructor de RejectRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection
    ) {
        parent::__construct($app, $collection);
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return Reject::class;
    }

    /**
     * Almacenar en la BD un nuevo rechazo.
     *
     * @param array $data
     *
     * @return Reject
     */
    public function fillData(array $data)
    {
        $entity = new $this->model;

        return $entity->fill($data);
    }

}