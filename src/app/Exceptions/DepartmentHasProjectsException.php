<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class DepartmentHasProjectsException extends Exception
{
    public function __construct()
    {
        parent::__construct(trans('departments.messages.exceptions.has_projects'));
    }
}
