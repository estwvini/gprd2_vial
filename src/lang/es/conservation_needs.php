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

    'title' => 'Necesidades de conservación',
    'image_path' => 'conservation_needs',
    'labels' => [
        'create' => 'Crear Necesidad de Conservación',
        'create_type_conservation_need' => 'Crear Tipo de Necesidad de Conservación',
        'new' => 'Nueva Necesidad de Conservación',
        'new_type_conservation_need' => 'Nuevo Tipo de Necesidad de Conservación',
        'update' => 'Actualizar Necesidad de Conservación',
        'edit' => 'Editar Necesidad de Conservación',
        'details' => 'Detalles de la Necesidad de Conservación',
        'gid' => 'Código de la Necesidad de Conservación',
        'tipo' => 'Tipo',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'observ' => 'Observación',
        'imagen' => 'Imagen',
        'code' => 'Código',
        'description' => 'Descripción',
        'type_conservation_need' => 'Tipo de necesidad de conservación'
    ],
    'placeholders' => [
        'gid' => 'Código del Necesidades de conservación',
        'tipo' => 'Tipo de Necesidades de conservación',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'observ' => 'Observación'
    ],
    'messages' => [
        'success' => [
            'created' => 'Necesidad de conservación creada satisfactoriamente',
            'type_conservation_need_created' => 'Tipo de necesidad de conservación creado satisfactoriamente',
            'updated' => 'Necesidad de conservación actualizada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Necesidad de conservación',
            'create_type_conservation_need' => 'Ha ocurrido un error al intentar crear el Tipo de necesidad de conservación',
            'update' => 'Ha ocurrido un error al intentar actualizar la Necesidad de conservación'
        ],
        'validations' => [
            'type_conservation_need_uniqueDesc' => 'La descripción del tipo de necesidad de conservación ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Necesidad de conservación no existe o no está disponible'
        ]
    ]
];
