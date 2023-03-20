<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UnexpectedException extends Exception
{
    public function __construct()
    {
        parent::__construct(trans('app.messages.exceptions.unexpected'));
    }
}
