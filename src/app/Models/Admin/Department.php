<?php

namespace App\Models\Admin;

use App\Models\BaseModel;
use App\Models\Business\Planning\OperationalActivity;
use App\Models\Business\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase Department
 *
 * @property mixed id
 * @property mixed code
 * @property mixed name
 * @property mixed description
 * @package App\Models\Admin
 * @mixin IdeHelperDepartment
 */
class Department extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'departments';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'parent_id',
        'name',
        'description',
        'phone_number',
        'code',
        'enabled'
    ];

    /**
     * Obtener los usuarios que pertenecen al departamento
     *
     * @return BelongsToMany
     */
    public function users()
    {
        return $this
            ->belongsToMany('App\Models\System\User', 'department_has_users', 'department_id', 'user_id')
            ->withPivot('is_manager');
    }

    /**
     * Obtener managers del departamento
     *
     * @return BelongsToMany
     */
    public function managers()
    {
        return $this
            ->belongsToMany('App\Models\System\User', 'department_has_users', 'department_id', 'user_id')
            ->wherePivot('is_manager', 1);
    }

    /**
     * Obtener los usuarios que no son managers
     *
     * @return BelongsToMany
     */
    public function nonManagers()
    {
        return $this
            ->belongsToMany('App\Models\System\User', 'department_has_users', 'department_id', 'user_id')
            ->wherePivot('is_manager', 0);
    }

    /**
     * Obtener el departemento padre
     *
     * @return BelongsTo
     */
    public function parentDepartment()
    {
        return $this->belongsTo(Department::class, 'parent_id');
    }

    /**
     * Obtener los departamentos hijos
     *
     * @return HasMany
     */
    public function childrenDepartments()
    {
        return $this->hasMany(Department::class, 'parent_id');
    }

    /**
     * Obtener los proyectos responsables
     *
     * @return HasMany
     */
    public function responsibleProjects()
    {
        return $this->hasMany(Project::class, 'responsible_unit_id');
    }

    /**
     * Obtener los proyectos ejecutados
     *
     * @return HasMany
     */
    public function executingProjects()
    {
        return $this->hasMany(Project::class, 'executing_unit_id');
    }

    /**
     * Obtener las actividades operativas
     *
     * @return HasMany
     */
    public function responsibleOperationalActivities()
    {
        return $this->hasMany(OperationalActivity::class, 'responsible_unit_id');
    }

    /**
     * Obtener las actividades operativas
     *
     * @return HasMany
     */
    public function executingOperationalActivities()
    {
        return $this->hasMany(OperationalActivity::class, 'executing_unit_id');
    }

    /**
     * Incluir sólo departamentos activos.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeEnabled($query)
    {
        return $query->where('enabled', 1);
    }
}
