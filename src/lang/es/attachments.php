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

    'title' => 'Anexos',

    'labels' => [
        'view_file' => 'Visualizar Documento',
        'download_file' => 'Descargar Documento',
        'delete_file' => 'Eliminar Documento',
        'select_file' => 'Seleccionar archivos'
    ],

    'files' => [
        'initiative' => 'Documento de Iniciativa',
        'prefeasibility' => 'Documento de Prefactibilidad',
        'feasibility' => 'Documento de Factibilidad',
        'studies' => 'Documento de Estudios',
        'execution' => 'Documento de Ejecución',
        'termination' => 'Documento de Terminación'
    ],

    'messages' => [
        'success' => [
            'created' => 'Anexo(s) almacenado(s) satisfactoriamente.',
            'deleted' => 'Anexo eliminado satisfactoriamente.',
            'status' => 'Estado actualizado satisfactoriamente.'
        ],
        'exceptions' => [
            'project_not_found' => 'El proyecto no existe o no se encuentra disponible.'
        ],
        'info' => [
            'road_type' => 'Para los proyectos viales la subida de los tres documentos es requerida.'
        ],
        'warning' => [
            'no_files' => 'No existen archivos cargados.'
        ],
        'errors' => [
            'extension_invalid' => 'Por favor ingresar únicamente archivos con extensión .pdf o excel'
        ]
    ]
];
