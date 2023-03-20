<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Catalogs\Institution;

/**
 * @mixin IdeHelperStaffActivity
 */
class StaffActivity extends BaseModel
{

    protected $table = 'staff_activities';

    public $timestamps = true;

    public const STATUS_DRAFT = 'PENDIENTE';
    public const STATUS_CLOSED = 'COMPLETADO';

    public const TYPE_STRATEGIC = 'ESTRATÉGICA';
    public const TYPE_ADMIN = 'ADMINISTRATIVA';
    public const TYPE_ALERT = 'ALERTA';
    public const TYPE_COORDINATION = 'COORDINACIÓN';

    public const SCOPE_INSTITUTIONAL = 'INSTITUCIONAL';
    public const SCOPE_GAD = 'GAD';
    public const SCOPE_EXECUTIVE = 'EJECUTIVO';
    public const SCOPE_OTHERS = 'OTROS';

    public const SCOPES = [
        self::SCOPE_INSTITUTIONAL,
        self::SCOPE_GAD,
        self::SCOPE_EXECUTIVE,
        self::SCOPE_OTHERS,
    ];

    public const STATUS_BG = [
        self::STATUS_DRAFT => 'warning',
        self::STATUS_CLOSED => 'info',
    ];

    protected $fillable = [
        'meeting_id',
        'parent_id',
        'name',
        'status',
        'type',
        'is_extra',
        'date_end',
        'scope',
        'requires_media_coverage',
        'is_public_purchase'
    ];

    protected $dates = [
        'start',
        'end'
    ];

    protected $appends = [
        'alert_count',
        'coordination_count',
    ];

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($item) {
            $item->activitiesRelated()->each(function ($act) {
                $act->delete();
            });
            $item->institutions()->sync([]);
        });
    }

    public function getAlertCountAttribute()
    {
        return $this->alerts()->count();
    }

    public function getCoordinationCountAttribute()
    {
        return $this->coordinations()->count();
    }

    public function meeting()
    {
        return $this->belongsTo(StaffMeeting::class, 'meeting_id');
    }

    public function activitiesRelated()
    {
        return $this->hasMany(StaffRelatedActivity::class, 'activity_id', 'id');
    }

    public function institutions()
    {
        return $this->belongsToMany(Institution::class, 'staff_activity_institutions', 'activity_id', 'institution_id');
    }

    public function alerts()
    {
        return $this->hasMany(StaffActivity::class, 'parent_id')->where('type', self::TYPE_ALERT);
    }

    public function coordinations()
    {
        return $this->hasMany(StaffActivity::class, 'parent_id')->where('type', self::TYPE_COORDINATION);
    }
}
