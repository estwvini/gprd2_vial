<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Bridge (puente)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperBridge
 */
class Bridge extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_puente';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'gid';

    /**
     * @var array
     */
    protected $fillable = [
        'gid',
        'codp',
        'nombre',
        'rioqueb',
        'caparodad',
        'galibo',
        'ancho',
        'anchotot',
        'longitud',
        'protlater',
        'estprot',
        'evalinfr',
        'evalsupes',
        'carga',
        'sencarga',
        'lat',
        'longi',
        'observ',
        'codigo',
        'imagen1',
        'imagen2',
        'imagen3',
        'imagen4',
        'imagen5'
    ];

    /**
     * Verificar si el modelo tiene una Imagen asociada.
     *
     * @param string $imageName
     *
     * @return bool
     */
    public function hasImage(string $imageName)
    {
        return null != $this->$imageName;
    }

    /**
     * Obtener la ruta de la foto.
     *
     * @param string $imageName
     *
     * @return string
     */
    public function imagePath(string $imageName)
    {
        if ($this->hasImage($imageName)) {
            $path = env('INVENTORY_ROAD_PATH');
            return $path . $this->$imageName;
        }
        return '';
    }
}
