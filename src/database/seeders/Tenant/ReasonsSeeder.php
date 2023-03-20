<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ReasonsSeeder extends Seeder
{

    public function run()
    {
        DB::table('reasons')->insert(array(
            0 =>
                array(
                    'name' => 'Suspensión de actividades por un nuevo acontecimiento de Riesgo',
                    'type' => 'CANCEL',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ),
            1 =>
                array(
                    'name' => 'Cancelación de la actividad por un nuevo evento de Riesgo',
                    'type' => 'CANCEL',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => null
                ),
            2 =>
                array(
                    'name' => 'Suspención o Cancelación de actividad por falta de recursos humanos, financieros, demás.',
                    'type' => 'CANCEL',
                    'created_at' => now(),
                    'updated_at' => now
                    (),
                    'deleted_at' => null
                ),
        ));
    }
}
