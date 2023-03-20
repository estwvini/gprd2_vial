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

    'title' => 'Indicadores',

    'labels' => [
        'create' => 'Crear Indicador / Meta',
        'new' => 'Nuevo Indicador / Meta',
        'update' => 'Actualizar Indicador / Meta',
        'edit' => 'Editar Indicador / Meta',
        'details' => 'Detalles de el Indicador / Meta',
        'delete' => 'Eliminar Indicador / Meta',
        'file_name_excel_report' => 'Indicadores_Proyectos.xlsx',
        'executing_unit' => 'Unidad Ejecutora',
        'project'=>'Proyecto',
        'project_indicator'=>'Indicador del Proyecto',
        'planned_goal'=>'Meta Planificada',
        'goal_executed'=>'Meta Ejecutada',
        'execution_percentage'=>'Porcentaje de Ejecucción',
        'quarterly_goal_planning'=>'Planificación trimestral de meta',
        'planned_quarter'=>'Planificado trimestre',
        'component'=>'componente',
        'indicator'=>'indicator',
        'executed_quarter'=>'Ejecutado trimestre'

    ],

    'placeholders' => [
        
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el Indicador?',
            'create' => '¿Está seguro que desea crear el Indicador?',
            'update' => '¿Está seguro que desea actualizar el Indicador?',
            'status_on' => '¿Está seguro que desea habilitar el Indicador seleccionado?',
            'status_off' => '¿Está seguro que desea inhabilitar el Indicador seleccionado?'
        ],
        'success' => [
            'created' => 'Indicador creado satisfactoriamente',
            'updated' => 'Indicador actualizado satisfactoriamente',
            'deleted' => 'Indicador eliminado satisfactoriamente'
        ],
        'validation' => [
            
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Indicador',
            'update' => 'Ha ocurrido un error al intentar actualizar el Indicador',
            'delete' => 'Ha ocurrido un error al intentar eliminar el Indicador'
        ],
        'exceptions' => [
            'not_found' => 'El Indicador no existe o no está disponible'
        ],
    ]
];
