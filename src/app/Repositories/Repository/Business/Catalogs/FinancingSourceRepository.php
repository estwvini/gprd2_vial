<?php

namespace App\Repositories\Repository\Business\Catalogs;


use App\Models\Business\Catalogs\FinancingSource;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Clase FinancingSourceRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class FinancingSourceRepository extends Repository
{
    /**
     * Constructor de FinancingSourceRepository.
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
        return FinancingSource::class;
    }

    /**
     * Actualizar en la BD la información de fuente de financiamiento.
     *
     * @param array $data
     * @param FinancingSource $entity
     *
     * @return FinancingSource|null
     */
    public function updateFromArray(array $data, FinancingSource $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva fuente de financiamiento.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->create($data);
    }

    /**
     * Eliminar de la BD una fuente de financiamiento.
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(Model $entity)
    {
        return $entity->delete();
    }

    /**
     * Modificar en la BD el estado de una fuente de financiamiento.
     *
     * @param FinancingSource $entity
     *
     * @return bool
     */
    public function changeStatus(FinancingSource $entity)
    {
        $entity->enabled = !$entity->enabled;
        return $entity->save();
    }

    /**
     * Obtiene los ingresos por fuente de financiamiento
     *
     * @param int $fiscalYearId
     * @param array $items
     *
     * @return mixed
     */
    public function incomesBySource(int $fiscalYearId, array $items)
    {
        $incomesSources = $this->model->join('incomes', 'financing_source_classifiers.id', 'incomes.financing_source_id')
            ->where('incomes.fiscal_year_id', $fiscalYearId)
            ->whereNull('incomes.deleted_at')
            ->groupBy('financing_source_classifiers.id')
            ->selectRaw('financing_source_classifiers.*, sum(incomes.value) as totalIncomes')->get();

        $expensesSources = $this->model->join('budget_items', 'financing_source_classifiers.id', 'budget_items.financing_source_id')
            ->where('budget_items.fiscal_year_id', $fiscalYearId)
            ->whereIn('budget_items.id', $items)
            ->whereNotIn('budget_items.financing_source_id', $incomesSources->pluck('id')->toArray())
            ->groupBy('financing_source_classifiers.id')
            ->selectRaw('financing_source_classifiers.*, 0 as totalIncomes')->get();

        return $incomesSources->concat($expensesSources);
    }
}