<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Planning\Justification;
use App\Models\Business\Planning\OperationalGoal;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase PlanElement
 *
 * @property mixed code
 * @property mixed description
 * @property PlanElement parent
 * @package App\Models\Business
 * @mixin IdeHelperPlanElement
 */
class PlanElement extends BaseModel
{
    use SoftDeletes;

    const TYPE_THRUST = 'THRUST';
    const TYPE_OBJECTIVE = 'OBJECTIVE';
    const TYPE_STRATEGY = 'STRATEGY';
    const TYPE_POLICY = 'POLICY';
    const TYPE_PROGRAM = 'PROGRAM';
    const TYPE_SUBPROGRAM = 'SUBPROGRAM';
    const TYPE_INDICATOR = 'INDICATOR';
    const TYPE_RISK = 'RISK';
    const TYPE_GOAL = 'GOAL';
    const TYPE_PROJECT = 'PROJECT';

    const PROGRAM_START_CODE = '02';

    const NEXT_ELEMENT = [
        'THRUST' => ['OBJECTIVE'],
        'OBJECTIVE' => ['INDICATOR', 'STRATEGY', 'POLICY', 'PROGRAM', 'RISK'],
        'GOAL' => [],
        'STRATEGY' => [],
        'POLICY' => [],
        'PROGRAM' => ['SUBPROGRAM'],
        'SUBPROGRAM' => ['PROJECT'],
        'PROJECT' => [],
        'RISK' => []
    ];

    const NEXT_ELEMENT_OPERATIONAL= [
        'OBJECTIVE' => ['OPERATIONAL_GOAL'],
        'OPERATIONAL_GOAL' => ['INDICATOR']
    ];

    const OBJECTIVE_FILTER = [
        'SUPRANATIONAL' => ['INDICATOR'],
        'NATIONAL' => ['INDICATOR'],
        'TERRITORIAL' => ['INDICATOR', 'STRATEGY', 'PROGRAM'],
        'INSTITUTIONAL' => ['INDICATOR', 'PROGRAM', 'RISK']
    ];

    const DIMENSION = [
        'VALUE_PUBLIC' => 'Valor Público',
        'PROCESS' => 'Procesos',
        'BUDGET' => 'Presupuesto',
        'HUMAN_TALENT' => 'Talento Humano'
    ];

    /**
     * @var string
     */
    protected $table = 'plan_elements';

    /**
     * @var bool
     */
    public $timestamps = true;


    /**
     * @var array
     */
    protected $fillable = [
        'plan_id',
        'parent_id',
        'description',
        'code',
        'type',
        'product',
        'production_goal',
        'dimension'
    ];

    /**
     * Función de arranque para eliminar lógicamente todas las entidades hijo
     */
    public static function boot()
    {
        parent::boot();

        self::deleting(function ($planElement) {

            $children = $planElement->children();

            if ($children->exists()) {
                $children->each(function ($child) {
                    $child->delete();
                });
            }

        });
    }

    /**
     * Obtener el elemento padre
     *
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(PlanElement::class, 'parent_id');
    }

    /**
     * Obtener los elementos hijo
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(PlanElement::class, 'parent_id', 'id');
    }

    /**
     * Obtener los proyectos de un subprograma
     *
     * @return HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class, 'plan_element_id');
    }

    /**
     * Obtener el plan al que pertenece el elemento
     *
     * @return BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    /**
     * Obtener todos los indicadores del objetivo de un plan.
     *
     * @return MorphMany
     */
    public function indicators()
    {
        return $this->morphMany(PlanIndicator::class, 'indicatorable');
    }

    /**
     * Obtener las justificaciones de un elemento del plan.
     *
     * @return MorphMany
     */
    public function justifications()
    {
        return $this->morphMany(Justification::class, 'justifiable');
    }

    /**
     * Obtener los objetivos operativos
     *
     * @return HasMany
     */
    public function operationalGoals()
    {
        return $this->hasMany(OperationalGoal::class, 'plan_element_id');
    }
}
