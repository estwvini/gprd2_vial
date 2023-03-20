<?php

namespace App\Filters\Filter\GeographicLocation;

use App\Filters\Library\Contracts\IFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Clase CantonFilter
 * @package App\Filters\Filter\GeographicLocation
 */
class CantonFilter implements IFilter
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
        return $builder->where('parent_id', '=', $value);
    }
}