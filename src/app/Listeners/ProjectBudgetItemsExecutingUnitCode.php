<?php

namespace App\Listeners;

use App\Events\ProgramAreaChanged;
use App\Events\ProjectExecutingUnitChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class ProjectBudgetItemsExecutingUnitCode
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ProjectExecutingUnitChanged $event
     *
     * @return void
     */
    public function handle(ProjectExecutingUnitChanged $event)
    {
        DB::update(" update budget_items bi
                            inner join activity_project_fiscal_years apfy on bi.activity_project_fiscal_year_id = apfy.id
                            inner join project_fiscal_years pfy on apfy.project_fiscal_year_id = pfy.id
                            set bi.code = concat(left(bi.code, 13), ? , substring(bi.code, 17))
                            where pfy.id = ?", [$event->code, $event->projectFiscalYearId]);
    }
}
