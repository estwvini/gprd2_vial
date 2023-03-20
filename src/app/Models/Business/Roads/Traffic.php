<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Traffic (tráfico)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperTraffic
 */
class Traffic extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_trafico';

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
        'codigo',
        'Numlivianos',
        'Tranlivianos',
        'Numbuses',
        'Tranbuses',
        'Num2ejes',
        'Tran2ejes',
        'Num3ejes',
        'Tran3ejes',
        'Num4ejes',
        'Tran4ejes',
        'Num5ejes',
        'Tran5ejes',
        'Total tráfico',
        'tipo_dia_codigo',
        'dias_semana'
    ];

}
