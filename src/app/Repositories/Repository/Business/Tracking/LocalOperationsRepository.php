<?php

namespace App\Repositories\Repository\Business\Tracking;

use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Tracking\Operation;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase LocalOperationsRepository
 * @package App\Repositories\Repository\Business\Tracking
 */
class LocalOperationsRepository extends Repository
{
    /**
     * Constructor de LocalOperationsRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection
    ) {
        parent::__construct($app, $collection);
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return Operation::class;
    }

    /**
     * Obtener de la BD una colección de todos los detalles de operaciones para un año fiscal.
     *
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function findByFiscalYear(FiscalYear $fiscalYear)
    {
        return $this->model
            ->where('year', $fiscalYear->year)
            ->get();
    }
}