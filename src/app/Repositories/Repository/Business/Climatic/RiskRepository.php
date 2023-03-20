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
use App\Models\Business\Roads\MainShape;
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
        return MainShape::class;
    }

    /**
     * Ejecuta consulta de coordenadas 
     *
     * @return mixed
     */
    public function locale(string $layerId, string $typeId, int $levelId, int $coordX, int $coordY)
    {   
        $shape_query =  array();
        $result = DB::select('SELECT * FROM sch_gis."sp_getclimaticrisk"(:layerId, :typeId, :coordx, :coordy, :levelId, :dpacode) 
                as feature', ['layerId' =>  $layerId, 'typeId' =>  $typeId, 'coordx' =>  $coordX, 'coordy' =>  $coordY, 'levelId' =>  $levelId, 'dpacode' =>  null]);                                    
        foreach ($result as $row) {
            $shape_qry =  [];
            $fileName1 = $layerId . "-" .  $typeId . "-" .  $row->dpa_r . "." . File::SHAPE_FILE_EXTENSION;
            Storage::disk('inventory_risks')->put($fileName1, $row->j ); 
            $shape_qry['name'] =  $fileName1;
            $shape_qry['path'] =  Storage::disk('inventory_risks')->path('') . $fileName1;                    
            $shape_qry['dpa_r'] =  $row->dpa_r;
            $shape_qry['dpa_c'] =  $row->dpa_c;
            $shape_qry['dpa_p'] =  $row->dpa_p;
            $shape_qry['dpa_dr'] =  $row->dpa_dr;
            $shape_qry['dpa_dc'] =  $row->dpa_dc;
            $shape_qry['dpa_dp'] =  $row->dpa_dp;
            array_push($shape_query, $shape_qry);
        }          
        return $shape_query;
    }

       /**
     * Ejecuta consulta de capas 
     *
     * @return mixed
     */
    public function execute(string $layerId, string $typeId, int $levelId, int $dpa_r, int $dpa_c, int $dpa_p)
    {   
        $dpacode = $dpa_r;
        if($levelId == 2)
        {
            $dpacode = $dpa_c;
        }else if($levelId == 3)
        {
            $dpacode = $dpa_p;
        }        
        $shape_query =  array();
        $fileName = $layerId . "-" .  $typeId . "-" .  $dpacode . "." . File::SHAPE_FILE_EXTENSION;
        if (Storage::disk('inventory_risks')->exists($fileName)) {          
            $shape_qry =  [];
            $shape_qry['name'] =  $fileName;
            $shape_qry['path'] =  Storage::disk('inventory_risks')->path('') . $fileName;                    
            array_push($shape_query, $shape_qry);
            return $shape_query;            
        }

        $result = DB::select('SELECT * FROM sch_gis."sp_getclimaticrisk"(:layerId, :typeId, :coordx, :coordy, :levelId, :dpacode) 
                as feature', ['layerId' =>  $layerId, 'typeId' =>  $typeId, 'coordx' =>  null, 'coordy' =>  null, 'levelId' =>  $levelId, 'dpacode' =>  $dpacode]);                                    
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