<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Planning\Justification;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase Plan
 *
 * @property int start_year
 * @property int end_year
 * @package App\Models\Business
 * @mixin IdeHelperPlan
 */
class Plan extends BaseModel
{
    use SoftDeletes;

    const TYPE_ODS = 'ODS';
    const TYPE_PND = 'PND';
    const TYPE_PDOT = 'PDOT';
    const TYPE_SECTORAL = 'SECTORAL';
    const TYPE_PEI = 'PEI';
    const TYPE_OTHER = 'OTHER';

    const SCOPE_SUPRANATIONAL = 'SUPRANATIONAL';
    const SCOPE_NATIONAL = 'NATIONAL';
    const SCOPE_TERRITORIAL = 'TERRITORIAL';
    const SCOPE_INSTITUTIONAL = 'INSTITUTIONAL';

    const STATUS_DRAFT = 'DRAFT';
    const STATUS_VERIFIED = 'VERIFIED';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_ARCHIVED = 'ARCHIVED';

    const PEI_DURATION = 5;

    const FIXED_PLANS = [
        self::TYPE_ODS,
        self::TYPE_PND,
        self::TYPE_PDOT,
        self::TYPE_PEI
    ];

    const HAS_VIEW = 1;
    const HAS_NOT_VIEW = 0;

    const INITIAL_ELEMENT = [
        'SUPRANATIONAL' => [
            'ODS' => 'OBJECTIVE',
            'OTHER' => 'OBJECTIVE'
        ],
        'NATIONAL' => [
            'PND' => 'THRUST',
            'OTHER' => 'THRUST'
        ],
        'TERRITORIAL' => [
            'PDOT' => 'THRUST',
            'SECTORAL' => 'OBJECTIVE'
        ],
        'INSTITUTIONAL' => [
            'PEI' => 'OBJECTIVE',
            'OTHER' => 'OBJECTIVE'
        ]

    ];

    const LINKS = [
        'PDOT' => [
            'PND',
            'ODS'
        ],
        'SECTORAL' => [
            'PND',
            'ODS'
        ],
        'PEI' => [
            'PDOT',
            'SECTORAL'
        ]
    ];

    const STATUS_COLOR = ['incomplete glyphicon glyphicon-remove', 'partial glyphicon glyphicon-alert', 'complete glyphicon glyphicon-ok'];

    /**
     * @var string
     */
    protected $table = 'plans';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'vision',
        'mission',
        'scope',
        'type',
        'start_year',
        'end_year',
        'status',
        'incoming_plan'
    ];

    /**
     * Obtener los elementos de un plan
     *
     * @return HasMany
     */
    public function planElements()
    {
        return $this->hasMany(PlanElement::class, 'plan_id');
    }

    /**
     * Obtener las justificaciones de un plan.
     *
     * @return MorphMany
     */
    public function justifications()
    {
        return $this->morphMany(Justification::class, 'justifiable');
    }
}
