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

    'title' => 'Justificaciones',

    'labels' => [
        'create' => 'Crear Justificación',
        'description' => 'Descripción',
        'file' => 'Archivo',
        'document_reference' => 'Ref. Documento',
        'save' => 'Guardar',
        'justify' => 'Justificar',
        'dismiss' => 'Cancelar'
    ],

    'actions' => [
        'create' => 'Creación',
        'update' => 'Actualización',
        'delete' => 'Eliminación',
        'approve' => 'Aprobación',
        'verify' => 'Verificación'
    ],

    'placeholders' => [
        'description' => 'Descripción de la Justificación'
    ],

    'messages' => [
        'default' => 'Para completar la acción se necesita una justificación. Por favor ingrese la descripción y adjunte un archivo.',
        'info' => [
            'abbreviation' => 'Por favor ingresar únicamente archivos con extensión .pdf'
        ],
        'exceptions' => [
            'not_found' => 'La justificación no existe o no está disponible',
            'file_not_found' => 'El archivo no existe o no está disponible'
        ],
        'validations' => [
            'file_extension' => 'Por favor seleccione un archivo con extensión .pdf'
        ]
    ]
];
