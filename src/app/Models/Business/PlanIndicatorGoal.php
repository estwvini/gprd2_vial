<?php

namespace App\Models\Business;

use App\Models\Admin\Threshold;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Clase PlanIndicatorGoal
 *
 * @property float goal_value
 * @property float actual_value
 * @property float min
 * @property float max
 * @property PlanIndicator planIndicator
 * @package App\Models\Business
 * @mixin IdeHelperPlanIndicatorGoal
 */
class PlanIndicatorGoal extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'plan_indicator_goals';

    /**
     * @var bool
     */
    public $timestamps = true;

    const CUMULATIVE = 'accumulated';
    const DISCRETE = 'discreet';
    const ASCENDING = 'ascending';
    const DESCENDING = 'descending';
    const TOLERANCE = 'tolerance';

    /**
     * Devuelve una constante
     *
     * @return string
     */
    public static function getDiscrete()
    {
        return self::DISCRETE;
    }

    /**
     * Devuelve una constante.
     *
     * @return string
     */
    public static function getCumulative()
    {
        return self::CUMULATIVE;
    }

    /**
     * Devuelve una constante.
     *
     * @return string
     */
    public static function getAscending()
    {
        return self::ASCENDING;
    }

    /**
     * Devuelve una constante.
     *
     * @return string
     */
    public static function getDescending()
    {
        return self::DESCENDING;
    }

    /**
     * Devuelve una constante
     *
     * @return string
     */
    public static function getTolerance()
    {
        return self::TOLERANCE;
    }

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'plan_indicator_id',
        'goal_value',
        'actual_value',
        'period',
        'actual_value_user_id'
    ];

    /**
     * Obtener el Indicador del Plan al que pertenece la Meta.
     *
     * @return BelongsTo
     */
    public function planIndicator()
    {
        return $this->belongsTo(PlanIndicator::class, 'plan_indicator_id');
    }

    /**
     * Calcula el porcentaje / desviación alcanzado del indicador
     *
     * @return float|int
     */
    public function calculatePercentage()
    {
        $percentage = 0;
        if ($this->goal_value > 0) {
            if ($this->planIndicator->type == PlanIndicator::TYPE_DESCENDING) {
                if (($this->planIndicator->base_line - $this->goal_value) != 0) {
                    if ($this->planIndicator->goal_type === PlanIndicator::TYPE_DISCREET) {
                        $percentage = (($this->planIndicator->base_line - ($this->planIndicator->base_line - $this->actual_value)) / ($this->planIndicator->base_line - ($this->planIndicator->base_line - $this->goal_value))) * 100;
                    } else {
                        $percentage = (($this->planIndicator->base_line - $this->actual_value) / ($this->planIndicator->base_line - $this->goal_value)) * 100;
                    }
                } else {
                    $percentage = 0;
                }
            } else {
                if ($this->planIndicator->type == PlanIndicator::TYPE_ASCENDING) {
                    $percentage = $this->actual_value * 100 / $this->goal_value;
                }
            }
        } else {

            if ($this->planIndicator->type == PlanIndicator::TYPE_TOLERANCE && !is_null($this->min) && !is_null($this->max) && $this->max > 0 && $this->min > 0) {
                if ($this->actual_value <= $this->max && $this->actual_value >= $this->min) {
                    $percentage = 0;
                } else {
                    $percentage_max = $this->actual_value * 100 / $this->max;
                    $percentage_min = $this->actual_value * 100 / $this->min;
                    $deviation_percentage_max = abs(($percentage_max - 100));
                    $deviation_percentage_min = abs(($percentage_min - 100));
                    $measurement_value = $deviation_percentage_max;
                    if ($deviation_percentage_max > $deviation_percentage_min) {
                        $measurement_value = $deviation_percentage_min;
                    }
                    $percentage = $measurement_value;
                }

            } else {
                $percentage = 0;
            }
        }

        return $percentage;
    }

    /**
     * Obtener el color del umbral.
     *
     * @return mixed
     */
    public function getThresholdColor()
    {
        $percentage = self::calculatePercentage();
        return Threshold::where([['min', '<=', $percentage], ['max', '>=', $percentage], ['type', '=', $this->planIndicator->type]])->value('color');
    }
}