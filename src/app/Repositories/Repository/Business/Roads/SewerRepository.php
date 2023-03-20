<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\Sewer;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Clase SewerRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class SewerRepository extends Repository
{
    /**
     * Constructor de SewerRepository.
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
        return Sewer::class;
    }

    /**
     * Obtener de la BD una colección de todas las alcantarillas de la via.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function findByCode(string $code)
    {
        return $this->model->where('codigo', $code)->select('gid', 'tipo', 'longitud', 'material')->get();
    }

    /**
     * Obtener de la BD todas las alcantarillas de la via.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function findByCodeDataTable(string $code)
    {
        return $this->model->where('codigo', $code)->select('gid', 'tipo', 'longitud', 'material');
    }

    /**
     * Obtener de la BD una alcantarilla por gid.
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
     * Actualizar en la BD la información de una alcantarilla.
     *
     * @param array $data
     * @param Sewer $entity
     *
     * @return Sewer|null
     */
    public function updateFromArray(array $data, Sewer $entity)
    {
        if ($data['imagen1']) {
            if (Storage::disk('inventory_roads')->exists($entity->imagen1)) {
                Storage::disk('inventory_roads')->delete($entity->imagen1);
            }
            $fileName = trans('sewer.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '_1' . '.' . $data['imagen1']->getClientOriginalExtension();
            $data['imagen1']->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen1'] = $entity->codigo . '/' . $fileName;
        } else {
            unset($data['imagen1']);
        }
        if ($data['imagen2']) {
            if (Storage::disk('inventory_roads')->exists($entity->imagen2)) {
                Storage::disk('inventory_roads')->delete($entity->imagen2);
            }
            $fileName = trans('sewer.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '_2' . '.' . $data['imagen2']->getClientOriginalExtension();
            $data['imagen2']->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen2'] = $entity->codigo . '/' . $fileName;
        } else {
            unset($data['imagen2']);
        }
        if ($data['imagen3']) {
            if (Storage::disk('inventory_roads')->exists($entity->imagen3)) {
                Storage::disk('inventory_roads')->delete($entity->imagen3);
            }
            $fileName = trans('sewer.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '_3' . '.' . $data['imagen3']->getClientOriginalExtension();
            $data['imagen3']->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen3'] = $entity->codigo . '/' . $fileName;
        } else {
            unset($data['imagen3']);
        }
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva alcantarilla.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        $images = [];
        if ($data['imagen1']) {
            $image1 = $data['imagen1'];
            array_push($images, $image1);
        } else {
            unset($data['imagen1']);
        }
        if ($data['imagen2']) {
            $image2 = $data['imagen2'];
            array_push($images, $image2);
        } else {
            unset($data['imagen2']);
        }
        if ($data['imagen3']) {
            $image3 = $data['imagen3'];
            array_push($images, $image3);
        } else {
            unset($data['imagen3']);
        }
        $entity = $entity->create($data);
        if (count($images) > 0) {
            $this->addImage($entity, $images);
        }
        return $entity->fresh();
    }

    /**
     * Agregar imagen a la base de datos y guardarla.
     *
     * @param Sewer $entity
     * @param $images
     */
    public function addImage(Sewer $entity, $images)
    {
        foreach ($images as $count => $image) {
            $count++;
            $fileName = trans('sewer.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '_' . $count . '.' . $image->getClientOriginalExtension();
            $image->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen' . $count] = $entity->codigo . '/' . $fileName;
            $entity->fill($data);
            $entity->save();
        }
    }
}