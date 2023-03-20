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

    'title' => 'Certificaciones',

    'labels' => [
        'create' => 'Crear Certificación',
        'new' => 'Nueva Certificación',
        'edit' => 'Editar Certificación',
        'show' => 'Detalles Certificación',
        'download' => 'Descargar Certificación',
        'number' => 'Número',
        'topic' => 'Objeto de contratación',
        'send_request' => 'Enviar Solicitud',
        'status' => 'Estado',
        'status_DRAFT' => 'Pendiente',
        'status_TO_REVIEW' => 'Revisión',
        'status_REJECTED' => 'Rechazada',
        'status_APPROVED' => 'Aprobada',
        'status_DIGITATED' => 'Digitado',
        'amount'=>'Monto',
        'certification_project'=>'Certificación por proyecto',
    ],

    'pdf'=>[
        'Number_of_certification'=>'Nro. de Formulario:',
        'date'=>'Fecha: ',
        'direction'=>'Dirección/Secretaria requirente: ',
        'project'=>'Proyecto:',
        'activity'=>'Actividad:',
        'Objectify'=>'Objetivo de Contratación:',
        'total_amount'=>'Valor total: $',
        'program'=>'Programa:',
        'subprogram'=>'Subprograma: ',
        'status'=>'Estado:',
        'message_certification'=>'Certifico que esta actividad consta en el Plan Operativo Anual   Si __  No __ ',
        'attentively'=>'Atentamente,',
        'page'=>'Página ',
        'APPROVED'=>'APROBADO',
        'title'=>'Certificación Aprobada PDF'
    ],

    'placeholders' => [

    ],

    'messages' => [
        'confirm' => [
        ],
        'exceptions' => [

        ],
        'success' => [
            'created' => 'Certificación creada satisfactoriamente',
            'approved' => 'Certificación aprobada satisfactoriamente',
            'updated' => 'Certificación actualizada satisfactoriamente',
            'deleted' => 'Certificación eliminada satisfactoriamente',
        ],
        'validation' => [
            'table_empty_message' => 'No existe información a mostrar',
            'no_files' => 'No existen archivos adjuntos.',
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Certificación',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Certificación',
            'not_found' => 'La Certificación no existe o no está disponible',
            'update' => 'Ha ocurrido un error al intentar actualizar la Certificación'
        ]
    ]
];
