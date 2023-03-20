<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Shape (capa vectorial)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperShape
 */
class Shape extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_shape';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'gid';

    /**
     * Maximo de archivos permitidos al subir
     */
    const MAX_FILE_UPLOAD = 5;

    /**
     * Maximo tamaño para subir archivos (bytes)
     */
    const MAX_SIZE_UPLOAD = 125829120;

    /**
     * Maximo tamaño para subir archivos (bytes)
     */
    const STRING_MAX_SIZE_UPLOAD = '120 Mb';

    /**
     * tipo de archivo dbf
     */
    const EXTENSION_DBF = 'dbf';

    /**
     * tipo de archivo shp
     */
    const EXTENSION_GEOJSON = 'geojson';

     /**
     * tipo de archivo json
     */
    const EXTENSION_JSON = 'json';

    /**
     * Shape de fondo
     */
    const IS_PRIMARY = 1;
    

    /**
     * @var array
     */
    protected $fillable = [
        'gid',
        'codigo',
        'path',
        'name',
        'extension',
        'is_primary'
    ];
}
