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

    'title' => 'Actividades Administrativas',

    'labels' => [
        'create' => 'Crear Actividad',
        'new' => 'Nueva actividad',
        'edit' => 'Editar actividad',
        'responsibleUnit' => 'Unidad responsable',
        'activity' => 'Actividad',
        'show_activity' => 'Ver Actividad',
        'assigned' => 'Asignado a',
        'qualification'=>'Calificación',
        'assigned_by_me' => 'Asignadas por mí',
        'responsible_unit' => 'Unidad responsable',
        'status' => 'Estado',
        'status_DRAFT' => 'Pendiente',
        'status_IN_PROGRESS' => 'En curso',
        'status_COMPLETED' => 'Completada',
        'status_CANCELED' => 'Cancelada',
        'qualification_EXCELLENT'=>'EXCELENTE',
        'qualification_VERY_GOOD'=>'MUY BUENO',
        'qualification_SATISFACTORY'=>'SATISFACTORIO',
        'qualification_DEFICIENT'=>'DEFICIENTE',
        'qualification_UNACCEPTABLE'=>'INACEPTABLE',
        'priority' => 'Prioridad',
        'priority_4' => 'Urgente',
        'priority_3' => 'Importante',
        'priority_2' => 'Media',
        'priority_1' => 'Baja',
        'date_init' => 'Fecha de inicio',
        'date_end' => 'Fecha de vencimiento',
        'frequency' => 'Repetir cada',
        'frequency_1' => 'Días',
        'frequency_2' => 'Semanas',
        'frequency_3' => 'Meses',
        'never' => 'Nunca',
        'frequency_limit' => 'Repetir hasta',
        'planned_hours' => 'Estimación original',
        'time_spent' => 'Seguimiento de tiempo',
        'description' => 'Descripción',
        'delete' => 'Eliminar Actividad',
        'attachments' => 'Datos adjuntos',
        'attachments_detail' => 'Arrastre multiples archivos al área de abajo o haga click para seleccionarlos. Los archivos se cargarán automáticamente',
        'attachments_zone' => 'Suelte los archivos aquí ó click para seleccionar',
        'automatic_upload' => 'Los archivos se cargarán automáticamente.',
        'drop_zone' => 'Datos adjuntos',
        'comments' => 'Comentarios',
        'send' => 'Enviar',
        'activity_type' => 'Tipo de actividad',
        'cancel_reason' => 'Motivo de cancelación',
        'admin_tracking' => 'Convertir en Actividad Administrativa',
        'check_list' => 'Lista de comprobación (L.C.)',
        'registered' => 'Registrado',
        'remaining' => 'Restante',
        'over' => 'Por encima',
        'list' => 'Lista',
        'calendar' => 'Calendario',
        'graphic' => 'Gráfico',
        'Administrative_Activity_Completed'=>'Actividad Administrativa Completada',
        'percentage_checkList'=>'% avance L.C'
    ],

    'placeholders' => [
        'name' => 'Nombre de la actividad',
        'description' => 'Escriba una descripción o agregue notas aquí',
        'comments' => 'Escribe aquí tu mensaje',
        'planned_hours' => 'Estimación en Horas',
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la Actividad?',
        ],
        'exceptions' => [
            'not_found' => 'La actividad no existe o no está disponible',
            'user_assigned_not_found' => 'El usuario asignado no existe o no está disponible',
            'department_not_found' => 'El usuario asignado no está asociado a ningún departamento o dirección',
            'fiscal_year_not_found' => 'El año fiscal no existe o no está disponible',
        ],
        'success' => [
            'created' => 'Actividad creada satisfactoriamente',
            'updated' => 'Actividad actualizada satisfactoriamente',
            'deleted' => 'Actividad eliminada satisfactoriamente',
            'file' => 'Archivo :name cargado  satisfactoriamente',
            'file_deleted' => 'Archivo eliminado satisfactoriamente',
            'comment_created' => 'Comentario creado satisfactoriamente',
        ],
        'validation' => [
            'table_empty_message' => 'No existe información a mostrar',
            'no_files' => 'No existen archivos adjuntos.',
            'no_files_completed' => 'Para completar la actividad es requerido al menos un archivo de respaldo.'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Actividad',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Actividad',
            'not_found' => 'La Actividad no existe o no está disponible',
            'update' => 'Ha ocurrido un error al intentar actualizar la Actividad',
            'file' => 'Ha ocurrido un error al intentar cargar los archivos'
        ]
    ]
];
