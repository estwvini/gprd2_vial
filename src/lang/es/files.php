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

    'title' => 'Repositorio Documentos',

    'labels' => [
        'plans' => 'Tipo de Plan',
        'strategic_objectives' => 'Objetivos Estratégicos',
        'operational_objectives' => 'Objetivos Operativos',
        'plan' => 'Plan',
        'projects' => 'Proyecto',
        'option' => 'Opción',
        'tracking' => 'Seguimiento',
        'download' => 'Descargar Archivo',
        'name' => 'Nombre',
        'user' => 'Propietario',
        'references_number' => '# Referencia',
        'creation_date' => 'Fecha Creación',
        'owner' => 'Responsable',
        'file' => 'Archivo',
        'version' => 'Versión',
        'extension' => 'Extensión',
        'indicator' => 'Indicador',
        'justification' => 'Justificación',
        'operational_objective' => 'Objetivo Operacional',
        'components' => 'Tipo de archivo',
        'select_year' => 'Año'
    ],

    'placeholders' => [
        'name' => 'Nombre del Archivo',
        'description' => 'Descripción del Archivo',
        'version' => 'Ej. 1.0',
        'indicator' => 'Seleccione un indicador',
        'plans' => 'Seleccione un Plan',
        'select_year' => 'Seleccione un año',
        'projects' => 'Seleccione un Proyecto',
        'justification' => 'Seleccione una Justificación',
        'option' => 'Seleccione una Opción',
        'operational_objective' => 'Seleccione un objetivo operacional',
        'components' => 'Seleccione un componente',
        'strategic_objectives' => 'Seleccione un Objetivo Estratégico',
        'operational_objectives' => 'Seleccione un Objetivo Operativo'
    ],

    'messages' => [
        'info' => [
            'abbreviation' => 'Por favor ingresar únicamente archivos con extensión .pdf',
            'abbreviation_roads' => 'Por favor ingresar únicamente archivos con extensión .pdf o excel',
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el Archivo?'
        ],
        'success' => [
            'created' => 'Archivo creado satisfactoriamente',
            'updated' => 'Archivo actualizado satisfactoriamente',
            'deleted' => 'Archivo eliminado satisfactoriamente',
            'downloaded' => 'Archivo descargado satisfactoriamente'
        ],
        'validation' => [
            'name_exists' => 'El nombre del archivo ya existe',
            'file_extension' => 'Por favor seleccione un archivo con extensión .pdf'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el archivo',
            'update' => 'Ha ocurrido un error al intentar actualizar el archivo',
            'delete' => 'Ha ocurrido un error al intentar eliminar el archivo'
        ],
        'exceptions' => [
            'not_found' => 'El archivo no existe o no está disponible'
        ],
    ]
];
