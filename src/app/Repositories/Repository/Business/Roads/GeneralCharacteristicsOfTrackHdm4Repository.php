<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\GeneralCharacteristicsOfTrackHdm4;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase generalCharacteristicsOfTrackHdm4Repository
 * @package App\Repositories\Repository\Business\Roads
 */
class GeneralCharacteristicsOfTrackHdm4Repository extends Repository
{
    /**
     * Constructor de generalCharacteristicsOfTrackHdm4Repository.
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
        return GeneralCharacteristicsOfTrackHdm4::class;
    }

    /**
     * Truncar de la BD la tabla del modelo.
     *
     * @return mixed
     */
    public function truncateTable()
    {
        return $this->model::truncate();
    }

}