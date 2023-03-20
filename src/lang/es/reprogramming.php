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

    'title' => 'Reprogramación',

    'labels' => [
        'create' => 'Crear Reprogramación',
        'new' => 'Nueva Reprogramación',
        'edit' => 'Editar Reprogramación',
        'show' => 'Detalles Reprogramación',
        'list' => 'Listado de Reprogramaciones',
        'finish' => 'Terminar Reprogramación',
        'project_update' => 'Actualizar proyecto',
        'document' => 'Documento #',
        'status' => 'Estado',
        'status_DRAFT' => 'Borrador',
        'status_APPROVED' => 'Aprobado',
        'file' => 'Documento Reprogramación',
        'download' => 'Descargar archivo',
        'created_at' => 'Fecha de creación',
        'approved_at' => 'Fecha de aprobación',
        'projects' => 'Proyectos',
        'project' => 'Proyecto',
        'projects_list' => 'Listado de Proyectos',
        'financing' => 'Financiera',
        'physical' => 'Física',
        'reformed' => 'Reformado',
        'budget_planning' => 'Planificación Financiera',
        'physical_planning' => 'Planificación Física',
        'logic_frame' => 'Marco Lógico',
        'project_profile' => 'Perfil Proyecto',
        'name' => 'Nombre',
        'total_assigned' => 'Asignado',
        'total_accrued' => 'Devengado',
        'total_not_accrued' => 'No Devengado',
        'total_reform' => 'Reforma',
        'total_encoded' => 'Codificado',
        'total_committed' => 'Comprometido',
        'total_certificate' => 'Certificado',
        'total_monthly' => 'Mensual No Dev',
        'quantity' => 'Cantidad',
        'jan' => 'Ene',
        'feb' => 'Feb',
        'mar' => 'Mar',
        'apr' => 'Abr',
        'may' => 'May',
        'jun' => 'Jun',
        'jul' => 'Jul',
        'aug' => 'Ago',
        'sep' => 'Sep',
        'oct' => 'Oct',
        'nov' => 'Nov',
        'dec' => 'Dic'
    ],

    'messages' => [
        'success' => [
            'created' => 'Reprogramación creada satisfactoriamente',
            'updated' => 'Reprogramación actualizada satisfactoriamente',
        ],
        'exceptions' => [
            'budget_planning' => 'El Total No Devengado deber ser igual a Mensual No Devengado de las actividades',
            'not_found' => 'La reprogramación no existe o no está disponible'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la reprogramación',
            'update' => 'Ha ocurrido un error al intentar actualizar la reprogramación'
        ],
    ]
];
