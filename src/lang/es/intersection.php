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

    'title' => 'Intersección',
    'image_path' => 'intersection',
    'labels' => [
        'create' => 'Crear Intersección',
        'new' => 'Nueva Intersección',
        'update' => 'Actualizar Intersección',
        'edit' => 'Editar Intersección',
        'details' => 'Detalles de la Intersección',
        'gid' => 'Número identificador',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'dist' => 'Distancia',
        'descrip' => 'Descripción',
        'observ' => 'Observación',
        'codigo' => 'Código de la vía',
        'imagen' => 'Imagen'
    ],
    'placeholders' => [
        'gid' => 'Número identificador en orden secuencial',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'dist' => 'Distancia en la cual existe la intersección',
        'descrip' => 'Punto de inicio o finalización del tramo',
        'observ' => 'Observaciones',
        'codigo' => 'Código de la vía'
    ],
    'messages' => [
        'success' => [
            'created' => 'Intersección creada satisfactoriamente',
            'updated' => 'Intersección actualizada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Intersección',
            'update' => 'Ha ocurrido un error al intentar actualizar la Intersección'
        ],
        'exceptions' => [
            'not_found' => 'La Intersección no existe o no está disponible'
        ]
    ]
];
