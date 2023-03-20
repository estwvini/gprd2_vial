<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase Component
 *
 * @package App\Models\Business
 * @mixin IdeHelperComponent
 */
class Component extends BaseModel
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'components';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'project_id',
        'name',
        'assumptions'
    ];

    /**
     * Obtiene el proyecto de un componente
     *
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    /**
     * Obtener todos los indicadores de un componente.
     *
     * @return MorphMany
     */
    public function indicators()
    {
        return $this->morphMany(PlanIndicator::class, 'indicatorable');
    }

    /**
     * Obtiene las actividades para un año fiscal
     *
     * @param int $projectFiscalYearId
     *
     * @return HasMany
     */
    public function activitiesProjectFiscalYear(int $projectFiscalYearId)
    {
        return $this->hasMany(ActivityProjectFiscalYear::class, 'component_id')->where('project_fiscal_year_id', $projectFiscalYearId);
    }

    /**
     * Obtiene todas las actividades
     *
     * @return HasMany
     */
    public function allActivitiesProjectFiscalYear()
    {
        return $this->hasMany(ActivityProjectFiscalYear::class, 'component_id');
    }
}
