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

    'title' => 'Configuración',

    'permission' => [
        'title' => 'Permisos',

        'labels' => [
            'create' => 'Crear permiso',
            'new' => 'Nuevo permiso',
            'edit' => 'Editar permiso',
            'update' => 'Actualizar permiso',
            'details' => 'Detalles del permiso',
            'delete' => 'Eliminar permiso',
            'delete_bulk' => 'Eliminar permisos seleccionados',

            'name' => 'Nombre del permiso',
            'label' => 'Label del permiso',
            'description' => 'Descripción del permiso',

            'example' => 'Dato de ejemplo del campo',
            'suggestion' => 'Sugerencia'
        ],
        
        'headers' => [
            'label' => 'Label',
            'name' => 'Nombre del Campo',
        ],

        'messages' => [
            'confirm' => [
                'delete' => '¿Está seguro que desea eliminar el permiso?',
                'delete_bulk' => '¿Está seguro que desea eliminar los permisos seleccionados?',
                'status_bulk' => '¿Está seguro que desea cambiar el estado a los permisos seleccionados?',
            ],
            'success' => [
                'created' => 'Permiso creado satisfactoriamente',
                'updated' => 'Permiso actualizado satisfactoriamente',
                'updated_bulk' => 'Permisos actualizados satisfactoriamente',
                'deleted' => 'Permiso eliminado satisfactoriamente',
                'deleted_bulk' => 'Permisos eliminados satisfactoriamente',
            ],
            'errors' => [
                'create' => 'Ha ocurrido un error al intentar crear el permiso',
                'show' => 'Ha ocurrido un error al intentar obtener los detalles del permiso',
                'update' => 'Ha ocurrido un error al intentar actualizar el permiso',
                'update_bulk' => 'Ha ocurrido un error al intentar actualizar los permisos',
                'delete' => 'Ha ocurrido un error al intentar eliminar el permiso',
                'delete_bulk' => 'Ha ocurrido un error al intentar eliminar los permisos',
            ],
            'exceptions' => [
                'not_found' => 'El permiso no existe o no está disponible',
            ],
            'warning' => [
                'update' => 'El nombre del permiso está atado a la programación, modifique solo si está seguro de lo que hace.',
                'delete' => 'El nombre del permiso está atado a la programación, elimine solo si está seguro de lo que hace.',
            ],
        ],
    ],

    'role' => [
        'title' => 'Roles',

        'labels' => [
            'create' => 'Crear rol',
            'new' => 'Nuevo rol',
            'edit' => 'Editar rol',
            'update' => 'Actualizar permisos',
            'details' => 'Detalles del rol',
            'permissions' => 'Permisos del rol :role',
            'delete' => 'Eliminar rol',
            'delete_bulk' => 'Eliminar roles seleccionados',
            'status' => 'Habilitar/Inhabilitar rol',
            'status_bulk' => 'Habilitar/Inhabilitar roles seleccionados',
            'editable' => 'Marcar/Desmarcar rol como editable',
            'name' => 'Nombre del rol',
            'description' => 'Descripción del rol',
        ],

        'headers' => [
            'slug' => 'Slug',
            'editable' => 'Editable',
        ],

        'messages' => [
            'confirm' => [
                'delete' => '¿Está seguro que desea eliminar el rol?',
                'delete_bulk' => '¿Está seguro que desea eliminar los roles seleccionados?',
                'status_bulk' => '¿Está seguro que desea cambiar el estado a los roles seleccionados?',
            ],
            'success' => [
                'created' => 'Rol creado satisfactoriamente',
                'updated' => 'Rol actualizado satisfactoriamente',
                'updated_bulk' => 'Roles actualizados satisfactoriamente',
                'deleted' => 'Rol eliminado satisfactoriamente',
                'deleted_bulk' => 'Roles eliminados satisfactoriamente',
                'permissions' => 'Permiso actualizado satisfactoriamente',
            ],
            'errors' => [
                'create' => 'Ha ocurrido un error al intentar crear el rol',
                'show' => 'Ha ocurrido un error al intentar obtener los detalles del rol',
                'update' => 'Ha ocurrido un error al intentar actualizar el rol',
                'update_bulk' => 'Ha ocurrido un error al intentar actualizar los roles',
                'delete' => 'Ha ocurrido un error al intentar eliminar el rol',
                'delete_bulk' => 'Ha ocurrido un error al intentar eliminar los roles',
                'permissions' => 'Ha ocurrido un error al intentar actualizar el permiso',
            ],
            'exceptions' => [
                'not_found' => 'El rol no existe o no está disponible',
            ],
        ],
    ],

    'menu' => [
        'title' => 'Menús',

        'labels' => [
            'create' => 'Crear menú',
            'new' => 'Nuevo menú',
            'edit' => 'Editar menú',
            'update' => 'Actualizar menú',
            'details' => 'Detalles del menú',
            'delete' => 'Eliminar menú',
            'delete_bulk' => 'Eliminar menús seleccionados',
            'status' => 'Habilitar/Inhabilitar menú',
            'status_bulk' => 'Habilitar/Inhabilitar menús seleccionados',

            'label' => 'Label del menú',
            'slug' => 'Slug del menú',
            'icon' => 'Icon del menú',
            'weight' => 'Peso del menú',

            'no_parent' => '- Ninguno -',
        ],

        'headers' => [
            'parent' => 'Menú padre',
            'label' => 'Label',
            'slug' => 'Slug',
            'icon' => 'Icon',
            'weight' => 'Peso',
        ],

        'messages' => [
            'confirm' => [
                'delete' => '¿Está seguro que desea eliminar el menú?',
                'delete_bulk' => '¿Está seguro que desea eliminar los menús seleccionados?',
                'status_bulk' => '¿Está seguro que desea cambiar el estado a los menús seleccionados?',
            ],
            'success' => [
                'created' => 'Menú creado satisfactoriamente',
                'updated' => 'Menú actualizado satisfactoriamente',
                'updated_bulk' => 'Menús actualizados satisfactoriamente',
                'deleted' => 'Menú eliminado satisfactoriamente',
                'deleted_bulk' => 'Menús eliminados satisfactoriamente',
            ],
            'errors' => [
                'create' => 'Ha ocurrido un error al intentar crear el menú',
                'show' => 'Ha ocurrido un error al intentar obtener los detalles del menú',
                'update' => 'Ha ocurrido un error al intentar actualizar el menú',
                'update_bulk' => 'Ha ocurrido un error al intentar actualizar los menús',
                'delete' => 'Ha ocurrido un error al intentar eliminar el menú',
                'delete_bulk' => 'Ha ocurrido un error al intentar eliminar los menús',
            ],
            'exceptions' => [
                'not_found' => 'El menú no existe o no está disponible',
            ],
        ],
    ],

    'ui' => [
        'title' => 'UI',

        'labels' => [
            'edit' => 'Editar UI',
            'update' => 'Actualizar UI',
            'menu_color' => 'Color menú',
            'menu_active_color' => 'Color menú activo',
            'text_color' => 'Color texto',
            'login_logo' => 'Logo inicio',
            'menu_logo' => 'Logo menú',
            'system_name' => 'Nombre sistema',
            'system_slogan' => 'Lema sistema',
            'footer' => 'Footer inicio',
        ],

        'messages' => [
            'success' => [
                'updated' => 'UI actualizado satisfactoriamente',
            ],
            'errors' => [
                'update' => 'Ha ocurrido un error al intentar actualizar el UI',
            ],
            'exceptions' => [
                'not_settings' => 'La tabla Settings no posee valores. Debe ejecutar el seeder.',
            ],
        ],
    ],

    'setting' => [
        'title' => 'Ajustes',

        'labels' => [
            'edit' => 'Editar ajustes',
            'update' => 'Actualizar ajustes',

            'key' => 'Clave',
            'value' => 'Valor',
        ],

        'messages' => [
            'success' => [
                'updated' => 'Ajuste actualizado satisfactoriamente',
            ],
            'errors' => [
                'update' => 'Ha ocurrido un error al intentar actualizar el menú',
            ],
            'exceptions' => [
                'not_found' => 'El menú no existe o no está disponible',
            ],
        ],
    ],

    'configuration' => [
        'messages' => [
            'errors' => [
                'validate_field' => 'No se pudo verificar si el campo ya existe.',
            ]
        ]
    ]
];
