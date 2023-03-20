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

    'title' => 'Gasto Permanente',

    'titles' => [
        'OPERATIONAL_ACTIVITY' => 'Actividades Operativas',
        'PROGRAM' => 'Programa',
        'SUBPROGRAM' => 'Subprogramas'
    ],

    'labels' => [
        'fiscal_year' => 'Año Fiscal: :fiscalYear',
        'PROGRAM' => 'Programa',
        'SUBPROGRAM' => 'Subprograma',
        'OPERATIONAL_ACTIVITY' => 'Actividad Operativa',
        'structure' => 'Estructura',
        'create' => 'Crear :element',
        'details' => 'Detalle :element',
        'update' => 'Actualizar :element',
        'code' => 'Código',
        'name' => 'Nombre :element',
        'area' => 'Área',
        'budget_items' => 'Partidas Presupuestarias',
        'exercise' => 'Ejercicio',
        'replicate' => 'Duplicar Presupuesto',
        'import' => 'Importar',
        'download' => 'Descargar',
        'file' => 'Presupuesto de Gasto Permanente',
    ],

    'placeholders' => [
        'code' => 'Ej: 01',
        'name' => 'Ej: Gastos Internos',
        'area' => 'Ej: Área Financiera'
    ],

    'messages' => [
        'warning' => [
            'empty' => [
                'PROGRAM' => 'No se ha ingresado un Programa',
                'SUBPROGRAM' => 'No se han ingresado Subprogramas',
                'OPERATIONAL_ACTIVITY' => 'No se han ingresado Actividades Operativas'
            ]
        ],
        'success' => [
            'create' => ':element almacenado satisfactoriamente',
            'update' => ':element actualizado satisfactoriamente',
            'delete' => ':element eliminado satisfactoriamente'
        ],
        'exceptions' => [
            'not_found' => 'El :element no existe o no está disponible',
            'element_not_found' => 'El elemento no existe o no está disponible',
            'parent_not_found' => 'El elemento padre no existe o no está disponible',
            'program_exists' => 'Ya existe un programa para el año fiscal. Por favor vuelva a ingresar a la opción del menú: Gasto Permanente',
            'has_children' => 'No se puede eliminar el :element porque tiene elementos asociados. Por favor elimine primero las dependencias para poder eliminar el :element.',
            'has_activities' => 'No se puede eliminar el Subprograma porque tiene Actividades asociadas. Por favor elimine primero las Actividades para poder eliminar el Subprograma.'
        ],
        'errors' => [
            'index' => 'Ha ocurrido un error al intentar obtener el programa del año fiscal a planificar',
            'create' => 'Ha ocurrido un error al intentar crear el :element',
            'update' => 'Ha ocurrido un error al intentar actualizar el :element',
            'delete' => 'Ha ocurrido un error al intentar eliminar el :element'
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el :element?',
            'import' => '¿Está seguro que desea reemplazar toda la estructura de Gasto Permanente? La acción eliminará toda la estructura permanentemente.'
        ],
        'validations' => [
            'uniqueCode' => 'El código del :element ya existe',
            'uniqueName' => 'El nombre del :element ya existe'
        ]
    ]
];
