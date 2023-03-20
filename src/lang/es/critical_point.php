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

    'title' => 'Punto crítico',
    'image_path' => 'critical_point',
    'labels' => [
        'create' => 'Crear Punto crítico',
        'create_critical_point_type' => 'Crear Tipo de Punto Crítico',
        'new' => 'Nuevo Punto crítico',
        'new_critical_point_type' => 'Nuevo Tipo de Punto Crítico',
        'update' => 'Actualizar Punto crítico',
        'edit' => 'Editar Punto crítico',
        'details' => 'Detalles del Punto crítico',
        'gid' => 'Código del Punto crítico',
        'tipo' => 'Tipo',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'observ' => 'Observación',
        'imagen' => 'Imagen',
        'code' => 'Código',
        'description' => 'Descripción',
        'critical_point_type' => 'Tipo de punto crítico'
    ],
    'placeholders' => [
        'gid' => 'Código del Punto crítico',
        'tipo' => 'Tipo de punto crítico',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'observ' => 'Observación'
    ],
    'messages' => [
        'success' => [
            'created' => 'Punto crítico creado satisfactoriamente',
            'critical_point_type_created' => 'Tipo de punto crítico creado satisfactoriamente',
            'updated' => 'Punto crítico actualizado satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Punto crítico',
            'create_critical_point_type' => 'Ha ocurrido un error al intentar crear el Tipo de punto crítico',
            'update' => 'Ha ocurrido un error al intentar actualizar el Punto crítico'
        ],
        'validations' => [
            'critical_point_type_uniqueDesc' => 'La descripción del tipo de punto crítico ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Punto crítico no existe o no está disponible'
        ]
    ]
];
