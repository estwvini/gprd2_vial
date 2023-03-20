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

    'title' => 'Avance Físico',

    'labels' => [
        'type' => [
            'ACTIVITY' => 'Actividad',
            'TASK' => 'Tarea',
            'MILESTONE' => 'Hito'
        ],
        'schedule' => 'Cronograma',
        'ganttProgress' => 'Gantt',
        'quarterlyProgress' => 'Avance Trimestral',
        'fiscalYear' => 'Año Fiscal',
        'task' => 'Tarea',
        'encoded'=>'Codificado',
        'date' => 'Fecha',
        'file_name' => 'Avance Físico Trimestral',
        'startDate' => 'Fecha Inicio',
        'endDate' => 'Fecha Fin',
        'dueDate' => 'Fecha Cumplimiento',
        'beneficiaries' => 'Beneficiarios',
        'attachment' => 'Adjunto',
        'attachments' => 'Archivos Adjuntos',
        'attachmentDate' => 'Fecha Adjunto',
        'status' => 'Estado',
        'semaphore' => 'Semáforo',
        'weight' => 'Ponderación',
        'progress' => 'Avance',
        'notApply' => 'N/A',
        'addProgress' => 'Registrar Avance',
        'detail' => 'Detalles',
        'removeProgress' => 'Eliminar Avance',
        'attachmentFile' => 'Archivo Adjunto',
        'PENDING' => 'Pendiente',
        'DELAYED' => 'Atrasado',
        'TO_REVIEW' => 'En Revisión',
        'DIGITATED' => 'Digitado',
        'REJECTED' => 'Rechazado',
        'COMPLETED_ONTIME' => 'Completado a tiempo',
        'COMPLETED_OUTOFTIME' => 'Completado fuera de tiempo',
        'delayed' => 'Atrasado',
        'atRisk' => 'En Riesgo',
        'ongoing' => 'En Tiempo',
        'activityStatus' => [
            'red' => 'Atrasado',
            'orange' => 'En Riesgo',
            'green' => 'En Tiempo',
            'white' => 'Pendiente'
        ],
        'currentStatus' => 'Estado Actual del Proyecto',
        'currentProgress' => 'Avance Actual del Proyecto',
        'activity' => 'Actividad',
        'quarter1' => 'Trimestre I',
        'quarter2' => 'Trimestre II',
        'quarter3' => 'Trimestre III',
        'quarter4' => 'Trimestre IV',
        'cumulative' => 'Acumulado',
        'sendToReview' => 'Enviar a Revisión',
        'from' => 'Desde',
        'to' => 'Hasta',
    ],

    'messages' => [
        'exceptions' => [
            'task_not_found' => 'La tarea o hito no existe o no está disponible',
            'task_not_file' => 'La tarea o hito no tiene un archivo adjunto',
            'fiscal_year_not_found' => 'El año fiscal no se encuentra definido',
            'project_fiscal_year_not_found' => 'El año fiscal del proyecto no se encuentra definido',
            'current_date_invalid' => 'No podrá registrar un avance mientras la fecha actual sea igual o menor a la fecha de inicio de la :element'
        ],
        'success' => [
            'update' => 'Avance actualizado satisfactoriamente',
            'deleted' => 'Avance eliminado satisfactoriamente',
            'approved' => 'Avance aprobado satisfactoriamente',
            'rejected' => 'Avance rechazado satisfactoriamente'
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el Avance?',
            'approve' => '¿Está seguro que desea aprobar el Avance?',
            'reject' => '¿Está seguro que desea rechazar el Avance?'
        ],
        'warning' => [
            'no_info_gantt' => 'No existe la información necesaria para generar el diagrama de Gantt.',
            'no_info_schedule' => 'No existen actividades relacionadas al proyecto.'
        ]
    ]

];
