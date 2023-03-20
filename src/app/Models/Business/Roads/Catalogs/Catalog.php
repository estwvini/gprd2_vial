<?php

namespace App\Models\Business\Roads\Catalogs;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase Catalog
 *
 * @package App\Models\Business\Roads\Catalogs
 * @mixin IdeHelperCatalog
 */
class Catalog extends Model
{
    /**
     * @var string
     */
    protected $table = 'sch_road.road_catalogo';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'codigo',
        'descrip',
        'padre_id'
    ];

     /**
     * Opción SIN DETERMINAR
     */
    const WITHOUT_DETERMINING = 'SIN DETERMINAR';

    /**
     * Opción OTRO
     */
    const OTHER = 'OTRO';

     /**
     * Catálogo capa rodadura puente
     */
    const ROLLINGLEATHERBRIDGES = "Capa rodadura puente";

     /**
     * Catálogo carriles
     */
    const LANES = "Carriles";

    /**
     * Catálogo condiciones climáticas
     */
    const CLIMATICCONDICTIONS = "Condiciones climáticas";

    /**
     * Catálogo estado
     */
    const STATES = "Estado";

   
    /**
     * Catálogo fuente
     */
    const SOURCES = "Fuente";

     /**
     * Catálogo lado
     */
    const SIDES = "Lado";

    /**
     * Catálogo material alcantarilla
     */
    const MATERIALSEWERS = "Material alcantarilla";

    /**
     * Catálogo material minas
     */
    const MATERIALMINES = "Material minas";

    /**
     * Catálogo protecciones laterales
     */
    const SIDEPROTECTIONS = "Protecciones laterales";

     /**
     * Catálogo sector productivo
     */
    const PRODUCTIVESECTORS = "Sector productivo";

    /**
     * Catálogo superficie rodadura
     */
    const ROUNDSURFACE = "Superficie rodadura";

    /**
     * Catálogo tipo alcantarilla
     */
    const TYPESEWERS = "Tipo alcantarilla";

    /**
     * Catálogo tipo cuneta
     */
    const TYPEDITCHES = "Tipo cuneta";

   
    /**
     * Catálogo tipo día
     */
    const TYPEDAYS = "Tipo día";

     /**
     * Catálogo tipo interconexión
     */
    const TYPEINTERCONNECTIONS = "Tipo interconexión";

    /**
     * Catálogo tipo minas
     */
    const TYPEMINES = "Tipo minas";

    /**
     * Catálogo tipo necesidad conservación
     */
    const TYPECONVERSATIONNEEDS = "Tipo necesidad conservación";

    /**
     * Catálogo tipo población 
     */
    const TYPEPOPULATION = "Tipo población";

    /**
     * Catálogo tipo punto crítico 
     */
    const TYPECRITICALPOINTS = "Tipo punto crítico";

    /**
     * Catálogo tipo servicio asociado 
     */
    const TYPESERVICESASSOCIATED = "Tipo servicio asociado";

    /**
     * Catálogo tipo señal horizontal
     */
    const HORIZONTALSIGNALTYPE = "Tipo señal horizontal";

    /**
     * Catálogo tipo señal horizontal
     */
    const VERTICALSIGNALTYPE = "Tipo señal vertical";

    /**
     * Catálogo tipo superficie rodadura
     */
    const SURFACETYPES = "Tipo superficie rodadura";

     /**
     * Catálogo tipo talud
     */
    const TYPESLOPES = "Tipo talud";

    /**
     * Catálogo tipo terreno
     */
    const LANDS = "Tipo terreno";

    /**
     * Catálogo uso vía
     */
    const USEROADS ="Uso vía";

    /**
     * Catálogo tipo vehículo
     */
    const TIPO_VEHICULO = "Tipo vehículo";

       /**
     * Catálogo tipo material
     */
    const TIPO_MATERIAL = "Tipo material";

     /**
     * Catálogo tipo firme
     */
    const TIPO_FIRME = "Tipo firme";

     /**
     * Catálogo tipo drenaje
     */
    const TIPO_DRENAJE = "Tipo drenaje";

    /**
     * Catálogo piso climático
     */
    const PISO_CLIMATICO = "Piso climático";

     /**
     * Catálogo estado drenaje
     */
    const ESTADO_DRENAJE = "Estado drenaje";

    /**
     * Catálogo humedad
     */
    const HUMEDAD = "Humedad";


}
