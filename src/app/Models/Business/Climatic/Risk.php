<?php

namespace App\Models\Business\Climatic;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
     /**
     * @var string
     */
    protected $table = 'sch_gis.rx95p_altas';

     /**
     * @var string
     */
    protected $primaryKey = 'ogc_fid';
    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'ogc_fid',
        'dpa_parroq',
        'dpa_despar',
        'dpa_canton',
        'dpa_descan',
        'dpa_provin',
        'dpa_despro'
    ];
}
