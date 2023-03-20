<?php

namespace App\Repositories\Repository\Business;


use App\Models\Business\PlanIndicator;
use App\Models\Business\PlanIndicatorGoal;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\ModelException;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

/**
 * Clase IndicatorGoalsRepository
 * @package App\Repositories\Repository
 */
class IndicatorGoalsRepository extends Repository
{
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * Nombre de la clase modelo
     *
     * @return mixed
     */
    function model()
    {
        return PlanIndicatorGoal::class;
    }

    /**
     * Devueleve una lista de indicadorMetas a partir de una lista de Ids
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
     * Devuelve una colección de metas dado un id de indicador
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findByIndicatorId(int $id)
    {
        return $this->model->where('plan_indicator_id', $id)->get();
    }

    /**
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * cantidad de elementos
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Devuelve elemnetos destruidos
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
     *
     * @throws ModelException
     */
    public function updateFromArray(array $data, $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        $data = $this->processInput($data, $entity);
        $entity->fill($data);
        $entity->save();

        return $entity->fresh();
    }

    /**
     * Crea una entidad desde un arreglo de datos
     *
     * @param array $data
     * @param int $indicatorId
     * @param int $startYear
     * @param int $goalsCount
     *
     * @return mixed
     */
    public function createFromArray(array $data, int $indicatorId, int $startYear, int $goalsCount)
    {
        if (isset($data['measurement_frequency_per_year']) && $data['measurement_frequency_per_year'] === '2') {
            $countBiannual=0;
            for ($i = 0; $i <= $goalsCount; $i++) {
                $entity = new $this->model;
                $entity->plan_indicator_id = $indicatorId;
                if ($data['type'] === PlanIndicator::TYPE_TOLERANCE) {
                    $entity->min = $data['min' . $i];
                    $entity->max = $data['max' . $i];
                    $entity->goal_value = 0;
                } else {
                    $entity->goal_value = $data[$i];
                    $entity->min = 0;
                    $entity->max = 0;
                }
                $entity->period = ($i + 1);
                if ($i % 2 == 0) {
                    $entity->year = $startYear + $countBiannual;
                } else {
                    $entity->year = $startYear + $countBiannual;
                    $countBiannual++;
                }
                $entity->actual_value_user_id = currentUser()->id;
                $entity->save();
            }
        } else {
            for ($i = 0; $i <= $goalsCount; $i++) {
                $entity = new $this->model;
                $entity->plan_indicator_id = $indicatorId;
                if ($data['type'] === PlanIndicator::TYPE_TOLERANCE) {
                    $entity->min = $data['min' . $i];
                    $entity->max = $data['max' . $i];
                    $entity->goal_value = 0;
                } else {
                    $entity->goal_value = $data[$i];
                    $entity->min = 0;
                    $entity->max = 0;
                }
                $entity->period = ($i + 1);
                $entity->year = $startYear + $i;
                $entity->actual_value_user_id = currentUser()->id;
                $entity->save();
            }
        }

        return true;
    }

    /**
     * Borrar
     *
     * @param $entity
     *
     * @return bool|null
     *
     * @throws ModelException
     * @throws \Exception
     */
    public function delete(Model $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        return $entity->delete();
    }

    /**
     * Borrar todas las metas dado un indicador
     *
     * @param $id
     *
     * @return void
     *
     */
    public function deleteAll($id)
    {
        $aux = $this->findByIndicatorId($id);

        if ($aux) {
            foreach ($aux as $goal) {
                $goal->forceDelete();
            }
        }
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
        $entity->plan_element_id = $data['plan_element_id'];

        if (isset($data['technical_file'])) {
            $technical_file = $data['technical_file'];

            $path = env('PLANS_PATH') . '/' . $entity->planElement->plan->id;

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

}