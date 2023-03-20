<?php

namespace App\Models\System;

use Altek\Accountant\Contracts\Identifiable;
use Altek\Accountant\Contracts\Recordable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laverix\Acl\Models\Eloquent\Role as Acl;

/**
 * @mixin IdeHelperRole
 */
class Role extends Acl implements Identifiable, Recordable
{
    use \Altek\Accountant\Recordable, HasFactory;

    const ADMIN = 'administrator';
    const PLANNER = 'planner';
    const AUTHORITY = 'authority';
    const SUPPORT = 'support';
    const LEADER = 'leader';
    const DIRECTOR = 'director';
    const FINANCIAL = 'financial';

    /**
     * Obtiene un bool de confirmación si un rol es admin
     *
     * @return bool
     */
    public function isAdminRole()
    {
        return $this->id == 1;
    }
}
