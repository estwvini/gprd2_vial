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

    'title' => 'Instituciones',

    'labels' => [
        'create' => 'Crear Institución',
        'new' => 'Nueva Institución',
        'update' => 'Actualizar Institución',
        'edit' => 'Editar Institución',
        'delete' => 'Eliminar Institución',
        'name' => 'Nombre',
        'code' => 'Código'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la Institución?',
            'status_on' => '¿Está seguro que desea habilitar la Institución seleccionada?',
            'status_off' => '¿Está seguro que desea inhabilitar la Institución seleccionada?'
        ],
        'success' => [
            'created' => 'Institución creada satisfactoriamente',
            'updated' => 'Institución actualizada satisfactoriamente',
            'deleted' => 'Institución eliminada satisfactoriamente',
            'status_on' => 'Institución habilitada satisfactoriamente',
            'status_off' => 'Institución inhabilitada satisfactoriamente'
        ],
        'validation' => [
            'name_exists' => 'El nombre de la Institución ya existe',
            'code_exists' => 'El código de la Institución ya existe',
            'has_budgetItems' => 'No se puede completar la petición debido a que la institución tiene partidas presupuestarias de gasto asociadas',
            'has_incomes' => 'No se puede completar la petición debido a que la institución tiene partidas presupuestarias de ingreso asociadas'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Institución',
            'update' => 'Ha ocurrido un error al intentar actualizar la Institución',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Institución'
        ],
        'exceptions' => [
            'not_found' => 'La Institución no existe o no está disponible',
            'has_indicators' => 'La Institución tiene indicadores relacionados'
        ],
        'info' => [
            'code' => 'El código es la combinación del valor UDAF y el EOD en ese orden. Tanto UDAF como EOD se deben completar con ceros adelante hasta completar la longitud 
             Ej: UDAF 4 => 004 - EOD 3 => 0003 Código 004-0003'
        ]
    ]
];
