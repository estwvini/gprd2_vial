<?php

namespace App\Filters\Library\Contracts;

use Illuminate\Database\Eloquent\Model;

/**
 * Interface IFilterFactory
 * @package App\Filters\Library\Contracts
 */
interface IFilterFactory
{
    /**
     * @param string $filter
     * @param Model $model
     * @return IFilter
     */
    public static function factory(string $filter, Model $model): IFilter;
}