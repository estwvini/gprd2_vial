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

    'title' => 'Características vía',
    'image_path' => 'characteristics_of_track',

    'labels' => [
        'create' => 'Crear Características de la vía',
        'create_lane' => 'Crear Carril',
        'create_track_usage' => 'Crear Uso Vía',
        'create_terrain_type' => 'Crear Tipo de Terreno',
        'create_rolling_surface_type' => 'Crear Tipo de Superficie de Rodadura',
        'new' => 'Nueva Características de la vía',
        'new_lane' => 'Nuevo Carril',
        'new_track_usage' => 'Nuevo Uso Vía',
        'new_terrain_type' => 'Nuevo Tipo de Terreno',
        'new_rolling_surface_type' => 'Nuevo Tipo de Superficie de Rodadura',
        'update' => 'Actualizar Características de la vía',
        'edit' => 'Editar Características de la vía',
        'details' => 'Detalles de la Característica de la vía',
        'gid' => 'Código de la Característica de la vía',
        'origen' => 'Lugar inicio',
        'destino' => 'Lugar finaliza',
        'tipoterreno' => 'Tipo de terreno',
        'lati' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'latf' => 'Latitud final',
        'longf' => 'Longitud final',
        'Numerocamino' => 'Número del camino',
        'Numerosubcamino' => 'Número de subtramo',
        'tsuperf' => 'Tipo de capa',
        'esuperf' => 'Estado de la capa',
        'longitud' => 'Longitud marcada',
        'anchoca' => 'Ancho de calzada',
        'anchovi' => 'Ancho real del camino',
        'uso' => 'Derecho de vía',
        'carriles' => 'Tipo de carriles',
        'velprom' => 'Velocidad promedio',
        'numcurv' => 'Número de curvas/Km',
        'distvis' => 'Distancia de visibilidad',
        'numinters' => 'Número de intersecciones',
        'esenhori' => 'Señalización horizontal',
        'esenvert' => 'Señalización vertical',
        'nupuent' => 'Número de puentes',
        'observ' => 'Observaciones',
        'imagen' => 'Imagen',
        'numalcan' => 'Número de alcantarillas',
        'numminas' => 'Número de minas',
        'numpuntocri' => 'Número de puntos críticos',
        'numsen' => 'Número de señales',
        'numservicio' => 'Número de servicios',
        'poblacion' => 'Población',
        'viviendas' => 'Viviendas',
        'numtalud' => 'Número de taludes',
        'numasent' => 'Número de asentamientos',
        'code' => 'Código',
        'description' => 'Descripción',
        'track_usage' => 'Uso vía',
        'rolling_surface_type' => 'Tipo de superficie de rodadura'
    ],
    'placeholders' => [
        'gid' => 'Código de la vía',
        'origen' => 'Lugar donde se inicia la vía',
        'destino' => 'Lugar donde se finaliza la vía',
        'tipoterreno' => 'Tipo de terreno',
        'lati' => 'Latitud inicial',
        'longi' => 'Longitud inicial',
        'latf' => 'Latitud final',
        'longf' => 'Longitud final',
        'Numerocamino' => 'Número del camino en orden secuencial',
        'Numerosubcamino' => 'Número de subtramo que forma parte de la misma vía en orden secuencial',
        'tsuperf' => 'Tipo de capa de rodadura de la vía',
        'esuperf' => 'Estado de la capa superficial de la vía',
        'longitud' => 'Longitud marcada por el odómetro desde el inicio hasta el final',
        'anchoca' => 'Ancho de calzada',
        'anchovi' => 'Ancho real del camino, que es la distancia entre los puntos externos de la vía incluyendo espaldones',
        'uso' => 'Derecho de vía',
        'carriles' => 'Tipo de carriles de la vía',
        'velprom' => 'Velocidad promedio de la vía',
        'numcurv' => 'Número de curvas/Km',
        'distvis' => 'Distancia de visibilidad tomando en cuenta los obstáculos permanentes',
        'numinters' => 'Número de intersecciones de la vía',
        'esenhori' => 'Estado de la señalización horizontal',
        'esenvert' => 'Estado de la señalización vertical (Signos, leyendas, avisos)',
        'nupuent' => 'Número total de puentes',
        'observ' => 'Observaciones',
        'imagen' => 'Imagen',
        'numalcan' => 'Número total de alcantarillas',
        'numminas' => 'Número total de minas',
        'numpuntocri' => 'Número total de puntos críticos',
        'numsen' => 'Número total de señales',
        'numservicio' => 'Número total de servicios',
        'poblacion' => 'Número total de habitantes de cada uno de los asentamientos',
        'viviendas' => 'Número total de viviendas existentes en los asentamientos',
        'numtalud' => 'Número total de taludes',
        'numasent' => 'Número total de asentamientos'
    ],
    'messages' => [
        'success' => [
            'created' => 'Característica de la vía creada satisfactoriamente',
            'lane_created' => 'Carril creado satisfactoriamente',
            'track_usage_created' => 'Uso Vía creado satisfactoriamente',
            'terrain_type_created' => 'Tipo de Terreno creado satisfactoriamente',
            'rolling_surface_type_created' => 'Tipo de Superficie de Rodadura creado satisfactoriamente',
            'updated' => 'Característica de la vía actualizada satisfactoriamente',
            'deleted' => 'Característica de la vía eliminada satisfactoriamente'
        ],
        'errors' => [
            'create' => 'Ha ocurrido un error al intentar crear la Característica de la vía',
            'create_lane' => 'Ha ocurrido un error al intentar crear el Carril',
            'create_track_usage' => 'Ha ocurrido un error al intentar crear uso vía',
            'create_terrain_type' => 'Ha ocurrido un error al intentar crear un tipo de terreno',
            'create_rolling_surface_type' => 'Ha ocurrido un error al intentar crear un tipo de superficie de rodadura',
            'update' => 'Ha ocurrido un error al intentar actualizar la Característica de la vía',
            'delete' => 'Ha ocurrido un error al intentar eliminar la Característica de la vía'
        ],
        'validations' => [
            'lanes_uniqueDesc' => 'La descripción del carril ya existe',
            'rolling_surface_type_uniqueDesc' => 'La descripción del tipo de superfice de rodadura ya existe',
            'terrain_type_uniqueDesc' => 'La descripción del tipo de terreno ya existe',
            'track_usage_uniqueDesc' => 'La descripción de uso vía ya existe'
        ],
        'exceptions' => [
            'not_found' => 'La Característica de la vía no existe o no está disponible'
        ]
    ]
];
