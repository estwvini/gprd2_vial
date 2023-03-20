<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;
use App\Models\Business\AdminActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Clase Reason
 *
 * @property string name
 * @property string type
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperReason
 */
class Reason extends BaseModel
{
    use HasFactory;

    public const TYPE_CANCEL = 'CANCEL';

    /**
     * @var string
     */
    protected $table = 'reasons';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'type'
    ];

    /**
     * Obtiene la actividades administrativas
     *
     * @return HasMany
     */
    public function adminActivities()
    {
        return $this->hasMany(AdminActivity::class, 'reason_id');
    }
}
