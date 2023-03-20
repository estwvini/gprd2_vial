<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase ConversationNeeds (necesidades de conservación)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperConservationNeeds
 */
class ConservationNeeds extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_necesidades_conservacion';

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
