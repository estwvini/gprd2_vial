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

    'title' => 'Avance de Indicadores',
    'title_pdot' => 'Avance de Indicadores del PDOT',
    'title_pei' => 'Avance de Indicadores del PEI / Plan de Gobierno',
    'title_operational_goals' => 'Avance de Indicadores de Objetivos Operativos',
    'title_projects' => 'Avance de Indicadores de Proyectos',
    'title_components' => 'Avance de Indicadores de Componentes',
    'title_components_tracking' => 'Seguimiento de Indicadores de Componentes',
    'title_projects_tracking' => 'Seguimiento de Indicadores de Proyectos',
    'title_sectoral' => 'Avance de Indicadores de Planes Sectoriales',

    'labels' => [
        'years' => 'Años',
        'year' => 'Año',
        'frequent' => 'Frecuencia de medición',
        'physical_progress' => 'Avance Físico',
        'pei' => 'PEI/ Plan de Gobierno',
        'pdot' => 'PDOT',
        'goal_value' => 'Medición planificada',
        'actual_value' => 'Medición alcanzada',
        'threshold' => 'Semáforo',
        'percentage' => 'Porcentaje / Desviación',
        'name' => ':parent / Indicadores',
        'type' => 'Tipo',
        'ascending' => 'Ascendente',
        'descending' => 'Descendente',
        'base_line' => 'Linea Base',
        'tolerance' => 'Banda de Tolerancia',
        'download' => 'Ficha Técnica',
        'file_download' => 'Descargar Ficha Técnica',
        'show_indicator' => 'Ver indicador',
        'details_indicator' => 'Detalles del indicador',
        'measurement_type' => 'Tipo de medición',
        'projects_list' => 'Listado de Proyectos',
        'select_year' => 'Seleccione hasta que año visualizar',
        'project' => 'Proyecto',
        'no_available' => 'N/A',
        'indicator' => 'Indicador',
        'goal_indicator' => 'Meta',
        'measurement_type' => 'Tipo de medición',
        'sectoral_plans' => 'Plan Sectorial',
        'parent' => [
            'project' => 'Proyecto',
            'plan' => 'Objetivo',
            'component' => 'Componente',
            'operational_goal' => 'Objetivo'
        ],

        'goal_indicator' => 'Meta',

        'chart_title' => 'Planeado vs Ejecutado',
        'label_x' => 'Periodo',
        'label_y' => 'Valor',
        'progress' => 'Ejecutado',
        'goal' => 'Planeado',
        'return' => 'Regresar',
        'no_indicators' => 'No tiene Indicadores',
        'no_components' => 'No tiene Componentes',
        'tolerance_min' => 'Tolerancia mínima',
        'tolerance_max' => 'Tolerancia máxima'
    ],

    'messages' => [
        'exceptions' => [
            'plan_not_found' => 'No se ha creado o no se ha aprobado el Plan',
            'indicator_not_found' => 'No se ha encontrado el indicador'
        ],
        'success' => [
            'update' => 'Se han actualizado las metas alcanzadas satisfactoriamente'
        ],
        'validations' => [
            'noApprovedPEI' => 'No existe un PEI / Plan de Gobierno aprobado o que haya iniciado',
            'noVerifiedPDOT' => 'No existe un PDOT verificado o que haya iniciado',
            'noVerifiedSECTORAL' => 'No existe un Plan Sectorial verificado o que haya iniciado',
            'noApprovedBudgetAdjustment' => 'El presupuesto para este año aún no ha sido aprobado'
        ]
    ],

    'actions' => [
        'physical_and_budget_progress' => 'Avance Físico y Presupuestario',
        'reforms' => 'Reformas',
        'reprogram' => 'Reprogramación',
        'indicators' => 'Ver Indicadores'
    ],
    'enums' => [
        'measuring_frequencies' => [
            '7' => '4to Trimestre',
            '6' => '3er Trimestre',
            '5' => '2do Trimestre',
            '4' => '1er Trimestre',
            '3' => '2do Semestre',
            '2' => '1er Semestre',
            '1' => 'Anual'
        ]
    ]
];
