<?php

namespace Database\Seeders\Tenant;

use App\Models\System\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{

    public function run()
    {
        $model = new Setting;
        $model::truncate();

        $model->create([
            'key' => 'ui_menu_styles',
            'value' => [
                'color' => '#00537f',
                'active_color' => '#1abb9c',
                'text_color' => '#FFFFFF'
            ],
            'description' => 'Estilos del menú lateral izquierdo'
        ]);

        $model->create([
            'key' => 'ui_logos',
            'value' => [
                'login_logo' => 'images/logo_login.png',
                'menu_logo' => 'images/logo_menu.png'
            ],
            'description' => 'Ruta de los logos del proyecto'
        ]);

        $model->create([
            'key' => 'ui_project_labels',
            'value' => [
                'system_name' => trans('app.labels.system_name'),
                'system_slogan' => trans('app.labels.system_slogan'),
                'footer' => trans('app.labels.footer')
            ],
            'description' => 'Etiquetas generales del proyecto'
        ]);

        $model->create([
            'key' => 'department_settings',
            'value' => [
                'max_depth' => 10
            ],
            'description' => 'Configuraciones generales de las direcciones'
        ]);

        $model->create([
            'key' => 'gad',
            'value' => [
                'province' => 'Pichincha',
                'province_short_name' => 'Pichincha',
                'code' => '17',
                'sfgprov' => [
                    'exist' => true,
                    'company_code' => '0004',
                    'user_code' => '999'
                ]
            ],
            'description' => 'Configuraciones generales del GAD'
        ]);

        // Budget Classifier
        $model->create([
            'key' => 'budget_classifier',
            'value' => [
                "capital_income" => 2,
                "current_income" => 1,
                "financing_income" => 3,
                "investment_expense" => 7,
                "production_expense" => 6,
                "capital_expenditure" => 8,
                "current_expenditure" => 5,
                "financing_application" => 9
            ],
            'description' => 'Configuración de códigos de naturaleza del gasto'
        ]);

        // percentage of control current expenses
        $model->create([
            'key' => 'percentage_of_control',
            'value' => [
                'percentage_of_control' => 0.30
            ],
            'description' => 'Porcenaje de control para gastos corrientes'
        ]);

        // VAT
        $model->create([
            'key' => 'tax',
            'value' => [
                "vat" => 1.12
            ],
            'description' => 'Configuración de Impuestos'
        ]);

        $model->create([
            'key' => 'start_year',
            'value' => 2020,
            'description' => 'Año de nueva estructura en el sistema financiero'
        ]);

        $model->create([
            'key' => 'admin_act_roles',
            'value' => [
                "roles" => "administrator|planner|authority"
            ],
            'description' => 'Roles que asignan Actividades administrativas a todos los usuarios'
        ]);
    }
}
