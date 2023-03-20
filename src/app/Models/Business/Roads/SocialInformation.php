<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase SocialInformation (información social)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperSocialInformation
 */
class SocialInformation extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_social';

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
        'asent',
        'organ1',
        'organ2',
        'organ3',
        'tipopob',
        'pobtot',
        'vivienda',
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
