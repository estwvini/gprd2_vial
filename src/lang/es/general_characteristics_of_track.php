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

    'title' => 'Vías',
    'report' => 'Reporte de vías ',

    'labels' => [
        'create' => 'Crear Vía',
        'create_interconnection_type' => 'Crear Tipo de Interconexión',
        'create_weather_condition' => 'Crear Condición Climática',
        'create_status' => 'Crear Estado',
        'new' => 'Nueva Vía',
        'new_interconnection_type' => 'Nuevo Tipo de Interconexión',
        'new_weather_condition' => 'Nueva Condición Climática',
        'new_status' => 'Nuevo Estado',
        'update' => 'Actualizar Vía',
        'edit' => 'Editar Vía',
        'details' => 'Detalles de Vía',
        'roads_components' => 'Componentes de la vía',
        'road_graphic' => 'Gráfico de la vía',
        'roads_province' => 'Vías de la provincia',
        'consult' => 'Consultar',
        'download_hdm4' => 'Descargar archivo HDM4',

        'code' => 'Código',
        'responsible' => 'Responsable',
        'date' => 'Fecha',
        'province' => 'Provincia',
        'canton' => 'Cantón',
        'parish' => 'Parroquia',
        'number_road' => 'Número de Camino',
        'type_interconnection' => 'Tipo de interconexión',
        'origin' => 'Origen',
        'destiny' => 'Destino',
        'settlement' => 'Asentamiento',
        'longitude_initial' => 'Longitud inicial',
        'latitude_initial' => 'Latitud inicial',
        'longitude_finish' => 'Longitud final',
        'latitude_finish' => 'Latitud final',
        'alternate' => 'Alterna',
        'treatment_plant' => 'Planta tratamiento',
        'fill' => 'Relleno',
        'social_projects' => 'Proyecto social',
        'strategic_projects' => 'Proyecto estratégico',
        'national_security_projects' => 'Proyecto seguridad nacional',
        'productive_projects' => 'Proyecto productivo',
        'change_climatic' => 'Zona Climática',
        'gid' => 'GID',
        'number_tram' => 'Número de subtramo',
        'description' => 'Descripción',
        'weather_conditions' => 'Condiciones climáticas',
        'status' => 'Estado',
        'yes' => 'Sí',
        'no' => 'No'
    ],
    'placeholders' => [
        'code' => 'Código de la vía',
        'responsible' => 'Nombre del responsable del levantamiento de los datos',
        'date' => 'DD/MM/YY',
        'province' => 'Provincia de donde parte y a donde conduce el camino o la vía',
        'canton' => 'Nombre del Cantón de donde parte y a donde conduce el camino o la vía',
        'parish' => 'Nombre de la Parroquia de donde parte y a donde conduce el camino o la vía',
        'number_road' => 'Número del camino en orden secuencial',
        'type_interconnection' => 'Tipo de interconexión al que pertenece la vía.',
        'origin' => 'Lugar donde se inicia la vía',
        'destiny' => 'Lugar donde se finaliza la vía',
        'settlement' => 'Número de asentamientos en el recorrido de la vía',
        'longitude_initial' => 'Longitud inicial',
        'latitude_initial' => 'Latitud inicial',
        'longitude_finish' => 'Longitud final',
        'latitude_finish' => 'Latitud final',
        'alternate' => 'El camino es una ruta alterna a la red estatal',
        'treatment_plant' => 'El camino conduce a la planta de tratamiento de agua potable',
        'fill' => 'El camino conduce relleno sanitario',
        'social_projects' => 'El camino conduce al sitio donde se ejecutan proyectos sociales',
        'strategic_projects' => 'El camino conduce a sitios estratégicos',
        'national_security_projects' => 'El camino conduce a sitios de seguridad nacional',
        'productive_projects' => 'El camino conduce al sitio donde se ejecutan proyectos productivos',
        'change_climatic' => 'Clima de mayor periodo durante el año',
        'gid' => 'GID',
        'number_tram' => 'Número de subtramo que forma parte de la misma vía en orden secuencial'
    ],
    'messages' => [
        'success' => [
            'created' => 'Vía creada satisfactoriamente',
            'interconnection_type_created' => 'Tipo de Interconexión creada satisfactoriamente',
            'weather_condition_created' => 'Condición Climática creada satisfactoriamente',
            'status_created' => 'Estado creado satisfactoriamente',
            'updated' => 'Vía actualizada satisfactoriamente',
            'deleted' => 'Vía eliminada satisfactoriamente',
            'enabled' => 'Vía habilitada satisfactoriamente',
            'disabled' => 'Vía inhabilitada satisfactoriamente'
        ],
        'validation' => [
            'code_exists' => 'El código de la vía ya está en uso'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Vía',
            'create_interconnection_type' => 'Ha ocurrido un error al intentar crear un Tipo de Interconexión',
            'create_weather_condition' => 'Ha ocurrido un error al intentar crear una Condición Climática',
            'create_status' => 'Ha ocurrido un error al intentar crear el Estado',
            'update' => 'Ha ocurrido un error al intentar actualizar la Vía',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Vía',
            'code_validate' => 'Ingrese solo números, letras y - (guión medio)'
        ],
        'validations' => [
            'interconnection_type_uniqueDesc' => 'La descripción del tipo de interconexión ya existe',
            'status_uniqueDesc' => 'La descripción del estado ya existe',
            'weather_condition_uniqueDesc' => 'La descripción de la condición climática ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Vía no existe o no está disponible'
        ],
        'info' => [
            'codeInfo' => 'Código único para las vías',
            'fields_required' => 'Llenar los campos para realizar la busqueda',
        ]
    ]
];
