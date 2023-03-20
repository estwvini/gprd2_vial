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

    'title' => 'Niveles Organizacionales',
    'title_dashboard' => 'Nivel(es) Organizacional(es)',

    'labels' => [
        'create' => 'Crear Nivel Organizacional',
        'new' => 'Nuevo Nivel Organizacional',
        'update' => 'Actualizar Nivel Organizacional',
        'edit' => 'Editar Nivel Organizacional',
        'details' => 'Detalles del Nivel Organizacional',
        'delete' => 'Eliminar Nivel Organizacional',
        'parent_department' => 'Pertenece a',
        'department_children' => 'Niveles Organizacionales Asociados',
        'manager' => 'Responsable',
        'phone_number' => 'Teléfono',
        'info' => 'Información del Nivel Organizacional',
        'code' => 'Código'
    ],

    'placeholders' => [
        'name' => 'Nombre del nivel organizacional',
        'description' => 'Descripción del nivel organizacional',
        'phone_number' => 'Número telefónico del nivel organizacional',
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el nivel organizacional?',
            'create' => '¿Está seguro que desea crear el nivel organizacional?',
            'update' => '¿Está seguro que desea actualizar el nivel organizacional?',
            'status_on' => '¿Está seguro que desea habilitar el nivel organizacional seleccionado?',
            'status_off' => '¿Está seguro que desea inhabilitar el nivel organizacional seleccionado?',
        ],
        'success' => [
            'created' => 'Nivel organizacional creado satisfactoriamente',
            'updated' => 'Nivel organizacional actualizado satisfactoriamente',
            'deleted' => 'Nivel organizacional eliminado satisfactoriamente',
        ],
        'validation' => [
            'department_exists' => 'El nombre del nivel organizacional ya existe',
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el nivel organizacional',
            'update' => 'Ha ocurrido un error al intentar actualizar el nivel organizacional',
            'delete' => 'Ha ocurrido un error al intentar eliminar el nivel organizacional'
        ],
        'exceptions' => [
            'not_found' => 'El nivel organizacional no existe o no está disponible',
            'has_users' => 'No se puede completar la petición debido a que el nivel organizacional tiene usuarios asociados',
            'has_projects' => 'No se puede completar la petición debido a que el nivel organizacional tiene proyectos asociados',
            'has_activities' => 'No se puede completar la petición debido a que el nivel organizacional tiene actividades operativas asociadas',
            'has_children_departments' => 'No se puede completar la petición debido a que el nivel organizacional tiene otros niveles asociados',
            'disabled_parent' => 'No se puede completar la petición debido a que el nivel organizacional al que pertenece se encuentra deshabilitado',
            'max' => 'Ha sobrepasado el número máximo de niveles organizacionales permitidos'
        ],
    ]
];
