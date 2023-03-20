<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreasSeeder extends Seeder
{

    public function run()
    {
        DB::table('areas')->insert(array(
            0 =>
                array(
                    'area' => 'Servicios generales',
                    'code' => '01'
                ),
            1 =>
                array(
                    'area' => 'Servicios sociales',
                    'code' => '02'
                ),
            2 =>
                array(
                    'area' => 'Servicios comunales',
                    'code' => '03'
                ),
            3 =>
                array(
                    'area' => 'Servicios económicos',
                    'code' => '04'
                ),
            4 =>
                array(
                    'area' => 'Servicios inclasificables ',
                    'code' => '05'
                )
        ));
    }
}
