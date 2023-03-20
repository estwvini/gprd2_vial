<?php

namespace App\Repositories\Repository\Business\Roads\Catalogs;

use App\Models\Business\Roads\Catalogs\Catalog;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase CatalogRepository
 * @package App\Repositories\Repository\Business\Roads\Catalogs
 */
class CatalogRepository extends Repository
{
    /**
     * Constructor de CatalogRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
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
        return Catalog::class;
    }

    /**
     * Actualizar en la BD la información de un catálogo
     *
     * @param array $data
     * @param Catalog $entity
     *
     * @return Catalog|null
     */
    public function updateFromArray(array $data, Catalog $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo catálogo.
     *
     * @param array $data
     *
     * @return Catalog|null
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $entity->create($data);       
    }

/**
     * Obtener de la BD todos los catálogos de nivel superior.
     *
     * @return mixed
     */
    public function getFatherCatalog()
    {      
        
        return $this->model
            ->whereNull('padre_id')                      
            ->select('id', 'codigo', 'descrip')
            ->orderBy('descrip')
            ->get();
    }

  
    /**
     * Obtener de la BD un catálogo por id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Obtiene todos los registros de catálogos por padre
     *
     * @param array $filters
     *
     * @return mixed
     */
    public function getAllWith(array $filters)
    {
        return $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['parent_id'])) {
                    $query->where('padre_id', $filters['parent_id']);
                }                
            })           
            ->select('id', 'codigo', 'descrip')
            ->orderBy('descrip')
            ->get();
    }

    /**
     * Obtener de la BD una colección de todos los tipos de estado.
     *
     * @return mixed
     */
    public function listState()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::STATES)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los tipos de carriles.
     *
     * @return mixed
     */
    public function listLanes()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::LANES)
        ->where('road_catalogo.descrip', '<>', Catalog::WITHOUT_DETERMINING)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos los tipos de superficie_rodadura.
     *
     * @return mixed
     */
    public function listRoundSurface()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::ROUNDSURFACE)
        ->where('road_catalogo.descrip', '<>', Catalog::OTHER)
        ->where('road_catalogo.descrip', '<>', Catalog::WITHOUT_DETERMINING)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos los tipo_terreno.
     *
     * @return mixed
     */
    public function listLands()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::LANDS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los uso de via.
     *
     * @return mixed
     */
    public function listUseRoads()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::USEROADS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los tipos de señal horizontal.
     *
     * @return mixed
     */
    public function listHorizontalSignalType()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip',  Catalog::HORIZONTALSIGNALTYPE)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los tipos de señal vertical.
     *
     * @return mixed
     */
    public function listVerticalSignalType()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::VERTICALSIGNALTYPE)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los tipos de alcantarilla.
     *
     * @return mixed
     */
    public function listTypeSewers()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::TYPESEWERS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los material de alcantarilla.
     *
     * @return mixed
     */
    public function listMaterialSewers()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::MATERIALSEWERS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos las protecciones laterales.
     *
     * @return mixed
     */
    public function listSideProtections()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::SIDEPROTECTIONS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos las capa rodadura puente.
     *
     * @return mixed
     */
    public function listRollingLeatherBridges()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip',Catalog::ROLLINGLEATHERBRIDGES)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos los tipo necesidad conservación.
     *
     * @return mixed
     */
    public function listTypeConversationNeeds()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::TYPECONVERSATIONNEEDS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los tipo punto crítico.
     *
     * @return mixed
     */
    public function listTypeCriticalPoints()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::TYPECRITICALPOINTS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los tipo cuneta.
     *
     * @return mixed
     */
    public function listTypeDitches()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::TYPEDITCHES)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los lado.
     *
     * @return mixed
     */
    public function listSides()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::SIDES)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos los tipos de estado.
     *
     * @return mixed
     */
    public function listClimaticConditions()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::CLIMATICCONDICTIONS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los tipos de estado.
     *
     * @return mixed
     */
    public function listTypeInterconnections()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::TYPEINTERCONNECTIONS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos los tipos de carriles.
     *
     * @return mixed
     */
    public function listStateActive()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::STATES)
        ->where('road_catalogo.descrip', '<>', Catalog::WITHOUT_DETERMINING)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos los tipo superficie rodadura.
     *
     * @return mixed
     */
    public function listSurfaceTypes()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::SURFACETYPES)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos los tipo superficie rodadura.
     *
     * @return mixed
     */
    public function listSurfaceTypesActive()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::SURFACETYPES)
        ->where('road_catalogo.descrip', '<>', Catalog::OTHER)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos los tipo minas.
     *
     * @return mixed
     */
    public function listTypeMines()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::TYPEMINES)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

    /**
     * Obtener de la BD una colección de todos los material minas.
     *
     * @return mixed
     */
    public function listMaterialMines()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::MATERIALMINES)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos las fuentes.
     *
     * @return mixed
     */
    public function listSources()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::SOURCES)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los sector productivo.
     *
     * @return mixed
     */
    public function listProductiveSectors()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::PRODUCTIVESECTORS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

      /**
     * Obtener de la BD una colección de todos los tipo talud.
     *
     * @return mixed
     */
    public function listTypeSlopes()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::TYPESLOPES)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los tipo población.
     *
     * @return mixed
     */
    public function listTypesPopulation()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::TYPEPOPULATION)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

     /**
     * Obtener de la BD una colección de todos los tipo día.
     *
     * @return mixed
     */
    public function listTypeDays()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::TYPEDAYS)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }

      /**
     * Obtener de la BD una colección de todos los tipo servicio asociado.
     *
     * @return mixed
     */
    public function listTypeServicesAssociated()
    {
        return $this->model
        ->join('sch_road.road_catalogo AS rc', 'road_catalogo.padre_id', '=', 'rc.id')
        ->where('rc.descrip', Catalog::TYPESERVICESASSOCIATED)
        ->whereNull('rc.padre_id')
        ->select('road_catalogo.id', 'road_catalogo.codigo', 'road_catalogo.descrip')
        ->orderBy('road_catalogo.descrip')
        ->get();
    }
}