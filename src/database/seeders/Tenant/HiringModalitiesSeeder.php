<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HiringModalitiesSeeder extends Seeder
{

    public function run()
    {
        DB::table('hiring_modalities')->insert(array(
            0 =>
                array(
                    'name' => 'Contrato Servicios Ocasionales',
                    'enabled' => 1,
                    'created_at' => '2019-06-17 19:36:20',
                    'updated_at' => '2019-06-17 19:36:20'
                ),
            1 =>
                array(
                    'name' => 'Contrato Servicios Profesionales',
                    'enabled' => 1,
                    'created_at' => '2019-06-17 19:36:20',
                    'updated_at' => '2019-06-17 19:36:20'
                ),
            2 =>
                array(
                    'name' => 'Nombramiento Provisional',
                    'enabled' => 1,
                    'created_at' => '2019-06-17 19:36:20',
                    'updated_at' => '2019-06-17 19:36:20'
                ),
            3 =>
                array(
                    'name' => 'Nombramiento Permanente',
                    'enabled' => 1,
                    'created_at' => '2019-06-17 19:36:20',
                    'updated_at' => '2019-06-17 19:36:20'
                ),
            4 =>
                array(
                    'name' => 'Libre Nombramiento y Remoción',
                    'enabled' => 1,
                    'created_at' => '2019-06-17 19:36:20',
                    'updated_at' => '2019-06-17 19:36:20'
                ),
            5 =>
                array(
                    'name' => 'Contrato de Pasantías',
                    'enabled' => 1,
                    'created_at' => '2019-06-17 19:36:20',
                    'updated_at' => '2019-06-17 19:36:20'
                ),
            6 =>
                array(
                    'name' => 'Contrato Prácticas Pre-profesionales',
                    'enabled' => 1,
                    'created_at' => '2019-06-17 19:36:20',
                    'updated_at' => '2019-06-17 19:36:20'
                ),
            7 =>
                array(
                    'name' => 'Sujetos al Código del Trabajo',
                    'enabled' => 1,
                    'created_at' => '2019-06-17 19:36:20',
                    'updated_at' => '2019-06-17 19:36:20'
                ),
            8 =>
                array(
                    'name' => 'Encargo',
                    'enabled' => 1,
                    'created_at' => '2019-06-17 19:36:20',
                    'updated_at' => '2019-06-17 19:36:20'
                )
        ));

    }
}
