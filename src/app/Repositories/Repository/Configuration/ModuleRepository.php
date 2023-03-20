<?php

namespace App\Repositories\Repository\Configuration;


use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;

/**
 * Clase ModuleRepository
 * @package App\Repositories\Repository\Configuration
 */
class ModuleRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return config('acl.module');
    }
}