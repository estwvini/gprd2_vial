<?php

namespace App\Providers;

use App\Events\ActivityAreaChanged;
use App\Events\ActivityCodeChanged;
use App\Events\ProgramAreaChanged;
use App\Events\ProjectExecutingUnitChanged;
use App\Events\SendMailAfterUpdateActivity;
use App\Listeners\Auth\LogSuccessfulLogin;
use App\Listeners\CurrentExpenseBudgetItemsAreaCode;
use App\Listeners\ProjectBudgetItemsExecutingUnitCode;
use App\Listeners\SendMailCompleteActivity;
use App\Listeners\UpdateActivityBudgetItemsActCode;
use App\Listeners\UpdateActivityBudgetItemsAreaCode;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Login::class => [
            LogSuccessfulLogin::class
        ],
        ActivityAreaChanged::class => [
            UpdateActivityBudgetItemsAreaCode::class,
        ],
        ProgramAreaChanged::class => [
            CurrentExpenseBudgetItemsAreaCode::class,
        ],
        ProjectExecutingUnitChanged::class => [
            ProjectBudgetItemsExecutingUnitCode::class,
        ],
        ActivityCodeChanged::class => [
            UpdateActivityBudgetItemsActCode::class,
        ],
        SendMailAfterUpdateActivity::class => [
            SendMailCompleteActivity::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
