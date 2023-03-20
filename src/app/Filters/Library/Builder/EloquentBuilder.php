<?php

namespace App\Filters\Library\Builder;

use App\Filters\Library\Exceptions\NotFoundFilterException;
use App\Filters\Library\Factory\FilterFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
/**
 * Clase EloquentBuilder
 * @package App\Filters\Lybrary\Builder
 */
class EloquentBuilder
{

    /**
     * Create a new EloquentBuilder for a request and model.
     *
     * @param string|Builder $query Model class or eloquent builder
     * @param array $filters
     *
     * @return
     */
    public static function to($query, array $filters = null): Builder
    {
        if (is_string($query)) {
            $query = ($query)::query();
        }
        if (!$filters) {
            return $query;
        }
        static::build($query, array_filter($filters));
        return $query;
    }

    /**
     *  Build query and apply filters
     *
     * @param Builder $query
     * @param array $filters
     */
    private static function build(Builder &$query, array $filters)
    {
        foreach ($filters as $filterName => $value) {
            try {
                $query = FilterFactory::factory($filterName, $query->getModel())->apply($query, $value);
            } catch (NotFoundFilterException $e) {
                Log::warning($e->getMessage());
            }
        }
    }

}