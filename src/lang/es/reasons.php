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

    'title' => 'Motivo',

    'labels' => [
        'create' => 'Crear Motivo',
        'new' => 'Nuevo Motivo',
        'update' => 'Actualizar Motivo',
        'edit' => 'Editar Motivo',
        'delete' => 'Eliminar Motivo',
        'name' => 'Nombre'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el Motivo?'
        ],
        'success' => [
            'created' => 'Motivo creado satisfactoriamente',
            'updated' => 'Motivo actualizado satisfactoriamente',
            'deleted' => 'Motivo eliminado satisfactoriamente'
        ],
        'validation' => [
            'name_exists' => 'El nombre del Motivo ya existe',
            'has_activities' => 'No se puede completar la petición debido a que el Motivo tiene Actividades Administrativas asociadas',
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Motivo',
            'update' => 'Ha ocurrido un error al intentar actualizar el Motivo',
            'delete' => 'Ha ocurrido un error al intentar eliminar el Motivo'
        ],
        'exceptions' => [
            'not_found' => 'El Motivo no existe o no está disponible'
        ]
    ]
];
