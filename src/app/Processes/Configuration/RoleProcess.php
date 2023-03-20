<?php

namespace App\Processes\Configuration;

use App\Repositories\Repository\Configuration\PermissionRepository;
use App\Repositories\Repository\Configuration\RoleRepository;
use Laverix\Acl\Models\Eloquent\Module;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Exception;
use Throwable;

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

    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * @return string
     */
    public function process()
    {
        return 'App\Processes\Configuration\RoleProcess';
    }

    /**
     * @return mixed
     */
    public function data()
    {
        $actions['list-ol'] = [
            'route' => 'show.roles.configuration',
            'tooltip' => trans('configuration.role.labels.update')
        ];

        $dataTable = Datatables::eloquent(config('acl.role')::query())
            ->setRowId('id')
            ->addColumn('updated_at', function ($entity) {
                Carbon::setLocale(config('app.locale'));
                return $entity->updated_at->diffForHumans();
            })
            ->editColumn('editable', function ($entity) {
                $checked = $entity->editable ? 'checked' : '';
                return "<input type='checkbox' class='js-switch js-switch-editable' {$checked} />";
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions', 'updated_at', 'editable'])
            ->make(true);

        return $dataTable;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function show($id)
    {
        $entity = $this->roleRepository->find($id);
        $modules = Module::all();
        if (!$entity)
            throw new Exception(trans('configuration.role.messages.exceptions.not_found'));

        $response['view'] = view('configuration.role.show', [
            'entity' => $entity,
            'modules' => $modules
        ])->render();

        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function editable($id)
    {
        $entity = $this->roleRepository->find($id);

        if (!$entity)
            throw new Exception(trans('configuration.role.messages.exceptions.not_found'), 1000);

        if (!$this->roleRepository->changeEditable($entity))
            throw new Exception(trans('app.messages.exceptions.unexpected'), 1000);

        $response['message'] = [
            'type' => 'success',
            'text' => trans('configuration.role.messages.success.updated')
        ];

        return $response;
    }


    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function permissions(Request $request)
    {
        $role = $request->role;

        $entity = $this->roleRepository->findBy('slug', $role);
        if (!$entity)
            throw new Exception(trans('roles.messages.exceptions.not_found'), 1000);

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
            $this->roleRepository->changePermission($permission, $request->base_third, $request->base_fourth, $request->base_fifth, $request->base_sixth, $request->base, $request->action);
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
     * Change or create all permissions
     *
     * @param Request $request
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
            $this->roleRepository->changeAllPermissions($permission, $parent->slug, $checked, $request->base_third, $request->base_fourth, $request->base_fifth, $request->base_sixth, $request->base);
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
