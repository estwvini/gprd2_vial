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

    'title' => 'Tipo de actividad',

    'labels' => [
        'create' => 'Crear Tipo de actividad',
        'new' => 'Nueva Tipo de actividad',
        'update' => 'Actualizar Tipo de actividad',
        'edit' => 'Editar Tipo de actividad',
        'delete' => 'Eliminar Tipo de actividad',
        'name' => 'Nombre'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el Tipo de actividad?'
        ],
        'success' => [
            'created' => 'Tipo de actividad creada satisfactoriamente',
            'updated' => 'Tipo de actividad actualizada satisfactoriamente',
            'deleted' => 'Tipo de actividad eliminada satisfactoriamente'
        ],
        'validation' => [
            'name_exists' => 'El nombre del Tipo de actividad ya existe',
            'has_activities' => 'No se puede completar la petición debido a que el Tipo de Actividad tiene Actividades Administrativas asociadas',
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Tipo de actividad',
            'update' => 'Ha ocurrido un error al intentar actualizar el Tipo de actividad',
            'delete' => 'Ha ocurrido un error al intentar eliminar el Tipo de actividad'
        ],
        'exceptions' => [
            'not_found' => 'El Tipo de actividad no existe o no está disponible'
        ]
    ]
];
