<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;
use App\Models\System\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase Justification
 *
 * @package App\Models\Business\Planning
 * @mixin IdeHelperJustification
 */
class Justification extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'justifications';

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
        'description',
        'action',
        'path',
        'path',
        'document_reference',
        'justifiable_id'
    ];

    /**
     * Obtener el usuario que ejecutó la acción que necesitaba una justificación.
     *
     * @return BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtener todos los modelos justifiable.
     *
     * @return MorphTo
     */
    public function justifiable()
    {
        return $this->morphTo();
    }

    /**
     * Obtener el usuario que creó el archivo.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}