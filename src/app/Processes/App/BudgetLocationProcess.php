<?php

namespace App\Processes\App;

use App\Models\Business\BudgetItemLocation;
use Illuminate\Support\Collection;

/**
 * Clase BudgetLocationProcess
 *
 * @package App\Processes\App
 */
class BudgetLocationProcess
{

    public function getLocationsTotals(int $year): Collection
    {
        return BudgetItemLocation::query()
            ->join('geographic_location_classifiers', 'budget_item_locations.location_id', 'geographic_location_classifiers.id')
            ->join('budget_items', 'budget_item_locations.budget_item_id', 'budget_items.id')
            ->join('fiscal_years', 'budget_items.fiscal_year_id', 'fiscal_years.id')
            ->where('fiscal_years.year', $year)
            ->selectRaw('sum(budget_item_locations.amount) as amount, geographic_location_classifiers.id, geographic_location_classifiers.description')
            ->groupBy(['geographic_location_classifiers.id', 'geographic_location_classifiers.description'])->get();
    }

}