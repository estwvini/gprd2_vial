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

    'title' => 'Revisión',

    'labels' => [
        'reverse' => 'Rechazar',
        'approve' => 'Aprobar'
    ],

    'messages' => [
        'confirm' => [
            'approve' => '¿Está seguro que desea aprobar los proyectos seleccionados?',
            'reverse' => '¿Está seguro que desea rechazar el proyecto seleccionado?'
        ],
        'warning' => [
            'only_one_rejected' => 'No puede rechazar más de dos proyectos al mismo tiempo'
        ],
        'success' => [
            'updated_bulk' => 'Proyectos actualizados satisfactoriamente',
        ]
    ]
];
