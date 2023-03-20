<?php

namespace Database\Seeders\Tenant;

use App\Models\System\Module;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesSeeder extends Seeder
{

    public function run()
    {
        DB::table('modules')->insert(array(
            0 =>
                array(
                    'created_at' => Carbon::now(),
                    'deleted_at' => null,
                    'description' => null,
                    'enabled' => 1,
                    'icon' => null,
                    'id' => Module::MODULE_GXR,
                    'image' => 'images/llky-plan-icon.png',
                    'name' => 'Módulo Planificación GxR',
                    'updated_at' => Carbon::now()
                ),
            1 =>
                array(
                    'created_at' => Carbon::now(),
                    'deleted_at' => null,
                    'description' => null,
                    'enabled' => 1,
                    'icon' => null,
                    'id' => Module::MODULE_ROADS,
                    'image' => 'images/llky-vial-icon.png',
                    'name' => 'Módulo Vial',
                    'updated_at' => Carbon::now()
                ),
            2 =>
                array(
                    'created_at' => Carbon::now(),
                    'deleted_at' => null,
                    'description' => null,
                    'enabled' => 1,
                    'icon' => null,
                    'id' => Module::MODULE_CONFIGURATION,
                    'image' => 'images/llky-config-icon.png',
                    'name' => 'Módulo Configuración',
                    'updated_at' => Carbon::now()
                ),
            3 =>
                array(
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                    'deleted_at' => null,
                    'description' => null,
                    'enabled' => 1,
                    'icon' => null,
                    'id' => Module::MODULE_APP,
                    'image' => 'images/llky-app-icon.png',
                    'name' => 'Aplicación Móvil'
                )
        ));
        DB::statement("select setval('modules_id_seq', (select max(id) from modules)+1)");
    }
}
