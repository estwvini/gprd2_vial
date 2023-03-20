<?php

namespace App\Repositories\Repository\Criteria\SpendingGuide;


use App\Repositories\Library\Contracts\IRepositoryInterface as Repository;
use App\Repositories\Library\Criteria\Criteria;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase SpendingGuideEnabledTrue
 * @package App\Repositories\Repository\Criteria\GeographicLocation
 */
class SpendingGuideEnabledTrue extends Criteria
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