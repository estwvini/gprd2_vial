<?php

namespace App\Repositories\Repository\Business;

use App\Models\Business\Comment;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase CommentRepository
 *
 * @package App\Repositories\Repository\Business
 */
class CommentRepository extends Repository
{

    /**
     * Constructor de TaskRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection
    ) {
        parent::__construct($app, $collection);
    }

    /**
     * Nombre del modelo de la clase
     *
     * @return mixed|string
     */
    function model()
    {
        return Comment::class;
    }
}