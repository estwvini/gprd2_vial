<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Project;
use App\Models\Business\Task;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Business\Reports\TrackingReportsRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ProjectRepositoryProcess
 * @package App\Processes\Business\Planning
 */
class ProjectsRepositoryProcess
{
    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var ProjectProcess
     */
    private $projectProcess;

    /**
     * @var PlanElementRepository
     */
    private $planElementRepository;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var TrackingReportsRepository
     */
    private $trackingReportsRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    private $activityProjectFiscalYearRepository;

    /**
     * Constructor de ProjectRepositoryProcess.
     *
     * @param ProjectRepository $projectRepository
     * @param DepartmentRepository $departmentRepository
     * @param ProjectProcess $projectProcess
     * @param PlanElementRepository $planElementRepository
     * @param BudgetItemRepository $budgetItemRepository
     * @param TrackingReportsRepository $trackingReportsRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     */
    public function __construct(
        ProjectRepository $projectRepository,
        DepartmentRepository $departmentRepository,
        ProjectProcess $projectProcess,
        PlanElementRepository $planElementRepository,
        BudgetItemRepository $budgetItemRepository,
        TrackingReportsRepository $trackingReportsRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->departmentRepository = $departmentRepository;
        $this->projectProcess = $projectProcess;
        $this->planElementRepository = $planElementRepository;
        $this->budgetItemRepository = $budgetItemRepository;
        $this->trackingReportsRepository = $trackingReportsRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
    }

    /**
     * Retorna información necesaria para la vista base de banco de proyectos
     *
     * @return array
     */
    public function index(): array
    {
        $phases = Project::PROJECT_PHASES;
        $statuses = Project::STATUSES;
        $year = Carbon::now()->year;

        return compact('phases', 'statuses', 'year');
    }

