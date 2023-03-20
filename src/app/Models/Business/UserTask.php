<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\System\User;
use App\Traits\HasTags;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperUserTask
 */
class UserTask extends BaseModel
{
    use SoftDeletes, HasTags;

    protected $table = 'user_tasks';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'date_at',
        'is_completed',
        'is_important',
        'type',
        'work_time',
        'rating',
        'user_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', '=', currentUser()->id);
        });

        static::saving(function ($item) {
            $item->user_id = currentUser()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
