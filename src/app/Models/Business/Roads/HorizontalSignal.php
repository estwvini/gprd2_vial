<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase HorizontalSignal (Señalización horizontal)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperHorizontalSignal
 */
class HorizontalSignal extends Model
{
    /**
     * @var string
     */
    protected $table = 'sch_road.road_sen_horizontal';

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
        'lati',
        'longi',
        'latf',
        'longf',
        'observ',
        'codigo'
    ];

}
