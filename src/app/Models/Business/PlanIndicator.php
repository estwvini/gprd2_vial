<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Catalogs\MeasureUnit;
use App\Models\Business\Planning\Justification;
use App\Models\System\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Clase PlanIndicator
 *
 * @property string type
 * @property float base_line
 * @property Collection planIndicatorGoals
 * @package App\Models\Business
 * @mixin IdeHelperPlanIndicator
 */
class PlanIndicator extends BaseModel
{

    use SoftDeletes;

    const STATUS_DRAFT = 'draft';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    const STATUS_FIXED = 'fixed';
    const INDICATORABLE_PROJECT = 'project';
    const INDICATORABLE_PLAN = 'plan';
    const INDICATORABLE_COMPONENT = 'component';
    const INDICATORABLE_OPERATIONAL_GOAL = 'operational_goal';
    const INDICATORABLE_ACTIVITY_ROUTE = 'App\Models\Business\Activity';
    const INDICATORABLE_PLAN_ELEMENT_ROUTE = 'App\Models\Business\PlanElement';
    const DEFAULT_FISCAL_YEAR = 0;
    const DEFAULT_FREQUENCY_PEI = 3;
    const DEFAULT_FREQUENCY_PDOT = 1;
    const BIANNUAL_FREQUENCY = 2;

    const TYPE_TOLERANCE = 'tolerance';
    const TYPE_ASCENDING = 'ascending';
    const TYPE_DESCENDING = 'descending';

    const TYPE_DISCREET = 'discreet';
    const TYPE_ACCUMULATED = 'accumulated';
    const TYPE_YEAR = 'year';
    const TYPE_SEMESTER = 'semester';

    const TYPE_DANGER = 'danger';
    const TYPE_WARNING = 'warning';
    const TYPE_SUCCESS = 'success';

    const ANNUAL_FREQUENCY = 1;
    const SEMESTER_FREQUENCY = 2;
    const TRIMESTER_FREQUENCY = 4;


    const FILTER_ANNUAL = 1;
    const FILTER_FIRST_SEMESTER = 2;
    const FILTER_SECOND_SEMESTER = 3;

    const FILTER_FIRST_TRIMESTER = 4;
    const FILTER_SECOND_TRIMESTER = 5;
    const FILTER_THIRD_TRIMESTER = 6;
    const FILTER_FOURTH_TRIMESTER = 7;


    const FREQUENCY_FILTER_EQUIVALENCE = [
        self::FILTER_ANNUAL => self::ANNUAL_FREQUENCY,
        self::FILTER_FIRST_SEMESTER => self::SEMESTER_FREQUENCY,
        self::FILTER_SECOND_SEMESTER => self::SEMESTER_FREQUENCY,

        self::FILTER_FIRST_TRIMESTER => self::TRIMESTER_FREQUENCY,
        self::FILTER_SECOND_TRIMESTER => self::TRIMESTER_FREQUENCY,
        self::FILTER_THIRD_TRIMESTER => self::TRIMESTER_FREQUENCY,
        self::FILTER_FOURTH_TRIMESTER => self::TRIMESTER_FREQUENCY
    ];

