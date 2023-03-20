<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class RoleHasUsersException extends Exception
{
    public function __construct(string $role)
    {
        parent::__construct(trans('roles.messages.errors.has_users', ['entities' => $role]));
    }
}
