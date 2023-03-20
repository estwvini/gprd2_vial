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

    'title' => 'Cronograma',

    'labels' => [
        'type' => [
          'ACTIVITY' => 'Actividad',
          'TASK' => 'Tarea',
          'MILESTONE' => 'Hito'
        ],
        'create' => 'Crear Tarea/Hito',
        'new' => 'Nueva Tarea/Hito',
        'details' => 'Detalles de :element',
        'update' => 'Actualizar :element',
        'edit' => 'Editar :element',
        'delete' => 'Eliminar :element',
        'fiscalYear' => 'Año Fiscal',
        'task' => 'Tarea',
        'milestone' => 'Hito',
        'startDate' => 'Fecha de Inicio',
        'endDate' => 'Fecha Fin',
        'duration' => 'Duración (días)',
        'relevance' => 'Importancia',
        'responsible' => 'Responsable',
        'weight' => 'Ponderación',
        'budget' => 'Presupuesto',
        'select' => 'Seleccione',
        'selectResponsible' => 'Seleccione un Responsable',
        'selectRelevance' => 'Seleccione la relevancia de la actividad',
        'notApply' => 'N/A',
        'totalWeight' => 'Ponderación Total Tareas e Hito',
        'gantt' => 'Gantt',
        'replicate' => 'Duplicar Cronograma Año Anterior'
    ],

    'placeholders' => [
        'task' => 'Ej: Tarea 1',
        'milestone' => 'Ej: Hito',
        'weight' => 'Ej: 30'
    ],

    'messages' => [
        'success' => [
            'created' => ':element almacenado/a satisfactoriamente',
            'updated' => ':element actualizado/a satisfactoriamente',
            'status' => 'Cronograma actualizado satisfactoriamente',
            'deleted' => ':element eliminado/a satisfactoriamente'
        ],
        'exceptions' => [
            'not_found' => 'El/la :element no existe o no está disponible',
            'not_found_default' => 'La Tarea/Hito no existe o no está disponible',
            'fiscal_year_not_found' => 'El año fiscal no se encuentra definido',
            'project_fiscal_year_not_found' => 'El año fiscal del proyecto no se encuentra definido',
            'activity_fiscal_year_not_found' => 'La actividad no tiene asociado un año fiscal de proyecto'
        ],
        'errors' => [
            'created' => 'Ha ocurrido un error al intentar crear el/la :element',
            'updated' => 'Ha ocurrido un error al intentar actualizar el/la :element',
            'deleted' => 'Ha ocurrido un error al intentar eliminar el/la :element',
            'has_children' => 'No se puede actualizar porque tiene una tarea/hito con fecha menor a la final de la actividad'
        ],
        'confirm' => [
            'delete_milestone' => '¿Está seguro que desea eliminar el Hito?',
            'delete_task' => '¿Está seguro que desea eliminar la Tarea?'
        ],
        'validation' => [
            'budget_classifier' => 'El Item Presupuestario ya ha sido ingresado.',
            'weight_100' => 'La ponderación debe ser menor o igual a 100.',
            'weight_0' => 'La ponderación debe ser mayor a 0.',
            'total_weight' => 'La suma de las ponderaciones del hito y las tareas de la actividad debe ser 100 %.',
            'milestone_weight' => 'La ponderación asignada a un hito debe ser mayor o igual a 11 %. La suma de las ponderaciones del hito y las tareas de la actividad debe ser 100 %',
            'required_fields' => 'Complete los campos requeridos.',
            'milestone_already_exists' => 'La actividad ya tiene un hito creado.',
            'missing_dates' => 'La actividad debe tener una fecha de inicio y fin para poder crear una tarea o hito.',
            'max_length_name' => 'La longitud máxima del nombre de la tarea es de 140 caracteres.',
            'missing_activity' => 'Para crear una Tarea o Hito, seleccione una actividad de la tabla.'
        ],
        'warning' => [
            'no_info_gantt' => 'No existe la información necesaria para generar el diagrama de Gantt.',
            'no_info_schedule' => 'No existen componentes relacionados al proyecto.'
        ]
    ]

];
