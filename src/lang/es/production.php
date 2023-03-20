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

    'title' => 'Producción',

    'labels' => [
        'create' => 'Crear Producción',
        'create_productive_sector' => 'Crear Sector Productivo',
        'new' => 'Nueva Producción',
        'new_productive_sector' => 'Nuevo Sector Productivo',
        'update' => 'Actualizar Producción',
        'edit' => 'Editar Producción',
        'details' => 'Detalles de la Producción',
        'gid' => 'Código de Producción',
        'sector' => 'Sector',
        'prod1' => 'Primer Producto',
        'prod2' => 'Segundo Producto',
        'prod3' => 'Tercer Producto',
        'vol1' => 'Volumen primer producto',
        'vol2' => 'Volumen segundo producto',
        'vol3' => 'Volumen tercer producto',
        'dest1' => 'Destino primer producto',
        'dest2' => 'Destino segundo producto',
        'dest3' => 'Destino tercer producto',
        'val1' => 'Costo primer producto',
        'val2' => 'Costo segundo producto',
        'val3' => 'Costo tercer producto',
        'flete1' => 'Flete del primer producto',
        'flete2' => 'Flete del primer producto',
        'flete3' => 'Flete del primer producto',
        'observ' => 'Observación',
        'code' => 'Código',
        'description' => 'Descripción',
        'productive_sector' => 'Sector productivo'
    ],
    'placeholders' => [
        'gid' => 'Código de Producción',
        'sector' => 'Sector',
        'prod1' => 'Primer Producto',
        'prod2' => 'Segundo Producto',
        'prod3' => 'Tercer Producto',
        'vol1' => 'Volumen primer producto',
        'vol2' => 'Volumen segundo producto',
        'vol3' => 'Volumen tercer producto',
        'dest1' => 'Destino primer producto',
        'dest2' => 'Destino segundo producto',
        'dest3' => 'Destino tercer producto',
        'val1' => 'Costo por volumen primer producto',
        'val2' => 'Costo por volumen segundo producto',
        'val3' => 'Costo por volumen tercer producto',
        'flete1' => 'Costo del flete del primer producto',
        'flete2' => 'Costo del flete del primer producto',
        'flete3' => 'Costo del flete del primer producto',
        'observ' => 'Observación'
    ],
    'messages' => [
        'success' => [
            'created' => 'Producción creada satisfactoriamente',
            'productive_sector_created' => 'Sector productivo creado satisfactoriamente',
            'updated' => 'Producción actualizada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Producción',
            'create_productive_sector' => 'Ha ocurrido un error al intentar crear el Sector productivo',
            'update' => 'Ha ocurrido un error al intentar actualizar la Producción'
        ],
        'validations' => [
            'productive_sector_uniqueDesc' => 'La descripción del sector productivo ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Producción no existe o no está disponible'
        ]
    ]
];
