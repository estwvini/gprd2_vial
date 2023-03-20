<?php

namespace App\Processes;


use App\Models\System\User;
use App\Repositories\Repository\Configuration\ModuleRepository;
use App\Repositories\Repository\Configuration\PermissionRepository;
use Illuminate\Support\Collection;

/**
 * Clase AppProcess
 * @package App\Processes
 */
class AppProcess
{
    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @var ModuleRepository
     */
    protected $moduleRepository;

    /**
     * Constructor de AppProcess.
     *
     * @param PermissionRepository $permissionRepository
     * @param ModuleRepository $moduleRepository
     */
    public function __construct(
        PermissionRepository $permissionRepository,
        ModuleRepository $moduleRepository
    ) {
        $this->permissionRepository = $permissionRepository;
        $this->moduleRepository = $moduleRepository;
    }

    /**
     * Obtener los módulos asignados a un usuario mediante los permisos.
     *
     * @param User $user
     *
     * @return Collection
     */
    public function getUserModules(User $user)
    {
        $permissions = collect([]);
        $user->roles->each(function ($rol) use (&$permissions) {
            $rol->permissions->each(function ($perm) use (&$permissions) {
                $permissions->push($perm);
            });
        });

        $modules = $permissions->map(function ($item, $key) {
            return $item['module_id'];
        })->unique()->filter(function ($value, $key) {
            return $value != null;
        })->values()->map(function ($item, $key) {
            return $this->moduleRepository->find($item);
        });

        return $modules->sortBy('id');
    }
}