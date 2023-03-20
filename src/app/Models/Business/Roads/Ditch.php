<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Ditch (cuneta)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperDitch
 */
class Ditch extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_cuneta';

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
        'lado',
        'estado',
        'tipo',
        'lati',
        'longi',
        'latf',
        'longf',
        'observ',
        'codigo'
    ];

    /**
     * Verificar si el modelo tiene una Imagen asociada.
     *
     * @return bool
     */
    public function hasImage()
    {
        return null != $this->imagen;
    }

    /**
     * Obtener la ruta de la foto.
     *
     * @return string
     */
    public function imagePath()
    {
        if ($this->hasImage()) {
            $path = env('INVENTORY_ROAD_PATH');
            return $path . $this->imagen;
        }
        return '';
    }
}
