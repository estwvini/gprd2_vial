<?php

namespace App\Repositories\Repository\App;

use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Project;
use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase ProjectRepository
 *
 * @package App\Repositories\Repository\App
 */
class ProjectRepository
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
     *
     * Proyectos por Unidad Ejecutora
     *
     * @param int $fiscalYearId
     * @param int $executingUnitId
     *
     * @return mixed
     */
    public function findByExecutingUnit(int $fiscalYearId, int $executingUnitId)
    {
        return Project::join('project_fiscal_years', 'project_fiscal_years.project_id', 'projects.id')
            ->join('departments', 'projects.executing_unit_id', 'departments.id')
            ->whereNull('projects.deleted_at')
            ->where([
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYearId],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS],
                ['projects.status', '=', Project::STATUS_IN_PROGRESS],
                ['projects.executing_unit_id', '=', $executingUnitId]
            ])->select('projects.*')->get();
    }

    public function findByLocation(int $fiscalYearId, int $locationId)
    {
        return Project::join('project_fiscal_years', 'project_fiscal_years.project_id', 'projects.id')
            ->join('activity_project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', 'project_fiscal_years.id')
            ->join('budget_items', 'budget_items.activity_project_fiscal_year_id', 'activity_project_fiscal_years.id')
            ->join('budget_item_locations', 'budget_item_locations.budget_item_id', 'budget_items.id')
            ->whereNull('projects.deleted_at')
            ->where([
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYearId],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS],
                ['projects.status', '=', Project::STATUS_IN_PROGRESS],
                ['budget_item_locations.location_id', '=', $locationId],
            ])->select('projects.*')->distinct()->get();
    }

    /**
     *  Presupuesto de proyectos
     *
     * @param int $year
     * @param string $date
     * @param array $projectCodes
     *
     * @return Collection
     */
    public function getProjectBudget(int $year, string $date, array $projectCodes = []): Collection
    {
        $filterByProject = '';
        if (count($projectCodes)) {
            $bindingsString = trim(str_repeat('?,', count($projectCodes)), ',');
            $filterByProject = "and substring(f.cuenta, 4, 9) in ({$bindingsString})";
        }

        $query = "select substring(f.cuenta, 4, 9)                                                                  as code,
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
                            ) where f.niv_cue = 4 and substring(f.cuenta, 10, 3) != '999' {$filterByProject} group by 1;";

        $this->sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return collect(DB::connection('pgsql')->select($query, array_merge([$this->sfgprov->company_code, $year, $date], $projectCodes)));
    }

}
