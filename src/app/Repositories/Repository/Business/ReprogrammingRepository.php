<?php

namespace App\Repositories\Repository\Business;


use App\Models\Business\Reprogramming;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase ReprogrammingRepository
 * @package App\Repositories\Repository\Business
 */
class ReprogrammingRepository extends Repository
{

    /**
     * Constructor de ReprogrammingRepository.
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
     * Actualizar la entidad mediante un arreglo
     *
     * @param array $data
     * @param Model $entity
     *
     * @return mixed
     * @throws ModelException
     */
    public function updateFromArray(array $data, Model $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Nombre del modelo de la clase
     *
     * @return mixed|string
     */
    function model()
    {
        return Reprogramming::class;
    }

    /**
     * Crear una entidad mediante un arreglo
     *
     * @param array $data
     *
     * @return mixed
     * @throws ModelException
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $this->updateFromArray($data, $entity);
    }

    /**
     * Genera un código autoincremental para reprogramaciones
     *
     * @param int $fiscalYearId
     *
     * @return string
     */
    public function nextCode(int $fiscalYearId)
    {
        $maxCode = $this->model->join('project_fiscal_years', 'reprogramming.project_fiscal_year_id', 'project_fiscal_years.id')
            ->where('project_fiscal_years.fiscal_year_id', $fiscalYearId)
            ->max('reprogramming.code');

        return $maxCode ? $maxCode + 1 : 1;
    }

    /**
     * Obtiene las reprogramaciones de un año fiscal
     *
     * @param int $fiscalYearId
     *
     * @return mixed
     */
    public function findByFiscalYear(int $fiscalYearId)
    {
        return $this->model->join('project_fiscal_years', 'reprogramming.project_fiscal_year_id', 'project_fiscal_years.id')
            ->where('project_fiscal_years.fiscal_year_id', $fiscalYearId)
            ->with('projectFiscalYear.project')
            ->orderBy('reprogramming.code', 'desc')
            ->select('reprogramming.*');
    }
}