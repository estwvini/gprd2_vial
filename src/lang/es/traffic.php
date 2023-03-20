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

    'title' => 'Tráfico',

    'labels' => [
        'create' => 'Crear Tráfico',
        'create_day_type' => 'Crear Tipo de Día',
        'new' => 'Nuevo Tráfico',
        'new_day_type' => 'Nuevo Tipo de Día',
        'update' => 'Actualizar Tráfico',
        'edit' => 'Editar Tráfico',
        'details' => 'Detalles del Tráfico',
        'gid' => 'Número identificador',
        'numlivianos' => 'Número vehículos livianos',
        'tranlivianos' => 'Transitabilidad vehículos livianos',
        'numbuses' => 'Número buses',
        'tranbuses' => 'Transitabilidad buses',
        'num2ejes' => 'Vehículos de 2 Ejes',
        'tran2ejes' => 'Número vehículos 2 Ejes',
        'num3ejes' => 'Vehículos de 3 Ejes',
        'tran3ejes' => 'Número vehículos 3 Ejes',
        'num4ejes' => 'Vehículos de 4 Ejes',
        'tran4ejes' => 'Número vehículos 4 Ejes',
        'num5ejes' => 'Vehículos de 5 Ejes',
        'tran5ejes' => 'Número vehículos 5 Ejes',
        'total tráfico' => 'Total tráfico',
        'tipo_dia_codigo' => 'Código día',
        'dias_semana' => 'Día',
        'code' => 'Código',
        'description' => 'Descripción',
        'day_type' => 'Tipo de día'

    ],
    'placeholders' => [
        'gid' => 'Número identificador en orden secuencial',
        'numlivianos' => 'Número de vehículos livianos',
        'tranlivianos' => 'Número de meses de transitabilidad de los vehículos livianos',
        'numbuses' => 'Número de vehículos tipo buses.',
        'tranbuses' => 'Número de meses de transitabilidad de los buses',
        'num2ejes' => 'Número de vehículos de tipo 2 Ejes.',
        'tran2ejes' => 'Número de meses de transitabilidad de los vehículos de 2 ejes',
        'num3ejes' => 'Número de vehículos de tipo 3 Ejes.',
        'tran3ejes' => 'Número de meses de transitabilidad de los vehículos de 3 ejes',
        'num4ejes' => 'Número de vehículos de tipo 4 Ejes',
        'tran4ejes' => 'Número de meses de transitabilidad de los vehículos de 4 ejes',
        'num5ejes' => 'Número de vehículos de tipo 5 Ejes.',
        'tran5ejes' => 'Número de meses de transitabilidad de los vehículos de 5 ejes',
        'total tráfico' => 'Número de tráfico total',
        'tipo_dia_codigo' => 'Código del tipo de día',
        'dias_semana' => 'Día de la semana en el que se realizó el conteo'
    ],
    'messages' => [
        'success' => [
            'created' => 'Tráfico creado satisfactoriamente',
            'day_type_created' => 'Tipo de día creado satisfactoriamente',
            'updated' => 'Tráfico actualizado satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Tráfico',
            'create_day_type' => 'Ha ocurrido un error al intentar crear el Tipo de día',
            'update' => 'Ha ocurrido un error al intentar actualizar el Tráfico'
        ],
        'validations' => [
            'day_type_uniqueDesc' => 'La descripción del tipo de día ya existe'
        ],
        'exceptions' => [
            'not_found' => 'El Tráfico no existe o no está disponible'
        ]
    ]
];
