<?php

namespace App\Repositories\Repository\Business\Tracking;

use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Tracking\OperationDetail;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase LocalOperationDetailsRepository
 * @package App\Repositories\Repository\Business\Tracking
 */
class LocalOperationDetailsRepository extends Repository
{
    /**
     * Constructor de LocalOperationDetailsRepository.
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
        return OperationDetail::class;
    }

    /**
     * Obtener de la BD una colección de todas las operaciones para un año fiscal.
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