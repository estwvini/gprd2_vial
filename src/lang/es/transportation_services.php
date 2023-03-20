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

    'title' => 'Servicios de Transporte',
    'image_path' => 'transportation_services',
    'labels' => [
        'create' => 'Crear Servicio de Transporte',
        'create_associated_service_type' => 'Crear Tipo de Servicio Asociado',
        'new' => 'Nuevo Servicio de Transporte',
        'new_associated_service_type' => 'Nuevo Tipo de Servicio Asociado',
        'update' => 'Actualizar Servicio de Transporte',
        'edit' => 'Editar Servicio de Transporte',
        'details' => 'Detalles del Servicio de Transporte',
        'gid' => 'Código del Servicio de Transporte',
        'tipo' => 'Tipo',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'observ' => 'Observación',
        'imagen' => 'Imagen',
        'code' => 'Código',
        'description' => 'Descripción',
        'associated_service_type' => 'Tipo de servicio asociado'
    ],
    'placeholders' => [
        'gid' => 'Código del Servicios de Transporte',
        'sector' => 'Sector',
        'tipo' => 'Tipo',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'observ' => 'Observación'
    ],
    'messages' => [
        'success' => [
            'created' => 'Servicio de Transporte creado satisfactoriamente',
            'associated_service_type_created' => 'Tipo de Servicio Asociado creado satisfactoriamente',
            'updated' => 'Servicio de Transporte actualizado satisfactoriamente',
            'deleted' => 'Servicio de Transporte eliminado satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Servicio de Transporte',
            'create_associated_service_type' => 'Ha ocurrido un error al intentar crear el Tipo de Servicio Asociado',
            'update' => 'Ha ocurrido un error al intentar actualizar el Servicio de Transporte',
            'delete' => 'Ha ocurrido un error al intentar eliminar el Servicio de Transporte'
        ],
        'validations' => [
            'uniqueDesc' => 'La descripción del tipo de servicio asociado ya existe'
        ],
        'exceptions' => [
            'not_found' => 'El Servicio de Transporte no existe o no está disponible'
        ]
    ]
];
