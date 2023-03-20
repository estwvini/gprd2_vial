<?php


namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {

        View::composer('layout.left_col', 'App\Http\ViewComposers\MenuComposer');
        View::composer('dashboard.configuration.landing', 'App\Http\ViewComposers\ConfigurationDashboardComposer');
        View::composer('dashboard.planning.projects', 'App\Http\ViewComposers\PlanningDashboardComposer');
        View::composer('default_dashboard', 'App\Http\ViewComposers\DefaultDashboardComposer');
        View::composer('system.default_page', 'App\Http\ViewComposers\DefaultPageComposer');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}