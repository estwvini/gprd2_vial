<?php

namespace App\Models\Business;

use App\Models\BaseModel;

/**
 * @mixin IdeHelperStaffRelatedActivity
 */
class StaffRelatedActivity extends BaseModel
{

    protected $table = 'staff_related_activities';

    public $timestamps = false;

    protected $fillable = [
        'activity_id',
        'relatable_type',
        'relatable_id',
    ];

    public function relatable()
    {
        return $this->morphTo();
    }

}
