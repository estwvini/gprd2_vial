<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\Shape;
use App\Models\System\File;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use DB;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Repository\Configuration\SettingRepository;


/**
 * Clase ShapeRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class ShapeRepository extends Repository
{
    /**
     * Constructor de ShapeRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * Constructor de MainShapeRepository.
     *
     * @param SettingRepository $settingRepository
     */    public function __construct(App $app, Collection $collection, SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
        parent::__construct($app, $collection);
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return Shape::class;
    }

    /**
     * Obtener de la BD un shape por gid.
     *
     * @param int $gid
     *
     * @return mixed
     */
    public function findById(int $gid)
    {
        return $this->model->where('gid', $gid)->first();
    }

    /**
     * Obtener de la BD todos los shapes de la vía.
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
     * Verificar si existe un shape principal.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function shapeCode(string $code)
    {
        return $this->model->where(['codigo' => $code, 'is_primary' => Shape::IS_PRIMARY])->select('is_primary')->get();
    }

    /**
     * Obtener de la BD todos los shapes de la vía por codigo.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function findByCode(string $code)
    {
        return $this->model
            ->where('codigo', $code)
            ->where('is_primary', '<>', Shape::IS_PRIMARY)
            ->where(function ($query) {
                $query->where('extension', Shape::EXTENSION_JSON);
            })
            ->select('extension', 'gid', 'name', DB::raw('CONCAT(\'' . env('INVENTORY_ROAD_PATH') . '\',path) as shape'))
            ->get();
    }

    /**
     * Obtener de la BD todos los shapes de la vía por codigo.
     *
     * @param string $code
     *
     * @return mixed
     */
    public function shapesBackground(string $code)
    {
        return $this->model
            ->where('codigo', $code)
            ->where('is_primary', Shape::IS_PRIMARY)
            ->select('extension', 'gid', 'name', DB::raw('CONCAT(\'' . env('INVENTORY_ROAD_PATH') . '\',path) as shape'))
            ->first();
    }

    /**
     * Actualizar en la BD la información de un shape.
     *
     * @param array $data
     * @param Shape $entity
     *
     * @return Shape|null
     */
    public function updateFromArray(array $data, Shape $entity)
    {
        $provinceCode = $this->settingRepository->findByKey('gad')->value['code'];
        if (isset($data['shape']) && $data['shape']) {
            if (Storage::disk('inventory_roads')->exists($entity->path)) {
                Storage::disk('inventory_roads')->delete($entity->path);
            }
            $data['name'] = $data['shape']->getClientOriginalName();
            $data['extension'] = $data['shape']->getClientOriginalExtension();
            $fileName = $data['codigo'] . '_' . $data['shape']->getClientOriginalName();
            $data['shape']->storeAs( "/" . $provinceCode . "/" . $data['codigo'] . env('SHAPE_PATH'), $fileName, 'inventory_roads');
            $data['path'] =   $provinceCode . "/" . $data['codigo'] . env('SHAPE_PATH') . $fileName;
        } else {
            unset($data['shape']);
        }
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo shape.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $shape = $data['shape'];
        $message = trans('main_shape.messages.success.created');
        $type_message = 'success';
        $enable = 1;
        $provinceCode = $this->settingRepository->findByKey('gad')->value['code'];
        
            if (strtolower($shape->getClientOriginalExtension()) !== File::SHAPE_FILE_EXTENSION) {
                $message = trans('shape.messages.errors.only_json');
                $type_message = 'danger';
                $enable = 0;
            }
        

        if ($enable) {
            try {              
                    $entity = new $this->model;
                    $shapeData['codigo'] = $data['codigo'];
                    $shapeData['name'] = $shape->getClientOriginalName();
                    $shapeData['extension'] = $shape->getClientOriginalExtension();
                    $fileName = $data['codigo'] . '_' . $shape->getClientOriginalName();
                    $shape->storeAs( "/" . $provinceCode . "/" . $data['codigo'] . env('SHAPE_PATH'), $fileName, 'inventory_roads');
                    $shapeData['path'] =  $provinceCode . "/". $data['codigo'] . env('SHAPE_PATH') . $fileName;
                    $entity->create($shapeData);
            } catch (Exception $e) {
                return [false];
            }

            return [true, $message, $type_message];
        }

        return [false, $message, $type_message];
        
    }


    /**
     * Eliminar de la BD un shape.
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(Model $entity)
    {
        if (Storage::disk('inventory_roads')->exists($entity->path)) {
            Storage::disk('inventory_roads')->delete($entity->path);
        }
        return $entity->delete();
    }
     

}