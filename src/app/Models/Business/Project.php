<?php

namespace App\Models\Business;

use App\Models\Admin\Department;
use App\Models\App\Review;
use App\Models\BaseModel;
use App\Models\Business\Catalogs\Competence;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\Justification;
use App\Models\Business\Planning\OperationalGoal;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\System\File;
use App\Models\System\User;
use App\Traits\ReviewRateable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpOffice\PhpSpreadsheet\Shared\Date;

/**
 * Class Project
 *
 * @property mixed id
 * @property mixed name
 * @property mixed cup
 * @property mixed description
 * @property Department responsibleUnit
 * @property Department executingUnit
 * @property PlanElement subprogram
 * @property mixed referential_budget
 * @property mixed activities
 * @property mixed actions
 * @property string qualitative_benefit
 * @property bool is_road
 * @property Date date_init
 * @property Date date_end
 * @property Competence competence
 * @package App\Models\Business
 * @mixin IdeHelperProject
 */
class Project extends BaseModel
{
    use HasFactory;
    use ReviewRateable;
    use SoftDeletes;

    public const EXECUTION_TERM_PLURIANNUAL = 'Plurianual';
    public const EXECUTION_TERM_ANNUAL = 'Anual';

    // File types
    public const FILE_INITIATIVE = 'initiative';
    public const FILE_PREFEASIBILITY = 'prefeasibility';
    public const FILE_FEASIBILITY = 'feasibility';
    public const FILE_STUDIES = 'studies';
    public const FILE_EXECUTION = 'execution';
    public const FILE_TERMINATION = 'termination';

    public const FILES = [self::FILE_INITIATIVE, self::FILE_PREFEASIBILITY, self::FILE_FEASIBILITY, self::FILE_STUDIES, self::FILE_EXECUTION, self::FILE_TERMINATION];

    // Project actions
    public const ACTION_PROFILE = 'profile';
    public const ACTION_LOGIC_FRAME = 'logic_frame';
    public const ACTION_SCHEDULE = 'schedule';
    public const ACTION_ACTIVITIES = 'activities';
    public const ACTION_ATTACHMENTS = 'attachments';
    public const ACTION_SEND = 'send';

    public const MAX_ALLOWED_VALUE = 9999999999.99;

    public const PROJECT_PHASES = [
        1 => 'Iniciativa',
        2 => 'Prefactibilidad',
        3 => 'Factibilidad',
        4 => 'Estudios definitivos',
        5 => 'Ejecución',
        6 => 'Terminación'
    ];

    public const INITIATIVE = 1;
    public const PREFEASIBILITY = 2;
    public const FEASIBILITY = 3;
    public const STUDIES = 4;
    public const EXECUTION = 5;
    public const TERMINATION = 6;

    public const STATUS_DRAFT = 'DRAFT';
    public const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    public const STATUS_CANCELLED = 'CANCELLED';
    public const STATUS_CLOSED = 'CLOSED';
    public const STATUS_COMPLETED = 'COMPLETED';
    public const STATUS_SUSPENDED = 'SUSPENDED';

    public const STATUS_TRANSITIONS = [
        self::STATUS_DRAFT => [],
        self::STATUS_IN_PROGRESS => [
            self::STATUS_CANCELLED,
            self::STATUS_COMPLETED,
            self::STATUS_SUSPENDED
        ],
        self::STATUS_CANCELLED => [
            self::STATUS_IN_PROGRESS
        ],
        self::STATUS_CLOSED => [],
        self::STATUS_COMPLETED => [
            self::STATUS_IN_PROGRESS,
            self::STATUS_CLOSED
        ],
        self::STATUS_SUSPENDED => [
            self::STATUS_IN_PROGRESS,
            self::STATUS_CANCELLED
        ]
    ];

