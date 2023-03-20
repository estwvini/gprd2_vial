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

    'title' => 'Avance Presupuestario',

    'labels' => [
        'activity_component' => 'Actividad/Componente',
        'activity' => 'Actividad',
        'budget_item' => 'Ítem Presupuestario',
        'jan' => 'Ene',
        'feb' => 'Feb',
        'mar' => 'Mar',
        'apr' => 'Abr',
        'may' => 'May',
        'jun' => 'Jun',
        'jul' => 'Jul',
        'aug' => 'Ago',
        'sep' => 'Sep',
        'oct' => 'Oct',
        'nov' => 'Nov',
        'dec' => 'Dic',
        'planned' => 'Planificado',
        'encoded' => 'Codificado',
        'accrued' => 'Devengado',
        'budget_execution' => '% Ejecución Presupuestaria',
        'percent_progress' => '% de Avance',
        'budget' => 'Presupuesto',
        'months' => 'Meses',
        'encoded_total' => 'Codificado Total (Inversión)',
        'accrued_total' => 'Devengado Total (Inversión)',
        'encoded_accrued' => 'Codificado vs Devengado',
        'encoded_accrued_responsible_unit' => 'Codificado vs Devengado',
        'difference' => 'Diferencia (Por Devengar)',
        'budget_execution_up' => 'Ejecución presupuestaria hasta:',
        'projects_quantity' => 'Cantidad de Proyectos',
        'projects_quantity_risk' => 'Cantidad de Proyectos en Riesgo',
        'projects_quantity_in_time' => 'Cantidad de Proyectos en Tiempo',
        'projects_progress' => 'Avance Físico y Presupuestario de Proyectos',
        'projects_status' => 'Proyectos por estados',
        'activities' => 'Actividades/Componentes',
        'task' => 'Tareas/Hitos',
        'projects' => 'Proyectos',
        'criteria' => [
            'title' => 'Criterio',
            'area' => 'Áreas',
            'ur' => 'Unidades Responsables',
            'ue' => 'Unidades Ejecutoras'
        ],
        'delayed_tasks' => 'Tareas/Hitos Atrasadas',
        'days' => 'Días Vencidos',
        'responsible' => 'Responsable',
        'status' => 'Estado',
        'physical_progress' => 'Av. Físico',
        'budgetary_progress' => 'Av. Presupuestario',
        'due_date' => 'Fecha Vencimiento',
        'line' => 'Línea',
        'bar' => 'Barras',
        'restore' => 'Reiniciar',
        'file_name' => 'Avance Presupuesto Proyecto'
    ],

    'messages' => [
        'success' => [
            'budget_location_created' => 'Presupuesto de Cantón actualizado correctamente'
        ],
        'info' => [
            'empty' => 'No existe información. Ingrese los valores por Cantón en el formulario de abajo.',
            'total' => 'Se ha registrado el total devengado por cantones'
        ],
        'exceptions' => [
            'project_fiscal_year_not_found' => 'El año fiscal del proyecto no se encuentra definido',
            'fiscal_year_not_found' => 'El año fiscal no se encuentra definido'
        ]
    ]
];
