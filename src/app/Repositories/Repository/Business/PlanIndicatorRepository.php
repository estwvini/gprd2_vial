<?php

namespace App\Repositories\Repository\Business;

use App\Models\Business\Component;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Project;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\ModelException;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Clase PlanIndicatorRepository
 * @package App\Repositories\Repository
 */
class PlanIndicatorRepository extends Repository
{
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * Nombre de la clase del modelo
     *
     * @return mixed
     */
    function model()
    {
        return PlanIndicator::class;
    }

    /**
     * Devueleve una lista de indicadores a partir de una lista de Ids
     *
     * @param array $ids
     * @param array $columns
     *
     * @return mixed
     */
    public function findByIds(array $ids, $columns = ['*'])
    {
        return $this->model->whereIn('id', $ids)->get($columns);
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Contador de elementos
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Devuelve elementos destruidos
     */
    public function trashed()
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * Actualiza una entidad desde un arreglo de datos
     *
     * @param array $data
     * @param null $entity
     *
     * @return mixed
     * @throws ModelException
     */
    public function updateFromArray(array $data, $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        $data = $this->processInput($data, $entity);
        $entity->fill($data);

        if (!isset($entity->measurement_frequency_per_year)) {
            $entity->measurement_frequency_per_year = 1;
        }
        DB::transaction(function () use ($entity) {
            $entity->planIndicatorGoals()->delete();
            $entity->save();
        }, 5);

        return $entity->fresh();
    }

    /**
     * Crea una entidad desde un arreglo de datos
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        $data = $this->processInput($data, $entity);
        $entity->measurement_frequency_per_year = 1;
        return $entity->fill($data);
    }

    /**
     * Elimina un indicador y sus articulaciones
     *
     * @param $entity
     *
     * @return bool|null
     * @throws ModelException
     * @throws \Exception
     */
    public function delete(Model $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        DB::transaction(function () use ($entity) {

            $entity->parentLinks()->detach();
            $entity->childLinks()->detach();
            $entity->planIndicatorGoals()->delete();
            $entity->delete();
        }, 5);

        return $entity->fresh();
    }

    /**
     * Elimina varios indicadores y sus articulaciones
     *
     * @param MorphMany $entities
     *
     * @return bool
     */
    public function bulkDelete(MorphMany $entities)
    {
        $indicators = $entities->get();

        DB::transaction(function () use ($entities, $indicators) {

            $indicators->each(function ($indicator) {
                $indicator->parentLinks()->detach();
                $indicator->childLinks()->detach();
            });

            $entities->delete();
        }, 5);

        return true;
    }

    /**
     * Procesar elementos enviados antes de guardarlos en la Base de Datos.
     *
     * @param $data
     * @param Model|null $entity
     *
     * @return mixed
     */
    private function processInput($data, Model $entity = null)
    {

        if (isset($data['technical_file'])) {
            $technical_file = $data['technical_file'];

            $path = env('INDICATORS_PATH') . '/';

            if (!file_exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            } else {
                if ($entity->hasTechnicalFile()) {
                    $filePath = $path . $entity->technical_file;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            }

            $fileName = time() . '.' . $technical_file->getClientOriginalExtension();
            File::put($path . '/' . $fileName, File::get($technical_file));
            $data['technical_file'] = $fileName;
        }

        return $data;
    }

    /**
     * Obtiene la información de los indicadores que se van a articular
     *
     * @param array $data
     *
     * @return mixed
     */
    public function getLinksInfo(array $data)
    {
        $indicators = $this->model->whereIn('id', $data['parentIndicators'])->get();

        $response = $indicators->map(function ($indicator) {

            $objective = $indicator->indicatorable;

            $thrust = null;
            if ($objective->parent_id) {
                $thrust = $objective->parent;
            }

            $plan = $objective->plan;

            return collect([
                'id' => $indicator->id,
                'name' => $indicator->name,
                'goal_description' => $indicator->goal_description,
                'objective_code' => $objective->code,
                'thrust_code' => $thrust ? $thrust->code : '',
                'plan_name' => $plan->name

            ]);
        });

        return $response;
    }

    /**
     * Obtiene todos los indicadores de un plan por modelo
     *
     * @param string $model
     * @param string|null $year
     *
     * @return mixed
     */
    public function findAllIndicatorsPlan(string $model, string $year = null)
    {

        $plans = $this->model
            ->where('plan_indicators.indicatorable_type', $model)
            ->join('plan_elements', 'plan_elements.id', '=', 'plan_indicators.indicatorable_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNotNull('plan_indicators.technical_file')
            ->select('plan_indicators.*', 'plans.name AS plan');
        if ($year) {
            $plans->join('operational_goals', 'operational_goals.id', 'plan_indicators.indicatorable_id')
                ->where('operational_goals.fiscal_year_id', $year);
        }
        return $plans->get();
    }

    /**
     * Obtiene todos los indicadores de un Plan Operacional por modelo.
     *
     * @param string $model
     *
     * @return mixed
     */
    public function findAllIndicatorsPlanOperational(string $model)
    {

        $plans = $this->model
            ->where(['plan_indicators.indicatorable_type' => $model])
            ->whereNotNull('plan_indicators.technical_file')
            ->join('operational_goals', 'operational_goals.id', '=', 'plan_indicators.indicatorable_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'operational_goals.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->select('plan_indicators.*', 'plans.name AS plan');

        return $plans->get();
    }

    /**
     * Obtiene todos los indicadores de un plan por modelo y planId
     *
     * @param string $model
     * @param int $planId
     *
     * @return mixed
     */
    public function findIndicatorsByIdPlan(string $model, int $planId)
    {

        $plans = $this->model
            ->where(['plan_indicators.indicatorable_type' => $model, 'plans.id' => $planId])
            ->join('plan_elements', 'plan_elements.id', '=', 'plan_indicators.indicatorable_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNotNull('plan_indicators.technical_file')
            ->select('plan_indicators.*', 'plans.name AS plan');
        return $plans->get();
    }

    /**
     * Obtiene todos los indicadores de un Plan Operacional por modelo y planId, EstrategiaId, Objetivo OperacionalId, año
     *
     * @param string $model
     * @param int|null $planId
     * @param int|null $strategicObjectiveId
     * @param string|null $operationalGoalPlanId
     * @param string|null $year
     *
     * @return mixed
     */
    public function findIndicatorsByIdPlanOperational(
        string $model,
        int $planId = null,
        int $strategicObjectiveId = null,
        string $operationalGoalPlanId = null,
        string $year = null
    ) {

        $plans = $this->model
            ->where('plan_indicators.indicatorable_type', $model)
            ->whereNotNull('plan_indicators.technical_file')
            ->join('operational_goals', 'operational_goals.id', '=', 'plan_indicators.indicatorable_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'operational_goals.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->select('plan_indicators.*', 'plans.name AS plan');
        if ($planId) {
            $plans->where('plans.id', $planId);
        }
        if ($strategicObjectiveId) {
            $plans->where('plan_elements.id', $strategicObjectiveId);
        }
        if ($operationalGoalPlanId) {
            $plans->where('operational_goals.id', $operationalGoalPlanId);
        }
        if ($year) {
            $plans->where('operational_goals.fiscal_year_id', $year);
        }
        return $plans->get();
    }

    /**
     * Obtiene todos los indicadores de un proyecto por modelo
     *
     * @param string $model
     *
     * @return mixed
     */
    public function findAllIndicatorsProject(string $model)
    {

        $plans = $this->model
            ->where('plan_indicators.indicatorable_type', $model)
            ->join('components', 'components.id', '=', 'plan_indicators.indicatorable_id')
            ->join('projects', 'projects.id', '=', 'components.project_id')
            ->whereNotNull('plan_indicators.technical_file')
            ->whereNull('projects.deleted_at')
            ->whereNull('components.deleted_at')
            ->select('plan_indicators.*', 'projects.name AS project');
        return $plans->get();
    }

    /**
     * Obtiene todos los indicadores de un proyecto por modelo y projectId
     *
     * @param string $model
     * @param int $projectId
     *
     * @return mixed
     */
    public function findIndicatorsByIdProject(string $model, int $projectId)
    {

        $plans = $this->model
            ->where(['plan_indicators.indicatorable_type' => $model, 'projects.id' => $projectId])
            ->join('components', 'components.id', '=', 'plan_indicators.indicatorable_id')
            ->join('projects', 'projects.id', '=', 'components.project_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('components.deleted_at')
            ->whereNotNull('plan_indicators.technical_file')
            ->select('plan_indicators.*', 'projects.name AS project');
        return $plans->get();
    }
}