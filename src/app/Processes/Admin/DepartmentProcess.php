<?php

namespace App\Processes\Admin;

use App\Exceptions\DepartmentHasChildrenException;
use App\Exceptions\DepartmentHasOperationalActivitiesException;
use App\Exceptions\DepartmentHasParentDisabledException;
use App\Exceptions\DepartmentHasProjectsException;
use App\Exceptions\DepartmentHasUsersException;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase DepartmentProcess
 * @package App\Processes\Admin
 */
class DepartmentProcess
{
    /**
     * @var DepartmentRepository
     */
    protected $departmentRepository;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Constructor de DepartmentProcess.
     *
     * @param DepartmentRepository $departmentRepository
     * @param SettingRepository $settingRepository
     * @param UserRepository $userRepository
     */
    public function __construct(
        DepartmentRepository $departmentRepository,
        SettingRepository $settingRepository,
        UserRepository $userRepository
    ) {
        $this->departmentRepository = $departmentRepository;
        $this->settingRepository = $settingRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Obtener modelo del proceso de departamentos.
     *
     * @return string
     */
    public function process()
    {
        return DepartmentProcess::class;
    }

    /**
     * Cargar información de departamentos.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('show.departments')) {
            $actions['search'] = [
                'route' => 'show.departments',
                'tooltip' => trans('departments.labels.details')
            ];
        }

        if ($user->can('edit.departments')) {
            $actions['edit'] = [
                'route' => 'edit.departments',
                'tooltip' => trans('departments.labels.update')
            ];
        }

        if ($user->can('destroy.departments')) {
            $actions['trash'] = [
                'route' => 'destroy.departments',
                'tooltip' => trans('departments.labels.delete'),
                'confirm_message' => trans('departments.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        return DataTables::collection($this->departmentRepository->findAll())
            ->setRowId('id')
            ->editColumn('enabled', function ($entity) use ($user) {
                $checked = $entity->enabled ? 'checked' : '';

                if ($user->can('status.departments')) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                } else {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' disabled {$checked}/></label>";
                }
            })
            ->addColumn('parent_id', function ($entity) {
                return isset($entity->parentDepartment) ? $entity->parentDepartment->name : '';
            })
            ->addColumn('manager_id', function ($entity) {
                $manager = $entity->managers()->first();
                return isset($manager) ? $manager->first_name . ' ' . $manager->last_name : '';
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['enabled', 'actions'])
            ->make(true);
    }

    /**
     * Mostrar el formulario de creación de departamentos.
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function create()
    {
        $code = sprintf('%03d', ((int)$this->departmentRepository->maxValueCode() + 1));

        $departmentDepth = $this->settingRepository->findByKey('department_settings');

        $departments = $this->departmentRepository->findMaxDepthEnabled($departmentDepth->value['max_depth']);

        $response['view'] = view('admin.department.create', [
            'departments' => $departments,
            'code' => $code
        ])->render();

        return response()->json($response);
    }

    /**
     * Almacenar nuevo departamento.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function store(array $data)
    {
        $entity = $this->departmentRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('departments.messages.errors.create'), 1000);
        }

        $response = [
            'view' => view('admin.department.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('departments.messages.success.created')
            ]
        ];

        return response()->json($response);
    }

    /**
     * Mostrar la información de departamento.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function show(int $id)
    {
        $entity = $this->departmentRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('departments.messages.exceptions.not_found'), 1000);
        }

        $response['modal_st'] = view('admin.department.show', [
            'entity' => $entity
        ])->render();

        return $response;
    }

    /**
     * Mostrar el formulario de edición de departamento.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function edit(int $id)
    {
        $entity = $this->departmentRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('departments.messages.exceptions.not_found'), 1000);
        }

        $departmentDepth = $this->settingRepository->findByKey('department_settings');

        $departments = $this->departmentRepository->findMaxDepthEnabled($departmentDepth->value['max_depth'], $entity->id);

        $response['view'] = view('admin.department.update', [
            'entity' => $entity,
            'departments' => $departments
        ])->render();

        return $response;
    }

    /**
     * Actualizar la información de departamento.
     *
     * @param Request $request
     * @param int $id
     *
     * @return array
     * @throws Throwable
     */
    public function update(array $data, int $id)
    {
        $entity = $this->departmentRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('departments.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->departmentRepository->updateFromArray($data, $entity);

        if (!$entity) {
            throw new Exception(trans('departments.messages.errors.update'), 1000);
        }

        return [
            'view' => view('admin.department.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('departments.messages.success.updated')
            ]
        ];
    }

    /**
     * Eliminar lógicamente un departamento.
     *
     * @param int $id
     *
     * @return array
     * @throws Throwable
     */
    public function destroy(int $id)
    {
        $entity = $this->departmentRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('departments.messages.exceptions.not_found'), 1000);
        }

        if ($entity->childrenDepartments()->count()) {
            throw new DepartmentHasChildrenException();
        }

        if ($entity->users()->count()) {
            throw new DepartmentHasUsersException();
        }

        if ($entity->responsibleProjects()->count()) {
            throw new DepartmentHasProjectsException();
        }

        if ($entity->executingProjects()->count()) {
            throw new DepartmentHasProjectsException();
        }

        if ($entity->responsibleOperationalActivities()->count()) {
            throw new DepartmentHasOperationalActivitiesException();
        }

        if ($entity->executingOperationalActivities()->count()) {
            throw new DepartmentHasOperationalActivitiesException();
        }

        if (!$this->departmentRepository->delete($entity)) {
            throw new Exception(trans('departments.messages.errors.delete'), 1000);
        }

        $response = [
            'view' => view('admin.department.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('departments.messages.success.deleted')
            ]
        ];

        return $response;
    }

    /**
     * Modificar el estado de departamento.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function status(int $id)
    {
        $entity = $this->departmentRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('departments.messages.exceptions.not_found'), 1000);
        }

        if ($entity->childrenDepartments()->where('enabled', 1)->count() > 0) {
            throw new DepartmentHasChildrenException();
        }

        if ($entity->users()->count()) {
            throw new DepartmentHasUsersException();
        }

        if (isset($entity->parentDepartment) && !$entity->parentDepartment->enabled) {
            throw new DepartmentHasParentDisabledException();
        }

        if (!$this->departmentRepository->changeStatus($entity)) {
            throw new Exception(trans('departments.messages.errors.update'), 1000);
        }

        $response['message'] = [
            'type' => 'success',
            'text' => trans('departments.messages.success.updated')
        ];

        return $response;
    }
}
