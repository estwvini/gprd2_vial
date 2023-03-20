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

    'title' => 'Capas',
    'labels' => [
        'create' => 'Cargar Capa',
        'update' => 'Actualizar Capa',
        'edit' => 'Editar Capa',
        'shape' => 'Capa GeoJson',
        'type' => 'Principal',
        'not_data' => 'No hay archivos .geojson registrados',
        'list' => 'Listado de Capas',
        'is_primary' => 'Capa de fondo',
        'listshape' => '--Seleccione Capa--',
        'execute' => 'Ejecutar'
    ],
    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la capa?',
            'status_on' => '¿Está seguro que desea poner como capa de fondo?',
            'status_off' => '¿Está seguro que desea quitar como capa de fondo?'
        ],
        'success' => [
            'created' => 'Capa cargada satisfactoriamente',
            'updated' => 'Capa actualizada satisfactoriamente',
            'delete' => 'Capa eliminada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la capa',
            'update' => 'Ha ocurrido un error al intentar actualizar la capa',
            'delete' => 'Ha ocurrido un error al intentar eliminar la capa',
            'max_file' => 'Solo puede subir 5 archivos a la vez',
            'size_file' => 'El tamaño maximo de subida es 120Mb',
            'status_error' => 'Ya tiene registrado una capa de fondo',
            'only_json' => 'Por favor cargue únicamente archivos .geojson'
        ],
        'exceptions' => [
            'not_found' => 'La capa no existe o no está disponible'
        ],
        'info' => [
            'is_primary' => 'Agregar capa como fondo'
        ]
    ]
];
