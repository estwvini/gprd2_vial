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

    'title' => 'Actividades Operacionales',

    'labels' => [
        'OPERATIONAL_ACTIVITY' => 'Actividad Operativa',
        'create' => 'Crear Actividad Operativa',
        'details' => 'Detalle Actividad Operativa',
        'update' => 'Actualizar Actividad Operativa',
        'code' => 'Código',
        'name' => 'Nombre Actividad Operativa',
        'responsibleUnit' => 'Unidad Responsable',
        'area' => 'Área',
        'executingUnit' => 'Unidad Ejecutora',
        'total' => 'Total'
    ],

    'placeholders' => [
        'code' => 'Ej: 001',
        'name' => 'Ej: Actividad Interna',
        'total' => 'Ej: 800000.00'
    ],

    'messages' => [
        'success' => [
            'create' => 'Actividad Operativa almacenada satisfactoriamente',
            'update' => 'Actividad Operativa actualizada satisfactoriamente',
            'delete' => 'Actividad Operativa eliminada satisfactoriamente'
        ],
        'exceptions' => [
            'not_found' => 'Actividad Operativa no existe o no está disponible',
            'parent_not_found' => 'Subprograma no existe o no está disponible',
            'items_not_found' => 'La actividad no tiene Partidas Presupuestarias',
            'has_children' => 'No se puede eliminar la Actividad Operativa porque tiene Partidas Presupuestarias asociadas. Por favor elimine primero las Partidas Presupuestarias para poder eliminar la Actividad Operativa.'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Actividad Operativa',
            'update' => 'Ha ocurrido un error al intentar actualizar la Actividad Operativa',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Actividad Operativa'
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la Actividad Operativa?'
        ],
        'validations' => [
            'uniqueCode' => 'El código de la Actividad Operativa ya existe',
            'uniqueName' => 'El nombre de la Actividad Operativa ya existe'
        ]
    ]
];
