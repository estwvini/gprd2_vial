<?php

namespace App\Repositories\Repository\Business\Catalogs;


use App\Filters\Library\Builder\EloquentBuilder;
use App\Models\Business\Catalogs\GeographicLocation;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Clase GeographicLocationRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class GeographicLocationRepository extends Repository
{
    /**
     * @var EloquentBuilder
     */
    private $eloquentBuilder;

    /**
     * Constructor de GeographicLocationRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @param EloquentBuilder $eloquentBuilder
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection, EloquentBuilder $eloquentBuilder)
    {
        parent::__construct($app, $collection);
        $this->eloquentBuilder = $eloquentBuilder;
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return GeographicLocation::class;
    }

    /**
     * Buscar las localizaciones geográficas habilitadas.
     *
     * @return mixed
     */
    public function findEnabled()
    {
        return $this->model->where('enabled', 1)->orderBy('name', 'asc')->get();
    }

    /**
     * Obtener de la BD una colección de todas las localizaciones geográficas.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Obtener de la BD el conteo de la cantidad de localizaciones geográficas.
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Actualizar en la BD la información de localización geográfica.
     *
     * @param array $data
     * @param GeographicLocation $entity
     *
     * @return GeographicLocation|null
     */
    public function updateFromArray(array $data, GeographicLocation $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva localización geográfica.
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
     * Eliminar lógicamente de la BD una localización geográfica.
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(Model $entity)
    {
        return $entity->delete();
    }

    /**
     * Modificar en la BD el estado de una localización geográfica.
     *
     * @param GeographicLocation $entity
     *
     * @return bool
     */
    public function changeStatus(GeographicLocation $entity)
    {
        $entity->enabled = !$entity->enabled;
        return $entity->save();
    }

    /**
     * Obtener de la BD una colección de todos los padres.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findAllEnabledParents(int $id = null)
    {
        return $this->model->where(['enabled' => 1, 'parent_id' => null])->where(function ($query) use ($id) {
            if (isset($id)) {
                $query->where('id', '<>', $id);
            }
        })->get();
    }

    /**
     * Aplica filtros al modelo
     *
     * @param array $filters
     *
     * @return $this
     */
    public function filters(array $filters)
    {
        $this->model = $this->eloquentBuilder->to($this->model(), $filters);

        return $this;
    }

    /**
     * Obtener de la BD una colección de todas las localizaciones geográficas.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function findAllOrdered(array $data)
    {
        if (count(array_filter($data)) == 0) {
            $classifiers = $this->model
                ->whereNull('parent_id')
                ->where('code', '<>', GeographicLocation::NO_LOCATION_CODE)
                ->orderBy('code', 'ASC')->get();
        } else {
            if (isset(array_filter($data)['addressing'])) { // only filter by addressing
                unset($data['spending']);
            }
            $this->filters($data);
            $classifiers = $this->model->orderBy('code', 'ASC')->get();
        }
        $response = collect([]);

        self::getChildrenOrdered($response, $classifiers);

        return $response;
    }

    /**
     * Función recursiva para ordenar las localizaciones geográficas.
     *
     * @param $response
     * @param $classifiers
     */
    private function getChildrenOrdered(&$response, $classifiers)
    {
        $classifiers->each(function ($classifier) use (&$response, $classifiers) {
            $children = $classifier->children()->orderBy('code', 'ASC')->get();
            $response = $response->push($classifier);
            self::getChildrenOrdered($response, $children);
        });
    }

    /**
     * Obtener de la BD una colección de todas las localizaciones geográficas.
     *
     * @param string $type
     *
     * @return mixed
     */
    public function findByType(string $type)
    {
        return $this->model->where('type', $type)->get();
    }
}