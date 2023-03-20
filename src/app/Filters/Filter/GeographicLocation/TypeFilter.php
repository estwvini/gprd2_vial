<?php

namespace App\Filters\Filter\GeographicLocation;

use App\Filters\Library\Contracts\IFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Clase TypeFilter
 * @package App\Filters\Filter\GeographicLocation
 */
class TypeFilter implements IFilter
{

    /**
     * Apply filter to model
     *
     * @param Builder $builder
     * @param $value
     *
     * @return Builder
     */
    public function apply(Builder $builder, $value): Builder
    {
        return $builder->where('type', '=', $value);
    }
}