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

    'title' => 'Minas',
    'image_path' => 'mines',
    'labels' => [
        'create' => 'Crear Mina',
        'create_source' => 'Crear Fuente',
        'create_mines_type' => 'Crear Tipo de Minas',
        'create_mines_material' => 'Crear Material de Minas',
        'new' => 'Nueva Mina',
        'new_source' => 'Nueva Fuente',
        'new_mines_type' => 'Nuevo Tipo de Minas',
        'new_mines_material' => 'Nuevo Material de Minas',
        'update' => 'Actualizar Mina',
        'edit' => 'Editar Mina',
        'details' => 'Detalles de la Mina',
        'gid' => 'Número identificador',
        'tipo' => 'Tipo',
        'fuente' => 'Fuente',
        'material' => 'Material',
        'distan' => 'Distancia',
        'lat' => 'Latitud Inicial',
        'longi' => 'Longitud Inicial',
        'observ' => 'Observación',
        'imagen' => 'Imagen',
        'code' => 'Código',
        'description' => 'Descripción',
        'mines_type' => 'Tipo de minas',
        'mines_material' => 'Material de minas'
    ],
    'placeholders' => [
        'gid' => 'Número identificador en orden secuencial',
        'tipo' => 'Descripción del tipo de señalización horizontal',
        'fuente' => 'Fuente de explotación',
        'material' => 'Material de explotación de las minas',
        'distan' => 'Longitud entre el eje vial hasta el sitio de explotación',
        'lat' => 'Latitud Inicial',
        'longi' => 'Longitud Inicial',
        'observ' => 'Observación',
        'imagen' => 'Nombre de la imagen referenciada al atributo'
    ],
    'messages' => [
        'success' => [
            'created' => 'Mina creada satisfactoriamente',
            'source_created' => 'Fuente creada satisfactoriamente',
            'mines_type_created' => 'Tipo de minas creado satisfactoriamente',
            'mines_material_created' => 'Material de minas creado satisfactoriamente',
            'updated' => 'Mina actualizada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Mina',
            'create_source' => 'Ha ocurrido un error al intentar crear la Fuente',
            'create_mines_type' => 'Ha ocurrido un error al intentar crear el Tipo de minas',
            'create_mines_material' => 'Ha ocurrido un error al intentar crear el Material de minas',
            'update' => 'Ha ocurrido un error al intentar actualizar la Mina'
        ],
        'validations' => [
            'mines_material_uniqueDesc' => 'La descripción del material de minas ya existe',
            'mines_type_uniqueDesc' => 'La descripción del tipo de minas ya existe',
            'source_uniqueDesc' => 'La descripción de la fuente ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Mina no existe o no está disponible'
        ]
    ]
];
