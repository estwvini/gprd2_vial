<?php

namespace App\Repositories\Repository\Admin;

use App\Models\Admin\Threshold;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase ThresholdRepository
 * @package App\Repositories\Repository
 */
class ThresholdRepository extends Repository
{
    /**
     * Constructor de ThresholdRepository.
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
    public function model()
    {
        return Threshold::class;
    }


    /**
     * Actualiza todos los threshold
     *
     * @param array $data
     *
     * @return mixed
     */
    public function updateAll(array $data)
    {
        $entities = [];
        DB::transaction(function () use (&$entities, $data) {
            for ($i = 0; $i < 9; $i++) {

                $entity = $this->find($data['id_' . $i]);

                if (!$entity) {
                    throw new Exception(trans('thresholds.threshold.messages.errors.update'), 1000);
                }

                $entity->min = $data['min_' . $i];
                $entity->max = $data['max_' . $i];
                $entities[] = $entity;
                $entity->update();
                $entity->fresh();

            }

        }, 5);

        return $entities;
    }

    /**
     * Obtener el color del umbral.
     *
     * @param $percentage
     * @param $typeGoal
     *
     * @return mixed
     */
    public function getThreshold(float $percentage, string $typeGoal)
    {
        return $this->model->where([['min', '<=', $percentage], ['max', '>=', $percentage], ['type', '=', $typeGoal]])->value('color');
    }

    /**
     * Obtener de la BD una colección de umbrales a través de un arreglo de IDs.
     *
     * @param array $ids
     * @param array $columns
     *
     * @return mixed
     */
    public function findByIds(array $ids, array $columns = ['*'])
    {
        return $this->model->whereIn('id', $ids)->get($columns);
    }

    /**
     * Obtener de la BD una colección de umbrales por tipo.
     *
     * @param string $type
     *
     * @return mixed
     */
    public function findByType(string $type)
    {
        return $this->model->where('type', $type)->get();
    }

    /**
     * Obtener de la BD una colección de todos los umbrales.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }
}
