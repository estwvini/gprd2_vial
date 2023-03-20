<?php

namespace App\Http\ViewComposers;


use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Configuration\RoleRepository;
use Illuminate\View\View;

/**
 * Clase ConfigurationDashboardComposer
 * @package App\Http\ViewComposers
 */
class ConfigurationDashboardComposer
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
     * Constructor de ConfigurationDashboardComposer.
     *
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     * @param DepartmentRepository $departmentRepository
     */
    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository,
        DepartmentRepository $departmentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->departmentRepository = $departmentRepository;
    }

    /**
     * Enlazar datos a la vista.
     *
     * @param View $view
     */
    public function compose(View $view)
    {
        $stat_tiles[] = [
            'title' => trans('users.user.title_dashboard'),
            'description' => trans('app.labels.active'),
            'amount' => $this->userRepository->findVisible()->count(),
            'icon' => 'fa-users'
        ];

        $stat_tiles[] = [
            'title' => trans('roles.title_dashboard'),
            'description' => trans('app.labels.active'),
            'amount' => $this->roleRepository->findAssignable()->count(),
            'icon' => 'fa-tasks'
        ];

        $stat_tiles[] = [
            'title' => trans('departments.title_dashboard'),
            'description' => trans('app.labels.active'),
            'amount' => $this->departmentRepository->findEnabled()->count(),
            'icon' => 'fa-sitemap'
        ];

        $view->with('stat_tiles', $stat_tiles);
    }
}