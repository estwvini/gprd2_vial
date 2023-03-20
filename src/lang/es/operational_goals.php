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

    'title' => 'Objetivos Operativos',

    'titles' => [
        'OBJECTIVE' => 'Objetivo Estratégico',
        'OPERATIONAL_GOAL' => 'Objetivo Operativo',
        'INDICATOR' => 'Indicador / Meta'
    ],

    'labels' => [
        'structure' => 'Estructura',
        'OBJECTIVE' => 'Objetivos Estratégicos',
        'OPERATIONAL_GOAL' => 'Objetivos Operativos',
        'INDICATOR' => 'Indicadores / Metas',
        'create' => 'Crear Objetivo Operativo',
        'update' => 'Actualizar Objetivo Operativo',
        'details' => 'Detalles Objetivo Operativo',
        'code' => 'Código',
        'name' => 'Nombre',
        'objective' => 'Objetivo Operativo',
        'indicators' => 'Indicadores / Metas',
        'success' => 'Conforme',
        'warning' => 'En alerta',
        'danger' => 'En riesgo',
        'no_data' => 'No hay datos registrados',
        'return' => 'Regresar',
        'indicator' => 'Indicador / Meta',
        'goal_indicator' => 'Meta',
        'chart_title' => 'Planeado vs Ejecutado',
        'label_x' => 'Periodo',
        'label_y' => 'Valor',
        'goal' => 'Planeado',
        'progress' => 'Ejecutado',
        'select_year' => 'Seleccione hasta que año visualizar',
        'replicate' => 'Duplicar objetivos operativos',
    ],

    'placeholders' => [
        'code' => 'Ej: 01',
        'name' => 'Ej: Objetivo'
    ],

    'messages' => [
        'success' => [
            'created' => 'Objetivo Operativo almacenado satisfactoriamente',
            'updated' => 'Objetivo Operativo actualizado satisfactoriamente',
            'deleted' => 'Objetivo Operativo eliminado satisfactoriamente',
            'deletedIndicator' => 'Indicador / Meta eliminado(a) satisfactoriamente',
        ],
        'exceptions' => [
            'not_found' => 'El objetivo operativo no existe o no está disponible',
            'not_found_indicator' => 'El indicador no existe o no está disponible',
            'fiscal_year_not_found' => 'El año fiscal no se encuentra definido',
            'no_indicators' => 'El Objetivo Operativo no tiene indicadores asociados'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Objetivo Operativo',
            'update' => 'Ha ocurrido un error al intentar actualizar el Objetivo Operativo',
            'delete' => 'Ha ocurrido un error al intentar eliminar el Objetivo Operativo',
            'create_indicator' => 'Ha ocurrido un error al intentar crear el indicador',
            'update_indicator' => 'Ha ocurrido un error al intentar actualizar el indicador',
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el :type? :warning',
            'delete_operational_goal' => 'Todos los elementos relacionados a este serán eliminados.'
        ],
        'validations' => [
            'uniqueCode' => 'El código del Objetivo Operativo ya existe',
            'uniqueName' => 'El nombre del Objetivo Operativo ya existe',
            'noApprovedPEI' => 'No existe un Plan Estratégico Institucional aprobado'
        ]
    ]

];
