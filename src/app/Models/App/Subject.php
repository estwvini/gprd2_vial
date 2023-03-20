<?php

namespace App\Models\App;

use App\Models\BaseModel;
use App\Models\System\User;
use App\Traits\ReviewRateable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperSubject
 */
class Subject extends BaseModel
{
    use ReviewRateable;

    protected $table = 'app_subjects';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'responsible_id'
    ];

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function comments()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
