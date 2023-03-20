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

    'title' => 'Metodologías de Priorización',

    'labels' => [
        'description' => 'Descripción',
        'fiscal_year' => 'Año Fiscal',
        'status' => 'Estado',
        'creation_date' => 'Fecha de Creación',
        'create' => 'Crear Metodología',
        'edit' => 'Editar Metodología',
        'show' => 'Detalles de Metodología',
        'destroy' => 'Eliminar Metodología',
        'template' => 'Metodología',
        'fiscal_year_template' => 'Metodología Año Fiscal: :fiscalYear',
        'weight' => 'Peso (%)',
        'total_weight' => 'Peso Total (%)'
    ],

    'status' => [
        'default' => 'Predefinido',
        'enabled' => 'Habilitado',
        'blocked' => 'Bloqueado'
    ],

    'placeholders' => [
        'description' => 'Descripción de la Metodología'
    ],

    'messages' => [
        'exceptions' => [
            'templates_not_found' => 'No existen metodologías de priorización previas.',
            'fiscal_years_completed' => 'Todos los años fiscales almacenados ya tienen una metodología asociada.',
            'current_fiscal_year_not_found' => 'No existe año fiscal definido',
            'fiscal_year_not_found' => 'El año fiscal al que se desea asignar una metodología no existe o no se encuentra disponible',
            'base_template_not_found' => 'La metodología que se deseaba replicar o modificar no existe o no se encuentra disponible',
            'entity_not_found' => 'La metodología de priorización no existe o no se encuentra disponible.',
            'blocked_status' => 'La metodología de priorización no puede ser eliminada. Existen proyectos priorizados con dicha metodología.',
            'has_budget_items' => 'La metodología de priorización no puede ser eliminada. El ajuste presupuestario ya fue realizado utilizando la metodología.'
        ],
        'info' => [
            'template' => 'Los valores de los ámbitos y criterios serán precargados con la metodología seleccionada.',
            'range' => 'Rango de 0 a 5. El valor afectará el peso del proyecto.'
        ],
        'validation' => [
            'total_weight' => 'La suma de los pesos de todos los ámbitos debe ser 100(%).',
            'invalid_scope' => 'Los ámbitos presentan inconsistencias. Por favor vuelva a intentar. Si el problema persiste consulte con el administrador del sistema.',
            'invalid_criteria' => 'Los criterios presentan inconsistencias. Por favor vuelva a intentar. Si el problema persiste consulte con el administrador del sistema.',
            'invalid_options' => 'Las opciones de los criterios presentan inconsistencias. Por favor vuelva a intentar. Si el problema persiste consulte con el administrador del sistema.'
        ],
        'confirm' => [
            'create' => '¿Desea crear la metodología con los valores ingresados?',
            'edit' => '¿Desea actualizar la metodología con los valores ingresados?',
            'delete' => 'Existen proyectos priorizados con esta metodología. ¿Desea eliminar la metodología de priorización junto con las priorizaciones existentes de los proyectos?'
        ],
        'success' => [
            'created' => 'Metodología creada satisfactoriamente',
            'updated' => 'Metodología actualizada satisfactoriamente',
            'deleted' => 'Metodología eliminada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la metodología de priorización',
            'update' => 'Ha ocurrido un error al intentar actualizar metodología de priorización',
            'delete' => 'Ha ocurrido un error al intentar eliminar metodología de priorización'
        ]
    ]
];
