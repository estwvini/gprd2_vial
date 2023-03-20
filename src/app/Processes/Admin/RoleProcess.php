<?php

namespace App\Processes\Admin;

use App\Exceptions\RoleHasUsersException;
use App\Exceptions\UnexpectedException;
use App\Models\System\Role;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Configuration\PermissionRepository;
use App\Repositories\Repository\Configuration\RoleRepository;
use Exception;
use Illuminate\Http\Request;
use Laverix\Acl\Models\Eloquent\Module;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase RoleProcess
 * @package App\Processes\Admin
 */
class RoleProcess
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * Constructor de RoleProcess
     * RoleProcess constructor.
     *
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Obtener modelo del proceso de departamentos.
     *
     * @return string
     */
    public function process()
    {
        return RoleProcess::class;
    }

    /**
     * Cargar información de roles.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('show.roles')) {
            $actions['search'] = [
                'route' => 'show.roles',
                'tooltip' => trans('app.labels.details')
            ];
        }

        if ($user->can('edit.roles')) {
            $actions['edit'] = [
                'route' => 'edit.roles',
                'tooltip' => trans('app.labels.edit')
            ];
        }

        if ($user->can('permissions.roles')) {
            $actions['list-ol'] = [
                'route' => 'permissions.roles',
                'tooltip' => trans('roles.labels.permissions')
            ];
        }

        if ($user->can('destroy.roles')) {
            $actions['trash'] = [
                'route' => 'destroy.roles',
                'tooltip' => trans('roles.labels.delete'),
                'confirm_message' => trans('roles.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        return DataTables::collection(Role::where('slug', '<>', 'developer')->get())
            ->setRowId('id')
            ->addColumn('bulk_action', function ($entity) {
                return "<input type='checkbox' name='table_records' class='bulk check-one' value='{$entity->id}' />";
            })
            ->editColumn('enabled', function ($entity) use ($user) {
                $checked = $entity->enabled ? 'checked' : '';

                if ($user->can('status.roles') && $entity->editable) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                } else {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' disabled {$checked}/></label>";
                }
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                if (!$entity->editable) {
                    unset($actions['edit']);
                    unset($actions['list-ol']);
                }

                if ($entity->isAdminRole() || $entity->slug === Role::PLANNER || $entity->slug === Role::AUTHORITY || $entity->slug === Role::SUPPORT || $entity->slug ===
                    Role::LEADER || $entity->slug === Role::DIRECTOR || $entity->slug === Role::FINANCIAL) {
                    unset($actions['trash']);
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['bulk_action', 'actions', 'updated_at', 'enabled'])
            ->make(true);
    }

    /**
     * Mostrar el formulario de creación de roles.
     *
     * @param Request $request
     *
     * @return array
     * @throws ModelException
     * @throws Throwable
     */
    public function store(array $data)
    {
        $entity = $this->roleRepository->createFromArray($data);
        if (!$entity) {
            throw new Exception(trans('app.messages.exceptions.unexpected'));
        }

        $modules = Module::all();

        $response = [
            'view' => view('admin.role.permission', [
                'entity' => $entity,
                'modules' => $modules
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('roles.messages.success.created')
            ]
        ];

        return $response;
    }

    /**
     * Mostrar la información de rol
     *
     * @param $id
     *
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function show($id)
    {
        $entity = $this->roleRepository->find($id);
        $modules = Module::all();
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'));
        }

        $response['modal'] = view('admin.role.show', [
            'entity' => $entity,
            'modules' => $modules
        ])->render();

        return $response;
    }

    /**
     * Mostrar el formulario de edición de rol
     *
     * @param $id
     *
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function edit($id)
    {
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'));
        }

        $response['view'] = view('admin.role.update', [
            'entity' => $entity
        ])->render();

        return $response;
    }

    /**
     * Actualizar la información de rol
     *
     * @param Request $request
     * @param $id
     *
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function update(array $data, $id)
    {
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->roleRepository->updateFromArray($data, $entity);

        return [
            'view' => view('admin.role.index', [
                'entity' => $entity
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('roles.messages.success.updated')
            ]
        ];
    }

    /**
     * Eliminar lógicamente un rol
     *
     * @param $id
     *
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function destroy($id)
    {
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);
        }

        if ($entity->users()->count() > 0) {
            throw new RoleHasUsersException($entity->name);
        }

        if (!$this->roleRepository->delete($entity)) {
            throw new UnexpectedException();
        }

        return [
            'view' => view('admin.role.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('roles.messages.success.deleted')
            ]
        ];
    }

    /**
     * Modificar el estado de rol
     *
     * @param $id
     *
     * @return mixed
     * @throws Exception
     */
    public function status($id)
    {

        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);
        }

        if (!$this->roleRepository->changeStatus($entity)) {
            throw new UnexpectedException();
        }

        $response['message'] = [
            'type' => 'success',
            'text' => trans('roles.messages.success.updated')
        ];


        return $response;
    }

    /**
     * Modificar el campo editable de rol
     *
     * @param $id
     *
     * @return array
     * @throws Exception
     */
    public function editable($id): array
    {
        $entity = $this->roleRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);
        }

        if (!$this->roleRepository->changeEditable($entity)) {
            throw new UnexpectedException();
        }

        $response['message'] = [
            'type' => 'success',
            'text' => trans('roles.messages.success.updated')
        ];

        return $response;
    }

    /**
     * Mostrar el formulario de permisos de rol
     *
     * @param $id
     *
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function permissions($id)
    {
        $entity = $this->roleRepository->find($id);
        $modules = Module::all();
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'));
        }

        $response['view'] = view('admin.role.permission', [
            'entity' => $entity,
            'modules' => $modules
        ])->render();

        return $response;
    }

    /**
     * Crea y asigna permisos a rol
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function onePermissions(Request $request)
    {
        $role = $request->role;

        $entity = $this->roleRepository->findBy('slug', $role);
        if (!$entity) {
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);
        }

        if ($request->base_second) {
            $action = $request->base;
            $base = $request->base_second;
        } else {
            $action = $request->action;
            $base = $request->base;
        }
        $inherit = $base . '.' . $role;
        $permission = $this->permissionRepository->findBy('name', $inherit);

        if (!$permission) {
            $parent = $this->permissionRepository->findBy('name', $base);

            if ($parent) {
                $permission = $this->permissionRepository->create([
                    'inherit_id' => $parent->id,
                    'module_id' => $parent->module_id,
                    'name' => $inherit,
                    'description' => trans('roles.labels.permissions_over', ['name' => $entity->name, 'label' => $parent->label]),
                    'slug' => $parent->slug,
                    'label' => $parent->label
                ]);
                $permission = $permission->fresh();
                $entity->assignPermission([$permission]);
            }
        }
        if ($request->base_sixth) {
            $this->roleRepository->changePermission($permission, $request->base_third, $request->base_fourth, $request->base_fifth, $request->base_sixth, $request->base,
                $request->action);
        } elseif ($request->base_fifth) {
            $this->roleRepository->changePermission($permission, $request->base_third, $request->base_fourth, $request->base_fifth, $request->base, $request->action);
        } elseif ($request->base_fourth) {
            $this->roleRepository->changePermission($permission, $request->base_third, $request->base_fourth, $request->base, $request->action);
        } elseif ($request->base_third) {
            $this->roleRepository->changePermission($permission, $request->base_third, $request->base, $request->action);
        } elseif ($request->base_second) {
            $this->roleRepository->changePermission($permission, $action, $request->action);
        } else {
            $this->roleRepository->changePermission($permission, $action);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('roles.messages.success.permissions')
        ];

        return $response;
    }

    /**
     *
     * Valida si existe el nombre del rol
     *
     * @param $name
     * @param $id
     *
     * @return bool
     */
    public function checkNameExists($name, $id)
    {
        return $this->roleRepository->exists(['name' => $name], $id);
    }

    /**
     * Cambia o crea todos los permisos de rol
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function allPermissions(Request $request)
    {
        $role = $request->role;
        $entity = $this->roleRepository->findBy('slug', $role);
        if (!$entity) {
            throw new Exception(trans('configuration.role.messages.exceptions.not_found'), 1000);
        }

        if ($request->base_second) {
            $base = $request->base_second;
        } else {
            $base = $request->base;
        }
        $parent = $this->permissionRepository->findBy('name', $base);
        if (!$parent) {
            throw new Exception(trans('configuration.role.messages.exceptions.not_parent'), 1000);
        }

        $inherit = $base . '.' . $role;
        $permission = $this->permissionRepository->findBy('name', $inherit);

        if (!$permission) {
            $permission = $this->permissionRepository->create([
                'inherit_id' => $parent->id,
                'module_id' => $parent->module_id,
                'name' => $inherit,
                'description' => trans('roles.labels.permissions_over', ['name' => $entity->name, 'label' => $parent->label]),
                'slug' => $parent->slug,
                'label' => $parent->label
            ]);
            $permission = $permission->fresh();
            $entity->assignPermission([$permission]);
        }

        $checked = $request->checked == 'true';
        if ($request->base_sixth) {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base_third, $request->base_fourth, $request->base_fifth,
                $request->base_sixth, $request->base);
        } elseif ($request->base_fifth) {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base_third, $request->base_fourth, $request->base_fifth, $request->base);
        } elseif ($request->base_fourth) {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base_third, $request->base_fourth, $request->base);
        } elseif ($request->base_third) {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base_third, $request->base);
        } elseif ($request->base_second) {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base);
        } else {
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked);
        }
        $response['message'] = [
            'type' => 'success',
            'text' => trans('configuration.role.messages.success.permissions')
        ];

        return $response;
    }

}
