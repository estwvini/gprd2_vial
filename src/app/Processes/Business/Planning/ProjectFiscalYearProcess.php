<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Reject;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ProjectFiscalYearProcess
 * @package App\Processes\Business\Planning
 */
class ProjectFiscalYearProcess
{
    /**
     * @var ProjectFiscalYearRepository
     */
    protected $projectFiscalYearRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * Constructor de ProjectFiscalYearProcess.
     *
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param FiscalYearRepository $fiscalYearRepository
     */
    public function __construct(
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        FiscalYearRepository $fiscalYearRepository
    ) {
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    /**
     * Crear un datatable con la información pertinente de departamentos.
     *
     * @return mixed
     * @throws Exception
     */
    public function data($unitId)
    {
        $user = currentUser();
        $userDepartments = $user->departments;
        $actions = [];
        $actionsReview = [];

        if (!$userDepartments->count()) {
            throw new Exception(trans('projects.messages.errors.no_department'), 1000);
        }

        if ($user->can('edit.profile.projects.plans_management')) {
            $actions['dot-circle-o'] = [
                'route' => 'edit.profile.projects.plans_management',
                'tooltip' => trans('projects.actions.profile'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('modify.logic_frame.projects.plans_management')) {
            $actions['file-text'] = [
                'route' => 'modify.logic_frame.projects.plans_management',
                'tooltip' => trans('projects.actions.logic_frame'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('list.activities.projects.plans_management')) {
            $actions['puzzle-piece'] = [
                'route' => 'list.activities.projects.plans_management',
                'tooltip' => trans('projects.actions.activities'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('index.schedule.projects.plans_management')) {
            $actions['calendar'] = [
                'route' => 'index.schedule.projects.plans_management',
                'tooltip' => trans('projects.actions.schedule'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('create.attachments.projects.plans_management')) {
            $actions['paperclip'] = [
                'route' => 'create.attachments.projects.plans_management',
                'tooltip' => trans('projects.actions.attachments'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('create_roads.attachments.projects.plans_management')) {
            $actions['road'] = [
                'route' => 'create_roads.attachments.projects.plans_management',
                'tooltip' => trans('projects.actions.attachments_roads'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('status.projects.plans_management')) {
            $actions['send'] = [
                'route' => 'status.projects.plans_management',
                'tooltip' => trans('projects.actions.send'),
                'method' => 'PUT',
                'btn_class' => 'btn-success'
            ];
        }
        if ($user->can('rejections_log.projects.plans_management')) {
            $actions['folder-open'] = [
                'route' => 'rejections_log.projects.plans_management',
                'tooltip' => trans('rejections.labels.rejectionsLog'),
                'method' => 'GET',
                'btn_class' => 'btn-warning'
            ];
        }

        if ($user->can('edit.profile.projects_review.plans_management')) {
            $actionsReview['dot-circle-o'] = [
                'route' => 'edit.profile.projects_review.plans_management',
                'tooltip' => trans('projects.actions.profile'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('modify.logic_frame.projects_review.plans_management')) {
            $actionsReview['file-text'] = [
                'route' => 'modify.logic_frame.projects_review.plans_management',
                'tooltip' => trans('projects.actions.logic_frame'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('list.activities.projects_review.plans_management')) {
            $actionsReview['puzzle-piece'] = [
                'route' => 'list.activities.projects_review.plans_management',
                'tooltip' => trans('projects.actions.activities'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('index_show.schedule.projects_review.plans_management')) {
            $actionsReview['calendar'] = [
                'route' => 'index_show.schedule.projects_review.plans_management',
                'tooltip' => trans('projects.actions.schedule'),
                'btn_class' => 'btn-primary'
            ];
        }
        if ($user->can('indexshow.projects_review.plans_management')) {
            $actionsReview['paperclip'] = [
                'route' => 'indexshow.projects_review.plans_management',
                'tooltip' => trans('projects.actions.attachments'),
                'btn_class' => 'btn-primary'
            ];
        }

        $departmentsFilter = $userDepartments->map(function ($item, $key) {
            return $item->id;
        })->toArray();

        return DataTables::of($this->projectFiscalYearRepository->findByUserDepartments($departmentsFilter, $this->fiscalYearRepository->findNextFiscalYear(), $unitId))
            ->setRowId('id')
            ->editColumn('full_cup', function (ProjectFiscalYear $entity) {
                return $entity->project->full_cup;
            })
            ->addColumn('name', function (ProjectFiscalYear $entity) {
                return $entity->project->name;
            })
            ->addColumn('responsibleUnit', function (ProjectFiscalYear $entity) {
                return $entity->project->responsibleUnit ? $entity->project->responsibleUnit->name : '';
            })
            ->addColumn('date_init', function (ProjectFiscalYear $entity) {
                return $entity->project->date_init;
            })
            ->addColumn('date_end', function (ProjectFiscalYear $entity) {
                return $entity->project->date_end;
            })
            ->addColumn('referential_budget', function (ProjectFiscalYear $entity) {
                return number_format($entity->referential_budget, 2);
            })
            ->editColumn('status', function (ProjectFiscalYear $entity) {
                return trans('projects.status.' . strtolower($entity->status));
            })
            ->addColumn('actions', function (ProjectFiscalYear $entity) use ($actions, $actionsReview) {

                if (ProjectFiscalYear::STATUS_REVIEWED === $entity->status) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity->project,
                        'actions' => $actionsReview

                    ]);
                } else {

                    if (isset($actions['send'])) {
                        $actions['send']['params'] = [
                            'project_fiscal_year_id' => $entity->id
                        ];
                    }

                    if (isset($actions['folder-open']) and $entity->rejections->count()) {
                        $actions['folder-open']['params'] = [
                            'project_fiscal_year_id' => $entity->id
                        ];
                    } else {
                        unset($actions['folder-open']);
                    }

                    if (!$entity->project->is_road) {
                        unset($actions['road']);
                    }

                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity->project,
                        'actions' => $actions

                    ]);
                }
            })
            ->filterColumn('projects.date_init', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(projects.date_init,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('projects.date_end', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(projects.date_end,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Modificar el estado del proyecto.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function status(int $id)
    {
        $entity = $this->projectFiscalYearRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        if (!$this->projectFiscalYearRepository->changeStatus($entity)) {
            throw new Exception(trans('projects.messages.errors.update'), 1000);
        }

        return $entity;
    }

    /**
     * Devuelve el proximo año fiscal.
     *
     *
     * @return mixed
     * @throws Exception
     */
    public function nextFiscalYear()
    {
        return $this->fiscalYearRepository->findNextFiscalYear();
    }

    /**
     * Obtiene datos para pantalla de rechazos
     *
     * @param Request $request
     *
     * @return array
     */
    public function rejectionsLog(Request $request)
    {
        $projectFiscalYear = ProjectFiscalYear::find($request->project_fiscal_year_id);

        return [
            'route' => route('data.rejections_log.projects.plans_management', ['project_fiscal_year_id' => $request->project_fiscal_year_id]),
            'project' => $projectFiscalYear->project,
            'projectFiscalYear' => $projectFiscalYear
        ];

    }

    /**
     * Genera la estructura de datatable de rechazos
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function rejectionsLogData(Request $request)
    {
        $projectFiscalYear = ProjectFiscalYear::find($request->project_fiscal_year_id);

        $dataTable = DataTables::of($projectFiscalYear->rejections)
            ->setRowId('id')
            ->addColumn('observations', function (Reject $entity) {
                return $entity->observations;
            })
            ->addColumn('user', function (Reject $entity) {
                return $entity->user->fullName();
            })
            ->addColumn('created_at', function (Reject $entity) {
                return $entity->created_at;
            })
            ->rawColumns(['observations', 'created_at'])
            ->make(true);

        return $dataTable;
    }

}