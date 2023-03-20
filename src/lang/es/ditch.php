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

    'title' => 'Cuneta',

    'labels' => [
        'create' => 'Crear Cuneta',
        'create_ditch_type' => 'Crear Tipo de Cuneta',
        'create_side' => 'Crear Lado',
        'new' => 'Nueva Cuneta',
        'new_ditch_type' => 'Nuevo Tipo de Cuneta',
        'new_side' => 'Nuevo Lado',
        'update' => 'Actualizar Cuneta',
        'edit' => 'Editar Cuneta',
        'details' => 'Detalles de la Cuneta',
        'gid' => 'Número identificador',
        'lado' => 'Lado cuneta',
        'estado' => 'Estado',
        'tipo' => 'Tipo de cuneta',
        'lati' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'latf' => 'Latitud final',
        'longf' => 'Longitud final',
        'observ' => 'Observación',
        'code' => 'Código',
        'description' => 'Descripción',
        'side' => 'Lado'
    ],
    'placeholders' => [
        'gid' => 'Número identificador en orden secuencial',
        'lado' => 'Lado en la que se encuentra la cuneta',
        'estado' => 'Estado aparente del atributo',
        'tipo' => 'tipo de cuneta',
        'lati' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'latf' => 'Latitud final',
        'longf' => 'Longitud final',
        'observ' => 'Observación'
    ],
    'messages' => [
        'success' => [
            'created' => 'Cuneta creada satisfactoriamente',
            'updated' => 'Cuneta actualizada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Cuneta',
            'update' => 'Ha ocurrido un error al intentar actualizar la Cuneta'
        ],
        'validations' => [
            'ditch_type_uniqueDesc' => 'La descripción del tipo de cuneta ya existe',
            'side_uniqueDesc' => 'La descripción del lado ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Cuneta no existe o no está disponible'
        ]
    ]
];
