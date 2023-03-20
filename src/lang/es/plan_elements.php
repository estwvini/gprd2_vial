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

    'titles' => [
        'THRUST' => 'Ejes',
        'OBJECTIVE' => 'Objetivos',
        'STRATEGY' => 'Estrategias',
        'POLICY' => 'Políticas',
        'GOAL' => 'Metas',
        'PROGRAM' => 'Programas',
        'SUBPROGRAM' => 'Subprogramas',
        'INDICATOR' => 'Indicadores/Metas',
        'INDICATORS' => 'Indicadores',
        'RISK' => 'Riesgos',
        'PROJECT' => 'Proyectos'
    ],
    'labels' => [
        'THRUST' => 'Eje',
        'OBJECTIVE' => 'Objetivo',
        'STRATEGY' => 'Estrategia',
        'POLICY' => 'Política',
        'GOAL' => 'Meta',
        'PROGRAM' => 'Programa',
        'SUBPROGRAM' => 'Subprograma',
        'DIRECTION'=>'Dirección',
        'INDICATOR' => 'Indicador/Meta',
        'RISK' => 'Riesgo',
        'PROJECT' => 'Proyecto',
        'code' => 'Código',
        'identifier' => 'Identificador',
        'description' => 'Descripción',
        'program_name' => 'Nombre Programa',
        'subprogram_name' => 'Nombre Subprograma',
        'product' => 'Producto',
        'production_goal' => 'Meta de Producción',
        'details' => 'Detalle :element',
        'update' => 'Actualizar :element',
        'edit' => 'Editar',
        'delete' => 'Eliminar',
        'manage' => 'Gestionar',
        'info' => 'Información del',
        'create' => 'Crear :element',
        'link' => 'Articulación',
        'name' => 'Nombre Indicador',
        'project_name' => 'Nombre Proyecto',
        'goal' => 'Meta',
        'isRoad' => 'Es Vial',
        'responsibleUnit' => 'Unidad Responsable',
        'dimension' => 'Dimensión',
        'scope_national_supranational' => 'Indicadores / Metas'
    ],

    'placeholders' => [
        'code' => 'Ej: 01',
        'name' => 'Ej: Reducción de la pobreza'
    ],

    'messages' => [
        'warning' => [
            'empty' => [
                'THRUST' => 'No se han ingresado Ejes',
                'OBJECTIVE' => 'No se han ingresado Objetivos',
                'PROGRAM' => 'No se han ingresado Programas',
                'SUBPROGRAM' => 'No se han ingresado Subprogramas',
                'INDICATOR' => 'No se han ingresado Indicadores',
                'PROJECT' => 'No se han ingresado Proyectos'
            ],
            'noIndicatorsProjectsGeneral' => 'Uno o varios Objetivos no disponen de Indicadores o Proyectos.',
            'noIndicatorsGeneral' => 'Uno o varios Objetivos no disponen de Indicadores.',
            'noProjectsGeneral' => 'Uno o varios :element no disponen de Proyectos.',

            'noIndicatorsProjectsIndividual' => 'El Objetivo no dispone de Indicadores y Proyectos.',
            'noIndicatorsIndividual' => 'El Objetivo no dispone de Indicadores.',
            'noProjectsIndividual' => 'El :element no dispone de Proyectos.',
            'noProjectsProgram' => 'Uno o varios Subprogramas no disponen de Proyectos.',

            'noLinks' => 'Uno o varios indicadores no se encuentran articulados'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el elemento del plan',
            'update' => 'Ha ocurrido un error al intentar actualizar el elemento del plan',
            'delete' => 'Ha ocurrido un error al intentar eliminar el elemento del plan'
        ],
        'success' => [
            'created' => ':element creado/a satisfactoriamente',
            'updated' => ':element actualizado/a satisfactoriamente',
            'deleted' => ':element eliminado/a satisfactoriamente'
        ],
        'exceptions' => [
            'not_found' => 'El elemento del plan no existe o no está disponible',
            'has_children' => 'No se puede completar la petición debido a que el :element tiene elementos asociados'
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el :element del Plan? Todos los elementos relacionados a este serán eliminados, incluyendo las articulaciones con otros planes',
            'deleteNoIndicators' => '¿Está seguro que desea eliminar el :element del Plan? Todos los elementos relacionados a este serán eliminados.'
        ],
        'validations' => [
            'uniqueCode' => 'El código de :element ya existe',
            'maxValue' => 'Ha excedido el valor máximo permitido.'
        ]
    ]

];
