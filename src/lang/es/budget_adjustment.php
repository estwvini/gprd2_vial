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

    'title' => 'Ajuste del presupuesto institucional',
    'title_small' => 'Ajuste Presupuestario',

    'labels' => [
        'start_value' => 'Ingresos',
        'current_expenses' => 'Gastos Corrientes',
        'projects_value' => 'Gastos inversión',
        'projects' => 'Proyectos Pre-Aprobados para Proforma Presupuestaria',
        'exercise' => 'Ejercicio',
        'select' => 'Seleccionar',
        'total_spends' => 'Total Gastos',
        'balance' => 'Saldo',
        'value' => 'Valor',
        'sync_proforma' => 'Sincronizar Proforma',
        'bulk_actions_tooltip' => 'Para Guardar un borrador o Aprobar el Ajuste Presupuestario seleccione los proyectos requeridos en esta columna y presione el botón con la acción correspondiente.',
        'terms' => 'Términos y Condiciones',
        'terms_conditions' => 'Al aprobar la proforma presupuestaria, usted como Director, (a). Financiero, (a), confirma que se ha verificado el cumplimiento del Art. 198 del COOTAD que indica textualmente lo siguiente:',
        'terms_conditions_2' => 'Destino de las Transferencias.- las transferencias que efectúa el gobierno central a los gobiernos autónomos descentralizados podrán financiar hasta el treinta por ciento (30%) de gastos permanentes, y un mínimo del setenta por ciento (70%) de gastos no permanentes necesarios para el ejercicio de sus competencias exclusivas con base en la planificación de cada gobierno autónomo descentralizado. Las transferencias provenientes de al menos el diez (10%) por ciento de los ingresos no permanentes, financiarán egresos no permanentes.',
        'agree' => 'He leído y estoy de acuerdo con los Téminos y Condiciones'
    ],

    'placeholders' => [
        'current_expenses' => 'Gastos Corrientes',
        'projects_value' => 'Valor Proyectos'

    ],

    'messages' => [

        'success' => [
            'adjusted' => 'Ajuste Presupuestario aprobado satisfactoriamente. La Proforma Presupuestaria ha sido generada.',
            'proforma_synched' => 'Poforma sincronizada satisfactoriamente con el sistema SFGPROV.',
        ],

        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Ajuste',
            'create_proforma' => 'Ha ocurrido un error al intentar crear la Proforma.'
        ],

        'info' => [
            'not_empty' => 'Debe seleccionar al menos un proyecto',
            'terms' => 'Debe aceptar los Términos y Condiciones para continuar.',
        ],

        'confirm' => [
            'save' => '¿Desea crear un borrador de ajuste presupuestario del actual ejercicio fiscal?',
            'approve' => 'Si aprueba el ajuste presupuestario ya no podrá editarlo ¿Está seguro que desea aprobar?'
        ],

        'exceptions' => [
            'not_found' => 'El Proyecto no existe o no está disponible',
            'undefined_projects' => 'No se han seleccionado proyectos para realizar el Ajuste Presupuestario',
            'invalid_status' => 'El estado del proyecto no permite la creación del Ajuste Presupuestario',
            'balance_not_cero' => 'Para aprobar el ajuste el saldo debe ser cero',
            'preview_balance_not_cero' => 'Para visualizar la proforma el saldo debe ser cero',
            'undefined_sfgprov_fiscal_year' => 'El año fiscal no existe en el sistema SFGPROV.',
            'sync_error' => 'No se ha podido almacenar la Proforma en el sistema SFGPROV.',
            'proforma_exists' => 'La proforma para el año fiscal :year ya existe en el sistema SFGPROV.',
            'invalid_adjustment' => 'El total de ingresos es diferente al total de gastos.',
            'local_proforma_creation' => 'Ha ocurrido un error al intentar almacenar la proforma.'
        ]
    ]
];
