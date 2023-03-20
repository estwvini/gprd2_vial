<?php

namespace App\Repositories\Repository\App;

use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase ActivityRepository
 *
 * @package App\Repositories\Repository\App
 */
class ActivityRepository
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

    public function findByProject(int $projectFiscalYearId)
    {
        return ActivityProjectFiscalYear::join('project_fiscal_years', 'project_fiscal_years.id', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->where([
                ['project_fiscal_years.id', '=', $projectFiscalYearId]
            ])->with(['tasks', 'area', 'projectFiscalYear.project.executingUnit', 'projectFiscalYear.project.subprogram.parent', 'responsible'])
            ->select('activity_project_fiscal_years.*')->get();
    }

    /**
     *  Presupuesto de proyectos
     *
     * @param int $year
     * @param string $date
     * @param array $activitiesCodes
     *
     * @return Collection
     */
    public function getActivitiesBudget(int $year, string $date, array $activitiesCodes = []): Collection
    {
        $filterByActivities = '';
        if (count($activitiesCodes)) {
            $bindingsString = trim(str_repeat('?,', count($activitiesCodes)), ',');
            $filterByActivities = "and f.cuenta in ({$bindingsString})";
        }

        $query = "select f.cuenta                                                                             as code,
                   sum(f.codificado)                                                                          as encoded,
                   sum(f.devengado)                                                                           as accrued
                    from ced_presupuestaria(?, ?, ?, 1, 0)
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
                            ) where f.niv_cue = 6 {$filterByActivities} group by 1;";

        $this->sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return collect(DB::connection('pgsql')->select($query, array_merge([$this->sfgprov->company_code, $year, $date], $activitiesCodes)));
    }

}
