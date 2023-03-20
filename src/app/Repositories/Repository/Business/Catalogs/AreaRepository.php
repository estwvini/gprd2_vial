<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Models\Business\Catalogs\Area;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use App\Repositories\Library\Exceptions\RepositoryException;

/**
 * Clase AreaRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class AreaRepository extends Repository
{
    /**
     * Constructor de AreaRepository.
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
        return Area::class;
    }
    
    /**
     * Obtener de la BD una colección de todas las areas.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->orderBy('area')->get();
    }

    /**
     * Obtener de la BD la cantidad de area.
     *
     * @return mixed
     */
    public function count()
    {
        return $this->model->count();
    }


}