<?php

namespace App\Models\App;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperVisitClient
 */
class VisitClient extends Model
{
    protected $table = 'app_visits';

    protected $fillable = [
        'visit_at', 'client_id'
    ];

    public function visit_client()
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }
}
