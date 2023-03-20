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

    'title' => 'Partidas presupuestarias',

    'labels' => [
        'create' => 'Crear partida presupuestaria',
        'edit' => 'Editar partida presupuestaria',
        'delete' => 'Eliminar partida presupuestaria',
        'new' => 'Nueva partida',
        'code' => 'Clave presupuestaria',
        'amount' => 'Valor',
        'item' => 'Ítem',
        'budget_item' => 'Ítem presupuestario',
        'geographic' => 'Ubicación',
        'source' => 'Fuente financiamiento',
        'spending_guide' => 'Orientación gasto',
        'participatory_budget' => 'Presupuesto participativo',
        'institution' => 'Organismo',
        'loan' => 'Préstamo',
        'responsibleUnit' => 'Unidad responsable',
        'executingUnit' => 'Actividad presupuestaria',
        'area' => 'Área',
        'activity' => 'Actividad planificación',
        'program' => 'Programa',
        'sub_program' => 'Sub-Programa',
        'project' => 'Proyecto',
        'tbd_description' => 'N/A',
        'tbd_code' => '999',
        'public_purchase' => 'Compra pública',
        'expenses_higher' => 'Los gastos corrientes sobrepasan al :percent de los ingresos',
        'expenses_percentage' => 'Porcentaje de gastos corrientes vs Ingresos',
        'financing_source_no_code' => '000 - Ninguno',
        'financing_source_data_code' => '000',
        'geographic_location_data_code' => '00',
        'guide_spending_no_code' => '99.99.99 - Ninguno',
        'guide_spending_data_code' => '99.99.99',
        'budgetItemValueTooltip' => 'El valor de la partida deberá ser modificado por medio de una reforma',
        'competence' => 'Competencia',
        'description' => 'Descripción',
        'name' => 'Nombre partida',
        'name_default' => 'Por defecto se establecerá el nombre del Item Presupuestario seleccionado',
        'replicate' => 'Duplicar Presupuesto Año Anterior',
        'review_approvals' => 'Revisión y aprobación de partidas presupuestarias',
        'budget_locations' => 'Presupuesto Ejecutado por Cantones'
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar la Partida Presupuestaria?',
            'approve' => '¿Está seguro que desea aprobar las partidas presupuestarias seleccionadas?'
        ],
        'success' => [
            'created' => 'Partida presupuestaria creada satisfactoriamente',
            'updated' => 'Partida presupuestaria actualizada satisfactoriamente',
            'delete' => 'Partida presupuestaria eliminada satisfactoriamente',
            'updated_bulk' => 'Partidas preupuestarias actualizadas satisfactoriamente',
        ],
        'validation' => [
            'create_budget_item' => 'No se ha podido completar la operación. :message no disponible o no existe.'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Partida presupuestaria',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Partida presupuestaria',
            'no_incomes' => 'No tiene ingresos registrados'
        ],
        'exceptions' => [
            'not_found' => 'La Partida presupuestaria no existe o no está disponible',
            'exist' => 'No se ha podido completar la operación. Existe una partida presupuestaria con la codificación que está intentando crear.',
            'has_public_purchase' => 'No se puede completar la petición debido a que la partida presupuestaria tiene compras públicas asociadas.',
            'has_budget_planning' => 'La Partida Presupuestaria no puede ser eliminada porque su planificación ya fue registrada.',
            'fiscal_year_not_found' => 'El año fiscal no se encuentra definido',
            'project_fiscal_year_not_found' => 'El año fiscal del proyecto no se encuentra definido',
            'activity_fiscal_year_not_found' => 'La actividad no tiene asociado un año fiscal de proyecto',
            'not_available_budget' => 'No tiene presupuesto disponible para realizar la operación',
            'no_next_fiscal_year_info' => 'No existe información relacionada al siguiente año fiscal',
            'no_current_fiscal_year_info' => 'No existe información relacionada al año fiscal actual',
            'project_not_found' => 'No existe el Proyecto con el código :code',
            'location_not_found' => 'No existe la Ubicación con el código :code'
        ],
    ]
];
