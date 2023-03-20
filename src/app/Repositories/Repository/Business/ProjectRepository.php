<?php

namespace App\Repositories\Repository\Business;

use App\Models\Business\Component;
use App\Models\Business\Plan;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Project;
use App\Models\System\Role;
use App\Processes\Business\Planning\ScheduleProcess;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Monolog\Handler\IFTTTHandler;

/**
 * Clase ProjectRepository
 *
 * @package App\Repositories\Repository\Business
 */
class ProjectRepository extends Repository
{
    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var PlanIndicator
     */
    protected $planIndicator;

    /**
     * Constructor de ProjectRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param FiscalYearRepository $fiscalYearRepository
     * @param TaskRepository $taskRepository
     * @param PlanIndicator $planIndicator
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection,
        FiscalYearRepository $fiscalYearRepository,
        TaskRepository $taskRepository,
        PlanIndicator $planIndicator
    )
    {
        parent::__construct($app, $collection);
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->taskRepository = $taskRepository;
        $this->planIndicator = $planIndicator;
    }

    /**
     * Nombre del modelo de la clase
     *
     * @return mixed|string
     */
    function model()
    {
        return Project::class;
    }

    /**
     * Buscar todos los proyectos
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Retorna todos los proyectos con su unidad responsable y la unidad ejecutora
     *
     * @return mixed
     */
    public function getAllWith()
    {
        return $this->model->with(['responsibleUnit', 'executingUnit']);
    }

