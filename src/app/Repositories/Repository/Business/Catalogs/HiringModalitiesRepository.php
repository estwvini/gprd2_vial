<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Models\Business\Catalogs\HiringModalities;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use App\Repositories\Library\Exceptions\RepositoryException;

/**
 * Clase HiringModalitiesRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class HiringModalitiesRepository extends Repository
{
    /**
     * Constructor de HiringModalitiesRepository.
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
        return HiringModalities::class;
    }
    
    /**
     * Obtener de la BD una colección de todas las modalidades de contratación.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->orderBy('name')->get();
    }

}