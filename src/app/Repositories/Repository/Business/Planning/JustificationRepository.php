<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\Planning\Justification;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase JustificationRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class JustificationRepository extends Repository
{
    /**
     * Constructor de JustificationRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws \App\Repositories\Library\Exceptions\RepositoryException
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
        return Justification::class;
    }

    /**
     * Almacenar en la BD una nueva justificación.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->fill($data);
    }

    /**
     * Obtiene listado de justificaciones de los planes
     *
     * @param string $model
     *
     * @return mixed
     */
    public function findJustificationsAllPlan(string $model)
    {
        return $this->model
            ->where(['justifications.justifiable_type' => $model])
            ->join('plans', 'plans.id', '=', 'justifications.justifiable_id')
            ->select('justifications.*', 'plans.name AS plan', 'justifications.document_reference AS references_number', 'justifications.description AS name')
            ->get();
    }

    /**
     * Obtiene listado de justificaciones de los planes por Plan Id
     *
     * @param string $model
     * @param int $planId
     *
     * @return mixed
     */
    public function findJustificationsByPlanId(string $model, int $planId)
    {
        return $this->model
            ->where(['justifications.justifiable_type' => $model, 'justifications.justifiable_id' => $planId])
            ->join('plans', 'plans.id', '=', 'justifications.justifiable_id')
            ->select('justifications.*', 'plans.name AS plan', 'justifications.description AS name', 'justifications.document_reference AS references_number')
            ->get();
    }

    /**
     * Obtiene listado de justificaciones de los proyectos
     *
     * @param string $model
     *
     * @return mixed
     */
    public function findAllJustificationsProjects(string $model)
    {
        return $this->model
            ->where(['justifications.justifiable_type' => $model])
            ->join('projects', 'projects.id', '=', 'justifications.justifiable_id')
            ->whereNull('projects.deleted_at')
            ->select('justifications.*', 'projects.name AS project', 'justifications.description AS name', 'justifications.document_reference AS references_number')
            ->get();
    }

    /**
     * Obtiene listado de justificaciones de los proyectos por Proyecto Id
     *
     * @param string $model
     * @param int $projectId
     *
     * @return mixed
     */
    public function findJustificationsByIdProjects(string $model, int $projectId)
    {
        return $this->model
            ->where(['justifications.justifiable_type' => $model, 'projects.id' => $projectId])
            ->join('projects', 'projects.id', '=', 'justifications.justifiable_id')
            ->whereNull('projects.deleted_at')
            ->select('justifications.*', 'projects.name AS project', 'justifications.description AS name', 'justifications.document_reference AS references_number')
            ->get();
    }

    /**
     * Obtiene listado de justificaciones por Operación
     *
     * @param string $model
     *
     * @return mixed
     */
    public function findAllJustificationsTracking(string $model)
    {
        return $this->model
            ->where(['justifications.justifiable_type' => $model])
            ->select('justifications.*', 'description AS name')
            ->get();
    }
}