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

    'title' => 'Estructura Programática',
    'title_singular' => 'Estructura del Proyecto',

    'labels' => [
        'fiscal_year' => 'Año Fiscal',
        'start' => 'Iniciar Proyecto'
    ],

    'messages' => [
        'exceptions' => [
            'fiscal_year_not_found' => 'El año fiscal no se encuentra definido'
        ],
        'confirm' => [
            'reset_budget_items' => 'Los montos planificados para todas las partidas presupuestarias y compras públicas del proyecto seleccionado serán actualizados con valor cero.<br>Luego de realizar este proceso, usted podrá agregar, editar o eliminar partidas presupuestarias.',
            'reset_budget_items_on_start' => 'Los montos planificados para todas las partidas presupuestarias y compras públicas del proyecto serán actualizados con valor cero y enviados al sistema financiero.',
            'start_project' => 'Las partidas presupuestarias del proyecto serán enviadas al sistema financiero.'
        ],
        'success' => [
            'created' => 'El projecto ha sido iniciado exitosamente'
        ]
    ],
    'actions' => [
        'restructure_project' => 'Reestructurar Proyecto'
    ]

];
