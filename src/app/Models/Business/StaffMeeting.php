<?php

namespace App\Models\Business;

use App\Models\Admin\Department;
use App\Models\BaseModel;

/**
 * @mixin IdeHelperStaffMeeting
 */
class StaffMeeting extends BaseModel
{

    protected $table = 'staff_meetings';

    public $timestamps = true;

    public const STATUS_DRAFT = 'PENDIENTE';
    public const STATUS_APPROVED = 'APROBADO';
    public const STATUS_CLOSED = 'CERRADO';

    public const STATUS_BG = [
        self::STATUS_DRAFT => 'warning',
        self::STATUS_APPROVED => 'success',
        self::STATUS_CLOSED => 'info',
    ];

    public const STATUS_EDITABLE = [
        self::STATUS_DRAFT,
        self::STATUS_APPROVED
    ];

    public const STATUS_NEXT = [
        self::STATUS_DRAFT => self::STATUS_APPROVED,
        self::STATUS_APPROVED => self::STATUS_CLOSED,
        self::STATUS_CLOSED => self::STATUS_CLOSED
    ];

    protected $fillable = [
        'department_id',
        'description',
        'status',
        'start',
        'end',
        'week',
        'physical_progress',
        'budget_progress',
    ];

    protected $dates = [
        'start',
        'end'
    ];

    public function activities()
    {
        return $this->hasMany(StaffActivity::class, 'meeting_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
