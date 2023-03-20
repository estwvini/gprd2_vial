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

    'title' => 'Señalización Vertical',
    'image_path' => 'vertical_signal',
    'labels' => [
        'create' => 'Crear Señalización Vertical',
        'create_vertical_signal_type' => 'Crear Tipo de Señal Vertical',
        'new' => 'Nueva Señalización Vertical',
        'new_vertical_signal_type' => 'Nuevo Tipo de Señal Vertical',
        'update' => 'Actualizar Señalización Vertical',
        'edit' => 'Editar Señalización Vertical',
        'details' => 'Detalles de la Señalización Vertical',
        'gid' => 'Número identificador',
        'tipo' => 'Tipo',
        'estado' => 'Estado',
        'lado' => 'Lado',
        'lat' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'observ' => 'Observaciones',
        'imagen' => 'Imagen',
        'code' => 'Código',
        'description' => 'Descripción',
        'vertical_signal_type' => 'Tipo de señal vertical'
    ],
    'placeholders' => [
        'gid' => 'Número identificador en orden secuencial',
        'tipo' => 'Tipo de señalización Vertical',
        'estado' => 'Estado aparente del atributo',
        'lado' => 'Lado en la que se encuentra la señalización Vertical',
        'lat' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'observ' => 'Observaciones'
    ],
    'messages' => [
        'success' => [
            'created' => 'Señalización Vertical creada satisfactoriamente',
            'vertical_signal_type_created' => 'Tipo de Señal Vertical creado satisfactoriamente',
            'updated' => 'Señalización Vertical actualizada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Señalización Vertical',
            'create_vertical_signal_type' => 'Ha ocurrido un error al intentar crear el Tipo de Señal Vertical',
            'update' => 'Ha ocurrido un error al intentar actualizar la Señalización Vertical'
        ],
        'validations' => [
            'vertical_signal_type' => 'La descripción del tipo de señal vertical ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Señalización Vertical no existe o no está disponible'
        ]
    ]
];
