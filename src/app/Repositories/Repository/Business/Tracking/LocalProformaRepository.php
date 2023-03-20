<?php

namespace App\Repositories\Repository\Business\Tracking;

use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Tracking\OperationDetail;
use App\Models\Business\Tracking\Proforma;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase LocalProformaRepository
 * @package App\Repositories\Repository\Business\Tracking
 */
class LocalProformaRepository extends Repository
{
    /**
     * Constructor de LocalProformaRepository.
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
        return Proforma::class;
    }

    /**
     * Obtener de la BD una colección de todos los registros de proformas para un año fiscal.
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

    /**
     * Obtener de la BD la información necesaira para mostrar el reporte de proforma presupuestaria para un año fiscal.
     *
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function findReportDataByFiscalYear(FiscalYear $fiscalYear)
    {
        $lastLevelItems = OperationDetail::where('budget_items_operations_details.year', $fiscalYear->year)
            ->join('proformas', 'proformas.code', 'budget_items_operations_details.code')
            ->where('proformas.year', $fiscalYear->year)
            ->select('budget_items_operations_details.company_code', 'budget_items_operations_details.year', 'budget_items_operations_details.code', 'proformas.description',
                'budget_items_operations_details.income_amount', 'budget_items_operations_details.expense_amount', 'budget_items_operations_details.type');

        return $this->model
            ->where('proformas.year', $fiscalYear->year)
            ->where('proformas.last_level', Proforma::NOT_LAST_LEVEL)
            ->selectRaw('proformas.company_code, proformas.year, proformas.code, proformas.description, 0 as income_amount, 0 as expense_amount, proformas.type')
            ->union($lastLevelItems)
            ->orderBy('code', 'asc')
            ->get();
    }
}