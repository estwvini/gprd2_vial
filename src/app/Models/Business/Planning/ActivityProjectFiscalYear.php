<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;
use App\Models\Business\BudgetItem;
use App\Models\Business\Catalogs\Area;
use App\Models\Business\Component;
use App\Models\Business\Task;
use App\Models\System\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase ActivityProjectFiscalYear
 * * @property int id
 *
 * @property Area area
 * @property string code
 * @property string name
 * @property ProjectFiscalYear projectFiscalYear
 * @property int area_id
 * @package App\Models\Business\Planning
 * @mixin IdeHelperActivityProjectFiscalYear
 */
class ActivityProjectFiscalYear extends BaseModel
{
    use SoftDeletes;

    public const RELEVANCE_OPTIONS = [
        '0' => '0',
        '1' => '1',
        '2' => '2',
        '3' => '3'
    ];

    public const TYPE = 'ACTIVITY';

    public const YES = 'Si';

    public const NO = 'No';

    public const FALSE = 'false';

    public const MAX_TOTAL_WEIGHT = 100;

    public const SEMAPHORE = [
        'DELAYED' => 'red',
        'AT_RISK' => 'orange',
        'ONGOING' => 'green'
    ];

    public const GANTT_SEMAPHORE = [
        'red' => 'gtaskred',
        'orange' => 'gtaskyellow',
        'green' => 'gtaskgreen',
        'white' => 'gtaskblue',
    ];

    public const GREEN_LIMIT = 90;
    public const ORANGE_LIMIT = 70;

    /**
     * @var string
     */
    protected $table = 'activity_project_fiscal_years';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'code',
        'name',
        'project_fiscal_year_id',
        'component_id',
        'area_id',
        'date_init',
        'date_end',
        'duration',
        'relevance',
        'weight',
        'weight_percentage',
        'has_budget'
    ];

    /**
     * Obtiene las partidas presupuestarias de una actividad para un año fiscal del proyecto
     *
     * @return HasMany
     */
    public function budgetItems()
    {
        return $this->hasMany(BudgetItem::class, 'activity_project_fiscal_year_id');
    }

    /**
     * Obtiene el área de la actividad
     *
     * @return BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    /**
     * Obtiene el compnente de la actividad
     *
     * @return BelongsTo
     */
    public function component()
    {
        return $this->belongsTo(Component::class, 'component_id');
    }

    /**
     * Obtiene las tareas asociadas a un año fiscal de una actividad
     *
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'activity_project_fiscal_year_id');
    }

    /**
     * Obtiene el usuario responsable de una actividad.
     *
     * @return BelongsToMany
     */
    public function responsible()
    {
        return $this->belongsToMany(User::class, 'users_manages_activities', 'activity_project_fiscal_year_id', 'user_id')
            ->withPivot(['active', 'date_init'])->withTimestamps();
    }

    /**
     * Obtiene año fiscal del proyecto
     *
     * @return BelongsTo
     */
    public function projectFiscalYear()
    {
        return $this->belongsTo(ProjectFiscalYear::class, 'project_fiscal_year_id');
    }

    /**
     * Accesorio para dar formato a date_init
     *
     * @return string
     */
    public function getDateInitAttribute()
    {
        if ($this->attributes['date_init']) {
            return Carbon::parse($this->attributes['date_init'])->format('d-m-Y');
        }
    }

    /**
     * Accesorio para dar formato a date_end
     *
     * @return string
     */
    public function getDateEndAttribute()
    {
        if ($this->attributes['date_end']) {
            return Carbon::parse($this->attributes['date_end'])->format('d-m-Y');
        }
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = preg_replace('!\s+!', ' ', str_replace(['"', "'"], '', $value));
    }

    /**
     * Obtiene el progreso actual de una actividad
     *
     * @return float
     */
    public function getProgress()
    {
        $progress = 0;
        $this->tasks->each(function ($task) use (&$progress) {
            if ($task->status === Task::STATUS_COMPLETED_ONTIME || $task->status === Task::STATUS_COMPLETED_OUTOFTIME) {
                $progress += $task->weight_percentage;
            }
        });

        return (float)number_format($progress, 2, '.', '');
    }

    /**
     * Verifica si existen tareas atrasadas en una actividad
     *
     * @return float
     */
    public function hasDelayedTask()
    {
        $hasDelayedTask = false;
        $this->tasks()->each(function ($task) use (&$hasDelayedTask) {
            if ($task->status === Task::STATUS_DELAYED) {
                $hasDelayedTask = true;
                return false;
            }
        });

        return $hasDelayedTask;
    }

    /**
     * Obtiene el color de semáforo según el progreso alcazado
     *
     * @return mixed
     */
    public function getSemaphore()
    {
        $progress = self::getProgress();

        $dateEnd = Carbon::parse($this->date_end);
        if ($dateEnd->gt(Carbon::now()) && $progress != 0 && !$this->hasDelayedTask()) {
            return 'white';
        }

        if ($progress >= self::GREEN_LIMIT) {
            return self::SEMAPHORE['ONGOING'];
        } elseif ($progress >= self::ORANGE_LIMIT) {
            return self::SEMAPHORE['AT_RISK'];
        } else {
            return self::SEMAPHORE['DELAYED'];
        }
    }

    /**
     * Obtiene el código presupuestario de la actividad.
     *
     * @return string
     */
    public function getProgrammaticCode()
    {
        return $this->area->code . '.' . $this->projectFiscalYear->project->subprogram->parent->code . '.' . $this->projectFiscalYear->project->subprogram->code . '.' .
            $this->projectFiscalYear->project->cup . '.' . $this->projectFiscalYear->project->executingUnit->code . '.' . $this->code;
    }

    public function getCompletedTasks()
    {
        return $this->tasks->filter(function ($task) {
            return $task->status === Task::STATUS_COMPLETED_ONTIME || $task->status === Task::STATUS_COMPLETED_OUTOFTIME;
        });
    }

    public function getReviewTasks()
    {
        return $this->tasks->filter(function ($task) {
            return $task->status === Task::STATUS_TO_REVIEW || $task->status === Task::STATUS_REJECTED;
        });
    }

    public function getDelayedTasks()
    {
        return $this->tasks->filter(function ($task) {
            return $task->status === Task::STATUS_DELAYED;
        });
    }
}
