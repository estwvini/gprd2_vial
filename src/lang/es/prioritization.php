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

    'title' => 'Priorización',

    'labels' => [
        'create' => 'Priorizar Proyecto',
        'edit' => 'Editar Priorización',
        'details' => 'Detalles de Priorización',
        'delete' => 'Eliminar Priorización',
        'priority' => 'Prioridad (índice)',
        'project' => 'Proyecto: :cup - :name',
        'scope' => 'Ámbito(s)',
        'criterion' => 'Criterio',
        'total' => 'Total',
        'weight' => 'Peso',
        'score' => 'Calificación',
        'formula' => '( total x peso )',
        'project_phase' => 'Fase',
        'fiscal_year' => 'Año Fiscal: :fiscalYear'
    ],

    'messages' => [
        'confirm' => [
            'create' => '¿Está seguro que desea priorizar el proyecto con índice: :total ?',
            'update' => '¿Está seguro que desea actualizar la priorización del proyecto con índice: :total ?',
            'delete' => '¿Está seguro que desea eliminar la priorización?'
        ],
        'success' => [
            'created' => 'Priorización creada satisfactoriamente',
            'updated' => 'Priorización actualizada satisfactoriamente',
            'deleted' => 'Priorización eliminada satisfactoriamente'
        ],
        'validation' => [
            'invalid_scopes' => 'Los ámbitos priorizados presentan inconsistencias. Por favor vuelva a intentar. Si el problema persiste consulte con el administrador del sistema.',
            'invalid_criteria' => 'Los criterios priorizados presentan inconsistencias. Por favor vuelva a intentar. Si el problema persiste consulte con el administrador del sistema.'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la priorización',
            'update' => 'Ha ocurrido un error al intentar actualizar la priorización',
            'delete' => 'Ha ocurrido un error al intentar eliminar la priorización'
        ],
        'exceptions' => [
            'prioritization_not_found' => 'La priorización no existe o no se encuentra disponible',
            'project_fiscal_year_not_found' => 'El proyecto para el año fiscal a priorizar no existe o no se encuentra disponible',
            'fiscal_year_not_found' => 'El año fiscal a priorizar no se encuentra definido',
            'template_not_found' => 'No existe una metodología de priorización definida para el año fiscal :year',
            'action_not_found' => 'No se puede ejecutar la acción seleccionada.'
        ]
    ]
];
