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

    'labels' => [
        'create_material_type' => 'Crear Tipo de Material',
        'create_climatic_floor' => 'Crear Piso Climático',
        'create_rolling_surface' => 'Crear Superficie de Rodadura',
        'create_drainage_type' => 'Crear Tipo de Drenaje',
        'create_drainage_status' => 'Crear Estado de Drenaje',
        'create_firm_type' => 'Crear Tipo Firme',
        'create_catalog' => 'Crear Catálogo',
        'new_material_type' => 'Nuevo Tipo de Material',
        'new_climatic_floor' => 'Nuevo Piso Climático',
        'new_rolling_surface' => 'Nueva Superficie de Rodadura',
        'new_drainage_type' => 'Nuevo Tipo de Drenaje',
        'new_drainage_status' => 'Nuevo Estado de Drenaje',
        'new_firm_type' => 'Nuevo Tipo Firme',
        'new_catalog' => 'Nuevo Catálogo',
        'code' => 'Código',
        'description' => 'Descripción',
        'material_type' => 'Tipo de material',
        'climatic_floor' => 'Piso climático',
        'rolling_surface' => 'Superficie de rodadura',
        'drainage_type' => 'Tipo de drenaje',
        'drainage_status' => 'Estado de drenaje',
        'firm_type' => 'Tipo firme',
        'catalogfather' => 'Catálogo Padre',
        'catalogs' => 'Catálogos',
        'catalog' => 'Catálogo',
        'id' => 'Id',
        'listcatalog' => '--Seleccione Catálogo--',

    ],
    'messages' => [
        'success' => [
            'material_type_created' => 'Tipo de material creado satisfactoriamente',
            'climatic_floor_created' => 'Piso climático creado satisfactoriamente',
            'rolling_surface_created' => 'Superficie de rodadura creada satisfactoriamente',
            'drainage_type_created' => 'Tipo de drenaje creado satisfactoriamente',
            'drainage_status_created' => 'Estado de drenaje creado satisfactoriamente',
            'firm_type_created' => 'Tipo firme creado satisfactoriamente',
            'catalog_created' => 'Catálogo creado satisfactoriamente'
        ],
        'errors' => [
            
            'create_material_type' => 'Ha ocurrido un error al intentar crear el Tipo de material',
            'create_climatic_floor' => 'Ha ocurrido un error al intentar crear el Piso climático',
            'create_rolling_surface' => 'Ha ocurrido un error al intentar crear la Superficie de rodadura',
            'create_drainage_type' => 'Ha ocurrido un error al intentar crear el Tipo de drenaje',
            'create_drainage_status' => 'Ha ocurrido un error al intentar crear el Estado de drenaje',
            'create_firm_type' => 'Ha ocurrido un error al intentar crear el Tipo firme',
            'create_catalog' => 'Ha ocurrido un error al intentar crear el Catálogo'
        ],
        'validations' => [
            'climatic_floor_uniqueDesc' => 'La descripción del piso climático ya existe',
            'drainage_status_uniqueDesc' => 'La descripción del estado de drenaje ya existe',
            'drainage_type_uniqueDesc' => 'La descripción del tipo de drenaje ya existe',
            'firm_type_uniqueDesc' => 'La descripción del tipo firme ya existe',
            'material_type_uniqueDesc' => 'La descripción del tipo de material ya existe',
            'rolling_surface_uniqueDesc' => 'La descripción de la superficie de rodadura ya existe',
            'catalog_uniqueDesc' => 'La descripción del catálogo ya existe'
        ]
    ]
];
