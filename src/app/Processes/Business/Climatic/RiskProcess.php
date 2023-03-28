<?php

namespace App\Processes\Business\Climatic;

use App\Repositories\Repository\Business\Climatic\RiskRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\Business\Roads\MainShapeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\Log;


/**
 * Clase RiskProcess
 * @package App\Processes\Business\Climatic
 */
class RiskProcess
{
    /**
     * @var RiskRepository
     */
    protected $riskRepository;

     /**
     * @var SettingRepository
     */
    protected $settingRepository;
    /**
     * @var MainShapeRepository
     */
    protected $mainShapeRepository;

    /**
     * Constructor de RiskProcess.
     *
     * @param RiskRepository $riskRepository
     * @param SettingRepository $settingRepository
     * @param MainShapeRepository $mainShapeRepository
     */
    public function __construct(
        RiskRepository $riskRepository, 
        SettingRepository $settingRepository,
        MainShapeRepository $mainShapeRepository,
    ) {
        $this->riskRepository = $riskRepository;
        $this->mainShapeRepository = $mainShapeRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Retornar data necesaria para mostrar el formulario de riesgos climáticos.
     *
     * @return array
     */
    public function indexRisk()
    {
        $gad = $this->settingRepository->findByKey('gad');        
        $cantons = $this->riskRepository->getCantons($gad->value['code']);
        $shapes = $this->mainShapeRepository->allShapes();
        $shapesBackground = $this->mainShapeRepository->shapesBackground();   
        $codePrv = $gad->value['code'];
        return [
            'gad' => $gad->value,
            'cantons' => $cantons,
            'shapes' => $shapes,
            'shapesDefault' => ($shapesBackground) ? [$shapesBackground] : [],
            'codePrv' => $codePrv
        ];
    }

     /**
     * ejecutar consulta de capas
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function execute(array $filters): Response
    {
        $layerId = '';
        $typeId = '';
        $levelId = '';
        $dpa = '';
        if (isset($filters['layerId'])) {
            $layerId = $filters['layerId'];
        }         
        if (isset($filters['typeId'])) {
            $typeId = $filters['typeId'];
        } 
        if (isset($filters['levelId'])) {
            $levelId = $filters['levelId'];
        } 
        if (isset($filters['dpa'])) {
            $dpa = $filters['dpa'];
        }
        $shape_query = $this->riskRepository->execute($layerId, $typeId, $levelId, $dpa);                    
        return new Response(json_encode($shape_query), 200, ['Content-Type' => 'text/plain']);
    }

    /**
     * Descargar un archivo.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function generate(int $id)
    {
        $entity =null;

        if (!$entity) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }
        if (!Storage::disk('inventory_documents')->exists($entity->path)) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        return Storage::disk('inventory_documents')->download($entity->path);
    }

    /**
     * Obtener las parroquias de un cantón.
     *
     * @param string $name
     *
     * @return Collection
     */
    public function getParishes(string $name)
    {
        return $this->riskRepository->findByCanton($name);
    }

     /**
     * Retornar data necesaria para mostrar todos los Shape de la provincia y query
     *
     * @return array
     */
    public function shapeQuery(array $filters): Response
    {
        $shapeId = '';
        $catId = '';
        if (isset($filters['shape_id'])) {
            $shapeId = $filters['shape_id'];
        }         
        if (isset($filters['cat_id'])) {
            $catId = $filters['cat_id'];
        }   
        $shape_query = $this->mainShapeRepository->shapeQuery($shapeId,$catId);                    
        return new Response(json_encode($shape_query), 200, ['Content-Type' => 'text/plain']);
    }
}