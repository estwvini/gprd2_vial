<?php

namespace App\Listeners;

use App\Events\ProgramAreaChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class CurrentExpenseBudgetItemsAreaCode
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
     * @param ProgramAreaChanged $event
     *
     * @return void
     */
    public function handle(ProgramAreaChanged $event)
    {
        DB::update("update budget_items bi
                    set bi.code = concat(?, substring(bi.code, 3))
                    where bi.operational_activity_id is not null and bi.fiscal_year_id = ?", [$event->code, $event->fiscalYearId]);
    }
}
