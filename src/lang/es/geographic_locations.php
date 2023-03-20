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

    'title' => 'Localizaciones Geográficas',

    'labels' => [
        'create' => 'Crear :type',
        'new' => 'Nueva(o) :type',
        'update' => 'Actualizar :type',
        'edit' => 'Editar :type',
        'details' => 'Detalles de :type',
        'delete' => 'Eliminar :type',
        'code' => 'Código :type',
        'description' => 'Descripción :type',
        'CANTON' => 'Cantón',
        'PARISH' => 'Parroquia',
        'children' => 'Parroquias',
        'info' => 'Información de la localización geográfica',
        'location_type' => 'Tipo de localización',
        'geographic_location' => 'Código localización geográfica',
        'geographic_location_name' => 'Nombre de localización geográfica',
        'type'=>'Tipo',
        'geographic_location_create' => 'localización geográfica'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar :type?',
            'status_on' => '¿Está seguro que desea habilitar :type?',
            'status_off' => '¿Está seguro que desea inhabilitar :type?'
        ],
        'success' => [
            'created' => ':type creada(o) satisfactoriamente',
            'updated' => ':type actualizada(o) satisfactoriamente',
            'deleted' => ':type eliminada(o) satisfactoriamente',
            'status_on' => ':type habilitada(o) satisfactoriamente',
            'status_off' => ':type inhabilitada(o) satisfactoriamente'
        ],
        'validation' => [
            'geographic_location_code_exists' => 'El código de la localización geográfica ya existe',
            'geographic_location_description_exists' => 'La descripción de la localización geográfica ya existe',
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la localización geográfica',
            'update' => 'Ha ocurrido un error al intentar actualizar la localización geográfica',
            'delete' => 'Ha ocurrido un error al intentar eliminar la localización geográfica'
        ],
        'exceptions' => [
            'not_found' => 'La localización geográfica no existe o no está disponible',
            'has_children_geographic_locations' => 'No se puede completar la petición debido a que el cantón tiene parroquias asociadas',
            'parent_disabled' => 'No se puede completar la petición debido a que el cantón al que la parroquia pertenece está deshabilitada',
            'has_budgetItems' => 'No se puede completar la petición debido a que la ubicación tiene partidas presupuestarias de gasto asociadas'
        ],
    ]
];
