<?php

namespace App\Repositories\Repository\App;

use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Support\Facades\DB;

/**
 * Clase BudgetIndicatorRepository
 *
 * @package App\Repositories\Repository\App
 */
class BudgetIndicatorRepository
{
    /**
     * @var mixed
     */
    private $sfgprov;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     *  Presupuesto por categoría
     *
     * @param int $year
     * @param string $date
     * @param array $codes
     * @param int $from
     * @param int $level
     * @param int $type
     *
     * @return array
     */
    public function getIndicatorBudget(int $year, string $date, array $codes = [], int $from = 22, int $level = 9, int $type = 1): array
    {
        $filterByCodes = '';
        $this->sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $param = [$this->sfgprov->company_code, $year, $date, $type, $level];
        if (count($codes)) {
            $bindingsString = trim(str_repeat('?,', count($codes)), ',');
            $filterByCodes = "and substring(f.cuenta, ?, 7) in ({$bindingsString})";
            $param[] = $from;
            $param = array_merge($param, $codes);
        }

        $query = "select sum(f.codificado)                                                                                          as encoded,
                   sum(f.devengado)                                                                                                 as accrued,
                   round((sum(f.devengado) * 100 / case when sum(f.codificado) = 0 then 1 else sum(f.codificado) end)::numeric, 2)  as percent
                    from ced_presupuestaria(?, ?, ?, ?, 0)
                             as f(ult_cue character(1),
                                  cuenta character varying(250),
                                  nom_cue character(250),
                                  niv_cue numeric(6),
                                  asig_ini double precision,
                                  reformas double precision,
                                  codificado double precision,
                                  certificado double precision,
                                  certificado_real double precision,
                                  comprometido double precision,
                                  devengado double precision,
                                  por_comprometer double precision,
                                  por_comprometer_real double precision,
                                  por_devengar double precision,
                                  comprometido_mes double precision,
                                  devengado_mes double precision,
                                  recaudado double precision,
                                  pagado double precision,
                                  anticipo double precision,
                                  porcencom double precision,
                                  porcendev double precision,
                                  niv_ug character(10)
                            ) where f.niv_cue = ? {$filterByCodes}";

        return DB::connection('pgsql')->select($query, $param);
    }

}
