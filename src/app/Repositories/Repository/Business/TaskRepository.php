<?php

namespace App\Repositories\Repository\Business;

use App\Models\Business\Task;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase TaskRepository
 * @package App\Repositories\Repository\Business
 */
class TaskRepository extends Repository
{

    /**
     * @var RejectRepository
     */
    protected $rejectRepository;

    /**
     * Constructor de TaskRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param RejectRepository $rejectRepository
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection,
        RejectRepository $rejectRepository
    ) {
        parent::__construct($app, $collection);
        $this->rejectRepository = $rejectRepository;
    }

    /**
     * Nombre del modelo de la clase
     *
     * @return mixed|string
     */
    function model()
    {
        return Task::class;
    }

    /**
     * Crear una entidad mediante un arreglo
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        DB::transaction(function () use ($data) {
            //Create task
            $entity = new $this->model;
            $task = $entity->create($data['task']);

            //Save responsible
            if (isset($data['responsible'])) {
                $task->responsible()->sync($data['responsible']);
            }
        }, 5);

        return true;
    }

    /**
     * Actualiza una entidad mediante un arreglo
     *
     * @param array $data
     * @param Task $task
     *
     * @return mixed|bool
     */
    public function updateFromArray(array $data, Task $task)
    {
        DB::transaction(function () use ($data, $task) {

            //Update task
            $task->fill($data['task']);
            $task->save();

            if (isset($data['task']['status']) && $data['task']['status'] === Task::STATUS_REJECTED) {
                $rejectData = $this->rejectRepository->fillData($data['rejectData']);
                $task->fresh()->rejections()->save($rejectData);
            } else {
                //Save responsible
                if (isset($data['responsible'])) {
                    $task->responsible()->sync($data['responsible']);
                }
            }
        }, 5);

        return true;
    }

    /**
     * Buscar las tareas de un proyecto con registro de cumplimiento
     *
     * @param int $projectFiscalYearId
     *
     * @return Collection
     */
    public function findByProjectFiscalYear(int $projectFiscalYearId)
    {
        return $this->model->join('activity_project_fiscal_years', 'activity_project_fiscal_years.id', '=', 'tasks.activity_project_fiscal_year_id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->where('project_fiscal_years.id', '=', $projectFiscalYearId)->select('tasks.*')->get();
    }

    /**
     * Buscar las tareas de un proyecto con registro de cumplimiento
     *
     * @param int $projectId
     *
     * @return Collection
     */
    public function findByExecutedProject(int $projectId)
    {
        return $this->model->join('activity_project_fiscal_years', 'activity_project_fiscal_years.id', '=', 'tasks.activity_project_fiscal_year_id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->whereNull('projects.deleted_at')
            ->where([
                ['projects.id', '=', $projectId],
                ['tasks.due_date', '<>', null]
            ])->select('tasks.*')->get();
    }

}