    /**
     * @var string
     */
    protected $table = 'plan_indicators';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'measuring_unit',
        'technical_file',
        'calculation_formula',
        'base_line',
        'base_line_year',
        'type',
        'goal_type',
        'goal',
        'goal_description',
        'source',
        'measurement_frequency_per_year',
        'status',
        'rejected_comments',
        'creator_user_id',
        'approval_user_id',
        'measure_unit_id',
        'indicatorable_type',
        'indicatorable_id'
    ];

    /**
     * Get all of the owning indicatorable models.
     *
     * @return MorphTo
     */
    public function indicatorable()
    {
        return $this->morphTo();
    }

    /**
     * Obtiene el objetivo del indicador
     *
     * @return BelongsTo
     */
    public function objective()
    {
        return $this->belongsTo(PlanElement::class, 'indicatorable_id')
            ->where('plan_indicators.indicatorable_type', PlanElement::class);
    }


    /**
     * Obtiene el projecto del indicador
     *
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'indicatorable_id')
            ->where('plan_indicators.indicatorable_type', Project::class);
    }

    /**
     * Obtiene el componente del indicador
     *
     * @return BelongsTo
     */
    public function component(): BelongsTo
    {
        return $this->belongsTo(Component::class, 'indicatorable_id')
            ->where('plan_indicators.indicatorable_type', Component::class);
    }

    /**
     * Obtener las metas del indicador
     *
     * @return HasMany
     */
    public function planIndicatorGoals()
    {
        return $this->hasMany(PlanIndicatorGoal::class, 'plan_indicator_id');
    }

    /**
     * % de Avance.
     *
     * @return bool
     */
    public function progress()
    {
        $this->planIndicatorGoals->each(function ($goal) use (&$hasProgress) {
            if ($goal->actual_value != null) {
                $hasProgress = true;
                return false;
            }
        });

        return $hasProgress;
    }

    /**
     * Verificar si el indicador tiene registro de avance.
     *
     * @return bool
     */
    public function hasProgress()
    {
        $hasProgress = false;
        $this->planIndicatorGoals->each(function ($goal) use (&$hasProgress) {
            if ($goal->actual_value != null) {
                $hasProgress = true;
                return false;
            }
        });

        return $hasProgress;
    }

    /**
     * Verificar si el usuario tiene una foto asociada.
     *
     * @return bool
     */
    public function hasTechnicalFile()
    {
        return null != $this->technical_file;
    }

    /**
     * Obtener la ruta de la foto del usuario.
     *
     * @return string
     */
    public function photoPath()
    {
        if ($this->hasPhoto()) {
            return 'images/images/' . $this->photo;
        }
        return 'images/user.png';
    }

    /**
     * Frecuencia de medicion, semestral y anual
     *
     * @return array
     */
    public static function measuringFrequencies()
    {
        return [
            '4' => trans('plan_indicators.enums.measuring_frequencies.' . '4'),
            '2' => trans('plan_indicators.enums.measuring_frequencies.' . '2'),
            '1' => trans('plan_indicators.enums.measuring_frequencies.' . '1')
        ];
    }

    /**
     * Frecuencia de medicion, semestral y anual
     *
     * @return array
     */
    public static function measuringFrequenciesCharts()
    {
        return [
            '4' => trans('plan_indicators.enums.measuring_frequencies_chart.' . '4'),
            '2' => trans('plan_indicators.enums.measuring_frequencies_chart.' . '2'),
            '1' => trans('plan_indicators.enums.measuring_frequencies_chart.' . '1')
        ];
    }

    /**
     * Frecuencia de medición, semestre 1, semestre 2 y anual
     *
     * @return array
     */
    public static function measuringFrequenciesChartsProgress()
    {
        return [
            '1' => trans('indicator_tracking.enums.measuring_frequencies.' . self::FILTER_ANNUAL),
            '2' => trans('indicator_tracking.enums.measuring_frequencies.' . self::FILTER_FIRST_SEMESTER),
            '3' => trans('indicator_tracking.enums.measuring_frequencies.' . self::FILTER_SECOND_SEMESTER),
            '4' => trans('indicator_tracking.enums.measuring_frequencies.' . self::FILTER_FIRST_TRIMESTER),
            '5' => trans('indicator_tracking.enums.measuring_frequencies.' . self::FILTER_SECOND_TRIMESTER),
            '6' => trans('indicator_tracking.enums.measuring_frequencies.' . self::FILTER_THIRD_TRIMESTER),
            '7' => trans('indicator_tracking.enums.measuring_frequencies.' . self::FILTER_FOURTH_TRIMESTER)
        ];
    }

    /**
     * Tipos
     *
     * @return array
     */
    public static function types()
    {
        return [
            'ascending' => trans('plan_indicators.enums.types.' . 'ascending'),
            'descending' => trans('plan_indicators.enums.types.' . 'descending'),
            'tolerance' => trans('plan_indicators.enums.types.' . 'tolerance')
        ];
    }

    /**
     * Tipos de meta
     *
     * @return array
     */
    public static function goalTypes()
    {
        return [
            'discreet' => trans('plan_indicators.enums.goal_types.' . 'discreet'),
            'accumulated' => trans('plan_indicators.enums.goal_types.' . 'accumulated')
        ];
    }

    /**
     * Retorna las articulaciones padre
     *
     * @return BelongsToMany
     */
    public function parentLinks()
    {
        return $this->belongsToMany(PlanIndicator::class, 'links', 'child_indicator', 'parent_indicator');
    }

    /**
     * Retorna las articulaciones hijo
     *
     * @return BelongsToMany
     */
    public function childLinks()
    {
        return $this->belongsToMany(PlanIndicator::class, 'links', 'parent_indicator', 'child_indicator');
    }

    /**
     * Obtener la unidad de medida.
     *
     * @return BelongsTo
     */
    public function measureUnit()
    {
        return $this->belongsTo(MeasureUnit::class, 'measure_unit_id');
    }

    /**
     * Obtener las justificaciones de un indicador.
     *
     * @return MorphMany
     */
    public function justifications()
    {
        return $this->morphMany(Justification::class, 'justifiable');
    }

    /**
     * Obtener el usuario que creó el archivo.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'creator_user_id');
    }

    /**
     * Obtener el porcentage de ejecucion de los indicadores
     *
     * @param Model $indicator
     * @return BelongsTo
     */
    public function calculatePercentageIndicator(Model $indicator)
    {

        $total_min_values = 0;
        $total_max_values = 0;
        $const_progress = 0;
        $const_goal = 0;
        $count = 0;
        $percentage = 0;
        if ($indicator->type == PlanIndicator::TYPE_ASCENDING) {
            if ($indicator->goal_type == PlanIndicator::TYPE_DISCREET) {
                foreach ($indicator->planIndicatorGoals as $indicatorGoal) {
                    if ($count == 0) {
                        $const_progress = $indicatorGoal->goal_value + $indicator->base_line;
                        $const_goal = $indicatorGoal->actual_value + $indicator->base_line;
                    } else {
                        $const_progress = $indicatorGoal->goal_value + $const_goal;
                        $const_goal = $indicatorGoal->actual_value + $const_goal;
                    }
                    $count += 1;
                }
                $total_goal_values = $const_progress - $indicator->base_line;
                $total_actual_values = $const_goal - $indicator->base_line;
                $count = 0;
            } else {
                $const_progress = 0;
                $const_goal = 0;
                $total_actual_values = 0;
                $total_goal_values = 0;
                foreach ($indicator->planIndicatorGoals as $indicatorGoal) {
                    if ($indicatorGoal->goal_value != null) {
                        $const_progress = $indicatorGoal->goal_value;
                    }
                    if ($indicatorGoal->actual_value != null) {
                        $const_goal = $indicatorGoal->actual_value;
                    }
                }
                $total_goal_values = $const_progress;
                $total_actual_values = $const_goal;
            }
        } elseif ($indicator->type == PlanIndicator::TYPE_DESCENDING) {
            if ($indicator->goal_type == PlanIndicator::TYPE_DISCREET) {
                $const_progress = 0;
                $const_goal = 0;
                $total_actual_values = 0;
                $total_goal_values = 0;
                foreach ($indicator->planIndicatorGoals as $indicatorGoal) {
                    if ($count == 0) {
                        $const_progress = $indicator->base_line - $indicatorGoal->goal_value;
                        $const_goal = $indicator->base_line - $indicatorGoal->actual_value;
                    } else {
                        $const_progress = $const_progress - $indicatorGoal->goal_value;
                        $const_goal = $const_goal - $indicatorGoal->actual_value;
                    }
                    $count += 1;
                }
                $total_goal_values = $indicator->base_line - $const_progress;
                $total_actual_values = $indicator->base_line - $const_goal;
                $count = 0;
            } else {
                $const_progress = 0;
                $const_goal = 0;
                $total_actual_values = 0;
                $total_goal_values = 0;
                foreach ($indicator->planIndicatorGoals as $indicatorGoal) {
                    if ($indicatorGoal->goal_value != null) {
                        $const_progress = $indicatorGoal->goal_value;
                    }
                    if ($indicatorGoal->actual_value != null) {
                        $const_goal = $indicatorGoal->actual_value;
                    }
                }
                $total_goal_values = $const_progress;
                $total_actual_values = $const_goal;
            }
        } else {
            $total_actual_values = 0;
            $total_goal_values = 0;
            $total_max_values = 0;
            $total_min_values = 0;
            foreach ($indicator->planIndicatorGoals as $indicatorGoal) {
                if ($indicatorGoal->actual != null) {
                    $total_actual_values = $indicatorGoal->actual_value;
                }
                if ($indicatorGoal->min > 0) {
                    $total_min_values = $indicatorGoal->min;
                }
                if ($indicatorGoal->max > 0) {
                    $total_max_values = $indicatorGoal->max;
                }
            }
        }
        if ($total_actual_values != 0) {
            if ($indicator->type == PlanIndicator::TYPE_ASCENDING) {
                if ($total_goal_values > 0) {
                    $percentage = (float)(($total_actual_values * 100) / $total_goal_values);
                }
            } elseif ($indicator->type == PlanIndicator::TYPE_DESCENDING) {
                if ($total_goal_values > 0) {
                    if ($indicator->goal_type == PlanIndicator::TYPE_DISCREET) {
                        $percentage = ($total_actual_values / $total_goal_values) * 100;
                    } else {
                        $percentage = ((($indicator->base_line - $total_goal_values) / ($indicator->base_line - $total_actual_values)) * 100);
                    }
                }
            } else {
                $percentage_max = $total_actual_values * 100 / (float)$total_max_values;
                $percentage_min = $total_actual_values * 100 / (float)$total_min_values;
                $deviation_percentage_max = abs($percentage_max - 100);
                $deviation_percentage_min = abs($percentage_min - 100);
                if ($total_actual_values >= $total_min_values && $total_actual_values <= $total_max_values) {
                    $percentage = 0;
                } else {
                    $measurement_value = $deviation_percentage_max;
                    if ($deviation_percentage_max > $deviation_percentage_min) {
                        $measurement_value = $deviation_percentage_min;
                    }
                    $percentage = $measurement_value;
                }
            }
        }
        return [
            'total_actual_values' => $total_actual_values,
            'percentage' => $percentage,
            'total_goal_values' => $total_goal_values
        ];
    }
}
