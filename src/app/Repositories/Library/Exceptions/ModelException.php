<?php

namespace App\Repositories\Library\Exceptions;


class ModelException extends RepositoryException
{
    public function __construct($model)
    {
        $this->message = "Class {$model} must be an instance of Illuminate\\Database\\Eloquent\\Model";
    }
}