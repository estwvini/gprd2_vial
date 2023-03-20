<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\Intersection;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Clase IntersectionRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class IntersectionRepository extends Repository
{
    /**
     * Constructor de IntersectionRepository.
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
        return Intersection::class;
    }

    /**
     * Obtener de la BD una colección de todas las intersecciones de una vía.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function findByCode(string $code)
    {
        return $this->model->where('codigo', $code)->get();
    }

    /**
     * Obtener de la BD una todas las intersecciones de una vía.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function findByCodeDataTable(string $code)
    {
        return $this->model->where('codigo', $code);
    }

    /**
     * Obtener de la BD una intersección por gid.
     *
     * @param $gid
     *
     * @return mixed
     */
    public function findByGid(string $gid)
    {
        return $this->model->where('gid', $gid)->first();
    }

    /**
     * Actualizar en la BD la información de una intersección.
     *
     * @param array $data
     * @param Intersection $entity
     *
     * @return Intersection|null
     */
    public function updateFromArray(array $data, Intersection $entity)
    {
        if ($data['imagen']) {
            if (Storage::disk('inventory_roads')->exists($entity->imagen)) {
                Storage::disk('inventory_roads')->delete($entity->imagen);
            }
            $fileName = trans('intersection.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '.' . $data['imagen']->getClientOriginalExtension();
            $data['imagen']->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen'] = $entity->codigo . '/' . $fileName;
        } else {
            unset($data['imagen']);
        }
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva intersección.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        if ($data['imagen']) {
            $image = $data['imagen'];
        } else {
            unset($data['imagen']);
        }
        $entity = $entity->create($data);
        if ($entity->imagen) {
            $this->addImage($entity, $image);
        }
        return $entity->fresh();
    }

    /**
     * Agregar imagen a la base de datos y guardarla.
     *
     * @param Intersection $entity
     * @param $image
     */
    public function addImage(Intersection $entity, $image)
    {
        $fileName = trans('intersection.image_path') . '_' . $entity->codigo . '_' . $entity->gid . '.' . $image->getClientOriginalExtension();
        $image->storeAs($entity->codigo, $fileName, 'inventory_roads');
        $data['imagen'] = $entity->codigo . '/' . $fileName;
        $entity->fill($data);
        $entity->save();
    }
}