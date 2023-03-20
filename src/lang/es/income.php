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

    'title' => 'Ingresos',
    'title_structure' => 'Estructura Programática de Ingresos',

    'labels' => [
        'create' => 'Crear Ingreso',
        'new' => 'Nuevo Ingreso',
        'details' => 'Detalles del Ingreso',
        'update' => 'Actualizar Ingreso',
        'edit' => 'Editar Ingreso',
        'delete' => 'Eliminar Ingreso',
        'detail' => 'Detalle del ingreso',
        'justification' => 'Detalle del ingreso',
        'legalBase' => 'Base Legal',
        'value' => 'Valor',
        'budgetClassifier' => 'Ítem presupuestario',
        'selectBudgetClassifier' => 'Seleccione un ítem presupuestario',
        'financingSource' => 'Fuente de Financiamiento',
        'selectFinancingSource' => 'Seleccione una fuente de financiamiento',
        'institution' => 'Organismo',
        'selectInstitution' => 'Seleccione un Organismo',
        'loan' => 'Préstamo',
        'selectLoan' => 'Seleccione un préstamo',
        'total' => 'Total',
        'subtotal' => 'Subtotal',
        'fiscalYear' => 'Año Fiscal',
        'code' => 'Código',
        'codeTooltip' => 'Estructura del código: {Clasificador Presupuestario}.{Fuente de Financiamiento}.{Distribuidor}',
        'incomeValueTooltip' => 'El valor del ingreso deberá ser modificado por medio de una reforma',
        'distributor' => 'Distribuidor',
        'distributor_name' => 'Nombre del Distribuidor',
        'replicate' => 'Duplicar Ingresos',
        'import' => 'Importar',
        'download' => 'Descargar',
        'formats' => 'Formatos permitidos: XLS, XLSX. ',
        'file' => 'Presupuesto de Ingresos',
        'row' => 'Fila',
        'column' => 'Columna',
        'errors' => 'Errores',
    ],

    'messages' => [
        'success' => [
            'created' => 'Ingreso almacenado satisfactoriamente',
            'updated' => 'Ingreso actualizado satisfactoriamente estos cambios pueden afectar sus gastos corrientes',
            'deleted' => 'Ingreso eliminado satisfactoriamente',
            'replicated' => 'Presupuesto de Ingreso duplicado satisfactoriamente'
        ],
        'exceptions' => [
            'not_found' => 'El ingreso no existe o no está disponible'
        ],
        'errors' => [
            'created' => 'Ha ocurrido un error al intentar crear el ingreso',
            'updated' => 'Ha ocurrido un error al intentar actualizar el ingreso',
            'deleted' => 'Ha ocurrido un error al intentar eliminar el ingreso'
        ],
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el Ingreso?',
            'import' => '¿Está seguro que desea reemplazar las partidas de ingreso existentes? Al realizar esta acción se ELIMINARÁN las partidas existentes.'
        ],
        'validation' => [
            'financing_source' => 'Ya existe un ítem presupuestario con la misma fuente de financiamiento',
            'max_value' => 'Ha excedido el valor máximo permitido'
        ]
    ]

];
