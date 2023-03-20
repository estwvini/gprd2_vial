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

    'title' => 'Reportes de Gestión Vial',

    'labels' => [
        'inventory_roads' => 'Inventario Vial',
        'cantonal_road_length' => 'Longitud de la Red Vial Cantonal por Tipo de Capa de Rodadura (Km)',
        'cantonal_road_status' => 'Estado de la Red Vial Cantonal por Tipo de Capa de Rodadura',
        'cantonal_road_total_length' => 'Longitud Total de la Red Vial por Cantón (Km)',
        'cantonal_road_general_status' => 'Estado General de la Red Vial por Cantón',
        'canton' => 'Cantón',
        'paved' => 'Adoquinado',
        'rigid_pavement' => 'Pavimento Rígido',
        'export' => 'Exportar',
        'save_image' => 'Guardar como Imagen',
        'length_percentage' => 'Porcentaje de Longitud\npor Tipo de Capa de Rodadura',
        'total_length_percentage' => 'Porcentaje de la Red Vial\npor Cantón',
        'surface_type' => 'Tipo de Capa de Rodadura',
        'representative_surface' => 'Superficie Representativa',
        'total_length' => 'Red Total (Km)',
        'element_total' => 'Total de ',
        'road_length_report' => 'Reporte de la red vial de la provincia: ',
        'road_status' => 'Estado de la Red Vial',
        'gad' => 'GAD ',
        'report' => 'Reporte ',
        'date' => 'Fecha: ',
        'length_surface_file_name' => 'longitud_capa_rodadura',
        'road_status_file_name' => 'estado_capa_rodadura',
        'total_length_file_name' => 'longitud_total_canton',
        'general_status_file_name' => 'estado_general_canton',
        'total' => 'Total',
        'percentage' => 'Porcentaje',
        'number' => 'Número',
        'length' => 'Longitud (Km)',
        'status_percentage' => 'Porcentaje del Estado de la Red Vial\npor Tipo de Capa de Rodadura',
        'status_per_surface' => 'Estado de la Red Vial\npor Tipo de Capa de Rodadura',
        'actual_total' => 'TOTAL ACTUAL',
        'status_of' => 'Estado de ',
        'total_per_status' => 'Total por Estado',
        'road_percentage' => '% Red Vial',
        'length_measure' => '(Km)',
        'total_length_per_status' => 'Longitud Total de los Estados\nde la Vía por Cantón'
    ],

    'exceptions' => [
        'cantons_not_found' => 'No existen cantones registrados de las vías',
        'status_not_found' => 'No existen estados de la vía registrados',
        'surface_types_not_found' => 'No existen tipos de capa de rodadura registrados',
        'total_length_not_found' => 'No existen registros de longitud de vía cantonal'
    ]
];
