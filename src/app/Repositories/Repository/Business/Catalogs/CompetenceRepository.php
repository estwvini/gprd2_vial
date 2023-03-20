<?php

namespace App\Repositories\Repository\Business\Catalogs;

use App\Models\Business\Catalogs\Competence;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use App\Repositories\Library\Exceptions\RepositoryException;

/**
 * Clase CompetenceRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class CompetenceRepository extends Repository
{
    /**
     * Constructor de CompetenceRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return Competence::class;
    }
}