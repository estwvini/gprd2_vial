<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\System\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase Comment
 *
 * @package App\Models\Business
 * @mixin IdeHelperComment
 */
class Comment extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'comments';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'comment',
        'commentable_id'
    ];
    /**
     * @var mixed
     */
    private $comment;

    /**
     * Obtener el modelos commentable.
     *
     * @return MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Obtener el usuario al que pertenece el comentario
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}