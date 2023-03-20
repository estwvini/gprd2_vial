<?php

namespace App\Processes\Admin;

use Altek\Accountant\Models\Ledger;
use App\Models\Business\Project;
use App\Models\System\User;
use App\Repositories\Repository\Admin\AuditRepository;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use Exception;
use Yajra\DataTables\DataTables;

/**
 * Clase ReportProcess
 *
 * @package App\Processes\Admin
 */
class ReportProcess
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var AuditRepository
     */
    private $auditRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * ReportProcess constructor.
     *
     * @param UserRepository $userRepository
     * @param ProjectRepository $projectRepository
     * @param AuditRepository $auditRepository
     * @param DepartmentRepository $departmentRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(
        UserRepository $userRepository,
        ProjectRepository $projectRepository,
        AuditRepository $auditRepository,
        DepartmentRepository $departmentRepository,
        SettingRepository $settingRepository
    ) {
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
        $this->auditRepository = $auditRepository;
        $this->departmentRepository = $departmentRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Cargar información de usuarios.
     *
     * @return mixed
     * @throws Exception
     */
    public function usersData()
    {
        return DataTables::of($this->userRepository->getAllWith()->get())
            ->setRowId('id')
            ->editColumn('enabled', function (User $entity) {
                return $entity->enabled ? trans('reports.config.users.yes') : trans('reports.config.users.no');
            })
            ->addColumn('name_surname', function (User $entity) {
                return $entity->fullName();
            })
            ->addColumn('hiringModality', function (User $entity) {
                return $entity->hiringModality ? $entity->hiringModality->name : '';
            })
            ->addColumn('role', function (User $entity) {
                $roles = '';
                foreach ($entity->roles as $role) {
                    $roles .= '<span class="label label-primary">' . $role->name . '</span></br>';
                }
                return $roles;
            })
            ->addColumn('department_name', function (User $entity) {
                $departments = '';
                foreach ($entity->departments as $department) {
                    if ($department->pivot->is_manager) {
                        $departments .= '<span class="label label-primary">' . $department->name . '</span></br>';
                    } else {
                        $departments .= '<span>' . $department->name . '</span></br>';
                    }
                }
                return $departments;
            })
            ->rawColumns(['role', 'department_name'])
            ->make(true);
    }

    /**
     * Cargar información de proyectos.
     *
     * @return mixed
     * @throws Exception
     */
    public function projectData()
    {
        return DataTables::of($this->projectRepository->getAllWith()->get())
            ->setRowId('id')
            ->addColumn('responsibleUnit', function (Project $entity) {
                return $entity->responsibleUnit ? $entity->responsibleUnit->name : '';
            })
            ->addColumn('executingUnit', function (Project $entity) {
                return $entity->executingUnit ? $entity->executingUnit->name : '';
            })
            ->addColumn('leader', function (Project $entity) {
                return $entity->activeLeader() ? $entity->activeLeader()->fullName() : '';
            })
            ->editColumn('status', function (Project $entity) {
                return trans('projects.status.' . strtolower($entity->status));
            })
            ->make(true);
    }

    /**
     * Cargar información de actividades de usuario.
     *
     * @param array $filter
     *
     * @return mixed
     * @throws Exception
     */
    public function auditData(array $filter)
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('detail.index.audit.config_reports')) {
            $actions['search'] = [
                'route' => 'detail.index.audit.config_reports',
                'tooltip' => trans('app.labels.details'),
                'btn_class' => 'btn-primary'
            ];
        }
        return DataTables::of($this->auditRepository->getAllWith($filter))
            ->setRowId('id')
            ->editColumn('created_at', function (Ledger $entity) {
                return Carbon::parse($entity->created_at)->format('d-m-Y H:i A');
            })
            ->addColumn('username', function (Ledger $entity) {
                return $entity->user->username;
            })
            ->addColumn('full_name', function (Ledger $entity) {
                return $entity->user->fullName();
            })
            ->addColumn('table', function (Ledger $entity) {
                return $entity->recordable()->getModel()->getTable();
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(ledgers.created_at,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->addColumn('actions', function (Ledger $entity) use ($actions) {

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions

                ]);
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Obtiene la información necesaria para exportar el reporte de actividades de usuarios
     *
     * @param array $filters
     *
     * @return array
     * @throws Exception
     */
    public function auditDataExport(array $filters)
    {
        $rows = $this->auditData($filters)->getData();
        $date = date('d-m-Y');
        $gadInfo = $this->settingRepository->findByKey('gad')->value;
        $department = isset($filters['department_id']) ? $this->departmentRepository->find($filters['department_id'])->name : trans('app.labels.all');
        $user = isset($filters['user_id']) ? $this->userRepository->find($filters['user_id'])->fullName() : trans('app.labels.all');

        return [
            'rows' => $rows->data,
            'date' => $date,
            'gad' => $gadInfo['province'],
            'department' => $department,
            'user' => $user,
        ];
    }

    /**
     * Buscar registro de actividad
     *
     * @param int $id
     *
     * @return mixed
     */
    public function auditDetail(int $id)
    {
        $entity = $this->auditRepository->find($id);

        if ($entity->getPivotData()) {
            $details = [
                [
                    'model' => $entity->getData(true),
                ],
                [
                    'model' => $entity->getData(),
                    'relations' => $entity->getPivotData()
                ],

            ];
        } else {
            $details = [
                $entity->getData(true),
                $entity->getData()
            ];
        }

        return ['entity' => $entity, 'details' => $details];
    }

    public function auditIndex()
    {
        $users = $this->userRepository->findVisible();
        $departments = $this->departmentRepository->findEnabled();

        return compact('users', 'departments');
    }
}
