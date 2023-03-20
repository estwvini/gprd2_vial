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

class DatabaseTenantSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ModulesSeeder::class,
            MenuSeeder::class,
            ThresholdSeeder::class,
            PrioritizationTemplatesSeeder::class,
            SettingSeeder::class,
            RolUsersSeeder::class,
            PermissionsSeeder::class,
            PermissionRoleSeeder::class,

            AreasSeeder::class,
            ActivityTypesSeeder::class,
            CompetencesSeeder::class,
            FiscalYearsSeeder::class,
            GuideSpendingClassifiersSeeder::class,
            HiringModalitiesSeeder::class,
            InstitutionsSeeder::class,
            MeasureUnitsSeeder::class,
            ProceduresSeeder::class,
            PlansSeeder::class,
            ReasonsSeeder::class
        ]);
    }
}
