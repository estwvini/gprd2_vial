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

    'threshold' => [
        'title' => 'Umbrales',

        'labels' => [

            'edit' => 'Editar umbrales',
            'update' => 'Actualizar',
            'details' => 'Detalles',
            'acceptable' => 'Aceptable',
            'unacceptable' => 'Inaceptable',
            'alert' => 'Alerta'
        ],

        'headers' => [
            'name' => 'Umbral',
        ],

        'messages' => [

            'success' => [

                'updated' => 'Umbrales actualizados satisfactoriamente',
            ],
            'errors' => [
                'update' => 'Ha ocurrido un error al intener actualizar los umbrales',
            ],
            'exceptions' => [
                'not_found' => 'El umbral no existe o no está disponible',
            ],
        ],
    ]
];
