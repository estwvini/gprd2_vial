<?php

namespace App\Models\App\History;

use App\Models\Admin\Department;
use App\Models\BaseModel;

/**
 * @mixin IdeHelperProject
 */
class Project extends BaseModel
{
    protected $table = 'app_dbh_projects';

    public $timestamps = true;

    protected $fillable = [
        'code',
        'name',
        'year',
        'project_related_id',
        'executing_unit_id'
    ];

    protected $with = ['activities'];

    protected $appends = ['encoded'];

    public function executingUnit()
    {
        return $this->belongsTo(Department::class, 'executing_unit_id');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'project_id');
    }

    public function getEncodedAttribute()
    {
        return $this->activities->sum('encoded');
    }

    public function getBeneficiaries()
    {
        return $this->activities->sum('beneficiaries');
    }

    public function rating()
    {
        return 0;
    }
}
