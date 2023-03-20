<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\Bridge;
use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

/**
 * Clase BridgeRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class BridgeRepository extends Repository
{
    /**
     * Constructor de BridgeRepository.
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
        return Bridge::class;
    }

    /**
     * Obtener de la BD una colección de todos los puentes de la via.
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
     * Obtener de la BD todos los puentes de la via.
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
     * Obtener un puente por gid.
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
     * Actualizar en la BD la información del puente.
     *
     * @param array $data
     * @param Bridge $entity
     *
     * @return Bridge|null
     */
    public function updateFromArray(array $data, Bridge $entity)
    {
        if ($data['imagen1']) {
            if (Storage::disk('inventory_roads')->exists($entity->imagen1)) {
                Storage::disk('inventory_roads')->delete($entity->imagen1);
            }
            $fileName = trans('bridge.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '_1' . '.' . $data['imagen1']->getClientOriginalExtension();
            $data['imagen1']->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen1'] = $entity->codigo . '/' . $fileName;
        } else {
            unset($data['imagen1']);
        }
        if ($data['imagen2']) {
            if (Storage::disk('inventory_roads')->exists($entity->imagen2)) {
                Storage::disk('inventory_roads')->delete($entity->imagen2);
            }
            $fileName = trans('bridge.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '_2' . '.' . $data['imagen2']->getClientOriginalExtension();
            $data['imagen2']->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen2'] = $entity->codigo . '/' . $fileName;
        } else {
            unset($data['imagen2']);
        }
        if ($data['imagen3']) {
            if (Storage::disk('inventory_roads')->exists($entity->imagen3)) {
                Storage::disk('inventory_roads')->delete($entity->imagen3);
            }
            $fileName = trans('bridge.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '_3' . '.' . $data['imagen3']->getClientOriginalExtension();
            $data['imagen3']->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen3'] = $entity->codigo . '/' . $fileName;
        } else {
            unset($data['imagen3']);
        }
        if ($data['imagen4']) {
            if (Storage::disk('inventory_roads')->exists($entity->imagen4)) {
                Storage::disk('inventory_roads')->delete($entity->imagen4);
            }
            $fileName = trans('bridge.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '_4' . '.' . $data['imagen4']->getClientOriginalExtension();
            $data['imagen4']->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen4'] = $entity->codigo . '/' . $fileName;
        } else {
            unset($data['imagen4']);
        }
        if ($data['imagen5']) {
            if (Storage::disk('inventory_roads')->exists($entity->imagen5)) {
                Storage::disk('inventory_roads')->delete($entity->imagen6);
            }
            $fileName = trans('bridge.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '_5' . '.' . $data['imagen5']->getClientOriginalExtension();
            $data['imagen5']->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen5'] = $entity->codigo . '/' . $fileName;
        } else {
            unset($data['imagen5']);
        }
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo puente.
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
        if ($data['imagen4']) {
            $image4 = $data['imagen4'];
            array_push($images, $image4);
        } else {
            unset($data['imagen4']);
        }
        if ($data['imagen5']) {
            $image5 = $data['imagen5'];
            array_push($images, $image5);
        } else {
            unset($data['imagen5']);
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
     * @param Bridge $entity
     * @param $images
     */
    public function addImage(Bridge $entity, $images)
    {
        foreach ($images as $count => $image) {
            $count++;
            $fileName = trans('bridge.image_path') . '_' . $entity->codigo . '_' . microtime() . '_' . $entity->gid . '_' . $count . '.' . $image->getClientOriginalExtension();
            $image->storeAs($entity->codigo, $fileName, 'inventory_roads');
            $data['imagen' . $count] = $entity->codigo . '/' . $fileName;
            $entity->fill($data);
            $entity->save();
        }
    }

}