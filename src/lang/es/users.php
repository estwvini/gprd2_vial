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

    'user' => [
        'title' => 'Usuarios',
        'title_dashboard' => 'Usuario(s)',
        'title_change_password' => 'Cambiar contraseña',

        'labels' => [
            'create' => 'Crear usuario',
            'new' => 'Nuevo usuario',
            'edit' => 'Editar usuario',
            'update' => 'Actualizar',
            'details' => 'Detalles',
            'delete' => 'Eliminar el usuario',
            'delete_bulk' => 'Eliminar usuarios seleccionados',
            'status' => 'Habilitar/Inhabilitar usuario',
            'status_bulk' => 'Habilitar/Inhabilitar usuarios seleccionados',
            'role' => 'Rol',

            'first_name' => 'Nombre(s) del usuario',
            'last_name' => 'Apellido(s) del usuario',
            'email' => 'Correo Electrónico',
            'photo' => 'Foto',
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'password_confirm' => 'Confirmar contraseña',

            'info' => 'Información del usuario',
            'profile_title' => 'Perfil de usuario',
            'full_name' => 'Nombre',
            'created_at' => 'Creado',

            'select_role' => 'Seleccione el rol para el usuario',
            'change_password' => 'Modificar contraseña la primera vez',
            'responsible_department' => 'Responsable de Nivel Organizacional',
            'department' => 'Nivel Organizacional',
            'institution' => 'Institución Externa',
            'select_department' => 'Seleccionar Nivel Organizacional',
            'reset_password' => 'Restablecer contraseña',
            'user_type' => 'Tipo de nombre de usuario',
            'username_info' => 'Si el tipo de usuario es una cédula ecuatoriana, se validará que cumpla con la regla del dígito verificador.',
            'department_info' => 'Si el usuario es interno se seleccionará su respectivo nivel organizacional. Si es externo dejar este campo sin seleccionar y escribir
             en el siguiente el nombre de la institución a la que pertenece',
            'hiring_modality' => 'Modalidad de Contratación',
            'minlength' => 'Debe tener al menos 6 caracteres',
            'maxlength' => 'Debe tener 20 caracteres máximo',
            'wordLowercase' => 'Debe tener al menos una letra minúscula',
            'wordUppercase' => 'Debe tener al menos una letra mayúscula',
            'wordOneNumber' => 'Debe tener al menos un número',
            'wordOneSpecialChar' => 'Debe tener al menos un carácter especial'

        ],

        'placeholders' => [
            'username' => 'Usuario',
            'first_name' => 'José Luis',
            'last_name' => 'Pérez Rodríguez',
            'email' => 'jose.luis@email.com',
            'password' => 'Ingrese la contraseña',
            'password_confirm' => 'Confirme la contraseña',
            'document_type' => 'Seleccione tipo de identificación',
            'document' => 'Identificación del usuario',
            'institution' => 'Institución Externa'
        ],

        'headers' => [
            'username' => 'Usuario',
        ],

        'messages' => [
            'confirm' => [
                'reset' => '¿Está seguro que desea restablecer la contraseña?',
                'user_type' => 'Marcar cuando el usuario tenga cédula ecuatoriana',
                'delete' => '¿Está seguro que desea eliminar el usuario?',
                'update' => '¿Está seguro que desea actualizar el usuario?',
                'delete_bulk' => '¿Está seguro que desea eliminar los usuarios seleccionados?',
                'status_bulk' => '¿Está seguro que desea cambiar el estado a los usuarios seleccionados?',
                'status_on' => '¿Está seguro que desea habilitar al usuario seleccionado?\n\nEl usuario podrá acceder al sistema.',
                'status_off' => '¿Está seguro que desea inhabilitar al usuario seleccionado?\n\nEl usuario no podrá acceder al sistema.',
            ],
            'success' => [
                'created' => 'Usuario creado satisfactoriamente',
                'updated' => 'Usuario actualizado satisfactoriamente',
                'updated_bulk' => 'Usuarios actualizados satisfactoriamente',
                'deleted' => 'Usuario eliminado satisfactoriamente',
                'deleted_bulk' => 'Usuarios eliminados satisfactoriamente',
                'password_changed' => 'Contraseña actualizada satisfactoriamente',
            ],
            'validation' => [
                'document_exists' => 'El documento ya existe',
                'username_exists' => 'El nombre de usuario ya existe',
                'email_exists' => 'El correo electrónico ya existe',
                'extension' => 'El archivo debe tener la extensión jpg ó jpeg ó png',
                'password_check' => 'Las contraseñas no coinciden'
            ],
            'errors' => [
                'create' => 'Ha ocurrido un error al intentar crear el usuario',
                'update' => 'Ha ocurrido un error al intener actualizar el usuario',
                'delete' => 'Ha ocurrido un error al intentar eliminar el usuario',
                'delete_relation' => 'No puede eiminar el usuario ya que es lider de un nivel organizacional',
                'password' => 'Ha ocurrido un error al intentar cambiar la contraseña',
            ],
            'exceptions' => [
                'not_found' => 'El usuario no existe o no está disponible',
            ],
        ],
    ]
];
