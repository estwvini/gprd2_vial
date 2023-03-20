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

    'title' => 'Clasificador Presupuestario',

    'labels' => [
        'level' => 'Nivel',
        'level_1' => 'Naturaleza',
        'level_2' => 'Grupo',
        'level_3' => 'Subgrupo',
        'level_default' => 'Ítem',
        'create' => 'Crear :type',
        'create_default' => 'Crear Ítem',
        'new' => 'Nueva(o) :type',
        'new_default' => 'Nuevo Ítem',
        'update' => 'Actualizar :type',
        'edit' => 'Editar :type',
        'edit_default' => 'Editar Ítem',
        'details' => 'Detalles :type',
        'delete' => 'Eliminar :type',
        'delete_default' => 'Eliminar Ítem',
        'code' => 'Código',
        'title' => 'Título',
        'info' => 'Información de Clasificador Presupuestario',
        'parent' => 'Pertenece a'
    ],

    'placeholders' => [
        'code' => 'Código de :type',
        'code_default' => 'Código de Ítem',
        'title' => 'Título de :type',
        'title_default' => 'Título de Ítem',
        'description' => 'Descripción de :type',
        'description_default' => 'Descripción de Ítem'
    ],

    'messages' => [
        'info' => [
            'codeInfo' => 'El código se estructura de la siguiente forma: (Naturaleza).(Grupo).(Subgrupo).(Ítem)'
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar :type?',
            'delete_default' => '¿Está seguro que desea eliminar el Ítem?',
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
            'title_exists' => 'El título de :type ya existe',
            'description_exists' => 'La descripción de :type ya existe'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el registro',
            'update' => 'Ha ocurrido un error al intentar actualizar el registro',
            'delete' => 'Ha ocurrido un error al intentar eliminar el registro'
        ],
        'exceptions' => [
            'not_found' => 'El clasificador presupuestario no existe o no está disponible',
            'has_children' => 'No se puede completar la petición debido a que la entidad tiene elementos asociados',
            'parent_disabled' => 'No se puede completar la petición debido a que el elemento padre está deshabilitado',
            'has_budgetItems' => 'No se puede completar la petición debido a que el elemento  tiene partidas presupuestarias de gasto asociadas',
            'has_incomes' => 'No se puede completar la petición debido a que el elemento tiene partidas presupuestarias de ingreso asociadas'
        ]
    ]
];
