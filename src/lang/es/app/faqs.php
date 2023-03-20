<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'title' => 'Preguntas frecuentes',
    'labels' => [
        'title' => 'Título',
        'list' => 'Listado',
        'publish' => 'Publicar'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la Pregunta?',
            'publish_on' => '¿Está seguro que desea publicar la pregunta frecuente seleccionada?\n\nLa pregunta frecuente se publicará en la aplicación móvil',
            'publish_off' => '¿Está seguro que desea publicar la pregunta frecuente seleccionada?\n\nLa pregunta frecuente no estará disponible en la aplicación móvil',
        ],
        'exceptions' => [
            'not_found' => 'La pregunta no existe o no está disponible',
        ],
        'success' => [
            'created' => 'Pregunta frecuente creada satisfactoriamente',
            'updated' => 'Pregunta frecuente actualizada satisfactoriamente',
            'deleted' => 'Pregunta frecuente eliminada satisfactoriamente',
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Actividad',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Actividad',
            'not_found' => 'La Actividad no existe o no está disponible',
            'update' => 'Ha ocurrido un error al intentar actualizar la Actividad',
            'file' => 'Ha ocurrido un error al intentar cargar los archivos'
        ]
    ]
];
