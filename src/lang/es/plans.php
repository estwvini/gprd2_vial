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

    'title' => 'Planes',
    'title_sectoral_tracking' => 'Seguimiento de Indicadores de Planes Sectoriales',

    'description' => [
        'ODS' => 'Objetivos de Desarrollo Sostenible',
        'PND' => 'Plan Nacional de Desarrollo',
        'PDOT' => 'Plan de Desarrollo y Ordenamiento Territorial',
        'PEI' => 'Plan Estratégico Institucional'
    ],

    'labels' => [
        'SUPRANATIONAL' => 'Supranacional',
        'NATIONAL' => 'Nacional',
        'TERRITORIAL' => 'Territorial',
        'INSTITUTIONAL' => 'Institucional',
        'ODS' => 'ODS',
        'PND' => 'PND',
        'PDOT' => 'PDOT',
        'PEI' => 'PEI/ Plan de Gobierno',
        'SECTORAL' => 'Sectorial',
        'create' => [
            'SUPRANATIONAL' => 'Crear Plan Supranacional',
            'NATIONAL' => 'Crear Plan Nacional',
            'TERRITORIAL' => 'Crear Plan Territorial',
            'INSTITUTIONAL' => 'Crear Plan Institucional'
        ],
        'new' => 'Nuevo Plan',
        'edit' => 'Actualizar Plan',
        'info' => 'Información del Plan',
        'approve' => 'Aprobar Plan',
        'verify' => 'Verificar Plan',
        'name' => 'Nombre',
        'vision' => 'Visión',
        'mission' => 'Misión',
        'startYear' => 'Año Inicio',
        'endYear' => 'Año Fin',
        'status' => 'Estado',
        'is' => 'Es',
        'link' => 'Articulación',
        'links' => 'Articulaciones',
        'planStructure' => 'Estructura del Plan :scope',
        'objWithIndicators' => 'Objetivos con Indicadores',
        'objWithoutIndicators' => 'Objetivos sin Indicadores',
        'noLinkedIndicators' => 'Indicadores sin Articular',
        'planWithoutProjects' => 'Proyectos del Plan',
        'objWithoutProjects' => 'Objetivos sin Proyectos',
        'programWithoutProjects' => 'Programas sin Proyectos',
        'save' => 'Guardar Plan',
        'APPROVED' => 'Aprobar',
        'VERIFIED' => 'Verificar',
        'projectsTooltip' => 'La información de los proyectos será completada en el perfil del proyecto correspondiente a la etapa de planificación',
        'sectorial_plan' => 'Plan Sectorial',
        'plansManagement' => 'Gestión de Planes',
        'replicate' => 'Duplicar Objetivos Plan Anterior'
    ],

    'placeholders' => [
        'name' => 'Ej: Plan Sectorial Vial',
        'vision' => '',
        'mision' => '',
        'startYear' => 'Ej: 2025',
        'endYear' => 'Ej: 2029',
        'selectPlan' => 'Seleccione un plan'
    ],

    'messages' => [
        'warning' => [
            'approvalNotAllowed' => [
                'TERRITORIAL' => 'La verificación no puede ser realizada. Todos los objetivos del plan deben tener al menos un indicador.',
                'INSTITUTIONAL' => 'La aprobación no puede ser realizada. Todos los objetivos del plan deben tener al menos un indicador y un proyecto asignado a un subprograma del plan.'
            ],
            'planAlreadyExists' => 'Ya existe un Plan Institucional activo. Archive dicho plan para poder crear uno nuevo.',
            'changeDate' => 'Si cambia el periodo del plan, las mediciones planeadas correspondientes a los indicadores ingresados se PERDERÁN y deberá ingresarlas nuevamente.'
        ],
        'info' => [
            'selectGoal' => 'Seleccione la meta que desea articular',
            'selectTargetGoals' => 'Seleccione una o varias metas con las que desea articular la meta seleccionada del '
        ],
        'validations' => [
            'elt' => 'El campo año inicio debe ser menor o igual al año fin',
            'egt' => 'El campo año fin debe ser mayor o igual al año inicio',
            'uniqueName' => 'El nombre del plan ya existe',
            'checkType1' => 'Ya existe un plan',
            'checkType2' => 'activo. Archive el plan para poder crear uno nuevo.',
            'reservedName' => 'El nombre del plan no puede ser igual a: ODS, PND, PDOT o PEI/ Plan de Gobierno',
            'checkStartYear' => 'El año de inicio del plan debe ser el año siguiente al año de fin del plan anterior',
        ],
        'success' => [
            'created' => 'Plan creado satisfactoriamente',
            'updated' => 'Plan actualizado satisfactoriamente',
            'replicated' => 'Plan duplicado satisfactoriamente',
            'deleted' => 'Plan eliminado satisfactoriamente',
            'archived' => 'Plan archivado satisfactoriamente',
            'VERIFIED' => 'Plan verificado satisfactoriamente',
            'APPROVED' => 'Plan aprobado satisfactoriamente',
        ],
        'exceptions' => [
            'not_found' => 'El plan no existe o no está disponible',
            'plans_not_found' => 'No existen planes registrados'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el plan',
            'update' => 'Ha ocurrido un error al intentar actualizar el plan',
            'delete' => 'Ha ocurrido un error al intentar eliminar el plan',
        ],
        'confirm' => [
            'deleteOther' => '¿Está seguro que desea eliminar el plan?',
            'archivePlan' => '¿Está seguro que desea archivar el plan? <br> Las articulaciones con otros planes serán eliminadas.',
            'deleteSectoralPlan' => '¿Está seguro que desea eliminar el plan? <br> Las articulaciones con otros planes serán eliminadas.',
            'approve' => [
                'APPROVED' => '¿Está seguro que desea aprobar el plan? Cualquier cambio posterior a la aprobación deberá ser justificado.',
                'VERIFIED' => '¿Está seguro que desea verificar el plan? Cualquier cambio posterior a la verificación deberá ser justificado.'
            ]
        ]
    ]

];
