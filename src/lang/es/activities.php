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

    'title' => 'Actividades',

    'labels' => [
        'create' => 'Crear Actividad',
        'new' => 'Nueva actividad',
        'edit' => 'Editar actividad',
        'code' => 'Código',
        'initial_value' => 'Valor inicial',
        'encoded_value' => 'Codificado',
        'budget_items' => 'Partidas Presupuestarias',
        'exercise' => 'Ejercicio',
        'responsibleUnit' => 'Unidad responsable',
        'executingUnit' => 'Unidad ejecutora',
        'area' => 'Área',
        'component' => 'Componente',
        'activity' => 'Actividad',
        'objective_pei' => 'Objetivo estratégico',
        'program' => 'Programa',
        'sub_program' => 'Sub-Programa',
        'project' => 'Proyecto',
        'create_indicator' => 'Crear Indicador',
        'show_activity' => 'Ver Actividad',
        'budget' => 'Presupuesto',
        'approved' => 'Aprobado',
        'planned' => 'Total Planificado',
        'difference' => 'Diferencia',
        'planned_approved' => '% Planificado vs Aprobado',
        'detail' => 'Detalle',
        'has_budget' => 'Tiene presupuesto',
        'responsible' => 'Responsable'
    ],

    'placeholders' => [
        'name' => 'Nombre de la actividad',
        'code' => 'Código de la actividad'
    ],

    'actions' => [
        'planning' => 'Planificar'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la Actividad?',
        ],
        'exceptions' => [
            'not_found' => 'La actividad no existe o no está disponible',
            'project_not_found' => 'El projecto no existe o no está disponible',
            'activity_is_not_empty' => 'La actividad tiene elementos asociados. No se puede eliminar'
        ],
        'success' => [
            'planning_created' => 'Planificación presupuestaria creada satisfactoriamente',
            'created' => 'Actividad creada satisfactoriamente',
            'updated' => 'Actividad actualizada satisfactoriamente',
            'deleted' => 'Actividad borrada satisfactoriamente'
        ],
        'validation' => [
            'activity_name_exists' => 'El nombre del Componente/Actividad ya existe',
            'code_exists' => 'El código de la Actividad ya existe',
            'table_empty_message' => 'No existe información a mostrar',
            'not_available_budget' => 'No tiene presupuesto disponible para crear partidas presupuestarias'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Actividad',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Actividad',
            'not_found' => 'La Actividad no existe o no está disponible',
            'update' => 'Ha ocurrido un error al intentar actualizar la Actividad',
            'budget_planning' => 'El Total Planificado deber ser igual al Total Mensual de las actividades'
        ]
    ]
];
