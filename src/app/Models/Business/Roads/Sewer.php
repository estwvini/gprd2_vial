<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Sewer (alcantarilla)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperSewer
 */
class Sewer extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_alcantarilla';

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
        'longitud',
        'material',
        'cuancho',
        'cualto',
        'cudiam',
        'cabezales',
        'ecabez',
        'ecuerpo',
        'lat',
        'longi',
        'observ',
        'codigo',
        'imagen1',
        'imagen2',
        'imagen3'
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
