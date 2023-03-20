<?php

namespace App\Filters\Library\Contracts;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface IFilter
 * @package App\Filters\Library\Contracts
 */
interface IFilter
{
    /**
     * Apply filter to model
     * @param Builder $builder
     * @param $value
     * @return Builder
     */
    public function apply(Builder $builder, $value): Builder;
}