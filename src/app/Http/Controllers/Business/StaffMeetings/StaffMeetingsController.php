<?php

namespace App\Http\Controllers\Business\StaffMeetings;

use App\Http\Controllers\Controller;
use App\Models\Business\AdminActivity;
use App\Models\Business\StaffActivity;
use App\Models\Business\StaffMeeting;
use App\Models\Business\StaffRelatedActivity;
use App\Models\Business\Task;
use App\Processes\Business\Reports\TrackingReportsProcess;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\AdminActivityRepository;
use App\Repositories\Repository\Business\Catalogs\InstitutionRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Tracking\BudgetProjectTrackingRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class StaffMeetingsController extends Controller
{

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    private $activityProjectFiscalYearRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var AdminActivityRepository
     */
    private $adminActivityRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var InstitutionRepository
     */
    private $institutionRepository;

    /**
     * @var TrackingReportsProcess
     */
    private $trackingReportsProcess;

    /**
     * @var BudgetProjectTrackingRepository
     */
    private $budgetProjectTrackingRepository;

    public function __construct(
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        FiscalYearRepository $fiscalYearRepository,
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        DepartmentRepository $departmentRepository,
        AdminActivityRepository $adminActivityRepository,
        UserRepository $userRepository,
        InstitutionRepository $institutionRepository,
        TrackingReportsProcess $trackingReportsProcess,
        BudgetProjectTrackingRepository $budgetProjectTrackingRepository
    ) {

        $this->middleware('route')->except(['searchActivity', 'searchTaskActivity', 'chart']);

        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->departmentRepository = $departmentRepository;
        $this->adminActivityRepository = $adminActivityRepository;
        $this->userRepository = $userRepository;
        $this->institutionRepository = $institutionRepository;
        $this->trackingReportsProcess = $trackingReportsProcess;
        $this->budgetProjectTrackingRepository = $budgetProjectTrackingRepository;
    }

    public function index()
    {
        try {
            $first = StaffMeeting::query()->orderBy('start')->first();
            if ($first) {
                $years = range($first->start->year, Carbon::now()->year);
            } else {
                $years = [Carbon::now()->year];
            }
            $departments = $this->departmentRepository->findEnabled();
            $response['view'] = view('business.staff_meetings.index', ['years' => $years, 'departments' => $departments])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    public function chart(int $departmentId)
    {
        $result = [];
        try {
            $year = now()->year;

            $query = StaffMeeting::query()
                ->whereYear('start', $year)
                ->where('department_id', $departmentId)
                ->where('status', StaffMeeting::STATUS_CLOSED)
                ->orderBy('start')
                ->select(['week', 'physical_progress', 'budget_progress']);
            return response()->json($query->get()->toArray());

        } catch (Throwable $e) {
        }

        return response()->json($result);
    }

    public function data(Request $request)
    {
        try {
            $user = currentUser();
            $actions = [];

            if ($user->can('show.staff')) {
                $actions['tasks'] = [
                    'route' => 'show.staff',
                    'tooltip' => trans('staff_meetings.labels.planning')
                ];
            }

            $year = $request->input('year');
            $week = $request->input('week');
            $department = $request->input('department');

            $query = StaffMeeting::query()->with('department')->orderBy('start', 'desc')
                ->when($year, function ($query) use ($year) {
                    $query->whereYear('start', $year);
                })->when($week, function ($query) use ($week) {
                    $query->where('week', $week);
                })->when($department, function ($query) use ($department) {
                    $query->where('department_id', $department);
                })->when(!currentUser()->isSuperAdmin(), function ($query) {
                    $query->where('department_id', currentUser()->departments()->first()->id);
                });

            return DataTables::of($query)
                ->setRowId('id')
                ->editColumn('status', function ($entity) use ($actions) {
                    switch ($entity->status) {
                        case StaffMeeting::STATUS_DRAFT:
                            $class = 'warning';
                            break;
                        case StaffMeeting::STATUS_APPROVED:
                            $class = 'info';
                            break;
                        case StaffMeeting::STATUS_CLOSED:
                            $class = 'success';
                            break;
                        default:
                            $class = '';
                    }

                    return "<span class='label label-{$class}'>{$entity->status}</span>";
                })
                ->editColumn('week', function ($entity) {
                    return '#' . $entity->week;
                })
                ->addColumn('actions', function ($entity) use ($actions, $user) {
                    if ($user->can('show.staff')) {
                        $actions['tasks']['params'] = [
                            'staffMeeting' => $entity->id,
                        ];
                    }
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                })
                ->rawColumns(['actions', 'status'])
                ->make(true);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    public function store()
    {
        try {

            if (!currentUser()->departments()->first()) {
                $response = [
                    'message' => [
                        'type' => 'warning',
                        'text' => trans('staff_meetings.messages.info.department_not_exist')
                    ]
                ];
                return response()->json($response);
            }

            Carbon::setWeekStartsAt(Carbon::MONDAY);
            $current = StaffMeeting::query()->where([
                ['start', '=', Carbon::now()->startOfWeek()->toDateString()],
                ['end', '=', Carbon::now()->endOfWeek()->toDateString()],
                ['department_id', '=', currentUser()->departments()->first()->id]
            ])->first();

            $next = StaffMeeting::query()->where([
                ['start', '=', Carbon::now()->startOfWeek()->addDay(7)->toDateString()],
                ['end', '=', Carbon::now()->endOfWeek()->addDay(7)->toDateString()],
                ['department_id', '=', currentUser()->departments()->first()->id]
            ])->count();

            if (!$current || !$next) {
                $meeting = StaffMeeting::create([
                    'department_id' => currentUser()->departments()->first()->id,
                    'status' => StaffMeeting::STATUS_DRAFT,
                    'start' => !$current ? Carbon::now()->startOfWeek() : Carbon::now()->startOfWeek()->addDay(7),
                    'end' => !$current ? Carbon::now()->endOfWeek() : Carbon::now()->endOfWeek()->addDay(7),
                    'week' => !$current ? Carbon::now()->startOfWeek()->weekOfYear : Carbon::now()->startOfWeek()->addDay(7)->weekOfYear
                ]);

                // create pending task off last week
                if ($current && $current->status == StaffMeeting::STATUS_CLOSED) {
                    $current->load(['activities.activitiesRelated', 'activities.institutions', 'activities.alerts', 'activities.coordinations']);
                    foreach ($current->activities as $act) {
                        if ($act->status == StaffActivity::STATUS_DRAFT) {
                            $newAct = $act->replicate();
                            $newAct->meeting_id = $meeting->id;
                            $newAct->save();
                            $newAct = $newAct->fresh();

                            // activities relates
                            foreach ($act->activitiesRelated as $rel) {
                                $newActRel = $rel->replicate();
                                $newActRel->activity_id = $newAct->id;
                                $newActRel->save();
                            }

                            // institutions
                            $newAct->institutions()->attach($act->institutions ? $act->institutions->pluck('id') : []);

                            // alerts relates
                            foreach ($act->alerts as $alert) {
                                $newActAlert = $alert->replicate();
                                $newActAlert->parent_id = $newAct->id;
                                $newActAlert->save();
                            }

                            // coordination's relate
                            foreach ($act->coordinations as $coordination) {
                                $newActCoordination = $coordination->replicate();
                                $newActCoordination->parent_id = $newAct->id;
                                $newActCoordination->save();
                            }
                        }
                    }
                }

                $response = [
                    'message' => [
                        'type' => 'success',
                        'text' => trans('staff_meetings.messages.success.created')
                    ]
                ];
            } else {
                $response = [
                    'message' => [
                        'type' => 'warning',
                        'text' => trans('staff_meetings.messages.info.exist')
                    ]
                ];
            }

        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    public function update(Request $request, StaffMeeting $staffMeeting)
    {
        try {
            $data = $request->all();

            if (isset($data['status']) && $data['status'] == StaffMeeting::STATUS_CLOSED) {
                $progress = self::panelProjects($staffMeeting);
                $data['physical_progress'] = $progress['physicalProgress'];
                $data['budget_progress'] = $progress['budgetProgress'];
            }
            $staffMeeting->update($data);

            $staffMeeting->load('activities.activitiesRelated.relatable');
            self::processMeetingRelations($staffMeeting);

            $meetingBefore = StaffMeeting::query()->where([
                ['department_id', '=', $staffMeeting->department_id],
                ['end', '<', $staffMeeting->end],
            ])->with('activities')->orderBy('end', 'desc')->first();

            $response = [
                'view' => view('business.staff_meetings.show', array_merge([
                    'meeting' => $staffMeeting,
                    'results' => $meetingBefore && $meetingBefore->status == StaffMeeting::STATUS_CLOSED ? $meetingBefore->activities : [],
                    'previous_week' => $meetingBefore ? $meetingBefore->week : 'N/A'
                ], self::panelProjects($staffMeeting)))->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('staff_meetings.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    public function show(StaffMeeting $staffMeeting)
    {
        try {
            setlocale(LC_TIME, 'es_ES.utf8');
            $staffMeeting->load(['activities.activitiesRelated.relatable']);
            self::processMeetingRelations($staffMeeting);

            $meetingBefore = StaffMeeting::query()->where([
                ['department_id', '=', $staffMeeting->department_id],
                ['end', '<', $staffMeeting->end],
            ])->with('activities')->orderBy('end', 'desc')->first();

            $response['view'] = view('business.staff_meetings.show', array_merge([
                'meeting' => $staffMeeting,
                'results' => $meetingBefore && $meetingBefore->status == StaffMeeting::STATUS_CLOSED ? $meetingBefore->activities : [],
                'previous_week' => $meetingBefore ? $meetingBefore->week : 'N/A'
            ], self::panelProjects($staffMeeting)))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    private function panelProjects(StaffMeeting $staffMeeting)
    {
        $department = $staffMeeting->department;
        $fiscalYear = $this->fiscalYearRepository->findBy('year', now()->year);

        $projects = $this->projectFiscalYearRepository->findByExecutingUnit($fiscalYear, $department->id)->with([
            'project.subprogram.parent',
            'activitiesProjectFiscalYear.tasks'
        ])->get();

        $sumPercent = $projects->reduce(function ($percent, $item) {
            return $percent + $item->getProgress();
        });

        $projectCodes = $projects->map(function ($item) {
            return $item->project->getProgramSubProgramCode();
        });

        $projects = $this->budgetProjectTrackingRepository->getProjectBudgetProgress($projects,
            $projectCodes->toArray(), $fiscalYear->year);

        $assigned = $projects->sum('assigned');
        $reform = $projects->sum('reform');
        $accrued = $projects->sum('accrued');

        return [
            'physicalProgress' => count($projects) ? round($sumPercent / count($projects), 1) : 0,
            'budgetProgress' => ($assigned + $reform) > 0 ? round(($accrued * 100) / ($assigned + $reform), 1) : 0,
            'projects' => $projects
        ];
    }

    private function processMeetingRelations(&$staffMeeting)
    {
        foreach ($staffMeeting->activities as $activity) {
            foreach ($activity->activitiesRelated as $related) {
                if ($related->relatable_type == AdminActivity::class) {
                    if ($related->relatable) {
                        $related->relatable->setAttribute('check_list', []);
                    }
                }
            }
        }
    }

    public function storeActivity(Request $request)
    {
        $data = $request->all();
        $meeting = StaffMeeting::query()->find($data['meeting_id']);
        $data['is_extra'] = $meeting->status != StaffMeeting::STATUS_DRAFT;
        if (in_array($data['type'], [StaffActivity::TYPE_ALERT, StaffActivity::TYPE_COORDINATION])) {
            unset($data['meeting_id']);
        }
        $task = StaffActivity::create($data);
        return response()->json($task, 201);
    }

    public function editActivity(Request $request, StaffActivity $staffActivity)
    {
        try {
            $departmentId = currentUser()->departments()->first()->id;
            $staffActivity->load(['activitiesRelated.relatable', 'institutions', 'meeting', 'alerts', 'coordinations']);
            $institutions = $this->institutionRepository->findEnabled();

            foreach ($staffActivity->activitiesRelated as $related) {
                if ($related->relatable_type == AdminActivity::class) {
                    $related->relatable->setAttribute('check_list', []);
                }
            }

            if ($request->input('type') == StaffActivity::TYPE_STRATEGIC) {

                $projects = $this->projectFiscalYearRepository->findByExecutingUnit($this->fiscalYearRepository->findCurrentFiscalYear(), $departmentId)->get();

                $response['view'] = view('business.staff_meetings.edit-strategic', [
                    'activity' => $staffActivity,
                    'projects' => $projects,
                    'institutions' => $institutions
                ])->render();
            } else {
                $users = $this->userRepository->findUsersByDepartment($departmentId, ['users.id', 'users.first_name', 'users.last_name']);

                $response['view'] = view('business.staff_meetings.edit-admin', [
                    'activity' => $staffActivity,
                    'users' => $users,
                    'institutions' => $institutions
                ])->render();
            }

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    public function searchActivity(Request $request)
    {
        try {
            if ($request->input('type') == 1) { // Project task
                return response()->json($this->activityProjectFiscalYearRepository->findByProjectFiscalYear($request->input('projectId')));
            }

            if ($request->input('type') == 2) { // Admin Activity
                $departmentId = currentUser()->departments()->first()->id;

                $filters['fiscal_year_id'] = $this->fiscalYearRepository->findCurrentFiscalYear()->id;
                $filters['responsible_unit_id'] = $departmentId;
                $filters['status'] = $request->input('status', null);
                $filters['priority'] = $request->input('priority', null);


                return response()->json($this->adminActivityRepository->findAllByFilters($filters)->select(['id', 'name', 'status', 'priority', 'date_init', 'date_init'])->get());
            }

        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json([]);
    }

    public function searchTaskActivity(Request $request)
    {
        try {
            $tasks = Task::query()->where('activity_project_fiscal_year_id', $request->input('activityId'))->get();
            return response()->json($tasks);
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    public function updateActivity(Request $request, StaffActivity $staffActivity)
    {
        try {
            $staffActivity->update($request->all());
            $taskIds = $request->input('tasks');
            $institutionsIds = $request->input('institutions');

            $staffActivity->institutions()->sync($institutionsIds);

            if ($taskIds && count($taskIds)) {
                $data = [];
                foreach ($taskIds as $id) {
                    $data[] = new StaffRelatedActivity([
                        'relatable_type' => $request->input('relatable_type'),
                        'relatable_id' => $id,
                    ]);
                }
                $staffActivity->activitiesRelated()->delete();
                $staffActivity->activitiesRelated()->saveMany($data);
            }

            $redirect = $request->input('redirect', 0);
            if ($redirect) {
                setlocale(LC_TIME, 'es_ES.utf8');
                $staffActivity->meeting->load('activities.activitiesRelated.relatable');

                self::processMeetingRelations($staffActivity->meeting);

                $meetingBefore = StaffMeeting::query()->where([
                    ['department_id', '=', $staffActivity->meeting->department_id],
                    ['end', '<', $staffActivity->meeting->end],
                ])->with('activities')->orderBy('end', 'desc')->first();
                $response['view'] = view('business.staff_meetings.show', array_merge([
                    'meeting' => $staffActivity->meeting,
                    'results' => $meetingBefore && $meetingBefore->status == StaffMeeting::STATUS_CLOSED ? $meetingBefore->activities : [],
                    'previous_week' => $meetingBefore ? $meetingBefore->week : 'N/A'
                ], self::panelProjects($staffActivity->meeting)))->render();
                return response()->json($response);
            }
            return response()->json($staffActivity);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    public function deleteActivity(StaffActivity $staffActivity)
    {
        try {

            if (in_array($staffActivity->type, [StaffActivity::TYPE_COORDINATION, StaffActivity::TYPE_ALERT])) {
                $staffActivity->delete();
                return response()->json(['success' => true]);
            }

            $staffMeeting = $staffActivity->meeting;
            $staffActivity->delete();
            $staffMeeting->load('activities.activitiesRelated.relatable');
            self::processMeetingRelations($staffMeeting);
            $meetingBefore = StaffMeeting::query()->where([
                ['department_id', '=', $staffMeeting->department_id],
                ['end', '<', $staffMeeting->end],
            ])->with('activities')->orderBy('end', 'desc')->first();
            $response = [
                'view' => view('business.staff_meetings.show', array_merge([
                    'meeting' => $staffMeeting,
                    'results' => $meetingBefore && $meetingBefore->status == StaffMeeting::STATUS_CLOSED ? $meetingBefore->activities : [],
                    'previous_week' => $meetingBefore ? $meetingBefore->week : 'N/A'
                ], self::panelProjects($staffMeeting)))->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('staff_meetings.messages.success.deleted_activity')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
