<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;
use App\Models\Business\AdminActivity;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Clase ActivityType
 *
 * @property string name
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperActivityType
 */
class ActivityType extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'activity_types';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Obtiene la actividades administrativas
     *
     * @return HasMany
     */
    public function adminActivities()
    {
        return $this->hasMany(AdminActivity::class, 'activity_type_id');
    }
}