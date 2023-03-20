<?php

namespace App\Repositories\Repository\Business;

use App\Models\Business\Component;
use App\Models\Business\Plan;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Project;
use App\Models\System\Role;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Exceptions\RepositoryException;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase ComponentRepository
 *
 * @package App\Repositories\Repository\Business
 */
class ComponentRepository extends Repository
{

    /**
     * Constructor de ComponentRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection
    )
    {
        parent::__construct($app, $collection);
    }

    /**
     * Actualizar la entidad mediante un arreglo
     *
     * @param array $data
     * @param Model $entity
     * @param Model $project
     *
     * @return mixed
     * @throws ModelException
     */
    public function updateFromArray(array $data, Model $entity, Model $project)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        $entity->fill($data);

        if (null != $project) {
            $project->components()->save($entity);
        }

        return $entity->fresh();
    }

    /**
     * Nombre del modelo de la clase
     *
     * @return mixed|string
     */
    function model()
    {
        return Component::class;
    }

    /**
     * Crear una entidad mediante un arreglo
     *
     * @param array $data
     * @param Model $project
     *
     * @return mixed
     * @throws ModelException
     */
    public function createFromArray(array $data, Model $project)
    {
        $entity = new $this->model;
        return $this->updateFromArray($data, $entity, $project);
    }

    /**
     * Eliminar lógicamente de la BD un componente.
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws ModelException
     * @throws Exception
     */
    public function delete(Model $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        return $entity->delete();
    }

    /**
     * Obtiene los componentes con sus indicadores
     *
     * @param array $filters
     * @param $departments
     *
     * @return mixed
     */
    public function getComponentsWithIndicators(array $filters, $departments)
    {
        $user = currentUser();

        return $this->model
            ->join('projects', 'projects.id', 'components.project_id')
            ->join('project_fiscal_years', function ($join) use ($filters) {
                $join->on('project_fiscal_years.project_id', 'projects.id')
                    ->where([
                        'project_fiscal_years.status' => ProjectFiscalYear::STATUS_IN_PROGRESS,
                    ]);
            })
            ->join('plan_indicators', function ($join) use ($filters) {
                $join->on('plan_indicators.indicatorable_id', 'components.id')
                    ->where([
                        'plan_indicators.measurement_frequency_per_year' => PlanIndicator::FREQUENCY_FILTER_EQUIVALENCE[$filters['frequency']],
                        'plan_indicators.indicatorable_type' => Component::class
                    ]);
            })
            ->join('plan_indicator_goals', function ($join) use ($filters) {
                $join->on('plan_indicator_goals.plan_indicator_id', 'plan_indicators.id')
                    ->where('plan_indicator_goals.year', $filters['year']);
            })
            ->join('plan_elements', 'projects.plan_element_id', 'plan_elements.id')
            ->join('plans', 'plans.id', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->whereNull('plan_indicators.deleted_at')
            ->where([
                ['projects.status', '=', Project::STATUS_IN_PROGRESS],
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $filters['year']],
                ['plans.end_year', '>=', $filters['year']],
            ])
            ->when($user->hasRole(Role::LEADER) and !$user->hasRole(Role::DIRECTOR), function ($q) use ($user) {
                $q->join('users_manages_projects', function ($join) use ($user) {
                    $join->on('users_manages_projects.project_id', '=', 'projects.id')
                        ->where([
                            ['users_manages_projects.user_id', $user->id],
                            ['users_manages_projects.active', true],
                        ]);
                });
            }, function ($q) use ($departments, $user) {
                $q->when((!$user->hasRole(Role::PLANNER) and !$user->isSuperAdmin()), function ($q) use ($departments) {
                    $q->whereIn('projects.responsible_unit_id', $departments);
                });
            })
            ->groupBy('components.id')
            ->select('components.*')
            ->with([
                'indicators' => function ($query) use ($filters) {
                    $query->where('plan_indicators.measurement_frequency_per_year', PlanIndicator::FREQUENCY_FILTER_EQUIVALENCE[$filters['frequency']])
                        ->with([
                            'planIndicatorGoals' => function ($query) use ($filters) {
                                $query->where('plan_indicator_goals.year', $filters['year']);

                                if ($filters['frequency'] == PlanIndicator::FILTER_SECOND_SEMESTER) {
                                    $query->orderBy('plan_indicator_goals.id', 'DESC');
                                }
                            }
                        ]);
                }
            ])
            ->get();
    }

    /**
     * Buscar todos los componentes por Id de Proyecto
     *
     * @param int $projectId
     *
     * @return mixed
     */
    public function findById(int $projectId)
    {
        return $this->model->where('project_id', $projectId)->get();
    }

    /**
     * Retorna los componentes con sus proyectos
     *
     * @return mixed
     */
    public function getAllWithProject()
    {
        return $this->model->join('projects', 'projects.id', 'project_id')
            ->leftJoin('plan_indicators', function ($query) {
                $query->on('plan_indicators.indicatorable_id', '=', 'components.id')
                    ->where('plan_indicators.indicatorable_type', '=', Component::class);
            })
            ->whereNull('projects.deleted_at')
            ->select('components.*', 'plan_indicators.name as indicator_name', 'plan_indicators.goal_description')
            ->with(['project'])
            ->orderBy('projects.id');
    }
}