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

    'title' => 'Banco de Proyectos',

    'labels' => [
        'fiscal_year' => 'Año Fiscal: :fiscalYear',
        'update_status' => 'Actualizar Estado',
        'status' => 'Estado',
        'select_phase' => 'Seleccione Fase:',
        'select_status' => 'Seleccione Estado:'
    ],

    'placeholder' => [
        'status' => 'Seleccione un Estado'
    ],

    'exceptions' => [
        'not_found' => 'El proyecto no existe o no está disponible.',
    ],

    'confirm' => [
        'change_status' => '¿Está seguro de cambiar el estado del proyecto?'
    ],

    'messages' => [
        'success' => 'El estado del proyecto ha sido actualizado exitosamente.'
    ]
];
