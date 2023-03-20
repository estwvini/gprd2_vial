<?php
namespace Database\Seeders\Tenant;

use App\Models\System\Setting;
use Illuminate\Database\Seeder;

class SettingRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Setting;


        $model->create([
            'key' => 'range_group',
            'value' => [
                'range' => '10',
                'first' => '20',
                'end' => '50',

            ],
            'description' => 'Rango de edad para agrupar usuarios'
        ]);
    }
}
