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

    'title' => 'Componentes',
    'title_tracking' => 'Seguimiento de Componentes de Proyectos',

    'labels' => [
        'create' => 'Crear Componente',
        'new' => 'Nuevo Componente',
        'edit' => 'Editar Componente',
        'assumptions' => 'Supuestos',
        'create_indicator' => 'Crear Indicador',
        'show_component' => 'Ver Componente',
        'show_indicator' => 'Ver Indicador',
        'detail' => 'Detalle',
        'file_name_excel_report'=>'Componentes_Proyectos.xlsx'
    ],

    'tracking' => [
        'labels' => [
            'component' => 'Componente',
            'indicators' => 'Indicadores',
            'indicator' => 'Indicador',
            'goal_indicator' => 'Meta',
            'chart_title' => 'Planeado vs Ejecutado',
            'label_x' => 'Periodo',
            'label_y' => 'Valor',
            'progress' => 'Ejecutado',
            'goal' => 'Planeado',
            'success' => 'Conforme',
            'warning' => 'En alerta',
            'danger' => 'En riesgo',
            'no_data' => 'No hay datos registrados',
            'tolerance_min' => 'Tolerancia mínima',
            'tolerance_max' => 'Tolerancia máxima',
        ],

        'messages' => [
            'exceptions' => [
                'no_indicators' => 'El Componente no tiene indicadores asociados'
            ]
        ]
    ],

    'placeholders' => [
        'name' => 'Nombre del Componente',
        'code' => 'Código del Componente',
        'assumptions' => 'Supuestos del Componente'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el Componente?'
        ],
        'exceptions' => [
            'not_found' => 'El Componente no existe o no está disponible',
            'component_is_not_empty' => 'El Componente tiene elementos asociados. No se puede eliminar'
        ],
        'success' => [
            'created' => 'Componente creado satisfactoriamente',
            'updated' => 'Componente actualizado satisfactoriamente',
            'deleted' => 'Componente borrado satisfactoriamente'
        ],
        'validation' => [
            'activity_name_exists' => 'El nombre del Componente/Componente ya existe',
            'code_exists' => 'El código del Componente ya existe',
            'table_empty_message' => 'No existe información a mostrar'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Componente',
            'delete' => 'Ha ocurrido un error al intentar eliminar el Componente',
            'not_found' => 'El Componente no existe o no está disponible',
            'update' => 'Ha ocurrido un error al intentar actualizar el Componente'
        ]
    ]
];
