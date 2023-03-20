<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\Planning\FiscalYear;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Carbon\Carbon;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Clase FiscalYearRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class FiscalYearRepository extends Repository
{
    /**
     * Constructor de FiscalYearRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return FiscalYear::class;
    }

    /**
     * Obtener el año de planificación (uno mayor al año actual).
     *
     * @return FiscalYear|null
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function findNextFiscalYear()
    {
        if (session()->has('fiscalYearPlanning')) {
            return $this->model->where('year', session()->get('fiscalYearPlanning'))->first();
        }

        return $this->model->where('year', Carbon::now()->addYear()->year)->first();
    }

    /**
     * Obtener el año fiscal actual.
     *
     * @return FiscalYear|null
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function findCurrentFiscalYear()
    {
        if (session()->has('fiscalYearExecution')) {
            return $this->model->where('year', session()->get('fiscalYearExecution'))->first();
        }

        return $this->model->where('year', Carbon::now()->year)->first();
    }

    /**
     * Obtener todos los años fiscales que no tengan asignados un template de priorización.
     *
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function findFiscalYearsWithoutTemplate()
    {
        return $this->model->whereDoesntHave('prioritizationTemplate')->where('year', '>=', $this->findCurrentFiscalYear()->year)->get();
    }

    /**
     * Obtener todos los años fiscales que esten habilitadoss.
     *
     * @return mixed
     */
    public function findAllFiscalYears()
    {
        return $this->model->where('enabled', 1)->get();
    }

    /**
     * Obtener todos los años fiscales menores al año actual y que esten habilitados.
     *
     * @return mixed
     */
    public function findAllFiscalYearsBeforeThis()
    {
        return $this->model->where('enabled', 1)->where('year', '<', Carbon::now()->year)->get();
    }
}
