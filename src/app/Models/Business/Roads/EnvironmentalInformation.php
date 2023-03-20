<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase EnvironmentalInformation (informe ambiental)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperEnvironmentalInformation
 */
class EnvironmentalInformation extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_info_ambiental';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'codigo';

    // EnvironmentalInformation status
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
        'participa',
        'eval_riesg',
        'riesg_pot',
        'reserv_nat',
        'pueb_indig',
        'prot_cuenc',
        'resforest',
        'act_ambie'
    ];

}
