<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;

/**
 * Clase Area
 *
 * @property string code
 * @property string area
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperArea
 */
class Area extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'areas';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'area'
    ];
}