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

    'title' => 'Unidades de Medida',

    'labels' => [
        'create' => 'Crear Unidad de Medida',
        'new' => 'Nueva Unidad de Medida',
        'update' => 'Actualizar Unidad de Medida',
        'edit' => 'Editar Unidad de Medida',
        'delete' => 'Eliminar Unidad de Medida',
        'name' => 'Nombre',
        'abbreviation' => 'Abreviatura'
    ],

    'messages' => [
        'info' => [
            'abbreviation' => 'En el caso de no existir abreviatura por favor ingresar nuevamente el nombre de la unidad de medida'
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la Unidad de Medida?',
            'status_on' => '¿Está seguro que desea habilitar la Unidad de Medida seleccionada?',
            'status_off' => '¿Está seguro que desea inhabilitar la Unidad de Medida seleccionada?'
        ],
        'success' => [
            'created' => 'Unidad de Medida creada satisfactoriamente',
            'updated' => 'Unidad de Medida actualizada satisfactoriamente',
            'deleted' => 'Unidad de Medida eliminada satisfactoriamente',
            'status_on' => 'Unidad de Medida habilitada satisfactoriamente',
            'status_off' => 'Unidad de Medida inhabilitada satisfactoriamente'
        ],
        'validation' => [
            'name_exists' => 'El nombre de la Unidad de Medida ya existe',
            'abbreviation_exists' => 'La abreviatura de la Unidad de Medida ya existe'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Unidad de Medida',
            'update' => 'Ha ocurrido un error al intentar actualizar la Unidad de Medida',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Unidad de Medida'
        ],
        'exceptions' => [
            'not_found' => 'La Unidad de Medida no existe o no está disponible',
            'has_indicators' => 'La Unidad de Medida tiene indicadores relacionados',
            'has_purchases' => 'La Unidad de Medida tiene compras relacionados'
        ]
    ]
];
