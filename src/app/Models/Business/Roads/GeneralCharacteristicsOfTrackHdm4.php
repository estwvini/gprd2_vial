<?php

namespace App\Models\Business\Roads;

use Illuminate\Database\Eloquent\Model;

/**
 * Clase GeneralCharacteristicsOfTrackHdm4 (vía)
 *
 * @package App\Models\Business\Roads
 * @mixin IdeHelperGeneralCharacteristicsOfTrackHdm4
 */
class GeneralCharacteristicsOfTrackHdm4 extends Model
{



    /**
     * @var string
     */
    protected $table = 'sch_road.road_caracteristicas_generales_via_hdm4';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $primaryKey = 'id_hdm4';

    /**
     * @var bool
     */
    public $incrementing = false;

    const STATUS_TRUE = 'VERDADERO';
    const STATUS_FALSE = 'FALSO';

    /**
     * @var array
     */
    protected $fillable = [
        'id_hdm4',
        'SECT_ID',
        'SECT_NAME',
        'LINK_ID',
        'LINK_NAME',
        'SPEED_FLOW',
        'TRAF_FLOW',
        'ACC_CLASS',
        'ROAD_CLASS',
        'CLIM_ZONE',
        'SURF_CLASS',
        'LENGTH',
        'CWAY_WIDTH',
        'SHLD_WIDTH',
        'MT_AADT',
        'NM_AADT',
        'AADT_YEAR',
        'DIRECTION',
        'RF',
        'NUM_RFS',
        'SUPERELEV',
        'CURVATURE',
        'SIGM_ADRAL',
        'SPEED_LIM',
        'ENFORCEMNT',
        'XNMT',
        'XMT',
        'XFRI',
        'HSNEW',
        'HSOLD',
        'HBASE',
        'RES_MODULU',
        'REL_COMPCT',
        'SNP_DERIVE',
        'SN',
        'CBR',
        'SNP_DRY',
        'D0',
        'BENKEL_DEF',
        'SURF_STREN',
        'BASE_STREN',
        'SUBB_STREN',
        'HSUBBASE',
        'SURF_THICK',
        'SLAB_LENTH',
        'BASE_THICK',
        'BASE_MODUL',
        'CNSTR_YEAR',
        'SUBG_MATRL',
        'COMPMETHOD',
        'COND_YEAR',
        'ROUGHNESS',
        'CRACKS_ACA',
        'CRACKS_ACW',
        'CRACKS_ACT',
        'RAVEL_AREA',
        'PHOLE_NUM',
        'EDGEBREAK',
        'RUT_DEPTH',
        'RUTDEPTH_SD',
        'TEXT_DEPTH',
        'SKIDRESIST',
        'DRAIN_COND',
        'FAULTING',
        'SPALL_JNTS',
        'CRACKSLABS',
        'DETERCRACK',
        'FAILURESKM',
        'GRAV_THICK',
        'LAST_CONST',
        'LAST_SURF',
        'LAST_PRVNT',
        'LAST_REHAB',
        'PREV_ACA',
        'PREV_ACW',
        'PREV_NCT',
        'LASTGRAVEL',
        'DRAIN_TYPE',
        'ALTITUDE',
        'SHOULDTYPE',
        'WIDN_WIDTH',
        'EDGEDRAINS',
        'NMT_SEPAR',
        'NMTLANES',
        'ELANES',
        'CALIB_ITEM',
        'REPCOST',
        'CONDBASED',
        'INIROUGH',
        'TERROUGH',
        'RDFOSBGR_P',
        'RDPVLA_PRR',
        'FTCYCLE_PR',
        'BRDGSTR_PR',
        'TRFSGN_PRR',
        'RDFOSBGR_R',
        'RDPVLA_RES',
        'FTCYCLE_RE',
        'BRDGSTR_RE',
        'TRFSGN_RES',
        'RDFOSBGR_U',
        'RDPVLA_USE',
        'FTCYCLE_US',
        'BRDGSTR_US',
        'TRFSGN_USE',
        'RDFOSBGR_A',
        'RDPVLA_AGE',
        'FTCYCLE_AG',
        'BRDGSTR_AG',
        'TRFSGN_AGE',
        'COMPAGEYEA',
        'USFLFEUNIT',
        'ID'
    ];

}
