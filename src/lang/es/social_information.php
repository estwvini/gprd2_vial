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

    'title' => 'Información Social',
    'image_path' => 'social_information',
    'labels' => [
        'create' => 'Crear Información Social',
        'create_population_type' => 'Crear Tipo de Población',
        'create_support_services' => 'Crear Servicio de Apoyo',
        'new' => 'Nueva Información Social',
        'new_population_type' => 'Nuevo Tipo de Población',
        'new_support_services' => 'Nuevo Servicio de Apoyo',
        'update' => 'Actualizar Información Social',
        'edit' => 'Editar Información Social',
        'details' => 'Detalles de la Información Social',
        'gid' => 'Código de la Información Social',
        'asent' => 'Nombre del asentamiento humano',
        'organ1' => 'Nombre de la primera organización',
        'organ2' => 'Nombre de la segunda organización',
        'organ3' => 'Nombre de la tercera organización',
        'tipopob' => 'Tipo de población',
        'pobtot' => 'Número total de habitantes',
        'vivienda' => 'Número total de viviendas',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'observ' => 'Observación',
        'imagen' => 'Imagen',
        'code' => 'Código',
        'description' => 'Descripción',
        'support_services' => 'Servicios de apoyo',
        'service' => 'Servicio',
        'number' => 'Número',
        'download_image' => 'Descargar Imagen'
    ],
    'placeholders' => [
        'gid' => 'Código del Información Social',
        'asent' => 'Nombre del asentamiento humano',
        'organ1' => 'Nombre de la primera organización',
        'organ2' => 'Nombre de la segunda organización',
        'organ3' => 'Nombre de la tercera organización',
        'tipopob' => 'Tipo de población',
        'pobtot' => 'Número total de habitantes de cada uno de los asentamientos',
        'vivienda' => 'Número total de viviendas existentes en los asentamientos',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'observ' => 'Observación'
    ],
    'messages' => [
        'success' => [
            'created' => 'Información Social creada satisfactoriamente',
            'population_type_created' => 'Tipo de población creado satisfactoriamente',
            'support_services_created' => 'Servicio de apoyo creado satisfactoriamente',
            'updated' => 'Información Social actualizada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Información Social',
            'create_population_type' => 'Ha ocurrido un error al intentar crear el Tipo de Población',
            'create_support_services' => 'Ha ocurrido un error al intentar crear el Servicio de apoyo',
            'download_support_service_image' => 'Ha ocurrido un error al intentar descargar la imagen del Servicio de apoyo',
            'update' => 'Ha ocurrido un error al intentar actualizar la Información Social'
        ],
        'validations' => [
            'population_type_uniqueDesc' => 'La descripción del tipo de población ya existe',
            'support_services_uniqueGid' => 'El código de la información social del servicio de apoyo ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Información Social no existe o no está disponible'
        ]
    ]
];
