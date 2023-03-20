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

    'title' => 'Proyectos',

    'labels' => [
        'create' => 'Crear proyecto',
        'edit' => 'Actualizar proyecto',
        'editProfile' => 'Actualizar perfil de proyecto',
        'editLogicFrame' => 'Actualizar marco lógico',
        'logicFrame' => 'Marco lógico',
        'new' => 'Nuevo proyecto',
        'replicate' => 'Duplicar este proyecto',
        'cup' => 'Código CUP',
        'code' => 'Código',
        'cup_tooltip' => 'Estructura del código: {Programa}.{Subprograma}.{Proyecto}',
        'bulk_actions_tooltip' => 'Para “Rechazar” o “Aprobar“ proyectos seleccione en esta columna y presione el botón con la acción requerida',
        'zone' => 'Zona',
        'responsibleUnit' => 'Unidad responsable',
        'executingUnit' => 'Unidad ejecutora',
        'operational_goal' => 'Objetivo Operativo',
        'strategic' => 'Estratégico',
        'responsible' => 'Responsable del proyecto',
        'days' => 'Días',
        'state' => 'Estado Año Fiscal',
        'general_status' => 'Estado general del proyecto',
        'ongoing_project' => 'Proyecto de arrastre',
        'type' => 'Tipo',
        'initial_budget' => 'Presupuesto referencial',
        'profile' => 'Perfil',
        'logic_frame' => 'Marco lógico',
        'to_plan' => 'Planificación',
        'objectives' => 'Objetivos',
        'general_objective' => 'Objetivo General',
        'purpose' => 'Propósito',
        'general_objective_indicator' => 'Indicador del objetivo General',
        'init_date' => 'Fecha inicio',
        'encoded'=>'Codificado',
        'end_date' => 'Fecha fin',
        'month_duration' => 'Duración (meses)',
        'execution_term' => 'Plazo de ejecución',
        'registration_date' => 'Fecha de registro',
        'obj_pei' => 'Objetivo del PEI/ Plan de Gobierno',
        'program' => 'Programa del PEI/ Plan de Gobierno',
        'sub_program' => 'Sub-Programa del PEI/ Plan de Gobierno',
        'components' => 'Componentes (resultados u objetivos específicos)',
        'indicators' => 'Indicadores',
        'indicators_logical_frame' => 'Indicadores / Metas',
        'files' => 'Archivos de respaldo digital',
        'general_data' => 'Datos Generales',
        'qualitative_benefit' => 'Necesidad que satisface / Beneficio cualitativo',
        'base_line' => 'Línea de base',
        'goals' => 'Metas',
        'assumptions' => 'Supuestos',
        'verification_means' => 'Medios de verificación',
        'pre-feasibility_study' => 'Estudios de Pre-factibilidad',
        'referential_budget' => 'Presupuesto Referencial Total',
        'year' => 'Año ',
        'annual_budgets' => 'Presupuestos',
        'actions' => 'Acciones',
        'requirements' => 'Requerimientos del proyecto',
        'product_description_service' => 'Descripción de productos y servicios',
        'approval_criteria' => 'Beneficiarios del proyecto',
        'general_risks' => 'Análisis general de riesgos',
        'phase' => 'Fase de proyecto',
        'contract_cup' => 'Código único del contrato',
        'leader' => 'Líder de proyecto',
        'mark_as_done' => 'Marcar como hecho',
        'activities' => 'Actividades',
        'component' => 'Componentes',
        'value' => 'Valor',
        'budget_value' => 'Valor Presupuestado',
        'project' => 'Proyecto',
        'is_road' => 'Es vial',
        'annual_budget' => 'Presupuesto Referencia Anual',
        'update_project_dates' => 'Actualizar fechas',
        'tir' => 'TIR',
        'van' => 'VAN',
        'benefit_cost' => 'Costo beneficio',
        'road_project' => 'Proyecto Vial',
        'budget' => 'Presupuesto',
        'structure' => 'Estructura Programática',
        'select_year' => 'Año para duplicar'
    ],

    'placeholders' => [
        'name' => 'Nombre del proyecto',
        'description' => 'Descripción del proyecto',
        'objective' => 'Objetivo general del proyecto',
        'initial_budget' => 'Presupuesto referencial',
        'cup' => 'Código Único de Proyecto',
        'zone' => 'Zona en la que se ejecuta el proyecto',
        'qualitative_benefit' => 'Necesidad que satisface / Beneficio cualitativo',
        'general_objective_indicator' => 'Indicador del objetivo General',
        'assumptions' => 'Supuestos del proyecto',
        'requirements' => 'Requerimientos del proyecto',
        'product_description_service' => 'Descripción de productos y servicios',
        'approval_criteria' => 'Beneficiarios del proyecto',
        'general_risks' => 'Análisis general de riesgos',
        'benefit_cost' => 'Motivo de los valores ingresados del (TIR y VAN).'
    ],

    'messages' => [
        'success' => [
            'created' => 'Proyecto creado satisfactoriamente',
            'updated' => 'Proyecto actualizado satisfactoriamente',
            'deleted' => 'Proyecto eliminado satisfactoriamente',
            'status_updated' => 'Estado del proyecto actualizado a ":status" satisfactoriamente',
        ],
        'validation' => [
            'project_name_exists' => 'El nombre del Proyecto ya existe',
            'project_cup_exists' => 'El código CUP del Proyecto ya existe',
            'table_empty_message' => 'No existe información a mostrar',
            'required_fields' => 'Ha ocurrido un error al intentar actualizar el Proyecto. Por favor complete todos los campos obligatorios(*).'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear el Proyecto',
            'update' => 'Ha ocurrido un error al intentar actualizar el Proyecto',
            'delete' => 'Ha ocurrido un error al intentar eliminar el Proyecto',
            'no_department' => 'No se pueden listar los proyectos ya que el usuario no pertenece a un departamento',
            'not_executing_unit' => 'Para agregar partidas presupuestarias a las actividades debe añadir una unidad ejecutora en el perfil del proyecto.',
            'only_two_decimal' => 'Ingrese solo 2 decimales.'
        ],
        'exceptions' => [
            'not_found' => 'El Proyecto no existe o no está disponible',
            'no_budget_items' => 'El Proyecto no tiene partidas presupuestarias asociadas'
        ],
    ],

    'status' => [
        'draft' => 'Borrador',
        'to_review' => 'En Revisión',
        'rejected' => 'Rechazado',
        'reviewed' => 'Revisado',
        'in_progress' => 'En progreso',
        'cancelled' => 'Cancelado',
        'closed' => 'Cerrado',
        'suspended' => 'Suspendido',
        'completed' => 'Terminado'
    ],

    'actions' => [
        'profile' => 'Perfil',
        'logic_frame' => 'Marco Lógico',
        'activities' => 'Actividades',
        'schedule' => 'Cronograma',
        'attachments' => 'Anexos',
        'attachments_roads' => 'Anexos viales',
        'send' => 'Enviar',
        'components' => 'Componentes',
        'rejections' => 'Rechazos',
        'budget' => 'Presupuesto',
    ],

    'import' => [
        'import' => 'Importar',
        'download' => 'Descargar',
        'message' => '¿Está seguro que desea reemplazar las partidas presupuestarias existentes? Al realizar esta acción se ELIMINARÁN permanentemente.',
        'formats' => 'Formatos permitidos: XLS, XLSX. ',
        'file' => 'Presupuesto de Proyecto',
    ]
];
