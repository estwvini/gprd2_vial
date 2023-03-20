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

    'title' => 'Orientación del Gasto',

    'labels' => [
        'level_1' => 'Orientación',
        'level_2' => 'Direccionamiento',
        'level_3' => 'Categoría',
        'level_4' => 'SubCategoría',
        'level' => 'Nivel',
        'create' => 'Crear :type',
        'new' => 'Nueva(o) :type',
        'update' => 'Actualizar :type',
        'edit' => 'Editar :type',
        'details' => 'Detalles :type',
        'delete' => 'Eliminar :type',
        'code' => 'Código',
        'info' => 'Información de :type',
        'parent' => 'Pertenece a',
        'type' => 'Tipo',
        'spending_orientation' =>'Orientación del Gasto',
        'name' => 'Nombre'
    ],

    'placeholders' => [
        'code' => 'Código de :type (e.j. 05)',
        'simple_code' => 'Código (e.j. 05)',
        'description' => 'Descripción de :type',
        'name' => 'Nombre'
    ],

    'messages' => [
        'info' => [
            'codeInfo' => 'El código sigue se estructura de la siguiente forma: {Orientación}.{Direccionamiento}.{Categoría}'
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar :type?',
            'status_on' => '¿Está seguro que desea habilitar :type?',
            'status_off' => '¿Está seguro que desea inhabilitar :type?'
        ],
        'success' => [
            'created' => ':type creada(o) satisfactoriamente',
            'updated' => ':type actualizada(o) satisfactoriamente',
            'deleted' => ':type eliminada(o) satisfactoriamente',
            'status_on' => ':type habilitada(o) satisfactoriamente',
            'status_off' => ':type inhabilitada(o) satisfactoriamente'
        ],
        'validation' => [
            'code_exists' => 'El código de :type ya existe',
            'code_exists_general' => 'El código ya existe',
            'description_exists' => 'La descripción de :type ya existe',
            'description_exists_general' => 'La descripción ya existe'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el registro',
            'update' => 'Ha ocurrido un error al intentar actualizar el registro',
            'delete' => 'Ha ocurrido un error al intentar eliminar el registro'
        ],
        'exceptions' => [
            'not_found' => 'Entidad no existe o no está disponible',
            'has_children' => 'No se puede completar la petición debido a que la entidad tiene elementos asociados',
            'parent_disabled' => 'No se puede completar la petición debido a que el elemento padre está deshabilitado',
            'has_budgetItems' => 'No se puede completar la petición debido a que el elemento  tiene partidas presupuestarias de gasto asociadas',
        ]
    ]
];
