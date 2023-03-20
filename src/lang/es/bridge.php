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

    'title' => 'Puente',
    'image_path' => 'bridge',
    'labels' => [
        'create' => 'Crear Puente',
        'create_bridge_rolling_layer' => 'Crear Capa de Rodadura de Puente',
        'create_side_protection' => 'Crear Protección Lateral',
        'new' => 'Nuevo Puente',
        'new_bridge_rolling_layer' => 'Nueva Capa de Rodadura de Puente',
        'new_side_protection' => 'Nueva Protección Lateral',
        'update' => 'Actualizar Puente',
        'edit' => 'Editar Puente',
        'details' => 'Detalles del Puente',
        'gid' => 'Número identificador',
        'codp' => 'Código del puente',
        'nombre' => 'Nombre',
        'rioqueb' => 'Registro del río o quebrada',
        'caparodad' => 'Material tablero',
        'galibo' => 'Altura quebrada',
        'ancho' => 'Ancho del puente',
        'anchotot' => 'Ancho total del puente',
        'longitud' => 'Longitud',
        'protlater' => 'Tipo material protecciones laterales',
        'estprot' => 'Estado protecciones laterales',
        'evalinfr' => 'Evaluación infraestructura',
        'evalsupes' => 'Evaluación superestructura',
        'carga' => 'Carga',
        'sencarga' => 'Señalización carga',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'observ' => 'Observaciones',
        'imagen1' => 'Imagen 1',
        'imagen2' => 'Imagen 2',
        'imagen3' => 'Imagen 3',
        'imagen4' => 'Imagen 4',
        'imagen5' => 'Imagen 5',
        'code' => 'Código',
        'description' => 'Descripción',
        'bridge_rolling_layer' => 'Capa de rodadura de puente',
        'side_protections' => 'Protecciones laterales'
    ],
    'placeholders' => [
        'gid' => 'Número identificador en orden secuencial',
        'codp' => 'Código del puente',
        'nombre' => 'Nombre del puente',
        'rioqueb' => 'Registro del río o quebrada',
        'caparodad' => 'Material que cubre el tablero del puente',
        'galibo' => 'Se indica la altura desde la parte inferior del tablero hasta la cota superior del espejo del agua o el fondo de la quebrada',
        'ancho' => 'Ancho de la capa de rodadura del puente',
        'anchotot' => 'Ancho del puente incluyendo el espacio de camineria, pasamanos y capa de rodadura',
        'longitud' => 'longitud en metros entre juntas externad del puente',
        'protlater' => 'tipo de material de las protecciones laterales',
        'estprot' => 'Se indica el estado de las protecciones laterales',
        'evalinfr' => 'Evaluación de la infraestructura',
        'evalsupes' => 'Evaluación de la superestructura',
        'carga' => 'Carga efectiva de acuerdo con el parque automotor de la vía',
        'sencarga' => 'Se indica si existe señalización de la carga en el puente',
        'lat' => 'Latitud',
        'longi' => 'Longitud',
        'observ' => 'Observaciones'
    ],
    'messages' => [
        'success' => [
            'created' => 'Puente creado satisfactoriamente',
            'bridge_rolling_layer_created' => 'Capa Rodadura Puente creada satisfactoriamente',
            'side_protection_created' => 'Protección Lateral creada satisfactoriamente',
            'updated' => 'Puente actualizado satisfactoriamente',
            'deleted' => 'Puente eliminado satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Puente',
            'create_bridge_rolling_layer' => 'Ha ocurrido un error al intentar crear la Capa Rodadura Puente',
            'create_side_protection' => 'Ha ocurrido un error al intentar crear la Protección Lateral',
            'update' => 'Ha ocurrido un error al intentar actualizar el Puente',
            'delete' => 'Ha ocurrido un error al intentar eliminar el Puente'
        ],
        'validations' => [
            'bridge_rolling_layer_uniqueDesc' => 'La descripción de la capa de rodadura de puente ya existe',
            'side_protection_uniqueDesc' => 'La descripción de la protección lateral ya existe'
        ],
        'exceptions' => [
            'not_found' => 'El Puente no existe o no está disponible'
        ]
    ]
];
