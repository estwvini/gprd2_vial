<?php

namespace App\Models\Business\Planning;

use Altek\Accountant\Contracts\Identifiable;
use Altek\Accountant\Contracts\Recordable;
use Altek\Eventually\Eventually;
use App\Models\Business\Project;
use App\Models\Business\Reject;
use App\Models\Business\Task;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Clase ProjectFiscalYear
 *
 * @property int id
 * @property int fiscal_year_id
 * @property FiscalYear fiscalYear
 * @property Project project
 * @package App\Models\Business\Planning
 * @mixin IdeHelperProjectFiscalYear
 */
class ProjectFiscalYear extends Pivot implements Identifiable, Recordable
{
    use \Altek\Accountant\Recordable, Eventually;

    // Project statuses
    const STATUS_DRAFT = 'DRAFT';
    const STATUS_TO_REVIEW = 'TO_REVIEW';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_REVIEWED = 'REVIEWED';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_CANCELLED = 'CANCELLED';
    const STATUS_CLOSED = 'CLOSED';
    const COLOR_RED = 'red';
    const COLOR_ORANGE = 'orange';
    const COLOR_GREEN = 'green';

    // Project statuses flow
    //TODO: verificar el flujo de los estados
    const NEXT_STATUS = [
        self::STATUS_DRAFT => [self::STATUS_TO_REVIEW],
        self::STATUS_TO_REVIEW => [self::STATUS_REJECTED, self::STATUS_REVIEWED],
        self::STATUS_REJECTED => [self::STATUS_TO_REVIEW],
        self::STATUS_REVIEWED => [self::STATUS_IN_PROGRESS],
        self::STATUS_IN_PROGRESS => [self::STATUS_CANCELLED, self::STATUS_CLOSED],
        self::STATUS_CANCELLED => [self::STATUS_CLOSED]
    ];

    const SEMAPHORE = [
        'DELAYED' => self::COLOR_RED,
        'AT_RISK' => self::COLOR_ORANGE,
        'ONGOING' => self::COLOR_GREEN
    ];

    const GREEN_LIMIT = 90;
    const ORANGE_LIMIT = 70;

    protected $table = 'project_fiscal_years';

    public $timestamps = false;

    const MODULE = [
        'PLANNING' => 'PLANNING',
        'EXECUTION' => 'EXECUTION'
    ];

    protected $fillable = [
        'referential_budget',
        'project_id',
        'fiscal_year_id',
        'status'
    ];

    /**
     * Obtener el proyecto.
     *
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
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
     * Obtener la priorización.
     *
     * @return HasOne
     */
    public function prioritization()
    {
        return $this->hasOne(Prioritization::class, 'project_fiscal_year_id');
    }

    /**
     * Obtiene las actividades por año fiscal de un proyecto
     *
     * @return HasMany
     */
    public function activitiesProjectFiscalYear()
    {
        return $this->hasMany(ActivityProjectFiscalYear::class, 'project_fiscal_year_id');
    }

    /**
     * Obtiene el progreso actual de un proyecto
     *
     * @return float
     */
    public function getProgress()
    {
        $progress = 0;

        $this->activitiesProjectFiscalYear->each(function ($activity) use (&$progress) {
            $progress += $activity->getProgress() * $activity->weight_percentage / 100;
        });

        if ($progress > 100) {
            $progress = 100;
        }

        return (float)number_format($progress, 2, '.', '');
    }

    /**
     * Obtiene el color de semáforo según el progreso físico alcazado
     *
     * @return mixed
     */
    public function getSemaphore()
    {
        $progress = self::getProgress();

        if ($progress >= self::GREEN_LIMIT) {
            return self::SEMAPHORE['ONGOING'];
        } elseif ($progress >= self::ORANGE_LIMIT) {
            return self::SEMAPHORE['AT_RISK'];
        } else {
            return self::SEMAPHORE['DELAYED'];
        }

    }

    /**
     * Obtiene el color de semáforo según el avance presupuestario
     *
     * @return mixed
     */
    public function getBudgetSemaphore()
    {
        if (!$this->budgetProgress) {
            return self::SEMAPHORE['DELAYED'];
        }

        if ($this->budgetProgress >= self::GREEN_LIMIT) {
            return self::SEMAPHORE['ONGOING'];
        } elseif ($this->budgetProgress >= self::ORANGE_LIMIT) {
            return self::SEMAPHORE['AT_RISK'];
        } else {
            return self::SEMAPHORE['DELAYED'];
        }

    }

    /**
     * Obtener todos los rechazos del proyecto.
     *
     * @return MorphMany
     */
    public function rejections()
    {
        return $this->morphMany(Reject::class, 'rejectable');
    }

    public function getCompletedTasksCount()
    {
        $count = 0;

        $this->activitiesProjectFiscalYear->each(function ($activity) use (&$count) {
            $count += $activity->getCompletedTasks()->count();
        });

        return $count;
    }

    public function getReviewTasksCount()
    {
        $count = 0;

        $this->activitiesProjectFiscalYear->each(function ($activity) use (&$count) {
            $count += $activity->getReviewTasks()->count();
        });

        return $count;
    }

    public function getDelayedTasksCount()
    {
        $count = 0;

        $this->activitiesProjectFiscalYear->each(function ($activity) use (&$count) {
            $count += $activity->getDelayedTasks()->count();
        });

        return $count;
    }
}
