<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;
use App\Models\Business\Roads\State;

/**
 * Clase CharacteristicsOfTrack (caracteristicas de la vía)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperCharacteristicsOfTrack
 */
class CharacteristicsOfTrack extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_caracteristicas_via';

    /**
     * @var string
     */
    protected $primaryKey = 'gid';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'gid',
        'codigo',
        'origen',
        'destino',
        'tipoterreno',
        'lati',
        'longi',
        'latf',
        'longf',
        'Numerocamino',
        'Numerosubcamino',
        'tsuperf',
        'esuperf',
        'longitud',
        'anchoca',
        'anchovi',
        'uso',
        'carriles',
        'velprom',
        'numcurv',
        'distvis',
        'numinters',
        'esenhori',
        'esenvert',
        'nupuent',
        'observ',
        'imagen',
        'numalcan',
        'numminas',
        'numpuntocri',
        'numsen',
        'numservicio',
        'Población',
        'Viviendas',
        'numtalud',
        'numasent'
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
