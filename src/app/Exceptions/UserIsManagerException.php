<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UserIsManagerException extends Exception
{
    public function __construct()
    {
        parent::__construct(trans('users.user.messages.errors.delete_relation'));
    }
}
