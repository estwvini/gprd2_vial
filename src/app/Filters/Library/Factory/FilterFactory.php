<?php

namespace App\Filters\Library\Factory;

use App\Filters\Library\Contracts\IFilterFactory;
use App\Filters\Library\Contracts\IFilter;
use App\Filters\Library\Exceptions\NotFoundFilterException;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FilterFactory
 * @package App\Filters\Library\Factory
 */
class FilterFactory implements IFilterFactory
{

    /**
     *
     * 
     * @param string $filter
     * @param Model $model
     * @return IFilter
     * @throws NotFoundFilterException
     */
    public static function factory(string $filter, Model $model): IFilter
    {
        return static::makeFilter($filter, $model);
    }

    private static function isValidFilter(string $filter): bool
    {
        return class_exists($filter);
    }

    /**
     * @param string $filterName
     * @param Model $model
     * @return \Illuminate\Foundation\Application|mixed
     * @throws NotFoundFilterException
     */
    private static function makeFilter(string $filterName, Model $model)
    {
        $filter = static::resolveNameSpace($model) . static::resolveFilterName($filterName);
        if (static::isValidFilter($filter)) {
            return app($filter);
        }
        throw new NotFoundFilterException("The {$filterName} filter not found for the " . static::getClassName($model) . ' model.');
    }

    /**
     *
     * @param string $filterName
     *
     * @return string
     */
    private static function resolveFilterName(string $filterName): string
    {
        return studly_case($filterName) . 'Filter';
    }

    /**
     *
     * @param Model $model
     *
     * @return string
     */
    private static function resolveNameSpace(Model $model): string
    {
        return config('filters.namespace', 'App\\Filters\\Filter\\') . static::getClassName($model) . '\\';
    }

    /**
     *
     * @param Model $model
     *
     * @return string
     */
    private static function getClassName(Model $model): string
    {
        return class_basename(get_class($model));
    }
}