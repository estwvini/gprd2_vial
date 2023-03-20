<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;
use App\Models\Business\PlanElement;
use App\Models\Business\PlanIndicator;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase OperationalGoal
 *
 * @package App\Models\Business\Planning
 * @mixin IdeHelperOperationalGoal
 */
class OperationalGoal extends BaseModel
{
    use SoftDeletes;

    const TYPE_OPERATIONAL_GOAL = 'OPERATIONAL_GOAL';

    protected $table = 'operational_goals';

    public $timestamps = true;

    protected $fillable = [
        'plan_element_id',
        'fiscal_year_id',
        'code',
        'name'
    ];

    /**
     * Obtener objetivo de PEI.
     *
     * @return BelongsTo
     */
    public function planElement()
    {
        return $this->belongsTo(PlanElement::class, 'plan_element_id');
    }

    /**
     * Obtener el año fiscal.
     *
     * @return BelongsTo
     */
    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id');
    }

    /**
     * Obtener todos los indicadores del objetivo operativo.
     *
     * @return MorphMany
     */
    public function indicators()
    {
        return $this->morphMany(PlanIndicator::class, 'indicatorable');
    }
}
