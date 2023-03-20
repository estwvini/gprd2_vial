<?php

namespace App\Repositories\Repository\Business\Reports;

use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase DashboardRepository
 *
 * @package App\Repositories\Repository\Business\Reports
 */
class DashboardRepository
{

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * Constructor de DashboardRepository.
     *
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Obtiene los detalles del presupuesto de ingresos
     *
     * @param int $year
     * @param string $date
     * @param int $type
     *
     * @return array
     */
    public function totalsBudgetByType(int $year, string $date, int $type = 1)
    {
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $query = "select
                       sum(f.asig_ini)                                    as asig_ini,
                       sum(f.reformas)                                    as reformas,
                       sum(f.codificado)                                  as codificado,
                       sum(f.certificado)                                 as certificado,
                       sum(f.comprometido)                                as comprometido,
                       sum(f.devengado)                                   as devengado,
                       sum(f.por_comprometer)                             as por_comprometer,
                       sum(f.por_devengar)                                as por_devengar,
                       sum(f.pagado)                                      as pagado,
                       sum(f.devengado) * 100 / case when sum(f.codificado) = 0 then 1 else sum(f.codificado) end              as porciento_ejecucion
                    from ced_presupuestaria(:company_code, :year, :date, :type, 0)
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
                            ) where f.niv_cue = 1";