    public const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_IN_PROGRESS,
        self::STATUS_CANCELLED,
        self::STATUS_CLOSED,
        self::STATUS_COMPLETED,
        self::STATUS_SUSPENDED
    ];

    public const MODULE_PLANNING = 'PLANNING';
    public const MODULE_PROGRAMMATIC_STRUCTURE = 'PROGRAMMATIC_STRUCTURE';
    public const MODULE_REFORM = 'REFORM';
    public const MODULE_REPROGRAMMING = 'REPROGRAMMING';

    /**
     * @var string
     */
    protected $table = 'projects';

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
        'cup',
        'full_cup',
        'description',
        'zone',
        'qualitative_benefit',
        'referential_budget',
        'month_duration',
        'execution_term',
        'date_init',
        'date_end',
        'operational_goal_id',
        'responsible_unit_id',
        'executing_unit_id',
        'requirements',
        'product_description_service',
        'approval_criteria',
        'general_risks',
        'contract_cup',
        'plan_element_id',
        'assumptions',
        'purpose',
        'is_road',
        'phase',
        'tir',
        'van',
        'benefit_cost',
        'status',
        'competence_id',
        'project_related_id'
    ];

    /**
     * Obtiene la unidad responsable del proyecto
     *
     * @return BelongsTo
     */
    public function responsibleUnit()
    {
        return $this->belongsTo(Department::class, 'responsible_unit_id');
    }

    /**
     * Obtiene la unidad ejecutora del proyecto
     *
     * @return BelongsTo
     */
    public function executingUnit()
    {
        return $this->belongsTo(Department::class, 'executing_unit_id');
    }

    /**
     * Obtiene los indicadores del proyecto
     *
     * @return MorphMany
     */
    public function indicators()
    {
        return $this->morphMany(PlanIndicator::class, 'indicatorable');
    }

    /**
     * Obtiene los presupuestos de los años fiscales de un proyecto.
     *
     * @return BelongsToMany
     */
    public function fiscalYears()
    {
        return $this->belongsToMany(FiscalYear::class, 'project_fiscal_years', 'project_id', 'fiscal_year_id')
            ->withPivot('referential_budget');
    }

    /**
     * Obtiene las justificaciones de un proyecto.
     *
     * @return MorphMany
     */
    public function justifications()
    {
        return $this->morphMany(Justification::class, 'justifiable');
    }

    /**
     * Obtiene el subprograma al que pertenece el proyecto.
     *
     * @return BelongsTo
     */
    public function subprogram()
    {
        return $this->belongsTo(PlanElement::class, 'plan_element_id');
    }

    /**
     * Obtiene todos líderes de un proyecto.
     *
     * @return BelongsToMany
     */
    public function leaders()
    {
        return $this->belongsToMany(User::class, 'users_manages_projects', 'project_id', 'user_id')
            ->withPivot('active', 'date_init', 'date_end')->withTimestamps();
    }

    /**
     * Obtiene el líder actual del proyecto
     *
     * @return mixed
     */
    public function activeLeader()
    {
        return $this->leaders()->wherePivot('active', 1)->first();
    }

    /**
     * Obtiene los compoentes de un proyecto.
     *
     * @return HasMany
     */
    public function components()
    {
        return $this->hasMany(Component::class, 'project_id');
    }

    /**
     * Obtener los archivos de un proyecto.
     *
     * @return MorphMany
     */
    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }

    /**
     * Obtiene el código CUP desde programa.
     *
     * @return string
     */
    public function getProgramSubProgramCode()
    {
        return $this->subprogram->parent->code . '.' . $this->subprogram->code . '.' . $this->cup;
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
     * Obtiene los años fiscales de un proyecto
     *
     * @return HasMany
     */
    public function getProjectFiscalYears()
    {
        return $this->hasMany(ProjectFiscalYear::class, 'project_id');
    }

    /**
     * Determina si un proyecto ya se encuentra en ejecución o no.
     *
     * @return bool
     */
    public function isInProgress()
    {
        return $this->getProjectFiscalYears()->where('status', ProjectFiscalYear::STATUS_IN_PROGRESS)->exists();
    }

    /**
     * Obtiene el objetivo operativo
     *
     * @return BelongsTo
     */
    public function operationalGoal()
    {
        return $this->belongsTo(OperationalGoal::class, 'operational_goal_id');
    }

    /**
     * Obtener el usuario que creó el archivo.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'responsible_unit_id');
    }

    public function getBeneficiaries()
    {
        $model = $this->join('project_fiscal_years', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('activity_project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', '=', 'project_fiscal_years.id')
            ->join('tasks', 'tasks.activity_project_fiscal_year_id', '=', 'activity_project_fiscal_years.id')
            ->where([
                ['projects.id', '=', $this->id],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS],
            ])->whereIn('tasks.status', [Task::STATUS_COMPLETED_ONTIME, Task::STATUS_COMPLETED_OUTOFTIME])
            ->selectRaw('sum(tasks.beneficiaries) as total')->first();
        return $model->total;
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable')->whereNull('parent_id');
    }

    public function rating()
    {
        return $this->reviews()->avg('rating');
    }
}
