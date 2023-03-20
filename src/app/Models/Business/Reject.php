<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\System\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase Reject
 *
 * @package App\Models\Business
 * @mixin IdeHelperReject
 */
class Reject extends BaseModel
{

    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'rejects';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'observations',
        'user_id',
        'rejectable_id',
        'rejectable_type'

    ];

    /**
     * Obtiene todos los modelos relacionados.
     *
     * @return MorphTo
     */
    public function rejectable()
    {
        return $this->morphTo();
    }

    /**
     * Obtener el usuario que realizó el rechazo.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}