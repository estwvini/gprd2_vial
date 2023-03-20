<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperProvince
 */
class Province extends Model
{
    /**
     * @var string
     */
    protected $table = 'provinces';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function cantons()
    {
        return $this->belongsToMany('App\Models\System\Canton');
    }
}