<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThresholdSeeder extends Seeder
{
    public function run()
    {
        DB::table('thresholds')->insert(array(
            0 =>
                array(
                    'type' => 'ascending',
                    'color' => 'danger',
                    'min' => 0,
                    'max' => 85,
                    'created_at' => '2019-01-16 20:08:38',
                    'updated_at' => '2019-01-16 20:08:38'
                ),
            1 =>
                array(
                    'type' => 'ascending',
                    'color' => 'warning',
                    'min' => 84.99,
                    'max' => 99.99,
                    'created_at' => '2019-01-16 20:08:38',
                    'updated_at' => '2019-01-16 20:08:38'
                ),
            2 =>
                array(
                    'type' => 'ascending',
                    'color' => 'success',
                    'min' => 100,
                    'max' => 99999,
                    'created_at' => '2019-01-16 20:08:38',
                    'updated_at' => '2019-01-16 20:08:38'
                ),
            3 =>
                array(
                    'type' => 'descending',
                    'color' => 'danger',
                    'min' => 115,
                    'max' => 99999,
                    'created_at' => '2019-01-16 20:08:38',
                    'updated_at' => '2019-01-16 20:08:38'
                ),
            4 =>
                array(
                    'type' => 'descending',
                    'color' => 'warning',
                    'min' => 100.01,
                    'max' => 114.99,
                    'created_at' => '2019-01-16 20:08:38',
                    'updated_at' => '2019-01-16 20:08:38'
                ),
            5 =>
                array(
                    'type' => 'descending',
                    'color' => 'success',
                    'min' => 0,
                    'max' => 100,
                    'created_at' => '2019-01-16 20:08:38',
                    'updated_at' => '2019-01-16 20:08:38'
                ),
            6 =>
                array(
                    'type' => 'tolerance',
                    'color' => 'danger',
                    'min' => 15,
                    'max' => 9999,
                    'created_at' => '2019-01-16 20:08:38',
                    'updated_at' => '2019-01-16 20:08:38'
                ),
            7 =>
                array(
                    'type' => 'tolerance',
                    'color' => 'warning',
                    'min' => 10.01,
                    'max' => 14.99,
                    'created_at' => '2019-01-16 20:08:38',
                    'updated_at' => '2019-01-16 20:08:38'
                ),
            8 =>
                array(
                    'type' => 'tolerance',
                    'color' => 'success',
                    'min' => 0,
                    'max' => 10,
                    'created_at' => '2019-01-16 20:08:38',
                    'updated_at' => '2019-01-16 20:08:38'
                )
        ));
    }
}
