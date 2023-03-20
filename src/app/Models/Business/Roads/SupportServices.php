<?php

namespace App\Models\Business\Roads\Catalogs;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase SupportServices
 *
 * @package App\Models\Business\Roads\Catalogs
 * @mixin IdeHelperSupportServices
 */
class SupportServices extends Model
{


    /**
     * @var string
     */
    protected $table = 'sch_road.road_servicios_apoyo';

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
        'id',
        'servicio',
        'numero',
        'lat',
        'longi',
        'gid',
        'imagen'
    ];
}
