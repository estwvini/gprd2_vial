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

    'title' => 'Articulaciones',

    'labels' => [
        'indicator' => 'Indicador',
        'plan' => 'Plan',
        'thrust' => 'Eje',
        'objective' => 'Objetivo',
        'goal' => 'Meta',
        'links' => 'Previsualización de articulaciones seleccionadas',
        'showLinks' => 'Ver Articulaciones',
        'removeLinks' => 'Eliminar Articulaciones',
        'vision' => 'Visión'
    ],

    'placeholders' => [
    ],

    'messages' => [
        'confirm' => [
            'deleteLinks' => '¿Está seguro que desea eliminar todas las articulaciones de la meta seleccionada con el plan: :plan?'
        ],
        'info' => [
            'selectTargetGoals' => 'A continuación debe seleccionar una o varias metas del :plan con las que desea articular la meta seleccionada:',
            'selectPlan' => 'Seleccione el plan con el que desea articular:',
            'noAvailablePlans' => 'No se han encontrado planes para articular (asegúrese que los planes dispongan de indicadores/metas y se encuentren aprobados/verificados)',
            'showGoal' => 'Para visualizar el contenido de la meta, haga click en el recuadro azul.',
            'noLinks' => 'No existen articulaciones creadas entre los planes seleccionados'
        ],
        'validation' => [
            'selectGoals' => 'Seleccione una o varias metas con las que desea articular'
        ],
        'success' => [
            'created' => 'Articulaciones almacenadas satisfactoriamente',
            'deleted' => 'Articulaciones eliminadas satisfactoriamente'
        ],
        'exceptions' => [
            'not_found' => 'La articulación no existe o no está disponible'
        ],
        'errors' => [
            'created' => 'Ha ocurrido un error al intentar crear la articulación',
            'deleted' => 'Ha ocurrido un error al intentar eliminar la articulación'
        ]
    ]

];
