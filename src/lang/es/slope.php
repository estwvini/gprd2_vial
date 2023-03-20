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

    'title' => 'Talud',
    'image_path' => 'slope',
    'labels' => [
        'create' => 'Crear Talud',
        'create_slope_type' => 'Crear Tipo de Talud',
        'new' => 'Nuevo Talud',
        'new_slope_type' => 'Nuevo Tipo de Talud',
        'update' => 'Actualizar Talud',
        'edit' => 'Editar Talud',
        'details' => 'Detalles del Talud',
        'gid' => 'Número identificador',
        'lado' => 'Lado',
        'estado' => 'Estado',
        'tipo' => 'Tipo',
        'lat' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'latf' => 'Latitud final',
        'longf' => 'Longitud final',
        'observ' => 'Observaciones',
        'imagen' => 'Imagen',
        'code' => 'Código',
        'description' => 'Descripción',
        'slope_type' => 'Tipo de talud'
    ],
    'placeholders' => [
        'gid' => 'Número identificador en orden secuencial',
        'lado' => 'Lado',
        'estado' => 'Estado aparente del atributo',
        'tipo' => 'Tipo de talud',
        'lat' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'latf' => 'Latitud final',
        'longf' => 'Longitud final',
        'observ' => 'Observaciones'
    ],
    'messages' => [
        'success' => [
            'created' => 'Talud creado satisfactoriamente',
            'slope_type_created' => 'Tipo de talud creado satisfactoriamente',
            'updated' => 'Talud actualizado satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Talud',
            'create_slope_type' => 'Ha ocurrido un error al intentar crear el Tipo de talud',
            'update' => 'Ha ocurrido un error al intentar actualizar el Talud'
        ],
        'validations' => [
            'slope_type_uniqueDesc' => 'La descripción del tipo de talud ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Talud no existe o no está disponible'
        ]
    ]
];
