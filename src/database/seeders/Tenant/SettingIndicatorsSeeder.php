<?php
namespace Database\Seeders\Tenant;

use App\Models\System\Setting;
use Illuminate\Database\Seeder;

class SettingIndicatorsSeeder extends Seeder
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
            'key' => 'app_indicators',
            'value' => [
                'income' => [
                    'met' => [
                        'value' => [
                            '1.18.01',
                            '1.18.06',
                            '2.28.01',
                            '2.28.06'
                        ],
                        'description' => 'Ingresos del Modelo de Equidad Territorial'
                    ],
                    'own' => [
                        'value' => [
                            '1.11.02',
                            '1.13.01',
                            '1.13.04',
                            '1.14.02',
                            '1.17.01',
                            '1.17.02',
                            '1.17.04'
                        ],
                        'description' => 'Ingresos propios'
                    ],
                    'current' => [
                        'value' => [
                            '1.11.02',
                            '1.13.01',
                            '1.13.04',
                            '1.14.02',
                            '1.17.01',
                            '1.17.02',
                            '1.17.04',
                            '1.18.01',
                            '1.18.06',
                            '1.19.01',
                            '1.19.04'
                        ],
                        'description' => 'Ingresos corrientes'
                    ],
                    'financing' => [
                        'value' => [
                            '3.37.01',
                            '3.38.01'
                        ],
                        'description' => 'Ingresos de financiamiento'
                    ],
                    'cooperation' => [
                        'value' => [
                            '2.28.02',
                            '2.28.03'
                        ],
                        'description' => 'Ingresos de cooperación'
                    ]
                ],
                'expenses' => [
                    'capital' => [
                        'value' => [
                            '8.84.01',
                            '8.84.02'
                        ],
                        'description' => 'Gastos de capital'
                    ],
                    'current' => [
                        'value' => [
                            '5.51.01',
                            '5.51.02',
                            '5.51.05',
                            '5.51.06',
                            '5.51.07',
                            '5.53.01',
                            '5.53.02',
                            '5.53.03',
                            '5.53.04',
                            '5.53.05',
                            '5.53.06',
                            '5.53.07',
                            '5.53.08',
                            '5.53.14',
                            '5.56.02',
                            '5.57.01',
                            '5.57.02',
                            '5.57.03',
                            '5.58.01',
                            '5.58.02'
                        ],
                        'description' => 'Gastos corrientes'
                    ],
                    'investment' => [
                        'value' => [
                            '7.73.01',
                            '7.73.02',
                            '7.73.03',
                            '7.73.04',
                            '7.73.05',
                            '7.73.06',
                            '7.73.07',
                            '7.73.08',
                            '7.73.14',
                            '7.73.15',
                            '7.75.01',
                            '7.75.05',
                            '7.77.01',
                            '7.77.02',
                            '7.78.01',
                            '7.78.02'
                        ],
                        'description' => 'Gastos de inversión'
                    ],
                    'current_investment' => [
                        'value' => [
                            '7.71.01',
                            '7.71.02',
                            '7.71.03',
                            '7.71.04',
                            '7.71.05',
                            '7.71.06',
                            '7.71.07'
                        ],
                        'description' => 'Gastos Corrientes de inversión'
                    ]
                ],
                'subnational' => [
                    'met' => [
                        'description' => '% del presupuesto del GAD que depende de las transferencias del MET. Fórmula: MET/Presupuesto'
                    ],
                    'current_expense' => [
                        'description' => '% del gasto corriente en comparación con los ingresos. Fómula: Gasto Corriente/Ingresos'
                    ],
                    'project_investment' => [
                        'description' => '% de la inversión realizada en comparación con los ingresos. Fómula: Total Proyectos/Ingresos'
                    ],
                    'current_investment' => [
                        'description' => 'Gasto corriente de inversión. Fórmula: Gasto Corriente Inversión/Ingresos'
                    ],
                    'current_saving' => [
                        'description' => 'Ahorro corriente como proporción de los ingresos corrientes. Fórmula: Gastos Corrientes/ Ingresos Corrientes'
                    ],
                    'financial_autonomy' => [
                        'description' => 'Participación de los recursos propios en relación a las fuentes de financiamiento. Fórmula: Ingresos Propios/Ingresos'
                    ]
                ]
            ],
            'description' => 'Configuración para cálculo de indicadores financieros'
        ]);
    }
}
