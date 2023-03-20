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

    'title' => 'Señalización Horizontal',

    'labels' => [
        'create' => 'Crear Señalización Horizontal',
        'create_horizontal_signal_type' => 'Crear Tipo de Señal Horizontal',
        'new' => 'Nueva Señalización Horizontal',
        'new_horizontal_signal_type' => 'Nuevo Tipo de Señal Horizontal',
        'update' => 'Actualizar Señalización Horizontal',
        'edit' => 'Editar Señalización Horizontal',
        'details' => 'Detalles de la Señalización Horizontal',
        'gid' => 'Número identificador',
        'tipo' => 'Tipo',
        'estado' => 'Estado',
        'lado' => 'Lado',
        'lati' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'latf' => 'Latitud final',
        'longf' => 'Longitud final',
        'observ' => 'Observaciones',
        'code' => 'Código',
        'description' => 'Descripción',
        'horizontal_signal_type' => 'Tipo de señal horizontal'
    ],
    'placeholders' => [
        'gid' => 'Número identificador en orden secuencial',
        'tipo' => 'Tipo de señalización horizontal',
        'estado' => 'Estado aparente del atributo',
        'lado' => 'Lado en la que se encuentra la señalización horizontal',
        'lati' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'latf' => 'Latitud final',
        'longf' => 'Longitud final',
        'observ' => 'Observaciones'
    ],
    'messages' => [
        'success' => [
            'created' => 'Señalización Horizontal creada satisfactoriamente',
            'horizontal_signal_type_created' => 'Tipo de Señal Horizontal creado satisfactoriamente',
            'updated' => 'Señalización Horizontal actualizada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Señalización Horizontal',
            'create_horizontal_signal_type' => 'Ha ocurrido un error al intentar crear el Tipo de Señal Horizontal',
            'update' => 'Ha ocurrido un error al intentar actualizar la Señalización Horizontal'
        ],
        'validations' => [
            'horizontal_signal_type_uniqueDesc' => 'La descripción del tipo de señal horizontal ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Señalización Horizontal no existe o no está disponible'
        ]
    ]
];
