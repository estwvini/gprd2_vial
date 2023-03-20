<?php

namespace App\Processes\Business\Roads\Catalogs;

use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

/**
 * Clase CatalogProcess
 * @package App\Processes\Business\Roads\Catalogs
 */
class CatalogProcess
{
    /**
     * @var CatalogRepository
     */
    protected $catalogRepository;

    /**
     * Constructor de CatalogProcess.
     *
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        CatalogRepository $catalogRepository
    ) {
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información del catálogo.
     *
     * @return mixed
     * @throws Exception
     */
    public function data(array $filter)
    {
        $catalog = $this->catalogRepository->getAllWith($filter);

        $dataTable = DataTables::of($catalog)
            ->setRowId('id')
            ->make(true);

        return $dataTable;
    }

    /**
     * Almacenar nuevo catálogo.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->catalogRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('hdm4.messages.errors.create_catalog'), 1000);
        }

        return $entity;
    }

    /**
     * Retornar los catálogos de nivel superior.
     *
     * @return array
     */
    public function getFatherCatalog()
    {
         
        return $this->catalogRepository->getFatherCatalog();
        
           
        /*return [
            'catalogs' => $catalog           
        ];*/
    }

    
    /**
     * Retornar el catálogo por id.
     *
     * @return array
     */
    public function findById(int $id)
    {
        $catalog = $this->catalogRepository->findById($id);
           
        return [
            'catalog' => $catalog           
        ];
    }
}