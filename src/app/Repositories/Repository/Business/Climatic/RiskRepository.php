<?php

namespace App\Repositories\Repository\Business\Climatic;

use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use App\Models\System\File;
use Exception;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Business\Climatic\Risk;
use App\Repositories\Repository\Configuration\SettingRepository;


/**
 * Clase RiskRepository
 * @package App\Repositories\Repository\Business\Climatic
 */
class RiskRepository extends Repository
{

    /**
     * Constructor de RiskRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    /**
     * @var SettingRepository
     *  @param SettingRepository $settingRepository
     */
    private $settingRepository;
    public function __construct(App $app, Collection $collection,SettingRepository $settingRepository)
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
        return Risk::class;
    }

    /**
     * Obtiene todos los cantones registrados en las vías.
     *
     * @return Collection
     */
    public function getCantons(string $dpa_provin)
    {
        return $this->model->select('dpa_canton','dpa_descan')
        ->where('dpa_provin', $dpa_provin)
        ->groupBy('dpa_canton')
        ->groupBy('dpa_descan')
        ->orderBy('dpa_descan')
        ->get();
    }

    /**
     * Obtener de la BD las parroquias según el cantón.
     *
     * @param string $name
     *
     * @return Collection
     */
    public function findByCanton(string $dpa_canton)
    {
        $query = $this->model
            ->select('dpa_parroq','dpa_despar')
            ->where('dpa_canton', $dpa_canton)
            ->orderBy('dpa_despar')
            ->get();
        return $query;
    }

    /**
     * Ejecuta consulta de capas 
     *
     * @return mixed
     */
    public function execute(string $layerId, string $typeId, int $levelId, string $dpacode)
    {  
        $shape_query =  array();
        $fileName = $layerId . "-" .  $typeId . "-" .  $dpacode . "." . File::SHAPE_FILE_EXTENSION;
        if (Storage::disk('inventory_risks')->exists($fileName)) {          
            $shape_qry =  [];
            $shape_qry['name'] =  $fileName;
            $shape_qry['path'] =  Storage::disk('inventory_risks')->path('') . $fileName;                    
            array_push($shape_query, $shape_qry);
            return $shape_query;            
        }
        $result = DB::select('SELECT * FROM sch_gis."sp_getclimaticrisk"(:layerId, :typeId, :levelId, :dpacode) 
                as feature', ['layerId' =>  $layerId, 'typeId' =>  $typeId, 'levelId' =>  $levelId, 'dpacode' =>  $dpacode]);                                    
        foreach ($result as $row) {
            $shape_qry =  [];
            $fileName = $layerId . "-" .  $typeId . "-" .  $dpacode . "." . File::SHAPE_FILE_EXTENSION;
            Storage::disk('inventory_risks')->put($fileName, $row->j ); 
            $shape_qry['name'] =  $fileName;
            $shape_qry['path'] =  Storage::disk('inventory_risks')->path('') . $fileName;                             
            array_push($shape_query, $shape_qry);
        }          
        return $shape_query;
    }

   
}