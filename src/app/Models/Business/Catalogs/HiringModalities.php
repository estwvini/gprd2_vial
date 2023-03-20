<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;

/**
 * Clase HiringModalities
 *
 * @property string name
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperHiringModalities
 */
class HiringModalities extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'hiring_modalities';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'enabled'
    ];
}