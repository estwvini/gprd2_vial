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

    'title' => 'Compras Públicas',

    'labels' => [
        'create' => 'Crear compra pública',
        'new' => 'Nueva compra pública',
        'update' => 'Actualizar compra pública',
        'edit' => 'Editar compra pública',
        'details' => 'Detalles de compra pública',
        'delete' => 'Eliminar compra pública',
        'code' => 'Código',
        'info' => 'Información de la compra pública'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la compra pública?',
            'status_on' => '¿Está seguro que desea habilitar la compra pública seleccionada?',
            'status_off' => '¿Está seguro que desea inhabilitar la compra pública seleccionada?'
        ],
        'success' => [
            'created' => 'Compra pública creada satisfactoriamente',
            'updated' => 'Compra pública actualizada satisfactoriamente',
            'deleted' => 'Compra pública eliminada satisfactoriamente',
            'status_on' => 'Compra pública habilitada satisfactoriamente',
            'status_off' => 'Compra pública inhabilitada satisfactoriamente'
        ],
        'validation' => [
            'code_exists' => 'El código de la compra pública ya existe',
            'description_exists' => 'La descripción de la compra pública ya existe',
            'has_purchases' => 'No se puede completar la petición debido a que el cpc tiene compras asociadas',
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la compra pública',
            'update' => 'Ha ocurrido un error al intentar actualizar la compra pública',
            'delete' => 'Ha ocurrido un error al intentar eliminar la compra pública',
        ],
        'exceptions' => [
            'not_found' => 'La compra pública no existe o no está disponible'
        ]
    ]
];
