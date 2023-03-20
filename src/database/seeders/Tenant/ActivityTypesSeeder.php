<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityTypesSeeder extends Seeder
{

    public function run()
    {
        DB::table('activity_types')->insert([
            ['name' => 'Planificación Institucional', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Compras Públicas', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Gestión de información y herramientas especializadas', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Gestión Financiera', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Gestión Administrativa', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Gestión de Talento Humano', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Gestión de TICS', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Asesoría y asistencia técnica', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Elaboración de acuerdos, alianzas, convenios y proyectos', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Cursos, capacitación y formación especializada', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Elaboración de propuestas, iniciativas, informes y/o hoja de ruta', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
            ['name' => 'Elaboración de propuestas, iniciativas y reformas legales.', 'created_at' => now(), 'updated_at' => now(), 'deleted_at' => null],
        ]);
    }
}
