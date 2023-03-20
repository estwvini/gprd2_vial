<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\Planning\CurrentExpenditureElement;
use App\Models\Business\Planning\OperationalActivity;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


/**
 * Clase OperationalActivityRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class OperationalActivityRepository extends Repository
{
    /**
     * Constructor de OperationalActivityRepository.
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
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return OperationalActivity::class;
    }

    /**
     * Actualizar en la BD la información de una actividad operativa.
     *
     * @param array $data
     * @param OperationalActivity $entity
     *
     * @return OperationalActivity|null
     */
    public function updateFromArray(array $data, OperationalActivity $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva actividad operativa.
     *
     * @param array $data
     *
     * @return CurrentExpenditureElement
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        $entity = $entity->create($data);
        return $entity->fresh();
    }

    /**
     * Genera un código autoincremental para actividad operativa.
     *
     * @param int|null $current_expenditure_element_id
     *
     * @return string
     */
    public function generateOperationalActivityCode(int $current_expenditure_element_id = null)
    {
        $maxCode = isset($current_expenditure_element_id) ? $this->model->where('current_expenditure_element_id', $current_expenditure_element_id)->max('code') : 0;

        return sprintf("%03d", ((int)$maxCode + 1));
    }
}