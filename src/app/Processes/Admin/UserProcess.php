<?php

namespace App\Processes\Admin;

use App\Exceptions\UserIsManagerException;
use App\Models\System\Role;
use App\Models\System\User;
use App\Processes\Profile\FiscalYearProcess;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\Catalogs\HiringModalitiesRepository;
use App\Repositories\Repository\Configuration\RoleRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase UserProcess
 * @package App\Processes\Admin
 */
class UserProcess
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var DepartmentRepository
     */
    protected $departmentRepository;

    /**
     * @var HiringModalitiesRepository
     */
    protected $hiringModalitiesRepository;

    /**
     * @var fiscalYearProcess
     */
    protected $fiscalYearProcess;

    /**
     * Constructor de UserProcess.
     *
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     * @param DepartmentRepository $departmentRepository
     * @param HiringModalitiesRepository $hiringModalitiesRepository
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        DepartmentRepository $departmentRepository,
        HiringModalitiesRepository $hiringModalitiesRepository,
        FiscalYearProcess $fiscalYearProcess
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->departmentRepository = $departmentRepository;
        $this->hiringModalitiesRepository = $hiringModalitiesRepository;
        $this->fiscalYearProcess = $fiscalYearProcess;
    }


    /**
     * Cargar información de usuarios.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('show.users')) {
            $actions['search'] = [
                'route' => 'show.users',
                'tooltip' => trans('users.user.labels.details')
            ];
        }

        if ($user->can('edit.users')) {
            $actions['edit'] = [
                'route' => 'edit.users',
                'tooltip' => trans('users.user.labels.update')
            ];
        }

        if ($user->can('update.password.users')) {
            $actions['key'] = [
                'route' => 'update.password.users',
                'tooltip' => trans('users.user.labels.reset_password'),
                'confirm_message' => trans('users.user.messages.confirm.reset'),
                'method' => 'get'
            ];
        }

        if ($user->can('destroy.users')) {
            $actions['trash'] = [
                'route' => 'destroy.users',
                'tooltip' => trans('users.user.labels.delete'),
                'confirm_message' => trans('users.user.messages.confirm.delete'),
                'method' => 'delete',
                'btn_class' => 'btn-danger'
            ];
        }
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->whereIn('slug', ['developer']);
        })->where('username', '<>', 'bot')
            ->with(['roles']);
        return Datatables::of($users)
            ->setRowId('id')
            ->addColumn('updated_at', function ($entity) {
                Carbon::setLocale(config('app.locale'));
                return $entity->updated_at->diffForHumans();
            })
            ->editColumn('enabled', function (User $entity) use ($user) {
                $checked = $entity->enabled ? 'checked' : '';
                $role = $entity->hasRole(Role::ADMIN);

                if ($entity->id != $user->id && $user->isSuperAdmin()) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                } elseif ($user->can('status.users') && $entity->id != $user->id && !$role) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                }
                return '';
            })
            ->addColumn('role', function (User $entity) {
                return $entity->roles->first() ? $entity->roles->first()->name : '';
            })
            ->addColumn('actions', function (User $entity) use ($actions, $user) {

                $aux = $actions;
                $role = $entity->hasRole(Role::ADMIN);

                if ($entity->id == $user->id) {
                    unset($aux['trash']);
                    unset($aux['key']);
                }

                if ($entity->id != $user->id && $role) {
                    if (!$user->isSuperAdmin()) {
                        unset($aux['edit']);
                        unset($aux['trash']);
                        unset($aux['key']);
                    }
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $aux
                ]);
            })
            ->rawColumns(['updated_at', 'enabled', 'actions'])
            ->make(true);
    }

    /**
     * Mostrar el formulario de creación de usuario.
     *
     * @return mixed
     * @throws Throwable
     */
    public function create()
    {
        $departments = $this->departmentRepository->findAll();
        $roles = $this->roleRepository->findAssignable();
        $hiringModalities = $this->hiringModalitiesRepository->findAll();

        if (!$roles) {
            throw new Exception();
        }

        $response['view'] = view('admin.user.create', [
            'roles' => $roles,
            'departments' => $departments,
            'hiringModalities' => $hiringModalities
        ])->render();

        return $response;
    }

    /**
     * Almacenar nuevo usuario.
     *
     * @param Request $request
     *
     * @return array
     * @throws ModelException
     * @throws Throwable
     */
    public function store(array $data): array
    {
        $entity = $this->userRepository->createFromArray($data);
        if (!$entity) {
            throw new Exception(trans('users.user.messages.errors.create'), 1000);
        }

        return [
            'view' => view('admin.user.index', [
                'entity' => $entity
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('users.user.messages.success.created')
            ]
        ];
    }

    /**
     * Mostrar la información de usuario.
     *
     * @param int $id
     *
     * @return array
     * @throws Throwable
     */
    public function show(int $id)
    {

        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }

        $response['modal'] = view('admin.user.show', [
            'entity' => $entity
        ])->render();


        return $response;
    }

    /**
     * Mostrar el formulario de edición de usuario.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function edit(int $id)
    {

        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }

        $userDepartments = $entity->departments;
        $departmentInCharge = $entity->getDepartmentInCharge();
        $departments = $this->departmentRepository->findAll();
        $roles = $this->roleRepository->findAssignable();
        $hiringModalities = $this->hiringModalitiesRepository->findAll();

        $entityRolesIds = $entity->roles()->pluck('roles.id')->all();

        $response['view'] = view('admin.user.update', [
            'entity' => $entity,
            'roles' => $roles,
            'entityRolesIds' => $entityRolesIds,
            'departments' => $departments,
            'userDepartments' => $userDepartments,
            'departmentInCharge' => $departmentInCharge,
            'hiringModalities' => $hiringModalities
        ])->render();

        return $response;
    }

    /**
     * Actualizar la información de usuario.
     *
     * @param Request $request
     * @param int $id
     *
     * @return array
     * @throws Throwable
     */
    public function update(array $data, int $id)
    {
        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->userRepository->updateFromArray($data, $entity);
        if (!$entity) {
            throw new Exception(trans('users.user.messages.errors.update'), 1000);
        }

        $this->clearAclCache($entity);
        return [
            'view' => view('admin.user.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('users.user.messages.success.updated')
            ]
        ];
    }

    /**
     * Eliminar lógicamente un usuario.
     *
     * @param int $id
     *
     * @return array
     * @throws ModelException
     * @throws Throwable
     */
    public function destroy(int $id)
    {
        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }

        if ($this->userRepository->isManager($entity)) {
            throw new UserIsManagerException();
        }

        if (!$this->userRepository->delete($entity)) {
            throw new Exception(trans('users.user.messages.errors.delete'), 1000);
        }

        return [
            'view' => view('admin.user.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('users.user.messages.success.deleted')
            ]
        ];
    }


    /**
     * Modificar el estado de usuario.
     *
     * @param $id
     *
     * @return mixed
     * @throws ModelException
     */
    public function status($id)
    {
        $entity = $this->userRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }

        if (!$this->userRepository->changeStatus($entity)) {
            throw new Exception(trans('users.user.messages.errors.update'), 1000);
        }

        $response['message'] = [
            'type' => 'success',
            'text' => trans('users.user.messages.success.updated')
        ];


        return $response;
    }


    /**
     * Mostrar el formulario de reestablecimiento de contraseña.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function changePassword(int $id)
    {
        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw  new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }

        $response['modal'] = view('admin.user.password', [
            'entity' => $entity
        ])->render();

        return $response;
    }

    /**
     * Esta funcion restablce la clave igualandola temporalmente al username
     *
     * @param int $id
     *
     * @return array
     * @throws ModelException
     * @throws Throwable
     */
    public function resetPassword(int $id)
    {
        $entity = $this->userRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('users.user.messages.exceptions.not_found'), 1000);
        }

        if (!$this->userRepository->resetPassword($entity)) {
            throw new Exception(trans('users.user.messages.errors.password'), 1000);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('users.user.messages.success.password_changed')
            ]
        ];

        return $response;
    }

    /**
     * Verificar si el nombre de usuario ya existe.
     *
     * @param Request $request
     *
     * @return bool
     */
    public function checkUsernameExists(Request $request)
    {
        if ($request->id) {
            $result = $this->userRepository->exists(['username' => $request->username], $request->id);
        } else {
            $result = $this->userRepository->exists(['username' => $request->username]);
        }

        return $result;
    }

    /**
     * Limpiar cache del ACL
     *
     * @param User $user
     */
    private function clearAclCache(User $user)
    {
        Cache::forget('acl.getRolesById_' . $user->id);
        Cache::forget('acl.getMergeById_' . $user->id);
        Cache::forget('acl.getPermissionsById_' . $user->id);
        foreach ($user->roles as $role) {
            Cache::forget('acl.getPermissionsInheritedById_' . $role->id);
        }
    }

}
