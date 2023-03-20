<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCanton
 */
class Canton extends Model
{
    /**
     * @var string
     */
    protected $table = 'cantons';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo('App\Models\System\Province');
    }
}