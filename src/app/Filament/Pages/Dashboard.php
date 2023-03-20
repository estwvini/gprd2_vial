<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    protected static ?string $title = 'Inicio';

    protected function getColumns(): int|array
    {
        return 1;
    }
}
