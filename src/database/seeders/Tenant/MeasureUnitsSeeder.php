<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeasureUnitsSeeder extends Seeder
{
    public function run()
    {
        DB::table('measure_units')->insert(array (
            0 =>
            array (
                'name' => 'PORCIENTO',
                'abbreviation' => '%',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 0,
            ),
            1 =>
            array (
                'name' => 'UNIDAD',
                'abbreviation' => 'u',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            2 =>
            array (
                'name' => 'KILOMETRO',
                'abbreviation' => 'km',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            3 =>
            array (
                'name' => 'KILOGRAMO',
                'abbreviation' => 'kg',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            4 =>
            array (
                'name' => 'GRAMO',
                'abbreviation' => 'g',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            5 =>
            array (
                'name' => 'METRO',
                'abbreviation' => 'm',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            6 =>
            array (
                'name' => 'PULGADA',
                'abbreviation' => 'in',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            7 =>
            array (
                'name' => 'GALON',
                'abbreviation' => 'gl',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            8 =>
            array (
                'name' => 'LITRO',
                'abbreviation' => 'l',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            9 =>
            array (
                'name' => 'TONELADA',
                'abbreviation' => 't',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            10 =>
            array (
                'name' => 'METRO CUBICO',
                'abbreviation' => 'm3',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            11 =>
            array (
                'name' => 'PIES',
                'abbreviation' => 'p',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            12 =>
            array (
                'name' => 'BARRIL',
                'abbreviation' => 'b',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            13 =>
            array (
                'name' => 'CENTIMETRO CUBICO',
                'abbreviation' => 'cm3',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            14 =>
            array (
                'name' => 'CENTIMETRO CUADRADO',
                'abbreviation' => 'cm2',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            15 =>
            array (
                'name' => 'CENTIGRAMO',
                'abbreviation' => 'cg',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            16 =>
            array (
                'name' => 'LIBRA',
                'abbreviation' => 'lb',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            17 =>
            array (
                'name' => 'MILIMETRO',
                'abbreviation' => 'mlm',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            18 =>
            array (
                'name' => 'YARDA',
                'abbreviation' => 'y',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            19 =>
            array (
                'name' => 'MILIGRAMO',
                'abbreviation' => 'mlg',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            20 =>
            array (
                'name' => 'PAR',
                'abbreviation' => 'par',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            21 =>
            array (
                'name' => 'QUINTAL',
                'abbreviation' => 'q',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            22 =>
            array (
                'name' => 'METRO CUADRADO',
                'abbreviation' => 'm2',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
            23 =>
            array (
                'name' => 'KILOMETRO CUADRADO',
                'abbreviation' => 'km2',
                'enabled' => 1,
                'deleted_at' => NULL,
                'is_cpc' => 1,
            ),
        ));


    }
}
