<?php

namespace App\Filters\Filter\SpendingGuide;

use App\Filters\Library\Contracts\IFilter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Clase AddressingFilter
 * @package App\Filters\Filter\SpendingGuide
 */
class AddressingFilter implements IFilter
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