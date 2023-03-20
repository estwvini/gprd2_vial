<?php

namespace App\Repositories\Library\Criteria;


use App\Repositories\Library\Contracts\IRepositoryInterface as Repository;
use Illuminate\Database\Eloquent\Model;

abstract class Criteria
{
    /**
     * @param            $model
     * @param Repository $repository
     *
     * @return mixed
     */
    public abstract function apply(Model $model, Repository $repository);
}