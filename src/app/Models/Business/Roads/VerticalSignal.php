<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase VerticalSignal (Señalización vertical)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperVerticalSignal
 */
class VerticalSignal extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_sen_vertical';

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
        'tipo',
        'estado',
        'lado',
        'lat',
        'longi',
        'observ',
        'codigo',
        'imagen'
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
