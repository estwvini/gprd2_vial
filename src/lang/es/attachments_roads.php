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

    'title' => 'Anexos resultantes de HDM4',

    'labels' => [
        'view_file' => 'Visualizar Documento',
        'download_file' => 'Descargar Documento',
        'delete_file' => 'Eliminar Documento',
        'select_file' => 'Seleccionar archivos'
    ],
    'messages' => [
        'success' => [
            'created' => 'Anexo(s) vial almacenado(s) satisfactoriamente.',
            'deleted' => 'Anexo vial eliminado satisfactoriamente.',
            'status' => 'Estado vial actualizado satisfactoriamente.'
        ],
        'exceptions' => [
            'project_not_found' => 'El proyecto no existe o no se encuentra disponible.'
        ],
        'warning' => [
            'no_files' => 'No existen archivos cargados.'
        ]
    ]
];
