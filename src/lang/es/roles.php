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

    'title' => 'Roles',
    'title_dashboard' => 'Rol(es)',

    'labels' => [
        'create' => 'Crear rol',
        'new' => 'Nuevo rol',
        'update' => 'Actualizar rol',
        'edit' => 'Editar rol',
        'delete' => 'Eliminar rol',
        'details' => 'Detalles del rol :role',
        'permissions' => 'Permisos',
        'name' => 'Nombre del rol',
        'description' => 'Descripción del rol',
        'slug' => 'Slug',
        'info' => 'Información',
        'role' => 'Rol',
        'roles' => 'Roles',
        'role_permissions' => 'Permisos del rol',
        'check_all' => 'Asignar/Revocar todos los permisos',
        'permissions_over' => 'Permisos de :name sobre :label',
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el rol?',
            'delete_bulk' => '¿Está seguro que desea eliminar los roles seleccionados?',
            'create' => '¿Está seguro que desea crear el rol?',
            'update' => '¿Está seguro que desea actualizar el rol?',
            'status_on' => '¿Está seguro que desea habilitar el rol seleccionado?\n\nLos usuarios asociados a este rol podrán acceder al sistema.',
            'status_off' => '¿Está seguro que desea inhabilitar el rol seleccionado?\n\nLos usuarios asociados a este rol no podrán acceder al sistema.',
            'status_bulk' => '¿Está seguro que desea cambiar el estado a los roles seleccionados?',
        ],
        'success' => [
            'created' => 'Rol creado satisfactoriamente',
            'updated' => 'Rol actualizado satisfactoriamente',
            'permission_updated' => 'Permiso actualizado satisfactoriamente',
            'updated_bulk' => 'Roles modificados satisfactoriamente',
            'deleted' => 'Rol eliminado satisfactoriamente',
            'deleted_bulk' => 'Roles eliminados satisfactoriamente',
            'permissions' => 'Permiso actualizado satisfactoriamente',
        ],
        'validation' => [
            'role_exists' => 'El nombre del rol ya existe',
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el rol',
            'update' => 'Ha ocurrido un error al intentar actualizar el rol',
            'delete' => 'Ha ocurrido un error al intentar eliminar el rol',
            'has_users' => 'No se puede eliminar el rol :entities porque tiene usuarios asociados al mismo'
        ],
        'exceptions' => [
            'not_found' => 'El rol no existe o no está disponible',
        ],
    ]
];
