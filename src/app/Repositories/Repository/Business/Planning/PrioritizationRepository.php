<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\Plan;
use App\Models\Business\Planning\Prioritization;
use App\Models\Business\Planning\PrioritizationTemplate;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Clase PrioritizationRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class PrioritizationRepository extends Repository
{
    /**
     * Constructor de PrioritizationRepository.
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
     * Nombre del modelo de la clase.
     *
     * @return mixed|string
     */
    function model()
    {
        return Prioritization::class;
    }

    /**
     * Almacenar en la BD una nueva priorización.
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
     * Actualizar en la BD la información de una priorización.
     *
     * @param array $data
     * @param Prioritization $entity
     *
     * @return Prioritization|null
     */
    public function updateFromArray(array $data, Prioritization $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Devuelve una coleccion de model dado un array de ids
     *
     * @param array $ids
     * @param array $columns
     *
     * @return mixed
     */
    public function findByIds(array $ids, array $columns = ['*'])
    {
        return $this->model->whereIn('id', $ids)->get($columns);
    }

    /**
     * Devuelve los proyectos priorizados para un anno fiscal
     *
     * @param int $idFiscalYear
     *
     * @return mixed
     */
    function findPrioritizationsForFiscalYear(int $idFiscalYear)
    {
        return $this->model
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'prioritizations.project_fiscal_year_id')
            ->join('projects', 'projects.id', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['project_fiscal_years.fiscal_year_id', '=', $idFiscalYear],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_REVIEWED]
            ])
            ->select('prioritizations.*')
            ->get();
    }

    /**
     * Eliminar de la BD una priorización.
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
     * Encontrar todas las priorizaciones que pertenecen a una metodología específica.
     *
     * @param PrioritizationTemplate $template
     *
     * @return mixed
     */
    public function findByTemplate(PrioritizationTemplate $template)
    {
        return $this->model
            ->join('project_fiscal_years', 'prioritizations.project_fiscal_year_id', '=', 'project_fiscal_years.id')
            ->join('fiscal_years', 'project_fiscal_years.fiscal_year_id', '=', 'fiscal_years.id')
            ->join('prioritization_templates', 'fiscal_years.id', '=', 'prioritization_templates.fiscal_year_id')
            ->where('prioritization_templates.id', $template->id)
            ->select('prioritizations.*')
            ->get();
    }
}