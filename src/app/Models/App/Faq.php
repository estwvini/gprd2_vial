<?php

namespace App\Models\App;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperFaq
 */
class Faq extends BaseModel
{
    use SoftDeletes;

    protected $table = 'app_faqs';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'image',
        'description',
    ];

    public function scopePublish($query)
    {
        $query->where('publish', true);
    }
}
