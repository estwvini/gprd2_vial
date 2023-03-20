<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiscalYearsSeeder extends Seeder
{

    public function run()
    {

        DB::table('fiscal_years')->insert(array(
            0 =>
                array(
                    'year' => 2022,
                    'enabled' => 1,
                ),
            1 =>
                array(
                    'year' => 2023,
                    'enabled' => 1,
                )
        ));
    }
}
