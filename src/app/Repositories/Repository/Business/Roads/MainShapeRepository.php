<?php

namespace App\Repositories\Repository\Business\Roads;

use App\Models\Business\Roads\MainShape;
use App\Models\System\File;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use DB;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use App\Repositories\Repository\Configuration\SettingRepository;

/**
 * Clase MainShapeRepository
 * @package App\Repositories\Repository\Business\Roads
 */
class MainShapeRepository extends Repository
{
    /**
     * Constructor de MainShapeRepository.
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
     */
    public function __construct(App $app, Collection $collection, SettingRepository $settingRepository)
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
        return MainShape::class;
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
     * Obtiene todos los registros de documento por tipo
     *
     * @param array $filters
     *
     * @return mixed
     */
    public function getAll()
    {         
        return $this->model                  
            ->select('gid', 'name', 'path', 'extension', 'is_primary', 'fecha', 'usuario')
            ->orderBy('name')
            ->get();
    }

    /**
     * Obtener de la BD todos los shapes de la vía por codigo.
     *
     * @return mixed
     */
    public function allShapes()
    {        
      
        return $this->model
            ->where('is_primary', '<>', MainShape::IS_PRIMARY)
            ->where(function ($query) {
                $query->where('extension', MainShape::EXTENSION_JSON);
            })           
            ->select('extension', 'gid', 'name', DB::raw('CONCAT(\'' . env('INVENTORY_ROAD_PATH') . '\',path) as shape'))
            ->orderBy('name')
            ->get();
    }

    /**
     * Obtener de la BD todos los shapes de la vía por codigo.
     *
     * @return mixed
     */
    public function shapesBackground()
    {
        return $this->model
            ->where('is_primary', MainShape::IS_PRIMARY)
            ->select('extension', 'gid', 'name', DB::raw('CONCAT(\'' . env('INVENTORY_ROAD_PATH') . '\',path) as shape'))
            ->first();
    }

    /**
     * Actualizar en la BD la información de un shape.
     *
     * @param array $data
     * @param MainShape $entity
     *
     * @return MainShape|null
     */
    public function updateFromArray(array $data, MainShape $entity)
    {
        $user = currentUser();
        $provinceCode = $this->settingRepository->findByKey('gad')->value['code'];
        if (isset($data['shape']) && $data['shape']) {
            $data['name'] = str_replace(" ", "_", $data['shape']->getClientOriginalName());
            $data['extension'] = $data['shape']->getClientOriginalExtension();
            $fileName = str_replace(" ", "_", $data['shape']->getClientOriginalName());
            $directory = $provinceCode . "/" . env('SHAPE_PATH') . str_replace("." . File::SHAPE_FILE_EXTENSION, '', $fileName). "/";
            Storage::disk('inventory_roads')->deleteDirectory($directory);
            Storage::disk('inventory_roads')->makeDirectory($directory);
            $data['shape']->storeAs($directory, $fileName, 'inventory_roads');
            $this->loadGeoJsonToPostgis($fileName, $directory);
            $data['path'] = $directory . $fileName;
            $data['fecha'] = date_create();
            $data['usuario'] = $user->username;
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
        $provinceCode = $this->settingRepository->findByKey('gad')->value['code'];
        $shape = $data['shape'];        
        $message = trans('main_shape.messages.success.created');
        $type_message = 'success';
        $enable = 1;
        $user = currentUser();
        if (strtolower($shape->getClientOriginalExtension()) !== File::SHAPE_FILE_EXTENSION) {
            $message = trans('shape.messages.errors.only_json');
            $type_message = 'danger';
            $enable = 0;
        }

        if ($enable) {
            try {                            
                $entity = new $this->model;
                $shapeData['name'] = str_replace(" ", "_", $shape->getClientOriginalName()); 
                $shapeData['extension'] = $shape->getClientOriginalExtension();
                $fileName = str_replace(" ", "_", $shape->getClientOriginalName());
                $directory = $provinceCode . "/" . env('SHAPE_PATH') . str_replace("." . File::SHAPE_FILE_EXTENSION, '', $fileName) . "/";
                Storage::disk('inventory_roads')->deleteDirectory($directory);
                Storage::disk('inventory_roads')->makeDirectory($directory);
                $shape->storeAs($directory, $fileName, 'inventory_roads');                   
                $this->loadGeoJsonToPostgis($fileName, $directory);                    
                $shapeData['path'] = $directory . $fileName;
                $shapeData['fecha'] = date_create();
                $shapeData['usuario'] = $user->username;
                $entity->create($shapeData);
            } catch (Exception $e) {
                return [false];
            }

            return [true, $message, $type_message];
        }

        return [false, $message, $type_message];

    }

    /**
     * Convertir de formato shp a json
     *
     * @param string $name, string $path
     *
     * @return null
     * @throws Exception
     */
    public function loadGeoJsonToPostgis(string $name, string $path){       
        $path_road = Storage::disk('inventory_roads')->path(''); 
        $name_without_ext = str_replace("." . File::SHAPE_FILE_EXTENSION, '_gj', $name);          
        $file_geojson =  public_path('') . '/' . $path_road . $path . $name;                   
        $command = 'ogr2ogr -f PostgreSQL PG:"dbname='. DB::connection()->getDatabaseName() .' host=' .  env('DB_HOST') .
         ' port='. env('DB_PORT') .' user='. env('DB_USERNAME') . ' password='. env('DB_PASSWORD') .'" ' .  $file_geojson . 
          ' -nln sch_gis.' . $name_without_ext . ' -overwrite';    
        Log::debug($command);               
        $process = Process::fromShellCommandline($command);        
        $process->run();
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }       
        Log::debug($process->getOutput());       
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
        $provinceCode = $this->settingRepository->findByKey('gad')->value['code'];
        if (Storage::disk('inventory_roads')->exists($entity->path)) {
            $directory =  $provinceCode . "/" . env('SHAPE_PATH') . str_replace("." . File::SHAPE_FILE_EXTENSION, '', $entity->name) . "/";
            Storage::disk('inventory_roads')->deleteDirectory($directory);
        }
        return $entity->delete();
    }

