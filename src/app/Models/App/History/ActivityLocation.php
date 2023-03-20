<?php

namespace App\Models\App\History;

use App\Models\BaseModel;

/**
 * @mixin IdeHelperActivityLocation
 */
class ActivityLocation extends BaseModel
{
    protected $table = 'app_dbh_activity_locations';

    public $timestamps = true;

    protected $fillable = [
        'activity_id',
        'location_id',
        'amount',
        'beneficiaries'
    ];
}
