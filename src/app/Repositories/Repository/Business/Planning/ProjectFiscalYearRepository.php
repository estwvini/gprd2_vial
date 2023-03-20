<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\Component;
use App\Models\Business\Plan;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Project;
use App\Models\Business\Task;
use App\Models\System\Role;
use App\Models\System\User;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\Business\RejectRepository;
use App\Repositories\Repository\Business\Tracking\POATrackingRepository;
use Carbon\Carbon;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase ProjectFiscalYearRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class ProjectFiscalYearRepository extends Repository
{

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    protected $activityProjectFiscalYearRepository;

    /**
     * @var RejectRepository
     */
    protected $rejectRepository;


    /**
     * @var POATrackingRepository
     */
    private $POATrackingRepository;

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * Constructor de ProjectFiscalYearRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     * @param RejectRepository $rejectRepository
     * @param POATrackingRepository $POATrackingRepository
     * @param FiscalYearRepository $fiscalYearRepository
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection,
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        RejectRepository $rejectRepository,
        POATrackingRepository $POATrackingRepository,
        FiscalYearRepository $fiscalYearRepository

    ) {
        parent::__construct($app, $collection);
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->rejectRepository = $rejectRepository;
        $this->POATrackingRepository = $POATrackingRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return ProjectFiscalYear::class;
    }

    /**
     * Obtener los proyectos a listar para la priorización.
     *
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function findProjectsToPrioritize(FiscalYear $fiscalYear)
    {
        return $this->model->join('projects', 'projects.id', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $fiscalYear->year],
                ['plans.end_year', '>=', $fiscalYear->year],
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYear->id],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_REVIEWED]
            ])
            ->whereIn('projects.status', [Project::STATUS_DRAFT, Project::STATUS_IN_PROGRESS])
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->select('project_fiscal_years.*')
            ->with(['project.responsibleUnit', 'prioritization']);
    }

    /**
     * Buscar proyectos en la BD de acuerdo a un listado de departamentos
     *
     * @param array $departments
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function findByUserDepartments(array $departments, FiscalYear $fiscalYear, $unitId)
    {
        $user = currentUser();
        $shownStatus = [ProjectFiscalYear::STATUS_DRAFT, ProjectFiscalYear::STATUS_REJECTED, ProjectFiscalYear::STATUS_REVIEWED];
        return $this->model
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYear->id],
                ['plans.start_year', '<=', $fiscalYear->year],
                ['plans.end_year', '>=', $fiscalYear->year]
            ])
            ->whereIn('project_fiscal_years.status', $shownStatus)
            ->whereIn('projects.status', [Project::STATUS_DRAFT, Project::STATUS_IN_PROGRESS])
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->when($user->hasRole(Role::LEADER), function ($q) use ($user) {
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
            ->when($unitId, function ($q) use ($unitId) {
                $q->where('projects.responsible_unit_id', $unitId);
            })
            ->select('project_fiscal_years.*')
            ->with(['project.responsibleUnit', 'rejections'])->
            orderBy('projects.full_cup');
    }

    /**
     * Buscar en la BD los proyectos en ejecución.
     *
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function findAllTraceable(FiscalYear $fiscalYear)
    {
        return $this->model
            ->where([
                'project_fiscal_years.status' => ProjectFiscalYear::STATUS_IN_PROGRESS,
                'project_fiscal_years.fiscal_year_id' => $fiscalYear->id
            ])
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('departments', 'departments.id', '=', 'projects.responsible_unit_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['projects.status', '=', Project::STATUS_IN_PROGRESS]
            ])
            ->with(['project.responsibleUnit', 'project'])
            ->select('project_fiscal_years.*');
    }

    /**
     * Buscar en la BD los proyectos en los cuales el usuario actual tiene alguna responsabilidad asignada.
     *
     * @param FiscalYear $fiscalYear
     * @param array $departments
     *
     * @return mixed
     */
    public function findTraceableByUser(FiscalYear $fiscalYear, array $departments)
    {
        $user = currentUser();

        return $this->model
            ->where([
                'project_fiscal_years.status' => ProjectFiscalYear::STATUS_IN_PROGRESS,
                'project_fiscal_years.fiscal_year_id' => $fiscalYear->id
            ])
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('departments', 'departments.id', '=', 'projects.responsible_unit_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['projects.status', '=', Project::STATUS_IN_PROGRESS],
                ['plans.start_year', '<=', $fiscalYear->year],
                ['plans.end_year', '>=', $fiscalYear->year]
            ])
            ->leftJoin('activity_project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', '=', 'project_fiscal_years.id')
            ->leftJoin('users_manages_activities', 'users_manages_activities.activity_project_fiscal_year_id', '=', 'activity_project_fiscal_years.id')
            ->leftJoin('tasks', 'tasks.activity_project_fiscal_year_id', '=', 'activity_project_fiscal_years.id')
            ->leftJoin('users_manages_tasks', 'users_manages_tasks.task_id', '=', 'tasks.id')
            ->leftJoin('users_manages_projects', 'users_manages_projects.project_id', '=', 'projects.id')
            ->when($user->hasRole(Role::DIRECTOR), function ($query) use ($departments) {
                $query->where('projects.responsible_unit_id', $departments);
            }, function ($query) use ($user) {
                $query->where(function ($query) use ($user) {
                    $query->orWhere([
                        'users_manages_tasks.user_id' => $user->id,
                        'users_manages_projects.user_id' => $user->id,
                        'users_manages_activities.user_id' => $user->id
                    ]);
                });
            })
            ->select('project_fiscal_years.*')
            ->distinct()
            ->with(['project.responsibleUnit', 'project']);
    }

    /**
     * Buscar proyectos en la BD de acuerdo a un listado de departamentos
     *
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function findByUserDepartmentsToReview(FiscalYear $fiscalYear)
    {
        return $this->model->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $fiscalYear->year],
                ['plans.end_year', '>=', $fiscalYear->year],
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYear->id],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_TO_REVIEW]
            ])
            ->whereIn('projects.status', [Project::STATUS_DRAFT, Project::STATUS_IN_PROGRESS])
            ->select('project_fiscal_years.*')
            ->with(['project.responsibleUnit', 'rejections', 'project.subprogram.parent.parent']);
    }

    /**
     * Buscar año fiscal de proyecto por año fiscal y proyecto
     *
     * @param int $fiscalYearId
     * @param int $projectId
     *
     * @return ProjectFiscalYear
     */
    public function findByYearAndProject(int $fiscalYearId, int $projectId)
    {
        return $this->model->where([
            ['fiscal_year_id', '=', $fiscalYearId],
            ['project_id', '=', $projectId]
        ])->first();
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
     * Modificar en la BD el estado de un proyecto.
     *
     * @param ProjectFiscalYear $entity
     *
     * @return ProjectFiscalYear|null
     */
    public function changeStatus(ProjectFiscalYear $entity)
    {
        DB::transaction(function () use ($entity) {
            foreach (ProjectFiscalYear::NEXT_STATUS[$entity->status] as $nextStatus) {
                $entity->status = $nextStatus;
                break;
            }

            $entity->save();

            if ($entity->status === Project::STATUS_IN_PROGRESS) {
                if ($entity->project->status === Project::STATUS_DRAFT) {
                    $entity->project->status = Project::STATUS_IN_PROGRESS;
                    $entity->project->save();
                }
            }

        });

        return $entity->fresh();
    }

    /**
     * Cambiar estado del proyecto
     *
     * @param ProjectFiscalYear $entity
     * @param string $status
     * @param array $rejectData
     *
     * @return void
     */
    public function changeState(ProjectFiscalYear $entity, string $status, array $rejectData = [])
    {
        DB::transaction(function () use ($entity, $status, $rejectData) {
            $entity->status = $status;

            $entity->save();

            if ($status === ProjectFiscalYear::STATUS_REJECTED) {
                $rejectData = $this->rejectRepository->fillData($rejectData);
                $entity->fresh()->rejections()->save($rejectData);
            }

            if ($status === Project::STATUS_IN_PROGRESS) {
                if ($entity->project->status === Project::STATUS_DRAFT) {
                    $entity->project->status = Project::STATUS_IN_PROGRESS;
                    $entity->project->save();
                }
            }
        }, 5);
    }

    /**
     * Obtiene los datos de la tabla intermedia entre proyecto y año fiscal
     *
     * @param int $projectId
     * @param int $fiscalYearId
     *
     * @return ProjectFiscalYear
     */
    public function getProjectFiscalYear(int $projectId, int $fiscalYearId)
    {
        return $this->model->where(['project_id' => $projectId, 'fiscal_year_id' => $fiscalYearId])->first();
    }

    /**
     * Obtiene la estructura del avance físico trimestral
     *
     * @param ProjectFiscalYear $projectFiscalYear
     *
     * @return Collection
     */
    public function getQuarterlyProgressStructure(ProjectFiscalYear $projectFiscalYear)
    {

        $response = collect([]);
        $date = date_format(Carbon::now(), 'Y-m-d');
        $activityBudget = $this->POATrackingRepository->activitiesBudgetProject($this->fiscalYearRepository->findCurrentFiscalYear()->year, $date);

        $projectFiscalYear->activitiesProjectFiscalYear->each(function ($activityProjectFiscalYear) use (&$response, $activityBudget) {
            $act = $activityBudget->firstWhere('cuenta', $activityProjectFiscalYear->getProgrammaticCode());
            $encoded = $act ? number_format($act->codificado, 2) : '0.00';

            $response->push([
                'id' => $activityProjectFiscalYear->id,
                'name' => $activityProjectFiscalYear->name,
                'encoded' => $encoded,
                'progress' => $this->activityProjectFiscalYearRepository->getQuarterlyProgress($activityProjectFiscalYear)
            ]);
        });
        return $response;
    }

    /**
     * Obtiene la estructura de componentes y actividades de un proyecto.
     *
     * @param int $projectId
     * @param int $projectFiscalYearId
     *
     * @return Collection
     */
    public function getComponentsInfo(int $projectId, int $projectFiscalYearId)
    {
        return Component::where('project_id', $projectId)
            ->with([
                'allActivitiesProjectFiscalYear' => function ($query) use ($projectFiscalYearId) {
                    $query->where('project_fiscal_year_id', $projectFiscalYearId);
                    $query->with([
                        'budgetItems',
                        'responsible' => function ($query) {
                            $query->where('active', true);
                        },
                        'tasks' => function ($query) {
                            $query->orderByRaw('ISNULL(date_init), date_init ASC');
                        },
                        'tasks.responsible' => function ($query) {
                            $query->where('active', true);
                        }
                    ])->orderBy('date_init', 'ASC');
                }

            ])->get();
    }

    /**
     * Obtiene la estructura de las actividades de un proyecto.
     *
     * @param int $projectFiscalYearId
     * @param Project $project
     *
     * @return Collection
     */
    public function getComponentsInfoTracking(int $projectFiscalYearId, Project $project, $dataFilter)
    {
        $user = currentUser();

        $isLeader = false;
        $leader = $project->activeLeader();
        if ($leader) {
            $isLeader = $leader->id === $user->id;
        }

        return Component::where('project_id', $project->id)
            ->with([
                'allActivitiesProjectFiscalYear' => function ($query) use ($user, $isLeader, $projectFiscalYearId, $dataFilter) {
                    $query->where('project_fiscal_year_id', $projectFiscalYearId);
                    $query->whereNotNull('activity_project_fiscal_years.weight');

                    $query->when(isset($dataFilter['dateFrom']), function ($q) use ($dataFilter) {
                        $q->where('date_init', '>=', $dataFilter['dateFrom']);
                    });
                    $query->when(isset($dataFilter['dateTo']), function ($q) use ($dataFilter) {
                        $q->where('date_end', '<=', $dataFilter['dateTo']);
                    });
                    $query->when(isset($dataFilter['activity']), function ($q) use ($dataFilter) {
                        $q->where('name', 'like', '%' . $dataFilter['activity'] . '%');
                    });

                    if (!$user->isSuperAdmin() && !$isLeader && !$user->hasRole(Role::PLANNER) && !$user->hasRole(Role::DIRECTOR)) {
                        $query->leftJoin('users_manages_activities', 'users_manages_activities.activity_project_fiscal_year_id', '=', 'activity_project_fiscal_years.id');
                        $query->leftJoin('tasks', 'tasks.activity_project_fiscal_year_id', '=', 'activity_project_fiscal_years.id');
                        $query->leftJoin('users_manages_tasks', 'users_manages_tasks.task_id', '=', 'tasks.id');
                        $query->where(function ($query) use ($user) {
                            $query->where('users_manages_activities.user_id', $user->id);
                            $query->orWhere('users_manages_tasks.user_id', $user->id);
                        });

                        $query->select('activity_project_fiscal_years.*')->distinct('activity_project_fiscal_years.id');
                    }

                    $query->with([
                        'tasks' => function ($query) use ($user, $isLeader) {
                            if (!$user->isSuperAdmin() && !$isLeader && !$user->hasRole(Role::PLANNER) && !$user->hasRole(Role::DIRECTOR)) {
                                $query->join('users_manages_tasks', 'users_manages_tasks.task_id', '=', 'tasks.id');
                                $query->where('users_manages_tasks.user_id', $user->id);
                                $query->select('tasks.*')->distinct('tasks.id');
                            }
                            $query->with([
                                'responsible' => function ($query) {
                                    $query->where('active', true);
                                }
                            ]);
                            $query->orderByRaw('ISNULL(tasks.date_init), tasks.date_init ASC');
                        }
                    ])->orderBy('date_init', 'ASC');
                }
            ])
            ->get();
    }

    /**
     * Buscar en la BD los proyectos en ejecución.
     *
     * @param FiscalYear $fiscalYear
     * @param bool $filter
     * @param int $projectFiscalYearId
     *
     * @return mixed
     */
    public function findByFiscalYearFilterByUser(FiscalYear $fiscalYear, bool $filter = true, int $projectFiscalYearId = 0)
    {
        $query = ProjectFiscalYear::join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $fiscalYear->year],
                ['plans.end_year', '>=', $fiscalYear->year],
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYear->id],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS]
            ])
            ->when($projectFiscalYearId, function ($query) use ($projectFiscalYearId) {
                $query->where('project_fiscal_years.id', $projectFiscalYearId);
            })
            ->select('project_fiscal_years.*')
            ->with([
                'project.responsibleUnit',
                'activitiesProjectFiscalYear' => function ($query) {
                    $query->with([
                        'tasks.responsible' => function ($query) {
                            $query->where('active', true);
                        }
                    ]);
                }
            ]);
        if ($filter) {
            $user = currentUser();
            if ($user->hasRole(Role::DIRECTOR)) {
                $departmentsFilter = $user->departments->map(function ($item, $key) {
                    return $item->id;
                })->toArray();
                $query->whereIn('projects.responsible_unit_id', $departmentsFilter);
            } else {

                $query->join('users_manages_projects', function ($join) use ($user) {
                    $join->on('users_manages_projects.project_id', '=', 'projects.id')
                        ->where([
                            ['users_manages_projects.user_id', $user->id],
                            ['users_manages_projects.active', true],
                        ]);
                });
            }
        }
        return $query->get();
    }

    /**
     * Obtiene los datos de la tabla proyecto y la tabla intermedia entre proyecto y año fiscal
     *
     * @param int $fiscalYearId
     * @param User|null $user
     *
     * @return Collection
     */
    public function getAllProjectFiscalYears(int $fiscalYearId, User $user = null)
    {
        $query = $this->model::join('projects', 'projects.id', '=', 'project_fiscal_years.project_id');

        if ($user) {
            $query = $query->join('users_manages_projects', function ($leftJoin) use ($user) {
                $leftJoin->on('projects.id', '=', 'users_manages_projects.project_id')
                    ->where([
                        ['users_manages_projects.user_id', $user->id],
                        ['users_manages_projects.active', true],
                    ]);
            });
        }

        $query = $query->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->where([
                'project_fiscal_years.fiscal_year_id' => $fiscalYearId,
                'plans.type' => Plan::TYPE_PEI,
                'plans.status' => Plan::STATUS_APPROVED,
                'projects.deleted_at' => null
            ])
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereIn('projects.status', [Project::STATUS_DRAFT, Project::STATUS_IN_PROGRESS])
            ->with('project')
            ->orderBy('projects.id')
            ->get(['project_fiscal_years.*']);

        return $query;
    }

    /**
     * Buscar proyectos por unidad ejecutora en ejecución
     *
     * @param FiscalYear $fiscalYear
     * @param int $executingUnitId
     *
     * @return mixed
     */
    public function findByExecutingUnit(FiscalYear $fiscalYear, int $executingUnitId)
    {
        return $this->model->join('projects', 'project_fiscal_years.project_id', 'projects.id')
            ->whereNull('projects.deleted_at')
            ->where([
                'project_fiscal_years.status' => ProjectFiscalYear::STATUS_IN_PROGRESS,
                'project_fiscal_years.fiscal_year_id' => $fiscalYear->id,
                'projects.status' => Project::STATUS_IN_PROGRESS
            ])->whereHas('project', function ($query) use ($executingUnitId) {
                $query->where('executing_unit_id', $executingUnitId);
            })
            ->select('project_fiscal_years.*')
            ->with('project.executingUnit');
    }

    /**
     * Buscar proyectos por unidad ejecutora planificación
     *
     * @param FiscalYear $fiscalYear
     * @param int $executingUnitId
     *
     * @return mixed
     */
    public function findByPlanningExecutingUnit(FiscalYear $fiscalYear, int $executingUnitId)
    {
        return $this->model->join('projects', 'project_fiscal_years.project_id', 'projects.id')
            ->whereNull('projects.deleted_at')
            ->where([
                'project_fiscal_years.fiscal_year_id' => $fiscalYear->id,
            ])->whereHas('project', function ($query) use ($executingUnitId) {
                $query->where('executing_unit_id', $executingUnitId);
            })->with('project')->get();
    }

    /**
     * Buscar total de reformas por proyectos
     *
     * @param string $companyCode
     * @param int $year
     * @param array $projectsCodes
     * @param Collection $projectFiscalYears
     * @param bool $filter
     *
     * @return Collection
     */
    public function findProjectsWithReforms(string $companyCode, int $year, array $projectsCodes, Collection $projectFiscalYears, bool $filter = true)
    {
        $bindingsString = trim(str_repeat('?,', count($projectsCodes)), ',');
        if ($bindingsString === "") {
            $bindingsString = "''";
        }

        $query = "select substring(a.cuenta, 4, 9) as project_code,
                           sum(case when a.sig_tip = 'RE' then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end else 0 end) as reform
                    from prdetmov a
                             left join prcabmov b on a.codemp = b.codemp and a.anio = b.anio and a.sig_tip = b.sig_tip and a.acu_tip = b.acu_tip
                    where a.codemp = ?
                      and a.anio = ?
                      and a.asociac = 1
                      and b.estado = 3
                      and b.sig_tip = 'RE'
                      and substring(a.cuenta, 4, 9) in ( {$bindingsString} )
                    group by 1
                    order by 1;";

        $projectsTotalReforms = collect(DB::connection('pgsql')->select($query, array_merge([$companyCode, $year], $projectsCodes)));

        $projectFiscalYears = $projectFiscalYears->map(function ($item) use ($projectsTotalReforms) {
            $project = $projectsTotalReforms->firstWhere('project_code', $item->project->getProgramSubProgramCode());
            if (!$project) {
                return $item;
            }
            foreach ($project as $key => $value) {
                $item->setAttribute($key, $value);
            }
            return $item;
        });

        return $filter ? $projectFiscalYears->filter(function ($value, $key) {
            return $value->reform != $value->total_reform;
        }) : $projectFiscalYears;
    }

    /**
     * Buscar en la BD los proyectos a los que se va a realizar seguimiento.
     *
     * @param FiscalYear $fiscalYear
     * @param bool $filter
     *
     * @return mixed
     */
    public function findAllTraceableByCurrentUser(FiscalYear $fiscalYear, bool $filter)
    {
        $query = ProjectFiscalYear::where([
            'project_fiscal_years.status' => ProjectFiscalYear::STATUS_IN_PROGRESS,
            'project_fiscal_years.fiscal_year_id' => $fiscalYear->id
        ])
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $fiscalYear->year],
                ['plans.end_year', '>=', $fiscalYear->year]
            ])
            ->select('project_fiscal_years.*')
            ->with('project');

        if ($filter) {
            $query->join('users_manages_projects', function ($join) {
                $join->on('users_manages_projects.project_id', '=', 'projects.id')
                    ->where([
                        ['users_manages_projects.user_id', currentUser()->id],
                        ['users_manages_projects.active', true],
                    ]);
            });
        }

        return $query->get();
    }

    /**
     * Obtiene los datos para el reporte (Resumen ejecutivo de proyectos priorizados).
     *
     * @param int $fiscalYearId
     *
     * @return Collection
     */
    public function getPriorizedProjectDataTable(int $fiscalYearId)
    {
        $query = $this->model::join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('prioritizations', 'prioritizations.project_fiscal_year_id', '=', 'project_fiscal_years.id')
            ->whereNull('projects.deleted_at')
            ->where([
                'project_fiscal_years.fiscal_year_id' => $fiscalYearId
            ])
            ->with('project.responsibleUnit')
            ->orderBy('projects.id')
            ->select(['project_fiscal_years.*']);

        return $query;
    }

    /**
     * Obtiene una colección de datos para el reporte (Resumen ejecutivo de proyectos priorizados).
     *
     * @param int $fiscalYearId
     *
     * @return Collection
     */
    public function getPriorizedProjectExport(int $fiscalYearId)
    {
        $query = $this->model::join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('prioritizations', 'prioritizations.project_fiscal_year_id', '=', 'project_fiscal_years.id')
            ->whereNull('projects.deleted_at')
            ->where([
                'project_fiscal_years.fiscal_year_id' => $fiscalYearId
            ])
            ->with('project.responsibleUnit')
            ->orderBy('projects.id')
            ->get(['project_fiscal_years.*']);

        return $query;
    }

    /**
     * Obtine los proyectos de arrastre
     *
     * @return mixed
     */
    public function findOngoingProjects()
    {
        return $this->model->join('projects', 'project_fiscal_years.project_id', 'projects.id')
            ->join('fiscal_years', 'project_fiscal_years.fiscal_year_id', 'fiscal_years.id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', Carbon::now()->year],
                ['plans.end_year', '>=', Carbon::now()->year]
            ])
            ->where([
                ['projects.status', '<>', Project::STATUS_DRAFT],
                ['projects.execution_term', '=', Project::EXECUTION_TERM_PLURIANNUAL]
            ])
            ->with('project')
            ->select('project_fiscal_years.*', 'fiscal_years.year AS year')
            ->orderBy('fiscal_years.year')->get();
    }

    /**
     * Buscar en la BD los proyectos en ejecución. para el reporte de Reformas y Certificaciones
     *
     * @param ProjectFiscalYear $projectFiscalYear
     * @param FiscalYear $fiscalYear
     *
     * @return Collection
     */
    public function findProjectByFiscalYear(ProjectFiscalYear $projectFiscalYear, FiscalYear $fiscalYear)
    {
        return Task::join('activity_project_fiscal_years', 'tasks.activity_project_fiscal_year_id', '=', 'activity_project_fiscal_years.id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->whereNull('tasks.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $fiscalYear->year],
                ['plans.end_year', '>=', $fiscalYear->year],
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYear->id],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS],
                ['project_fiscal_years.id', '=', $projectFiscalYear->id]
            ])
            ->select('tasks.*')
            ->with([
                'activityProjectFiscalYear.component.project'
            ])->get();
    }
}