    /**
     * Verificar si existe un shape principal.
     *
     * @return mixed
     */
    public function shapeCode()
    {
        return $this->model->where(['is_primary' => MainShape::IS_PRIMARY])->select('is_primary')->get();
    }

    /**
     * Ejecuta query en shape
     *
     * @return mixed
     */
    public function shapeQuery(string $shapeId, string $catId)
    {   
        $provinceCode = $this->settingRepository->findByKey('gad')->value['code'];
        $result = array();
        $shape_query =  array();
        $fileName = $shapeId . "-" .  $catId . "." . File::SHAPE_FILE_EXTENSION;
        $directory =  $provinceCode . "/" . env('SHAPE_PATH') . $shapeId . "/";
        $path_road = Storage::disk('inventory_roads')->path(''); 
        if (Storage::disk('inventory_roads')->exists($directory . $fileName)) {
            $stream = Storage::disk('inventory_roads')->readStream($directory . $fileName);
            $contenido = false;
            while (($line = fgets($stream, 4096)) !== false) {               
                $str_arr = explode (";", $line); 
                $shape_qry =  [];
                $shape_qry['name'] =  rtrim($str_arr[0]);
                $shape_qry['porcent'] =  $str_arr[1];
                $shape_qry['shape'] =  $path_road . $directory .  rtrim($str_arr[0]);                      
                array_push($shape_query, $shape_qry);
                $contenido = true;
            }
            if($contenido)
                return $shape_query;
        }
        $contenido = '';          

        $result = DB::select('SELECT * FROM sch_gis."sp_getshapequery"(:capa,:catalogo) 
                as feature', ['capa' =>  $shapeId, 'catalogo' =>  $catId]);                             
        foreach ($result as $row) {
            $shape_qry =  [];
            $fileName1 = $shapeId . "-" .  $catId . "-" . str_replace(' ', '', $row->c) . "." . File::SHAPE_FILE_EXTENSION;
            Storage::disk('inventory_roads')->put( $directory . $fileName1, $row->j ); 
            $shape_qry['name'] =  $fileName1;
            $shape_qry['shape'] =  $path_road . $directory . $fileName1;
            $shape_qry['porcent'] =  $row->n;                      
            array_push($shape_query, $shape_qry);
            $contenido =  $contenido . $fileName1 . ";" . $row->n . "\n";
        }
        Storage::disk('inventory_roads')->put( $directory . $fileName, $contenido );   
           
        return $shape_query;

    }   
}