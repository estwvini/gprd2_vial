<?php

namespace App\Processes\Business\Climatic;

use App\Repositories\Repository\Business\Climatic\RiskRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Exception;


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
     * Constructor de RiskProcess.
     *
     * @param RiskRepository $riskRepository
     */
    public function __construct(
        RiskRepository $riskRepository
    ) {
        $this->riskRepository = $riskRepository;
    }

    /**
     * ubicar coordenadas.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function locale(array $filters): Response
    {
        $layerId = '';
        $typeId = '';
        $levelId = '';
        $coordX = '';
        $coordY = '';
        if (isset($filters['layerId'])) {
            $layerId = $filters['layerId'];
        }         
        if (isset($filters['typeId'])) {
            $typeId = $filters['typeId'];
        } 
        if (isset($filters['levelId'])) {
            $levelId = intval($filters['levelId']);
        } 
        if (isset($filters['coordX'])) {
            $coordX = intval($filters['coordX']);
        } 
        if (isset($filters['coordY'])) {
            $coordY = intval($filters['coordY']);
        }   
        $shape_query = $this->riskRepository->locale($layerId, $typeId,  $levelId,  $coordX,  $coordY);                    
        return new Response(json_encode($shape_query), 200, ['Content-Type' => 'text/plain']);
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
        $dpa_r = '';
        $dpa_c = '';
        $dpa_p = '';
        if (isset($filters['layerId'])) {
            $layerId = $filters['layerId'];
        }         
        if (isset($filters['typeId'])) {
            $typeId = $filters['typeId'];
        } 
        if (isset($filters['levelId'])) {
            $levelId = $filters['levelId'];
        } 
        if (isset($filters['dpa_r'])) {
            $dpa_r = $filters['dpa_r'];
        } 
        if (isset($filters['dpa_c'])) {
            $dpa_c = $filters['dpa_c'];
        } 
        if (isset($filters['dpa_p'])) {
            $dpa_p = $filters['dpa_p'];
        }   
        $shape_query = $this->riskRepository->execute($layerId, $typeId, $levelId, $dpa_r, $dpa_c, $dpa_p);                    
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
}