<?php

namespace App\Models\System;

use Altek\Accountant\Ciphers\Bleach;
use Altek\Accountant\Contracts\Identifiable;
use Altek\Accountant\Contracts\Recordable;
use Altek\Eventually\Eventually;
use App\Models\Admin\Department;
use App\Models\Business\Catalogs\HiringModalities;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\UserManagesProjects;
use App\Models\Business\Task;
use App\Notifications\ResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Laverix\Acl\Models\Eloquent\User as Acl;

/**
 * Clase User
 *
 * @property Collection roles
 * @property int id
 * @property string email
 * @package App\Models\System
 * @mixin IdeHelperUser
 */
class User extends Acl implements Identifiable, Recordable
{
    use Notifiable, \Altek\Accountant\Recordable, Eventually, HasApiTokens, HasFactory;

    const ADMIN = 'administrator';
    const DEVELOPER = 'developer';

    /**
     * Cifrado.
     *
     * @var array
     */
    protected $ciphers = [
        'password' => Bleach::class,
        'remember_token' => Bleach::class
    ];

    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'password',
        'remember_token',
        'changed_password',
        'identification_type',
        'enabled'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Obtener el nombre completo de un usuario.
     *
     * @return string
     */
    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Obtener el nombre completo de un usuario iniciando con el apellido.
     *
     * @return string
     */
    public function fullNameWithLastNameFirst()
    {
        return $this->last_name . ' ' . $this->first_name;
    }

    /**
     * Obtener acrónimo del nombre completo de un usuario
     *
     * @return string
     */
    public function getAcronym()
    {
        $words = explode(" ", preg_replace('!\s+!', ' ', trim($this->fullName())));
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= $w[0];
        }

        return $acronym;
    }

    /**
     * Verificar si el usuario tiene una foto asociada.
     *
     * @return bool
     */
    public function hasPhoto()
    {
        return null != $this->photo;
    }

    /**
     * Obtener la ruta de la foto del usuario.
     *
     * @return string
     */
    public function photoPath()
    {
        if ($this->hasPhoto()) {
            return 'profiles/' . $this->photo;
        }
        return 'images/user.png';
    }

    /**
     * Obtener los roles de un usuario.
     *
     * @return Model|BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Obtener los departamentos relacionados al usuario
     *
     * @return BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_has_users', 'user_id', 'department_id')->withPivot('is_manager');
    }

    /**
     * Obtiene un bool de confirmación si un usuario es superadmin o no
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->id == 1;
    }

    /**
     * Obtiene un bool de confirmación si un usuario es developer o no
     *
     * @return bool
     */
    public function isDeveloper()
    {
        return $this->id == 2;
    }

    /**
     * Obtener los proyectos donde el usuario es responsable.
     *
     * @return HasMany
     */
    public function userManagesProjects()
    {
        return $this->hasMany(UserManagesProjects::class, 'user_id');
    }

    /**
     * Obtiene el departamento de cual es responsable el usuario
     *
     * @return mixed
     */
    public function getDepartmentInCharge()
    {
        return $this->departments()->wherePivot('is_manager', true)->first();
    }

    /**
     * Obtiene la modalidad de contratación de un usuario
     *
     * @return BelongsTo
     */
    public function hiringModality()
    {
        return $this->belongsTo(HiringModalities::class, 'hiring_modality_id');
    }

    /**
     * Obtiene las actividades donde el usuario es responsable.
     *
     * @return BelongsToMany
     */
    public function activities()
    {
        return $this->belongsToMany(ActivityProjectFiscalYear::class, 'users_manages_activities');
    }

    /**
     * Obtiene las tareas/hitos donde el usuario es responsable.
     *
     * @return BelongsToMany
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'users_manages_tasks');
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
