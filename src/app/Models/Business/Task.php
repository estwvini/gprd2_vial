<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\System\File;
use App\Models\System\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase Task
 *
 * @property string status
 * @property string name
 * @property string date_end
 * @property mixed responsible
 * @package App\Models\Business
 * @mixin IdeHelperTask
 */
class Task extends BaseModel
{
    use SoftDeletes;

    const TYPE_TASK = 'TASK';
    const TYPE_MILESTONE = 'MILESTONE';

    const ELEMENT_TYPE = [
        self::TYPE_TASK => 'TASK',
        self::TYPE_MILESTONE => 'MILESTONE'
    ];

    const MIN_WEIGHT_MILESTONE = 11;
    const MAX_NAME_LENGTH = 140;

    const STATUS_PENDING = 'PENDING';
    const STATUS_DELAYED = 'DELAYED';
    const STATUS_TO_REVIEW = 'TO_REVIEW';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_COMPLETED_ONTIME = 'COMPLETED_ONTIME';
    const STATUS_COMPLETED_OUTOFTIME = 'COMPLETED_OUTOFTIME';
    const ALL = 'ALL';

    const SEMAPHORE = [
        'PENDING' => 'white',
        'DELAYED' => 'red',
        'TO_REVIEW' => 'purple',
        'REJECTED' => 'red_300',
        'COMPLETED_ONTIME' => 'green',
        'COMPLETED_OUTOFTIME' => 'orange'
    ];

    const GANTT_SEMAPHORE = [
        'red' => 'gtaskred',
        'orange' => 'gtaskyellow',
        'green' => 'gtaskgreen',
        'white' => 'gtaskblue',
    ];

    const STATUS = [
        self::STATUS_DELAYED,
        self::STATUS_PENDING,
        self::STATUS_TO_REVIEW,
        self::STATUS_REJECTED
    ];

    /**
     * @var string
     */
    protected $table = 'tasks';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'activity_project_fiscal_year_id',
        'approval_user_id',
        'name',
        'type',
        'date_init',
        'date_end',
        'due_date',
        'duration',
        'weight_percentage',
        'status',
        'beneficiaries'
    ];

    /**
     * Obtiene la actividad
     *
     * @return BelongsTo
     */
    public function activityProjectFiscalYear()
    {
        return $this->belongsTo(ActivityProjectFiscalYear::class, 'activity_project_fiscal_year_id');
    }

    /**
     * Obtiene el usuario responsable de una tarea.
     *
     * @return BelongsToMany
     */
    public function responsible()
    {
        return $this->belongsToMany(User::class, 'users_manages_tasks', 'task_id', 'user_id')
            ->withPivot(['active', 'date_init'])->withTimestamps();
    }

    /**
     * Obtener archivo adjunto.
     *
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
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

    /**
     * Accesorio para dar formato a due_date
     *
     * @return string
     */
    public function getDueDateAttribute()
    {
        if ($this->attributes['due_date']) {
            return Carbon::parse($this->attributes['due_date'])->format('d-m-Y');
        }
    }

    /**
     * Accesorio para calcular el estado de la tarea
     *
     * @return string
     */
    public function getStatusAttribute()
    {
        $dateEnd = Carbon::parse($this->attributes['date_end']);
        if (in_array($this->attributes['status'], [self::STATUS_PENDING, self::STATUS_REJECTED]) and $dateEnd->lt(Carbon::now())) {
            return self::STATUS_DELAYED;
        } else {
            return $this->attributes['status'];
        }
    }

    /**
     * Obtener todos los rechazos de una tarea/hito.
     *
     * @return MorphMany
     */
    public function rejections()
    {
        return $this->morphMany(Reject::class, 'rejectable');
    }
}
