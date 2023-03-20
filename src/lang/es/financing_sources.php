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

    'title' => 'Fuentes de Financiamiento',

    'labels' => [
        'create' => 'Crear fuente de financiamiento',
        'new' => 'Nueva fuente de financiamiento',
        'update' => 'Actualizar fuente de financiamiento',
        'edit' => 'Editar fuente de financiamiento',
        'details' => 'Detalles de fuente de financiamiento',
        'delete' => 'Eliminar fuente de financiamiento',
        'code' => 'Código fuente',
        'info' => 'Información de la fuente de financiamiento',
        'income' => 'Ingresos',
        'expense' => 'Gastos'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la fuente de financiamiento?',
            'status_on' => '¿Está seguro que desea habilitar la fuente de financiamiento seleccionada?',
            'status_off' => '¿Está seguro que desea inhabilitar la fuente de financiamiento seleccionada?'
        ],
        'success' => [
            'created' => 'Fuente de financiamiento creada satisfactoriamente',
            'updated' => 'Fuente de financiamiento actualizada satisfactoriamente',
            'deleted' => 'Fuente de financiamiento eliminada satisfactoriamente',
            'enabled' => 'Fuente de financiamiento habilitada satisfactoriamente',
            'disabled' => 'Fuente de financiamiento inhabilitada satisfactoriamente'
        ],
        'validation' => [
            'code_exists' => 'El código de la fuente de financiamiento ya existe',
            'description_exists' => 'La descripción de la fuente de financiamiento ya existe',
            'has_budgetItems' => 'No se puede completar la petición debido a que la fuente tiene partidas presupuestarias de gasto asociadas',
            'has_incomes' => 'No se puede completar la petición debido a que la fuente tiene partidas presupuestarias de ingreso asociadas'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la fuente de financiamiento',
            'update' => 'Ha ocurrido un error al intentar actualizar la fuente de financiamiento',
            'delete' => 'Ha ocurrido un error al intentar eliminar la fuente de financiamiento'
        ],
        'exceptions' => [
            'not_found' => 'La fuente de financiamiento no existe o no está disponible',
            'exist' => 'No se ha podido completar la operación. Existe una partida presupuestaria con la codificación que está intentando crear.',
        ]
    ]
];
