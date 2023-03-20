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

    'title' => 'Empleados',

    'labels' => [
        'create' => 'Crear empleado',
        'new' => 'Nuevo empleado',
        'edit' => 'Editar empleado',
        'update' => 'Actualizar',
        'details' => 'Detalles',
        'delete' => 'Eliminar el empleado',
        'name' => 'Nombre',
        'first_name' => 'Nombre(s) del empleado',
        'last_name' => 'Apellido(s) del empleado',
        'email' => 'Correo Electrónico',
        'phone' => 'Número Telefónico',
        'document' => 'Identificación',
        'info' => 'Información del empleado',
        'user_info' => 'Información de usuario',
        'create_user' => 'Asignar rol al empleado',
        'department' => 'Nivel Organizacional'
    ],

    'placeholders' => [
        'first_name' => 'Ej: José Luis',
        'last_name' => 'Ej: Pérez Rodríguez',
        'email' => 'Ej: jose.luis@email.com',
        'phone' => 'Ej: 0984324566',
        'document_type' => 'Seleccione tipo de identificación',
        'document' => 'Identificación del empleado',
        'department' => 'Seleccione una Dirección',
        'hiring_modality' => 'Seleccione una Modalidad de Contratación'
    ],

    'headers' => [
        'username' => 'Empleado',
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el empleado?',
            'update' => '¿Está seguro que desea actualizar el empleado?',
        ],
        'success' => [
            'created' => 'Empleado creado satisfactoriamente',
            'updated' => 'Empleado actualizado satisfactoriamente',
            'deleted' => 'Empleado eliminado satisfactoriamente'
        ],
        'validation' => [
            'document_exists' => 'El documento ya existe',
            'username_exists' => 'El nombre de empleado ya existe',
            'email_exists' => 'El correo electrónico ya existe'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el empleado',
            'update' => 'Ha ocurrido un error al intentar actualizar el empleado',
            'delete' => 'Ha ocurrido un error al intentar eliminar el empleado'
        ],
        'exceptions' => [
            'not_found' => 'El empleado no existe o no está disponible'
        ],
        'info' => [
            'no_user' => 'El empleado no dispone de un usuario en el sistema'
        ]
    ],

];