        return DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'date' => $date,
            'type' => $type
        ]);
    }

    /**
     * Obtiene presupuesto por fuente de financiamiento
     *
     * @param int $year
     * @param string $date
     * @param int $from
     * @param int $length
     * @param int $level
     * @param int $type
     *
     * @return array
     */
    public function budgetByCategory(int $year, string $date, int $from, int $length, int $level, int $type = 1)
    {
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $query = "select f.nom_cue as category,
                       substring(trim(f.cuenta), {$from}, {$length}) as codigo,
                       sum(f.asig_ini)   as asignado,
                       sum(f.codificado)   as codificado,
                       sum(f.devengado) as devengado,
                       sum(f.por_devengar) as por_devengar,
                       case when sum(f.codificado) = 0 then 0 else sum(f.devengado) * 100 / sum(f.codificado) end as porciento_ejecucion
                    from ced_presupuestaria(:company_code, :year, :date, :type, 0)
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
                            ) where f.niv_cue = :level group by 1, 2 order by 3 desc";

        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'date' => $date,
            'type' => $type,
            'level' => $level
        ]));
    }

    /**
     * Obtiene la ejecución del presupuesto por mes
     *
     * @param int $year
     *
     * @return Collection
     */
    public function budgetMonthlyExecution(int $year)
    {
        $query = "select split_part(t.month, '-', 2) as month,
                           sum(t.devengado)            as devengado,
                           sum(t.comprometido)         as comprometido
                    from (select case
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 1)
                                         then '1-Ene'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 2)
                                         then '2-Feb'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 3)
                                         then '3-Mar'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 4)
                                         then '4-Abr'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 5)
                                         then '5-May'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 6)
                                         then '6-Jun'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 7)
                                         then '7-Jul'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 8)
                                         then '8-Ago'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 9)
                                         then '9-Sep'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 10)
                                         then '10-Oct'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 11)
                                         then '11-Nov'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 12)
                                         then '12-Dic'
                                     end               as month,
                                 COALESCE(sum(case
                                                  when a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                                      then val_cre - val_deb
                                                  else 0 end),
                                          0)           as devengado,
                                 sum((case when a.sig_tip IN ('CO') and b.comprom = 0 then a.val_cre else 0 end) +
                                     (case
                                          when a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE') and b.comprom = 0
                                              then a.val_cre -
                                                   a
                                                       .val_deb
                                          else 0 end)) as comprometido,
                                  sum((case when a.sig_tip IN ('CE') then a.val_cert else 0 end)) as certificado
                          from prdetmov a
                                   left join prcabmov b
                                             on a.codemp = b.codemp and a.anio = b.anio and a.sig_tip = b.sig_tip and a.acu_tip = b.acu_tip
                          where a.codemp = :company_code
                            and a.anio = :year
                            and a.asociac = 1
                            and b.estado = 3
                          group by 1
                          union
                          select '2-Feb' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '1-Ene' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '3-Mar' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '4-Abr' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '5-May' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '6-Jun' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '7-Jul' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '8-Ago' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '9-Sep' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '10-Oct' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '11-Nov' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '12-Dic' as month, 0 as devengado, 0 as reforma, 0 as comprometido) as t
                    group by t.month
                    order by split_part(t.month, '-', 1)::integer;";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code
        ]));
    }

    /**
     * Obtiene los detalles de los proyectos
     *
     * @param int $year
     * @param string $date
     * @param int $type
     *
     * @return array
     */
    public function totalsProjectByType(int $year, string $date, int $type = 1)
    {

        $query = "select
                       sum(f.asig_ini)                                    as asig_ini,
                       sum(f.reformas)                                    as reformas,
                       sum(f.codificado)                                  as codificado,
                       sum(f.certificado)                                 as certificado,
                       sum(f.comprometido)                                as comprometido,
                       sum(f.devengado)                                   as devengado,
                       sum(f.por_comprometer)                             as por_comprometer,
                       sum(f.por_devengar)                                as por_devengar,
                       sum(f.pagado)                                      as pagado,
                       sum(f.devengado) * 100 / case when sum(f.codificado) = 0 then 1 else sum(f.codificado) end              as porciento_ejecucion
                    from ced_presupuestaria(:company_code, :year, :date, :type, 0)
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
                            ) where f.niv_cue = 1";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'date' => $date,
            'type' => $type
        ]);
    }


    /**
     * Obtiene la ejecución del presupuesto por mes de proyectos
     *
     * @param int $year
     *
     * @return Collection
     */
    public function projectMonthlyExecution(int $year)
    {
        $query = "select split_part(t.month, '-', 2) as month,
                           sum(t.devengado)            as devengado,
                           sum(t.comprometido)         as comprometido
                    from (select case
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 1)
                                         then '1-Ene'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 2)
                                         then '2-Feb'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 3)
                                         then '3-Mar'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 4)
                                         then '4-Abr'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 5)
                                         then '5-May'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 6)
                                         then '6-Jun'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 7)
                                         then '7-Jul'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 8)
                                         then '8-Ago'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 9)
                                         then '9-Sep'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 10)
                                         then '10-Oct'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 11)
                                         then '11-Nov'
                                     when (date_part('year', date(b.fec_apr)) = :year
                                         and date_part('month', date(b.fec_apr)) = 12)
                                         then '12-Dic'
                                     end               as month,
                                 COALESCE(sum(case
                                                  when a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                                      then val_cre - val_deb
                                                  else 0 end),
                                          0)           as devengado,
                                 sum((case when a.sig_tip IN ('CO') and b.comprom = 0 then a.val_cre else 0 end) +
                                     (case
                                          when a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE') and b.comprom = 0
                                              then a.val_cre -
                                                   a
                                                       .val_deb
                                          else 0 end)) as comprometido,
                                  sum((case when a.sig_tip IN ('CE') then a.val_cert else 0 end)) as certificado
                          from prdetmov a
                                   left join prcabmov b
                                             on a.codemp = b.codemp and a.anio = b.anio and a.sig_tip = b.sig_tip and a.acu_tip = b.acu_tip
                          where a.codemp = :company_code
                            and a.anio = :year
                            and a.asociac = 1
                            and b.estado = 3
                          group by 1
                          union
                          select '2-Feb' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '1-Ene' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '3-Mar' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '4-Abr' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '5-May' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '6-Jun' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '7-Jul' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '8-Ago' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '9-Sep' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '10-Oct' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '11-Nov' as month, 0 as devengado, 0 as reforma, 0 as comprometido
                          union
                          select '12-Dic' as month, 0 as devengado, 0 as reforma, 0 as comprometido) as t
                    group by t.month
                    order by split_part(t.month, '-', 1)::integer;";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code
        ]));
    }
    /**
     * Obtiene presupuesto por fuente de financiamiento
     *
     * @param int $year
     * @param string $date
     * @param int $from
     * @param int $length
     * @param int $level
     * @param int $type
     *
     * @return array
     */
    public function projectByCategory(int $year, string $date, int $from, int $length, int $level, int $type = 1)
    {

        $query = "select f.nom_cue as category,
                       substring(trim(f.cuenta), {$from}, {$length}) as codigo,
                       sum(f.asig_ini)   as asignado,
                       sum(f.codificado)   as codificado,
                       sum(f.devengado) as devengado,
                       sum(f.por_devengar) as por_devengar,
                       case when sum(f.codificado) = 0 then 0 else sum(f.devengado) * 100 / sum(f.codificado) end as porciento_ejecucion
                    from ced_presupuestaria(:company_code, :year, :date, :type, 0)
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
                            ) where f.niv_cue = :level group by 1, 2 order by 3 desc";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'date' => $date,
            'type' => $type,
            'level' => $level
        ]));
    }

}
