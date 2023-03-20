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

    'title' => 'Comentarios ciudadanos',
    'labels' => [
        'list' => 'Listado',
        'comment' => 'Comentario',
        'responses' => 'Respuestas',
        'reply' => 'Respuesta',
        'subject' => 'Tema',
        'location' => 'Ubicación',
        'gad_author' => 'Prefectura del',
        'default' => 'Respuesta automática',
        'approval_title' => 'Revisión y aprobación de respuestas a comentarios',
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el comentario?',
            'approve' => '¿Está seguro que desea aprobar las respuestas seleccionadas?'
        ],
        'info' => [
            'empty' => 'No existen respuestas a este comentario. Ingrese una respuesta en el formulario de abajo',
            'default_response' => 'Muchas gracias por su comentario. Un funcionario de la Prefectura le responderá lo más pronto posible. '
        ],
        'exceptions' => [
            'not_found' => 'El comentario no existe o no está disponible',
        ],
        'success' => [
            'created' => 'Comentario creado satisfactoriamente',
            'updated' => 'Comentario actualizado satisfactoriamente',
            'deleted' => 'Comentario eliminado satisfactoriamente',
            'updated_bulk' => 'Respuestas aprobadas satisfactoriamente',
        ]
    ]
];
