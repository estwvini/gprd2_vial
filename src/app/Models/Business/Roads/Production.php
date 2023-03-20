<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Production (producción)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperProduction
 */
class Production extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_produccion';

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
        'sector',
        'prod1',
        'prod2',
        'prod3',
        'vol1',
        'vol2',
        'vol3',
        'dest1',
        'dest2',
        'dest3',
        'val1',
        'val2',
        'val3',
        'flete1',
        'flete2',
        'flete3',
        'observ'
    ];

}
