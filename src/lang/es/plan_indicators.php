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

    'title' => 'Indicadores del Plan',
    'title_module' => 'Planificación',
    'title_goals' => 'Metas',
    'title_chart' => 'Titulo',
    'goal_type_description' => 'Tipo de Medición: Discreto se refiere al avance que se va a realizar exclusivamente en el período vigente (Ej. 5km en trimestre II). Acumulado se refiere al avance realizado en el período vigente incluyendo los períodos anteriores (Ej. 7 km hasta trimestre II, incluyendo avance discreto de 2km en trimestre I)',
    'type_description' => 'Ascendente: Tipo de indicador cuya meta es mayor a su línea de base, es decir, 
                            interesa que su valor se incremente (Ej. Tasa de empleo). Descendente: 
                            Tipo de indicador cuya meta es menor a su línea de base, es decir interesa que su valor se 
                            reduzca (Ej. Tasa de desempleo). Banda de tolerancia: Tipo de indicador que 
                            requiere que sus valor meta se encuentre en una banda definida con un valor mínimo y un valor 
                            máximo predeterminado (Ej. tasa de inflación en una banda entre 2% y 3%)',
    'measurement_frequency_per_year_description' => '',
    'technical_file_description' => 'Documento que describe la metodología de cálculo del indicador e incluye: descripción, fórmula de cálculo, metodología de cálculo, interpretación, unidad de medida, unidad de análisis y fuentes de datos primarios',
    'base_line_description' => 'Valor del indicador más reciente. Se utiliza como referencia para definir la meta.',
    'calculation_formula_description' => 'Expresión que describe cómo se calcula el indicador y describe las variables usadas para este propósito',
    'goal_description' => 'Expresión cuantitativa que define el valor que se quiere alcanzar al final del período de la planificación (Ej: 5 años para la planificación estratégica institucional)',

    'labels' => [
        'create' => 'Crear Indicador / Meta',
        'new' => 'Nuevo Indicador / Meta',
        'update' => 'Actualizar Indicador / Meta',
        'edit' => 'Editar Indicador / Meta',
        'details' => 'Detalles de Indicador / Meta',
        'delete' => 'Eliminar Indicador / Meta',
        'info' => 'Información del Indicador / Meta',
        'indicator' => 'Indicador / Meta',
        'planned_measurements' => 'Mediciones Planeadas',
        'real_measurements' => 'Mediciones Reales',
        'plan_element_id' => '',
        'name' => 'Nombre Indicador',
        'description' => 'Descripción',
        'measuring_unit' => 'Unidad de Medida',
        'technical_file' => 'Ficha Técnica',
        'calculation_formula' => 'Fórmula de Cálculo',
        'base_line' => 'Línea Base',
        'base_line_year' => 'Año de Línea Base',
        'type' => 'Tipo',
        'goal_type' => 'Tipo de Medición',
        'goal' => 'Valor de la Meta',
        'description_goal' => 'Descripción de la Meta',
        'source' => 'Fuente',
        'measurement_frequency_per_year' => 'Frecuencia de Mediciones Planeadas',
        'status' => 'Estado',
        'rejected_comments' => 'Razón de Rechazo',
        'creator_user_id' => 'Creado Por',
        'approval_user_id' => 'Aprobado Por',
        'created_at' => 'Fecha de Creación',
        'updated_at' => 'Fecha de Actualización',
        'period' => 'Período',
        'line_base_a' => 'línea base, año: ',
        'discrete' => 'Discreto',
        'goal' => 'Meta',
        'cumulative' => 'Acumulativo',
        'yearMeasurement'  => 'Año de medición:',
        'year' => ' año ',
        'semester1' => 'Semestre 1',
        'semester2' => 'Semestre 2',
        'trimester1'=>'Trimestre1',
        'trimester2'=>'Trimestre2',
        'trimester3'=>'Trimestre3',
        'trimester4'=>'Trimestre4',
        'line' => 'Línea',
        'bar' => 'Barras',
        'min' => 'Mínimo',
        'max' => 'Máximo',
        'save_image' => 'Guardar como Imagen',
        'min_abbrev' => 'Mín',
        'max_abbrev' => 'Máx',
    ],

    'enums' => [
        'measuring_units' => [
            'percentage' => 'Porcentaje',
            'numeric' => 'Numérico',
            'kilometers' => 'Kilometros',
            'meters' => 'Metros',
            'hours' => 'Horas',
            'minutes' => 'Minutos',
            'persons' => 'Personas',
            'usd' => 'USD',
            'days' => 'Días',
            'average' => 'Promedio'
        ],
        'measuring_units_num' => [
            'percentage' => '%',
            'kilometers' => 'Km',
            'meters' => 'm',
            'hours' => 'Hrs',
            'minutes' => 'Minutos',
            'persons' => 'Personas',
            'usd' => 'USD',
            'days' => 'Días'
        ],
        'types' => [
            'ascending' => 'Ascendente',
            'descending' => 'Descendente',
            'tolerance' => 'Banda de Tolerancia'
        ],
        'goal_types' => [
            'discreet' => 'Discreto',
            'accumulated' => 'Acumulativo'
        ],
        'measuring_frequencies' => [
            '12' => 'Mensual',
            '6' => 'Bimensual',
            '4' => 'Trimestral',
            '3' => 'Cuatrimestral',
            '2' => 'Semestral',
            '1' => 'Anual'
        ],
        'measuring_frequencies_chart' => [
            '12' => 'Mes',
            '6' => 'Bimes',
            '4' => 'Trimestre',
            '3' => 'Cuatrimestre',
            '2' => 'Semestre',
            '1' => 'Año'
        ],
    ],

    'placeholder' => [
        'name' => '',
        'description' => '',
        'calculation_formula' => '',
        'base_line' => '',
        'base_line_year' => '',
        'goal' => ''
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar El Indicador?',
            'status_on' => '¿Está seguro que desea habilitar El Indicador seleccionada?',
            'status_off' => '¿Está seguro que desea inhabilitar El Indicador seleccionada?',
        ],
        'success' => [
            'created' => 'Indicador / Meta creado satisfactoriamente',
            'updated' => 'Indicador / Meta actualizado satisfactoriamente',
            'deleted' => 'Indicador / Meta eliminado satisfactoriamente',
            'created_goal' => 'Metas creadas satisfactoriamente'
        ],
        'validation' => [
            'geographic_location_code_exists' => 'El código de El Indicador / Meta ya existe',
            'geographic_location_description_exists' => 'La descripción de El Indicador / Meta ya existe',
            'goal_limit' => 'El valor de la medición planeada debe estar en el rango de la meta del proyecto'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear El Indicador / Meta',
            'update' => 'Ha ocurrido un error al intentar actualizar El Indicador / Meta',
            'delete' => 'Ha ocurrido un error al intentar eliminar El Indicador / Meta',
            'delete_goals' => 'Ha ocurrido un error al intentar eliminar las metas asociadas al Indicador / Meta',
            'delete_draft' => 'El Indicador / Meta ya no es un borrador'
        ],
        'exceptions' => [
            'not_found' => 'El Indicador / Meta no existe o no está disponible',
            'delete_approved' => 'No puede eliminar un Indicador / Meta aprobado',
            'has_children' => 'No se puede completar la petición debido a que el Indicador tiene avances reportados'
        ],
    ]
];
