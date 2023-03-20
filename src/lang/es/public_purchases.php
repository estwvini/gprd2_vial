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

    'title' => 'Compra pública',

    'labels' => [
        'title' => 'Compra pública',
        'item_purchase_list' => 'Listado de compras públicas',
        'create' => 'Crear compra pública',
        'edit' => 'Editar compra pública',
        'show' => 'Detalles compra pública',
        'delete' => 'Eliminar compra pública',
        'new' => 'Nueva compra pública',
        'cpc' => 'CPC',
        'cpc_description' => 'CPC Descripción',
        'international_funds' => 'Fondos internacionales',
        'c1' => 'C1',
        'c2' => 'C2',
        'c3' => 'C3',
        'regime_type' => 'Tipo de régimen',
        'budget_type' => 'Tipo de presupuesto',
        'hiring_type' => 'Tipo de contratación',
        'product_type' => 'Tipo de producto',
        'normalized' => 'Normalizado',
        'not_normalized' => 'No Normalizado',
        'procedure' => 'Procedimiento',
        'measure_unit' => 'Unidad Medida',
        'unit_price' => 'Precio unitario',
        'quantity' => 'Cantidad',
        'amount_no_vat' => 'Valor sin IVA',
        'amount_vat' => 'Valor con IVA',
        'budget_item' => 'Ítem presupuestario',
        'publicPurchaseValueTooltip' => 'El valor de la compra pública deberá ser modificado por medio de una reforma',
        'apply_vat' => 'Graba IVA?',
        'description' => 'Descripción'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la Compra Pública?'
        ],
        'success' => [
            'created' => 'Compra pública creada satisfactoriamente',
            'updated' => 'Compra pública actualizada satisfactoriamente',
            'deleted' => 'Compra pública eliminada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Compra pública',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Compra pública',
            'updated' => 'Ha ocurrido un error al intentar actualizar la Compra pública'
        ],
        'exceptions' => [
            'not_found' => 'La Compra Pública no existe o no está disponible',
            'not_available_budget' => 'No tiene presupuesto disponible para crear compras públicas'
        ],
    ]
];
