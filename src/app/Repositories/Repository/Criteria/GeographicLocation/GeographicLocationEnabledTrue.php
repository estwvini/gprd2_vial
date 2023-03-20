<?php

namespace App\Repositories\Repository\Criteria\GeographicLocation;


use App\Repositories\Library\Contracts\IRepositoryInterface as Repository;
use App\Repositories\Library\Criteria\Criteria;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase GeographicLocationEnabledTrue
 * @package App\Repositories\Repository\Criteria\GeographicLocation
 */
class GeographicLocationEnabledTrue extends Criteria
{


    /**
     * Aplica criterio al modelo
     *
     * @param Model $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply(Model $model, Repository $repository)
    {
        $query = $model->where('enabled', 1);
        return $query;
    }
}