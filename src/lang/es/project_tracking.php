<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Message Response Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default messages used by
    | the controller for response.
    |
    */

    'title' => 'Seguimiento de Proyectos',

    'labels' => [
        'projects' => 'Proyectos',
        'progress' => 'Avances',
        'budget_progress' => 'Avance Presupuestario',
        'physical_progress' => 'Avance Físico',
        'certifications' => 'Certificaciones'
    ],

    'messages' => [
        'exceptions' => [
            'fiscal_year_not_found' => 'No existe información relacionada al año fiscal actual'
        ]
    ],

    'actions' => [
        'physical_and_budget_progress' => 'Avance Físico y Presupuestario',
        'reforms' => 'Reprogramación Financiera',
        'reprogram' => 'Reprogramación Física'
    ]
];
