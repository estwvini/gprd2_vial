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

    'title' => 'Reformas',

    'labels' => [
        'show' => 'Ver detalles de la reforma',
        'create' => 'Crear Reforma',
        'disapprove' => 'Desaprobar',
        'edit' => 'Editar Reforma',
        'number' => 'Documento',
        'description' => 'Descripción',
        'file' => 'Documento Reforma',
        'type' => 'Tipo de Reforma',
        'budget_item_type' => 'Tipo de Partida',
        'executing_unit' => 'Unidad Ejecutora',
        'budget_type' => 'Tipo de Partida',
        'budget_type_income' => 'Ingresos',
        'budget_type_expense' => 'Gastos',
        'increase' => 'Incremento',
        'decrease' => 'Disminución',
        'balance' => 'Saldo',
        'item' => 'Partida',
        'search_budget_item' => 'Buscar Partidas Prespuestarias',
        'add_item' => 'Adicionar Partida Presupuestaria',
        'from' => 'Desde',
        'to' => 'Hasta',
        'assigned_date' => 'Fecha Creación de la Reforma',
        'type_transfer' => 'TRASPASO',
        'type_increase' => 'INCREMENTO',
        'type_decrease' => 'DISMINUCIÓN',
        'created_date' => 'Fecha creación',
        'approved_date' => 'Fecha Aprobación',
        'state' => 'Estado',
        'status_3' => 'APROBADO',
        'status_1' => 'DIGITADO',
        'status_2' => 'CUADRADO',
        'user' => 'Usuario',
        'details' => 'Detalles de la reforma',
        'year' => 'Año',
        'budget_item' => 'Partida presupuestaria',
        'projects' => 'Proyectos',
        'project' => 'Proyecto',
        'activity' => 'Actividad',
        'reprogramming' => 'Reprogramación',
        'projects_reform' => 'Proyectos afectados por reformas presupuestarias',
        'not_apply' => 'N/A',
        'sub_total_income' => 'Sub-Total Ingresos',
        'sub_total_expense' => 'Sub-Total Gastos',
        'distributor' => 'Distribuidor'

    ],
    'messages' => [
        'actions' => [
            'budgetary' => 'Reforma Presupuestaria',
            'create' => 'Se creará una nueva Reforma Presupuestaria, desea continuar?',
            'delete' => 'Eliminar partida',
            'edit' => 'Editar partida',
            'select' => 'Seleccionar partida',
        ],
        'success' => [
            'updated' => 'Reforma Presupuestaria actualizada satisfactoriamente',
            'approved' => 'Reforma Presupuestaria aprobada satisfactoriamente',
            'disapproved' => 'Reforma Presupuestaria desaprobada satisfactoriamente'
        ],
        'warning' => [
            'balance' => 'El valor de Disminución de la partida es menor al Saldo Actual'
        ],
        'exceptions' => [
            'fiscal_year_not_found' => 'El año fiscal no se encuentra definido',
            'reform_type_not_fount' => 'El tipo de comprobante no existe',
            'not_found' => 'La reforma no existe o no está disponible',
            'create' => 'Ha ocurrido un error al intentar crear la Reforma Presupuestaria',
            'update' => 'Ha ocurrido un error al intentar actualizar la Reforma Presupuestaria',
            'approve' => 'La Reforma Presupuestaria está descuadrada',
            'balance' => 'Existen partidas presupuestarias con saldo insuficiente para realizar la Reforma Presupuestaria',
            'balance_disapproved' => 'Existen partidas presupuestarias con saldo insuficiente para realizar la desaprobación de la Reforma Presupuestaria',
            'approve_not_details' => 'La Reforma Presupuestaria no tiene movimientos',
            'accounting_period_not_exist' => 'No existe el periodo contable, no puede realizar la Reforma Presupuestaria',
            'accounting_period_closed' => 'El período contable está cerrado, no puede realizar la Reforma Presupuestaria',
            'accounting_period_closed_disapproved' => 'El período contable está cerrado, no puede realizar la desaprobación de la Reforma Presupuestaria'
        ]
    ]
];
