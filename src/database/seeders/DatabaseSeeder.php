<?php

namespace Database\Seeders;

use Database\Seeders\Tenant\ActivityTypesSeeder;
use Database\Seeders\Tenant\AreasSeeder;
use Database\Seeders\Tenant\CompetencesSeeder;
use Database\Seeders\Tenant\FiscalYearsSeeder;
use Database\Seeders\Tenant\GuideSpendingClassifiersSeeder;
use Database\Seeders\Tenant\HiringModalitiesSeeder;
use Database\Seeders\Tenant\InstitutionsSeeder;
use Database\Seeders\Tenant\MeasureUnitsSeeder;
use Database\Seeders\Tenant\MenuSeeder;
use Database\Seeders\Tenant\ModulesSeeder;
use Database\Seeders\Tenant\PermissionRoleSeeder;
use Database\Seeders\Tenant\PermissionsSeeder;
use Database\Seeders\Tenant\PlansSeeder;
use Database\Seeders\Tenant\PrioritizationTemplatesSeeder;
use Database\Seeders\Tenant\ProceduresSeeder;
use Database\Seeders\Tenant\ReasonsSeeder;
use Database\Seeders\Tenant\RolUsersSeeder;
use Database\Seeders\Tenant\SettingSeeder;
use Database\Seeders\Tenant\ThresholdSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class
        ]);
        $this->call(RoadCatalogTableSeeder::class);
    }
}
