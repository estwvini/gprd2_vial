<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;
use App\Models\Business\Project;
use App\Models\System\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase UserManagesProjects
 *
 * @property int active
 * @property string date_init
 * @property string date_end
 * @property Project|null project
 * @property User|null user
 * @package App\Models\Business\Planning
 * @mixin IdeHelperUserManagesProjects
 */
class UserManagesProjects extends BaseModel
{
    use SoftDeletes;

    protected $table = 'users_manages_projects';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'project_id',
        'active',
        'date_init',
        'date_end'
    ];

    /**
     * Obtener el usuario.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtener el proyecto.
     *
     * @return BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