    /**
     * Cantidad de proyectos
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
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

        DB::transaction(function () use ($data, $entity) {

            $entity->fill($data);
            $entity->save();

            if (isset($data['annual_budgets']) && count($data['annual_budgets'])) {

                foreach ($data['annual_budgets'] as $index => $budget) {
                    $fiscalYear = $this->fiscalYearRepository->findByField('year', $budget['year'])->first();

                    if (!$fiscalYear) {
                        $fiscalYear = $this->fiscalYearRepository->create(['year' => $budget['year']]);

                        if (!$fiscalYear) {
                            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
                        }
                    }

                    $data['annual_budgets'][$index]['fiscalYearId'] = $fiscalYear->id;
                }

                $projectFiscalYears = [];
                foreach ($data['annual_budgets'] as $budget) {
                    $projectFiscalYears[$budget['fiscalYearId']] = ['referential_budget' => $budget['budget']];
                }

                $entity->fiscalYears()->sync($projectFiscalYears);
            }

            if (isset($data['leader_id'])) {
                if (isset($data['ex_leader_id'])) {
                    $entity->leaders()->updateExistingPivot($data['ex_leader_id'], ['date_end' => formatDate(Carbon::now(), 'Y-m-d'), 'active' => 0]);
                    $entity->leaders()->attach($data['leader_id'], ['date_init' => formatDate(Carbon::now(), 'Y-m-d'), 'active' => 1]);
                } else {
                    $entity->leaders()->attach($data['leader_id'], ['date_init' => formatDate(Carbon::now(), 'Y-m-d'), 'active' => 1]);
                }
            }

        }, 5);

        return $entity->fresh();
    }

    /**
     * Get a collection of models by array of ids
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
     * Eliminar lógicamente de la BD un proyecto
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(Model $entity)
    {
        $entity->delete();

        return $entity->fresh();
    }

    /**
     * Obtiene los proyectos con sus indicadores
     *
     * @param array $filters
     * @param array $departments
     *
     * @return mixed
     */
    public function getProjectsWithIndicators(array $filters, array $departments)
    {
        $user = currentUser();

        return $this->model
            ->join('project_fiscal_years', function ($join) use ($filters) {
                $join->on('project_fiscal_years.project_id', 'projects.id')
                    ->where([
                        'project_fiscal_years.status' => ProjectFiscalYear::STATUS_IN_PROGRESS,
                    ]);
            })
            ->join('plan_indicators', function ($join) use ($filters) {
                $join->on('plan_indicators.indicatorable_id', 'projects.id')
                    ->where([
                        'plan_indicators.measurement_frequency_per_year' => PlanIndicator::FREQUENCY_FILTER_EQUIVALENCE[$filters['frequency']],
                        'plan_indicators.indicatorable_type' => Project::class
                    ]);
            })
            ->join('plan_indicator_goals', function ($join) use ($filters) {
                $join->on('plan_indicator_goals.plan_indicator_id', 'plan_indicators.id')
                    ->where('plan_indicator_goals.year', $filters['year']);
            })
            ->join('plan_elements', 'projects.plan_element_id', 'plan_elements.id')
            ->join('plans', 'plans.id', 'plan_elements.plan_id')
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
            ->groupBy('projects.id')
            ->select('projects.*')
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
     * Actualizar la entidad mediante un arreglo
     *
     * @param array $data
     * @param Project $project
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return mixed
     */
    public function updateProjectDates(array $data, Project $project, ProjectFiscalYear $projectFiscalYear)
    {

        DB::transaction(function () use ($data, $project, $projectFiscalYear) {

            $activityProjectFiscalYearRepository = resolve(ActivityProjectFiscalYearRepository::class);
            $scheduleProcess = resolve(ScheduleProcess::class);

            $dateInit = DateTime::createFromFormat('d-m-Y', $data['date_init']);
            $dateEnd = DateTime::createFromFormat('d-m-Y', $data['date_end']);

            $activities = $activityProjectFiscalYearRepository->findByProjectFiscalYearDates($projectFiscalYear->id, $dateInit->format('Y-m-d'), $dateEnd->format('Y-m-d'));

            $activities->each(function ($activity) use ($data, $scheduleProcess, $activityProjectFiscalYearRepository) {
                $dataAct = $data;
                if ($activity->date_init && Carbon::parse($data['date_init']) <= Carbon::parse($activity->date_init)) {
                    $dataAct['date_init'] = $activity->date_init;
                }
                if ($activity->date_end && Carbon::parse($data['date_end']) >= Carbon::parse($activity->date_end)) {
                    $dataAct['date_end'] = $activity->date_end;
                }

                $dataAct['relevance'] = $activity->relevance;
                $requestInfo = $scheduleProcess->processActivityRequest($dataAct, $activity);

                if (!$activityProjectFiscalYearRepository->bulkUpdateFromArray($requestInfo['data'], $requestInfo['entities'])) {
                    throw new Exception(trans('schedule.messages.errors.updated', ['element' => trans('schedule.labels.type.' . ActivityProjectFiscalYear::TYPE)]), 1000);
                }

            });

            $project->date_init = $dateInit->format('Y-m-d');
            $project->date_end = $dateEnd->format('Y-m-d');

            $project->save();

        }, 5);

        return $project->fresh();
    }

    /**
     * Obtiene listado de proyectos
     *
     * @param string $query
     *
     * @return mixed
     */
    public function findProjects(string $query = '')
    {
        return $this->model->when(!empty($query), function ($q) use ($query) {
            $search = '%' . $query . '%';
            $q->orWhere('name', 'LIKE', $search);
            $q->orWhere('description', 'LIKE', $search);
        })->limit(10)
            ->get();
    }

    /**
     * Obtiene de la BD los proyectos según el estado.
     *
     * @param string $status
     *
     * @return mixed
     */
    public function findByStatus(string $status)
    {
        return $this->model
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', Carbon::now()->year],
                ['plans.end_year', '>=', Carbon::now()->year],
                ['projects.status', '=', $status]
            ])
            ->when(currentUser()->hasRole(Role::DIRECTOR), function ($query) {

                $departments = currentUser()->departments->map(function ($item, $key) {
                    return $item->id;
                })->toArray();

                $query->where('projects.responsible_unit_id', $departments);
            })
            ->select('projects.*')
            ->with([
                'indicators',
                'components'
            ])
            ->get();
    }

    /**
     * Obtiene listado de proyectos
     *
     * @param array $filters
     *
     * @return mixed
     */
    public function getAllProjects(array $filters)
    {
        return $this->model
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', Carbon::now()->year],
                ['plans.end_year', '>=', Carbon::now()->year]
            ])
            ->where(function ($query) use ($filters) {
                if (isset($filters['phase'])) {
                    $query->where('phase', $filters['phase']);
                }

                if (isset($filters['status'])) {
                    $query->where('status', $filters['status']);
                }
            })
            ->select('projects.*')
            ->with(['executingUnit', 'fiscalYears']);
    }

    /**
     * Obtiene listado de proyectos por año
     *
     * @param string $year
     *
     * @return mixed
     */
    public function findProjectsByYear(string $year)
    {
        return $this->model->WhereYear('created_at', $year)->get();
    }

    public function findIndicatorsProjectComponents(string $year)
    {
        return $this->model
//            ->join('project_fiscal_years', 'project_fiscal_years.project_id', '=', 'projects.id')

            ->join('plan_indicators as pl', 'pl.indicatorable_id', '=', 'projects.id')
            ->join('components as comp', 'comp.project_id', '=', 'projects.id')
            ->join('plan_indicator_goals as plg', 'plg.plan_indicator_id', '=', 'pl.id')
            ->where('plg.year', '>=', "{$year}")
            ->select('projects.id as IdProyecto', 'projects.name as NombreProyecto', 'comp.name as ComponentName', 'pl.name as NombreIndicador',
                'plg.goal_value', 'plg.actual_value')
            ->get();
    }

    /**
     * Obtiene los proyectos con sus indicadores
     *
     * @return mixed
     */
    public function getProjectsWithComponentsIndicators()
    {
        $projects = $this->model
            ->where([
                ['projects.status', '=', Project::STATUS_IN_PROGRESS]
            ])
            ->whereNull('deleted_at')
            ->with([
                'indicators.planIndicatorGoals',
                'components.indicators.planIndicatorGoals',
                'executingUnit'
            ])->get();
        $indicators = collect([]);
        $projects->each(function ($project) use (&$indicators) {
            $indicators->push($project->indicators);
            $project->components->each(function ($component) use (&$indicators) {
                $indicators->push($component->indicators);
            });
        });

        foreach ($indicators as $indicator_) {
            if (isset($indicator_)) {
                foreach ($indicator_ as $indicator) {
                    $data = $this->planIndicator->calculatePercentageIndicator($indicator);
                    $indicator->setAttribute("actualValue", $data['total_actual_values']);
                    $indicator->setAttribute("percentage", $data['percentage']);
                    $indicator->setAttribute("goalValue", $data['total_goal_values']);

                }
            }
        }
        return $indicators;
    }

}