<?php

namespace App\Models\App\History;

use App\Models\BaseModel;

/**
 * @mixin IdeHelperActivity
 */
class Activity extends BaseModel
{
    protected $table = 'app_dbh_activities';

    public $timestamps = true;

    protected $fillable = [
        'project_id',
        'name',
    ];

    protected $with = ['locations'];

    protected $appends = ['encoded', 'beneficiaries'];

    public function locations()
    {
        return $this->hasMany(ActivityLocation::class, 'activity_id');
    }

    public function getEncodedAttribute()
    {
        return $this->locations->sum('amount');
    }

    public function getBeneficiariesAttribute()
    {
        return $this->locations->sum('beneficiaries');
    }
}
