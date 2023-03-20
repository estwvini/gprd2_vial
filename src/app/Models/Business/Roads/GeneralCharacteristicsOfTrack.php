<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase GeneralCharacteristicsOfTrack (vía)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperGeneralCharacteristicsOfTrack
 */
class GeneralCharacteristicsOfTrack extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_caracteristicas_generales_via';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'codigo';

    // GeneralCharacteristicsOfTrack status
    const STATUS_TRUE = 'T';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'codigo',
        'respons',
        'fecha',
        'prov',
        'canton',
        'parroquia',
        'numcamino',
        'tipointer',
        'origen',
        'destino',
        'asentami',
        'longi',
        'lati',
        'longf',
        'latf',
        'altermat',
        'planttr',
        'relleno',
        'proysoc',
        'proyest',
        'proyseg',
        'proypro',
        'coclimati',
        'gid',
        'num_tra'
    ];

}
