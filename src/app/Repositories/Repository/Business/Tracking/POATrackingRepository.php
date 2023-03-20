<?php

namespace App\Repositories\Repository\Business\Tracking;

use App\Models\Admin\Department;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase POATrackingRepository
 * @package App\Repositories\Repository\Business\Tracking
 */
class POATrackingRepository
{

    const SELECT_ACCRUED_REFORMS = "trim(a.cuenta) as cuenta,
                               sum(case
                                   when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE'))
                                       then val_cre - val_deb
                                   else 0 end) as total_accrued,
                               sum(case
                                   when a.sig_tip = 'RE'
                                       then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                   else 0 end) as total_reform";

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * Constructor de POATrackingRepository.
     *
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Obtiene una colección de departamentos con sus proyectos y actividades
     *
     * @param int $fiscal_year_id
     * @param int $executingUnitId
     *
     * @return mixed
     */
    public function data(int $fiscal_year_id, int $executingUnitId)
    {
        return ActivityProjectFiscalYear::join('project_fiscal_years as pfy', 'pfy.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', '=', 'pfy.project_id')
            ->join('users_manages_activities as uma', 'uma.activity_project_fiscal_year_id', '=', 'activity_project_fiscal_years.id')
            ->join('users', 'users.id', '=', 'uma.user_id')
            ->join('departments', 'departments.id', '=', 'projects.executing_unit_id')
            ->join('components', 'components.id', 'activity_project_fiscal_years.component_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->whereNull('users.deleted_at')
            ->when($executingUnitId, function ($q) use ($executingUnitId) {
                $q->where('projects.executing_unit_id', $executingUnitId);
            })
            ->where([
                'pfy.fiscal_year_id' => $fiscal_year_id,
                'pfy.status' => ProjectFiscalYear::STATUS_IN_PROGRESS,
                'uma.active' => true
            ])
            ->select(
                'activity_project_fiscal_years.*',
                'departments.name as department_name',
                'projects.name as project_name',
                'components.name as component_name',
                DB::raw("CONCAT(users.first_name,' ',users.last_name) as responsible")
            )->with(['area', 'projectFiscalYear.project.executingUnit', 'projectFiscalYear.project.subprogram.parent'])
            ->get();
    }

    /**
     * Obtiene presupuesto por actividad
     *
     * @param int $year
     * @param string $date
     *
     * @return array
     */
    public function activitiesBudget(int $year, string $date)
    {
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;

        $query = "select f.cuenta as cuenta,
                       sum(f.codificado)   as codificado,
                       sum(f.por_comprometer_real) as por_comprometer,
                       sum(f.devengado) * 100 / case when sum(f.codificado) = 0 then 1 else sum(f.codificado) end as porciento_ejecucion
                    from ced_presupuestaria(:company_code, :year, :date, 1, 0)
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
                            ) where f.niv_cue = 6 group by 1;";

        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'date' => $date
        ]));
    }

    /**
     * Obtiene presupuesto por actividad para avance presupuestario
     *
     * @param int $year
     * @param string $date
     *
     * @return array
     */
    public function activitiesBudgetProject(int $year, string $date)
    {
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $query = "select f.cuenta as cuenta,
                       sum(f.codificado)   as codificado
                    from ced_presupuestaria(:company_code, :year, :date, 1, 0)
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
                            ) where f.niv_cue = 6 group by 1;";

        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'date' => $date
        ]));
    }
}
