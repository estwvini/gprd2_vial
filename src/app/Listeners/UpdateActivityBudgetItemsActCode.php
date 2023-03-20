<?php

namespace App\Listeners;

use App\Events\ActivityAreaChanged;
use App\Events\ActivityCodeChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class UpdateActivityBudgetItemsActCode
{

    /**
     * Handle the event.
     *
     * @param ActivityCodeChanged $event
     *
     * @return void
     */
    public function handle(ActivityCodeChanged $event)
    {
        DB::update("update budget_items bi
                            inner join activity_project_fiscal_years apfy on bi.activity_project_fiscal_year_id = apfy.id
                            set bi.code = concat(left(bi.code, 17), apfy.code, substring(bi.code, 21))
                            where bi.activity_project_fiscal_year_id = ?", [$event->activityProjectFiscalYear->id]);
    }
}
