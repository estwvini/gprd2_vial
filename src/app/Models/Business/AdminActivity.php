<?php

namespace App\Models\Business;

use App\Models\Admin\Department;
use App\Models\BaseModel;
use App\Models\Business\Catalogs\ActivityType;
use App\Models\System\File;
use App\Models\System\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Clase AdminActivity
 *
 * @property Department responsibleUnit
 * @property User assigned
 * @property Comment comments
 * @property string name
 * @property string status
 * @property integer priority
 * @property ActivityType activityType
 * @property string qualification
 * @package App\Models\Business
 * @mixin IdeHelperAdminActivity
 */
class AdminActivity extends BaseModel
{
    use SoftDeletes;

    const STATUS_DRAFT = 'DRAFT';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_COMPLETED = 'COMPLETED';
    const STATUS_CANCELED = 'CANCELED';

    const QUALIFICATION_EXCELLENT = 'EXCELLENT';
    const QUALIFICATION_VERY_GOOD = 'VERY_GOOD';
    const QUALIFICATION_SATISFACTORY = 'SATISFACTORY';
    const QUALIFICATION_DEFICIENT = 'DEFICIENT';
    const QUALIFICATION_UNACCEPTABLE = 'UNACCEPTABLE';

    const PRIORITY_URGENT = 4;
    const PRIORITY_IMPORTANT = 3;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_LOW = 1;

    const FREQUENCY_DAY = 1;
    const FREQUENCY_WEEK = 2;
    const FREQUENCY_MONTH = 3;

    const STATUS = [
        self::STATUS_DRAFT,
        self::STATUS_IN_PROGRESS,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELED
    ];

    const QUALIFICATION = [
        self::QUALIFICATION_EXCELLENT,
        self::QUALIFICATION_VERY_GOOD,
        self::QUALIFICATION_SATISFACTORY,
        self::QUALIFICATION_DEFICIENT,
        self::QUALIFICATION_UNACCEPTABLE
    ];

    const PRIORITIES = [
        self::PRIORITY_URGENT,
        self::PRIORITY_IMPORTANT,
        self::PRIORITY_MEDIUM,
        self::PRIORITY_LOW
    ];

    const FREQUENCIES = [
        self::FREQUENCY_DAY,
        self::FREQUENCY_WEEK,
        self::FREQUENCY_MONTH
    ];

    /**
     * @var string
     */
    protected $table = 'admin_activities';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'status',
        'date_init',
        'date_end',
        'priority',
        'responsible_unit_id',
        'created_by_id',
        'assigned_user_id',
        'fiscal_year_id',
        'check_list',
        'activity_type_id',
        'reason_id',
        'planned_hours',
        'time_spent',
        'qualification'
    ];


    /**
     * Obtiene el usuario asignado a una actividad.
     *
     * @return BelongsTo
     */
    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    /**
     * Obtiene el usuario asignado a una actividad.
     *
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * Obtiene el usuario asignado a una actividad.
     *
     * @return BelongsTo
     */
    public function activityType()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id');
    }

    /**
     * Obtiene la unidad responsable de una actividad.
     *
     * @return BelongsTo
     */
    public function responsibleUnit()
    {
        return $this->belongsTo(Department::class, 'responsible_unit_id');
    }

    /**
     * Obtener los archivos de una actividad.
     *
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * Obtener los comentarios de una actividad.
     *
     * @return MorphMany
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
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
     * Accesorio para dar formato a date_init
     *
     * @return string
     */
    public function getUpdatedAtAttribute()
    {
        if ($this->attributes['updated_at']) {
            return Carbon::parse($this->attributes['updated_at'])->format('d-m-Y');
        }
    }

    /**
     * Funcion para obtener la lsita de actividades
     *
     * @return array
     */
    public function getCheckList()
    {
        return json_decode($this->check_list, true);
    }

    /**
     * Funcion para obtener el porcentaje de avance
     *
     * @return array
     */
    public function getPercentageCheckList()
    {
        $hasProgress = 0;
        $count = count($this->getCheckList());
        if ($count > 0) {
            $checkList = $this->getCheckList();
            foreach ($checkList as $item) {
                if ($item['completed']) {
                    $hasProgress += 1;
                }
            }
            return $hasProgress / $count * 100;

        } else {
            return $hasProgress;
        }
    }
}