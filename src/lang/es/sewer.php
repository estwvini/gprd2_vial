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

    'title' => 'Alcantarilla',
    'image_path' => 'sewer',
    'labels' => [
        'create' => 'Crear Alcantarilla',
        'create_type' => 'Crear Tipo de Alcantarilla',
        'create_sewer_material' => 'Crear Material de Alcantarilla',
        'new' => 'Nueva Alcantarilla',
        'new_type' => 'Nuevo Tipo de Alcantarilla',
        'new_sewer_material' => 'Nuevo Material de Alcantarilla',
        'update' => 'Actualizar Alcantarilla',
        'edit' => 'Editar Alcantarilla',
        'details' => 'Detalles de la Alcantarilla',
        'gid' => 'Número identificador',
        'tipo' => 'Tipo de alcantarilla',
        'longitud' => 'Longitud',
        'material' => 'Material de alcantarilla',
        'cuancho' => 'Ancho del cuerpo',
        'cualto' => 'Alto del cuerpo',
        'cudiam' => 'Diamétro alcantarilla',
        'cabezales' => 'Cabezales',
        'ecabez' => 'Estado cabezales',
        'ecuerpo' => 'Cuerpo alcantarilla',
        'lat' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'observ' => 'Observación',
        'imagen1' => 'Imagen 1',
        'imagen2' => 'Imagen 2',
        'imagen3' => 'Imagen 3',
        'code' => 'Código',
        'description' => 'Descripción'

    ],
    'placeholders' => [
        'gid' => 'Número identificador en orden secuencial',
        'tipo' => 'Descripción del tipo de alcantarilla',
        'longitud' => 'Longitud en metros del atributo',
        'material' => 'Material del cuerpo de la alcantarilla',
        'cuancho' => 'Ancho del cuerpo de la alcantarilla',
        'cualto' => 'Alto del cuerpo de la alcantarilla',
        'cudiam' => 'Diámetro del cuerpo de la alcantarilla',
        'cabezales' => 'Existe o no cabezales',
        'ecabez' => 'Estado de los cabezales de la alcantarilla',
        'ecuerpo' => 'Estado del cuerpo de la alcantarilla',
        'lat' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'observ' => 'Observación'
    ],
    'messages' => [
        'success' => [
            'created' => 'Alcantarilla creada satisfactoriamente',
            'type_created' => 'Tipo de Alcantarilla creado satisfactoriamente',
            'sewer_material_created' => 'Material de Alcantarilla creado satisfactoriamente',
            'updated' => 'Alcantarilla actualizada satisfactoriamente',
            'deleted' => 'Alcantarilla eliminada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Alcantarilla',
            'create_type' => 'Ha ocurrido un error al intentar crear el Tipo de Alcantarilla',
            'create_sewer_material' => 'Ha ocurrido un error al intentar crear el Material de Alcantarilla',
            'update' => 'Ha ocurrido un error al intentar actualizar la Alcantarilla',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Alcantarilla'
        ],
        'validations' => [
            'sewer_material_uniqueDesc' => 'La descripción del material de alcantarilla ya existe',
            'sewer_type_uniqueDesc' => 'La descripción del tipo de alcantarilla ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Alcantarilla no existe o no está disponible'
        ]
    ]
];