    /**
     * Crear un datatable con la información pertinente de departamentos.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function data(Request $request)
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('change_status.projects_repository.plans_management')) {
            $actions['edit'] = [
                'route' => 'change_status.projects_repository.plans_management',
                'tooltip' => trans('projects_repository.labels.update_status'),
                'btn_class' => 'btn-primary'
            ];
        }

        $actions['copy'] = [
            'route' => 'create.index.projects_repository.plans_management',
            'tooltip' => trans('projects.labels.replicate'),
            'btn_class' => 'btn-warning'
        ];

        $projects = $this->projectRepository->getAllProjects($request->all());

        $dataTable = DataTables::of($projects)
            ->setRowId('id')
            ->editColumn('full_cup', function (Project $entity) {
                return $entity->full_cup;
            })
            ->addColumn('name', function (Project $entity) {
                return $entity->name;
            })
            ->addColumn('executing_unit', function (Project $entity) {
                return $entity->executingUnit ? $entity->executingUnit->name : '';
            })
            ->addColumn('date_init', function (Project $entity) {
                return $entity->date_init;
            })
            ->addColumn('date_end', function (Project $entity) {
                return $entity->date_end;
            })
            ->addColumn('referential_budget', function (Project $entity) {
                return number_format($entity->referential_budget, 2);
            })
            ->addColumn('month_duration', function (Project $entity) {
                return number_format($entity->month_duration, 2);
            })
            ->editColumn('phase', function (Project $entity) {
                return Project::PROJECT_PHASES[$entity->phase];
            })
            ->editColumn('status', function (Project $entity) {
                return trans('projects.status.' . strtolower($entity->status));
            })
            ->editColumn('is_road', function (Project $entity) {
                return $entity->is_road ? trans('app.labels.yes') : trans('app.labels.no');
            })
            ->addColumn('ongoing_project', function (Project $entity) {
                return $entity->fiscalYears->count() > 1 ? trans('app.labels.yes') : trans('app.labels.no');
            })
            ->addColumn('actions', function (Project $entity) use ($actions) {

                $auxActions = $actions;
                if ($entity->status == Project::STATUS_DRAFT || $entity->status == Project::STATUS_CLOSED) {
                    unset($auxActions['edit']);
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $auxActions
                ]);
            })
            ->rawColumns(['cup', 'name', 'responsibleUnit', 'date_init', 'date_end', 'referential_budget', 'month_duration', 'status', 'ongoing_project', 'actions'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Muestra modal de actualización de estado del proyecto
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function changeStatus(int $id)
    {
        $project = Project::find($id);

        if (!$project) {
            throw new Exception(trans('projects_repository.messages.exceptions.not_found'), 1000);
        }

        return [
            'status' => Project::STATUS_TRANSITIONS[$project->status],
            'id' => $id
        ];

    }

    /**
     * Actualiza el estado de un proyecto
     *
     * @param int $id
     * @param Request $request
     *
     * @throws ModelException
     */
    public function updateStatus(int $id, Request $request)
    {
        $project = Project::find($id);

        if (!$project) {
            throw new Exception(trans('projects_repository.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();

        $this->projectRepository->updateFromArray($data, $project);
    }

    /**
     * Mostrar formulario de creación de un proyecto
     *
     * @return mixed
     * @throws Exception
     */
    public function createProject()
    {

        $plan = Plan::where([
            ['type', '=', Plan::TYPE_PEI],
        ])->orderBy('end_year', 'desc')->first();

        if (!$plan) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $minDate = "01-01-{$plan->start_year}";
        $maxDate = "31-12-{$plan->end_year}";

        $objectives = $plan->planElements()->where('type', PlanElement::TYPE_OBJECTIVE)->get();

        return [
            'plan' => $plan,
            'minDate' => $minDate,
            'maxDate' => $maxDate,
            'responsibleUnits' => $this->departmentRepository->findEnabled(),
            'objectives' => $objectives
        ];
    }


    /**
     * Almacena un proyecto
     *
     * @param Request $request
     *
     * @return Project
     * @throws Throwable
     */
    public function storeProject(Request $request)
    {
        $oldProject = $this->projectRepository->find($request->old_project_id);
        $data = [
            'cup' => $this->planElementRepository->generateProjectCode($request->plan_element_id),
            'qualitative_benefit' => $oldProject->qualitative_benefit,
            'purpose' => $oldProject->purpose,
            'assumptions' => $oldProject->assumptions,
            'requirements' => $oldProject->requirements,
            'product_description_service' => $oldProject->product_description_service,
            'approval_criteria' => $oldProject->approval_criteria,
            'general_risks' => $oldProject->qualitative_benefit,
            'phase' => $oldProject->phase,
            'project_related_id' => $oldProject->id
        ];
        $request->merge($data);

        $project = $this->projectProcess->store($request);

        if (!$project) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        $oldProject->load(['indicators', 'components.indicators']);

        // Duplicate indicators
        $oldProject->indicators->each(function ($indicator) use ($project) {
            $newIndicator = $indicator->replicate();
            $newIndicator->indicatorable_id = $project->id;
            $newIndicator->save();
        });

        $oldProjectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($request->fiscal_year_id, $oldProject->id);
        $nextFiscalYear = $project->fiscalYears()->orderBy('year', 'asc')->first();
        $nextProjectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($nextFiscalYear->id, $project->id);


        // Duplicate components
        $oldProject->components->each(function ($component) use ($project, $oldProjectFiscalYear, $nextProjectFiscalYear) {
            $newComponent = $component->replicate();
            $newComponent->project_id = $project->id;
            $newComponent->save();
            $newComponent = $newComponent->fresh();

            $component->activitiesProjectFiscalYear($oldProjectFiscalYear->id)->each(function ($act) use ($newComponent, $nextProjectFiscalYear) {
                $dateInit = $act->date_init ? Carbon::createFromFormat('d-m-Y', $act->date_init)->addYear(1)->format('Y-m-d') : null;
                $dateEnd = $act->date_end ? Carbon::createFromFormat('d-m-Y', $act->date_end)->addYear(1)->format('Y-m-d') : null;

                $newActivity = $act->replicate()->fill([
                    'project_fiscal_year_id' => $nextProjectFiscalYear->id,
                    'component_id' => $newComponent->id,
                    'date_init' => $dateInit,
                    'date_end' => $dateEnd,
                ]);
                $newActivity->save();
            });

            $component->indicators->each(function ($indicator) use ($newComponent) {
                $newIndicator = $indicator->replicate();
                $newIndicator->indicatorable_id = $newComponent->id;
                $newIndicator->save();
            });
        });

        // Duplicate budget
        if ($oldProjectFiscalYear && $nextProjectFiscalYear) {
            $items = $this->budgetItemRepository->getItemsByProjectFiscalYear($oldProjectFiscalYear->id);
            try {
                $budgetCard = $this->trackingReportsRepository->budgetCard($oldProjectFiscalYear->fiscalYear->year, Carbon::now()->format('Y-m-d'), 1, 20, '=');
            } catch (Throwable $e) {
                $budgetCard = collect([]);
            }

            $projectCode = $project->getProgramSubProgramCode();
            $ueCode = $project->responsibleUnit ? $project->responsibleUnit->code : '000';

            foreach ($items as $item) {
                $newActivity = ActivityProjectFiscalYear::where([
                    ['code', $item->activityProjectFiscalYear->code],
                    ['project_fiscal_year_id', $nextProjectFiscalYear->id]
                ])->first();

                $encodedItem = $budgetCard->firstWhere('cuenta', $item->code);

                $code = self::buildItemCode($item->code, $ueCode, $projectCode);

                $newItem = $item->replicate()->fill([
                    'code' => $code,
                    'activity_project_fiscal_year_id' => $newActivity->id,
                    'fiscal_year_id' => $nextProjectFiscalYear->fiscal_year_id,
                    'name' => $item->name ?? $item->budgetClassifier->title,
                    'amount' => $encodedItem ? $encodedItem->codificado : $item->amount
                ]);

                $newItem->save();

                $purchases = $item->getRelations()['publicPurchases'];
                $plannings = $item->getRelations()['budgetPlannings'];

                foreach ($purchases as $purchase) {
                    $newPurchase = $purchase->replicate();
                    $newPurchase->budget_item_id = $newItem->id;
                    $newPurchase->save();
                }
                foreach ($plannings as $planning) {
                    $newPlanning = $planning->replicate();
                    $newPlanning->budget_item_id = $newItem->id;
                    $newPlanning->save();
                }
            }
        }

        // Duplicate tasks
        $activities = $this->activityProjectFiscalYearRepository->getActivitiesByProject($oldProjectFiscalYear->id);

        foreach ($activities as $activity) {

            $newActivity = ActivityProjectFiscalYear::where([
                ['code', $activity->code],
                ['project_fiscal_year_id', $nextProjectFiscalYear->id]
            ])->first();

            if ($newActivity) {
                foreach ($activity->tasks as $task) {
                    Task::where([
                        ['activity_project_fiscal_year_id', $newActivity->id],
                        ['name', $task->name]
                    ])->firstOr(function () use ($task, $newActivity) {
                        $dateInit = $task->date_init ? Carbon::createFromFormat('d-m-Y', $task->date_init)->addYear(1)->format('Y-m-d') : null;
                        $dateEnd = $task->date_end ? Carbon::createFromFormat('d-m-Y', $task->date_end)->addYear(1)->format('Y-m-d') : null;
                        $newTask = $task->replicate()->fill([
                            'activity_project_fiscal_year_id' => $newActivity->id,
                            'date_init' => $dateInit,
                            'date_end' => $dateEnd,
                            'due_date' => null,
                            'beneficiaries' => null,
                        ]);
                        $newTask->save();
                    });
                }
            }
        }


        return $project;
    }


    private function buildItemCode(string $code, string $ueCode, string $projectCode)
    {
        return substr($code, 0, 2) . '.' . $projectCode . '.' . $ueCode . '.' . substr($code, 17);
    }

}
