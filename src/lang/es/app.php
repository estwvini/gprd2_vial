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

    'labels' => [
        'system_name' => 'Congope',
        'system_slogan' => 'Congope',
        'footer' => 'Consorcio de Gobiernos Autónomos Provinciales del Ecuador',
        'loading' => 'Espere un momento por favor...',
        'welcome' => 'Bienvenido/a',
        'title' => 'Navegación',
        'send' => 'Enviar Financiero',
        'login' => 'Acceder',
        'administration' => 'Configuración',
        'dashboard' => 'Panel de Control',
        'catalogs' => 'Catálogos',
        'app_mobil' => 'Aplicación móvil',
        'roads' => 'Víal',
        'hdm4' => 'HDM4',
        'planning' => 'Planificación',
        'structure' => 'Estructura',
        'tracking' => 'Seguimiento',
        'execution' => 'Ejecución',
        'reports' => 'Reportes',
        'projects' => 'Proyectos',
        'budget' => 'Presupuesto',
        'income' => 'Ingreso',
        'expense' => 'Gasto',
        'list' => 'Listar',
        'create' => 'Crear',
        'new' => 'Crear',
        'edit' => 'Editar',
        'replicate' => 'Duplicar',
        'update' => 'Actualizar',
        'details' => 'Detalles',
        'open' => 'Abrir',
        'add' => 'Adicionar',
        'delete' => 'Eliminar',
        'delete_bulk' => 'Eliminar elementos seleccionados',
        'status' => 'Habilitar/Inhabilitar elemento',
        'status_bulk' => 'Habilitar/Inhabilitar elementos seleccionados',
        'select' => 'Seleccionar',
        'management' => 'Gestionar',
        'configure' => 'Configurar',
        'load' => 'Cargar',
        'init' => 'Iniciar',
        'forward' => 'Continuar',
        'backward' => 'Regresar',
        'exit' => 'Salir',
        'logout' => 'Cerrar Sesión',
        'close' => 'Cerrar',
        'archives' => 'Archivar',
        'link' => 'Articular',

        'save' => 'Guardar',
        'approve' => 'Aprobar',
        'save_and_continue' => 'Guardar y continuar',
        'save_and_exit' => 'Guardar y salir',
        'accept' => 'Aceptar',
        'cancel' => 'Cancelar',
        'reject' => 'Rechazar',
        'attention' => '&iexcl;Atención!',
        'error' => 'Error',
        'info' => 'Información',
        'warning' => 'Alerta',
        'all' => 'Todos',
        'select_all' => 'Seleccionar todos',
        'general' => 'General',
        'actions' => 'Acciones',
        'permissions' => 'Permisos',
        'info_general' => 'Información general',
        'info_system' => 'Información del sistema',
        'configuration' => 'Configuración',
        'deny' => 'Permiso denegado',
        'service_error' => 'Error servicio',
        'profile' => 'Mi Perfil',
        'trash' => 'Papelera',
        'change_password' => 'Cambiar contraseña',
        'change_fiscal_year_profile' => 'Seleccionar año fiscal',
        'change_fiscal_year_modal' => 'Seleccionar Año Fiscal',
        'fiscal_year_planning' => 'Año Fiscal Planificación',
        'fiscal_year_execution' => 'Año Fiscal Ejecución',
        'year' => 'Año',

        'disabled' => ' (deshabilitado)',
        'document_type' => 'Tipo de Identificación',
        'document' => 'Identificación',
        'identification_card' => 'Cédula',
        'passport' => 'Pasaporte',
        'ruc' => 'RUC',

        'modules' => 'Módulos',
        'active' => 'Activo(s)',
        'total' => 'Totales',
        'search' => 'Buscar',

        'clear_selection' => 'Borrar selección',
        'clear' => 'Limpiar Filtros',

        'footer_total' => 'Total',
        'footer_subtotal' => 'Subtotal',

        'preview' => 'Vista previa',

        'export' => [
            'pdf' => 'Exportar PDF'
        ],
        'next' => 'Siguiente',
        'back' => 'Atrás',
        'date' => 'Fecha',
        'yes' => 'Si',
        'no' => 'No',
        'congope'=> 'CONSORCIO DE GOBIERNOS AUTONOMOS PROVINCIALES DEL ECUADOR',
        'Send_PasswordReset_Link' => 'Enviar Link',
        'hello' => 'Hola!',
        'confirmation_password' => 'Confirmar contraseña',
        'note' => 'Notas',
    ],

    'messages' => [
        'confirm' => [
            'delete' => '¿Está seguro que desea eliminar el elemento?',
            'delete_bulk' => '¿Está seguro que desea eliminar los elementos seleccionados?',
            'status_bulk' => '¿Está seguro que desea cambiar el estado a los elementos seleccionados?',
        ],
        'success' => [
            'transaction' => 'Acción completada satisfactoriamente',
            'created' => 'Elemento creado satisfactoriamente',
            'updated' => 'Elemento actualizado satisfactoriamente',
            'updated_bulk' => 'Elementos actualizados satisfactoriamente',
            'deleted' => 'Elemento eliminado satisfactoriamente',
            'deleted_bulk' => 'Elementos eliminados satisfactoriamente',
            'fiscal_year_changed' => 'Años fiscales seleccionados'
        ],
        'warning' => [
            'unauthorized' => 'No est&aacute autorizado a realizar esta acción',
            'budget_adjustment_approved' => 'La Planificación se encuentra bloqueada debido a que el Ajuste Presupuestario del año fiscal :year ya fue aprobado.',
            'budget_adjustment_not_approved' => 'La Gestión de la Estructura Programática se encuentra bloqueada debido a que el Ajuste Presupuestario del año fiscal :year no ha sido aprobado.'

        ],
        'errors' => [
            'transaction' => 'La acción no se ha completado',
            'create' => 'Ha ocurrido un error al intentar crear el elemento',
            'show' => 'Ha ocurrido un error al intentar obtener los detalles del elemento',
            'update' => 'Ha ocurrido un error al intentar actualizar el elemento',
            'update_bulk' => 'Ha ocurrido un error al intentar actualizar los elementos',
            'delete' => 'Ha ocurrido un error al intentar eliminar el elemento',
            'delete_bulk' => 'Ha ocurrido un error al intentar eliminar los elementos',
            'required' => 'Este campo es obligatorio',
            'required_fields' => 'Debe completar los campos requeridos'
        ],
        'exceptions' => [
            'not_found' => 'El elemento no existe o no está disponible',
            'unexpected' => 'Error inesperado, consulte los logs para más información',
            'session_time_out' => 'Su sesión ha expirado por inactividad',
            'sfgprov_not_available' => 'Sistema financiero no se encuentra disponible en este momento.',
            'invalid_adjustment' => 'El total de ingresos es diferente al total de gastos.',
            'no_current_fiscal_year_info' => 'No existe información relacionada al año fiscal actual'
        ],
    ],

    'headers' => [
        'code' => 'Código',
        'name' => 'Nombre',
        'last_name' => 'Apellidos',
        'label' => 'Etiqueta',
        'description' => 'Descripción',
        'enabled' => 'Habilitado',
        'type' => 'Tipo',
        'date_init' => 'Fecha Inicio',
        'date_end' => 'Fecha Fin',
        'creation_date' => 'Fecha de creación',
        'status' => 'Estado',
        'created_at' => 'Ingresado',
        'updated_at' => 'Última Actualización',
        'email' => 'Correo Electrónico',
        'phone' => 'Número Telefónico',
        'department' => 'Nivel Organizacional'
    ],

    'error_pages' => [
        'access_denied' => 'Acceso denegado',
        'do_not_have_permissions' => 'Usted no tiene permisos para acceder a este recurso',
        'contact_ti' => 'Contáctese con el departamento de TI para más información',
        'back_control_panel' => 'Ir al Panel de Control',
        'resource_not_available' => 'El recurso no existe o ya no está disponible',
        'resource_not_available_error' => 'Error'
    ],

    'placeholders' => [
        'select' => 'Seleccione una opción',
        'select_simple' => 'Seleccione',
    ],
];
