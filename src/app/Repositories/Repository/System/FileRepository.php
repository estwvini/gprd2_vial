<?php

namespace App\Repositories\Repository\System;

use App\Models\Business\Project;
use App\Models\System\File;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase FileRepository
 * @package App\Repositories\Repository\System
 */
class FileRepository extends Repository
{
    /**
     * Constructor de FileRepository.
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
        return File::class;
    }

    /**
     * Obtener de la BD una colección de todos los archivos.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Obtener de la BD el conteo de la cantidad de archivos.
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Actualizar en la BD la información de archivo.
     *
     * @param array $data
     * @param File $entity
     *
     * @return File|null
     */
    public function updateFromArray(array $data, File $entity)
    {
        $entity->fill($data);
        $entity->save();

        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo archivo.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        $entity = $entity->create($data);

        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un archivo nuevo.
     *
     * @param array $data
     * @param Model $model
     *
     * @return mixed
     */
    public function createFromArrayGlobal(array $data, Model $model)
    {
        $entity = new $this->model;
        $entity->fill($data);
        $model->files()->save($entity);
        return $entity;
    }

    /**
     * Obtener de la BD una colección de todos los archivos.
     *
     * @return mixed
     */
    public function findAllFilesProjects()
    {
        return $this->model
            ->where('files.fileable_type', Project::class)
            ->join('projects', 'projects.id', '=', 'files.fileable_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->select('files.*', 'projects.name AS project', 'plans.name AS plan')
            ->get();
    }

    /**
     * Obtiene listado de proyectos por projectId
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findFilesByIdProject(int $id)
    {
        return $this->model
            ->where(['files.fileable_type' => Project::class, 'projects.id' => $id])
            ->join('projects', 'projects.id', '=', 'files.fileable_id')
            ->whereNull('projects.deleted_at')
            ->select('files.*', 'projects.name AS project', 'files.name AS name')
            ->get();
    }

    /**
     * Obtiene listado de anexos por plan Id
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findJustificationsByPlanId(int $id)
    {
        return $this->model
            ->where(['files.fileable_type' => Project::class, 'plans.id' => $id])
            ->join('projects', 'projects.id', '=', 'files.fileable_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->select('files.*', 'projects.name AS project', 'plans.name AS plan')
            ->get();
    }

    /**
     * Obtiene listado de anexos de los planes
     *
     * @param string $model
     *
     * @return mixed
     */
    public function findAllPlan(string $model)
    {
        return $this->model
            ->where(['files.fileable_type' => $model])
            ->join('projects', 'projects.id', '=', 'files.fileable_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->select('files.*', 'projects.name AS project', 'plans.name AS plan')
            ->get();
    }

    /**
     * Obtiene listado de anexos de seguimiento
     *
     * @param string $model
     *
     * @return mixed
     */
    public function findAllFilesTracking(string $model)
    {
        return $this->model
            ->where(['files.fileable_type' => $model])
            ->join('tasks', 'tasks.id', '=', 'files.fileable_id')
            ->select('files.*', 'tasks.name AS name')
            ->get();
    }

    /**
     * Obtiene listado de anexos de seguimiento reformas
     *
     * @return mixed
     */
    public function findAllTrackingReforms()
    {
        return $this->model->whereNull('files.fileable_type')->get();
    }

    /**
     * Obtiene listado de anexos de seguimiento reprogramación
     *
     * @param string $model
     *
     * @return mixed
     */
    public function findAllTrackingReprogramming(string $model)
    {
        return $this->model
            ->where(['files.fileable_type' => $model])
            ->join('reprogramming', 'reprogramming.id', '=', 'files.fileable_id')
            ->select('files.*', 'reprogramming.description AS name')
            ->get();
    }

    /**
     * Obtiene listado de anexos por proyecto Id
     *
     * @param string $model
     * @param int $projectId
     *
     * @return mixed
     */
    public function findFilesByIdTracking(string $model, int $projectId)
    {
        return $this->model
            ->where(['files.fileable_type' => $model, 'projects.id' => $projectId])
            ->join('tasks', 'tasks.id', '=', 'files.fileable_id')
            ->join('activity_project_fiscal_years', 'activity_project_fiscal_years.id', '=', 'tasks.activity_project_fiscal_year_id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->whereNull('tasks.deleted_at')
            ->select('files.*', 'tasks.name AS name')
            ->get();
    }
}