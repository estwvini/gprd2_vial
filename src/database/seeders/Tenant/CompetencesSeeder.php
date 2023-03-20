<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetencesSeeder extends Seeder
{

    public function run()
    {

        DB::table('competences')->insert(array(
            0 =>
                array(
                    'code' => '000',
                    'name' => 'Otra',
                ),
            1 =>
                array(
                    'code' => 'D24',
                    'name' => 'Riego',
                ),
        ));
    }
}
