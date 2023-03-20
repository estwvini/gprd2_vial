<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperTag
 */
class Tag extends BaseModel
{
    protected $table = 'tags';

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            $item->slug = Str::slug($item->name);
        });
    }
}
