<?php
namespace Database\Seeders\Tenant;

use App\Models\System\Setting;
use Illuminate\Database\Seeder;

class SettingAppSeeder extends Seeder
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
            'key' => 'app_ethnicity',
            'value' => [
                'Mestizo',
                'Indígena',
                'Afroecuatoriano',
                'Blanco',
            ],
            'description' => 'Etnias'
        ]);

        $model->create([
            'key' => 'app_contact',
            'value' => [
                ['value' => 'info@congope.gob.ec', 'description' => 'Correo electrónico'],
                ['value' => '04-1234567', 'description' => 'Teléfono de contacto'],
            ],
            'description' => 'Contactos Institucionales'
        ]);
    }
}
