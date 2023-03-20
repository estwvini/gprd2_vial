<?php

namespace App\Filament\Widgets;

use App\Models\Tenant;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{

    protected function getColumns(): int
    {
       return 4;
    }

    protected function getCards(): array
    {
        return [
//            Card::make('Tenants', Tenant::query()->count())
        ];
    }
}
