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

    'title' => 'Capas por Provincia',
    'labels' => [
        'create' => 'Cargar Capas',
        'update' => 'Actualizar Capa',
        'edit' => 'Editar Capa',
        'details' => 'Detalles de Capa',
        'name' => 'Capa GeoJson',
        'user' => 'Usuario',
        'date' => 'Fecha',
        'is_primary' => 'Capa de fondo',
        'load_map' => 'Mostrar mapa'
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
            'create' => 'Ha ocurrido un error al intentar crear la Capa',
            'update' => 'Ha ocurrido un error al intentar actualizar la Capa',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Capa',
            'max_file' => 'Solo puede subir 5 archivos a la vez',
            'size_file' => 'El tamaño maximo de subida es',
            'status_error' => 'Ya tiene registrado una capa de fondo',
            'file_extension_error' => 'El archivo seleccionado no es una Capa'
        ],
        'exceptions' => [
            'not_found' => 'El Capa no existe o no está disponible'
        ],
        'info' => [
            'is_primary' => 'Agregar capa como fondo'
        ]
    ]
];
