<?php

namespace App\Repositories\Repository\Business\Reports;

use App\Models\Business\BudgetItem;
use App\Models\Business\Plan;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\PublicPurchase;
use App\Models\Business\Task;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase TrackingReportsRepository
 *
 * @package App\Repositories\Repository\Business\Reports
 */
class TrackingReportsRepository
{
    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * Constructor de TrackingReportsRepository.
     *
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Obtener infomación del reporte poa
     *
     * @param FiscalYear $fiscalYear
     * @param array $filters
     *
     * @return BudgetItem[]|Builder[]|Collection
     * @throws Exception
     */
    public function poaReport(FiscalYear $fiscalYear, array $filters)
    {
        $budgetItemsFromOperationalActivities = BudgetItem::join('operational_activities', 'operational_activities.id', '=', 'budget_items.operational_activity_id')
            ->join('current_expenditure_elements', 'operational_activities.current_expenditure_element_id', 'current_expenditure_elements.id')
            ->where('budget_items.fiscal_year_id', $fiscalYear->id)
            ->when($filters['executing_unit'] != '0', function ($query) use ($filters) {
                return $query->where('operational_activities.executing_unit_id', $filters['executing_unit']);
            })
            ->when($filters['project'] != '0', function ($query) {
                return $query->where('budget_items.id', -1);
            })
            ->select('budget_items.*')
            ->with([
                'budgetClassifier',
                'geographicLocation',
                'source',
                'spendingGuide',
                'competence',
                'institution',
                'operationalActivity.subprogram.parent.area',
                'operationalActivity.executingUnit'
            ]);

        $budgetItems = BudgetItem::join('activity_project_fiscal_years', 'activity_project_fiscal_years.id', '=', 'budget_items.activity_project_fiscal_year_id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->where([
                ['budget_items.fiscal_year_id', '=', $fiscalYear->id],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS],
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED]
            ])
            ->when($filters['executing_unit'] != '0', function ($query) use ($filters) {
                return $query->where('projects.executing_unit_id', $filters['executing_unit']);
            })
            ->when($filters['project'] != '0', function ($query) use ($filters) {
                return $query->where('projects.id', $filters['project']);
            })
            ->with([
                'budgetClassifier',
                'geographicLocation',
                'source',
                'spendingGuide',
                'competence',
                'institution',
                'activityProjectFiscalYear.area',
                'activityProjectFiscalYear.projectFiscalYear',
                'activityProjectFiscalYear.component.project.executingUnit',
                'activityProjectFiscalYear.component.project.subprogram.parent'
            ])
            ->select('budget_items.*')
            ->union($budgetItemsFromOperationalActivities)
            ->get();
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        if ($sfgprov->exist) {
            return self::remotePOAQuery($budgetItems, $fiscalYear);
        } else {
            throw new Exception(trans('reports.exceptions.finance_system_not_found'), 1000);
        }
    }

    /**
     * Consulta información de las partidas presupuestarias en la base de datos del sistema financiero
     *
     * @param Collection $budgetItems
     * @param FiscalYear $fiscalYear
     *
     * @return Collection
     */
    private function remotePOAQuery(Collection $budgetItems, FiscalYear $fiscalYear)
    {
        $query = "select trim(a.cuenta) as cuenta,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE'))
                                   then val_cre - val_deb
                               else 0 end) as total_amount,
                       sum(case when a.sig_tip = 'PR' then a.val_cre else 0 end) as assigned,
                       sum(case
                               when a.sig_tip = 'RE' then case
                                                              when val_cre < 0 then a.val_deb + a.val_cre
                                                              else a.val_deb - a.val_cre end
                                else 0 end) as reform,
                       sum((case when a.sig_tip IN ('CO') and b.comprom = 0 then a.val_cre else 0 end) +
                                   (case
                                        when a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE') and b.comprom = 0 then a.val_cre - a.val_deb
                                        else 0 end))                                                                      as committed,

                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 1)
                                   then val_cre - val_deb
                               else 0 end) as jan,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 2)
                                   then val_cre - val_deb
                               else 0 end) as feb,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 3)
                                   then val_cre - val_deb
                               else 0 end) as mar,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 4)
                                   then val_cre - val_deb
                               else 0 end) as apr,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 5)
                                   then val_cre - val_deb
                               else 0 end) as may,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 6)
                                   then val_cre - val_deb
                               else 0 end) as jun,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 7)
                                   then val_cre - val_deb
                               else 0 end) as jul,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 8)
                                   then val_cre - val_deb
                               else 0 end) as aug,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 9)
                                   then val_cre - val_deb
                               else 0 end) as sep,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 10)
                                   then val_cre - val_deb
                               else 0 end) as oct,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 11)
                                   then val_cre - val_deb
                               else 0 end) as nov,
                       sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = :year
                                   and date_part('month', date(b.fec_apr)) = 12)
                                   then val_cre - val_deb
                               else 0 end) as dec

                from prdetmov a
                         left join prcabmov b on a.codemp = b.codemp and a.anio = b.anio and a.sig_tip = b.sig_tip and a.acu_tip = b.acu_tip
                where a.codemp = :company_code
                  and a.anio = :year
                  and a.asociac = 1
                  and b.estado = 3
                group by 1
                order by cuenta;";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $financeBudgetItems = collect(DB::connection('pgsql')->select($query, ['year' => $fiscalYear->year, 'company_code' => $sfgprov->company_code]));

        $result = $budgetItems->map(function ($item) use ($financeBudgetItems) {

            $bi = $financeBudgetItems->firstWhere('cuenta', $item->code);
            if (!$bi) {
                return $item;
            }
            foreach ($bi as $key => $value) {
                $item->setAttribute($key, $value);
            }
            return $item;
        });

        return $result;
    }


    /**
     * Obtiene información presupuestaria de las partidas
     *
     * @param int $year
     * @param string $date
     * @param int $itemType
     * @param int $level
     * @param string $operator
     * @param int $allItems
     * @param string $item
     * @param string $executingUnit
     *
     * @return \Illuminate\Support\Collection
     */
    public function budgetCard(int $year, string $date, int $itemType, int $level, string $operator, int $allItems = 0, string $item = '', string $executingUnit = '')
    {
        $filterByItem = '';
        if (isset($item) and $item != '') {
            $filterByItem = "and f.cuenta like '%{$item}%'";
        }

        $filterByUnit = '';
        if (isset($executingUnit) and $executingUnit != '' and $itemType == 1) {
            $filterByUnit = "and substring(f.cuenta, 14, 3) = '{$executingUnit}'";
        }
        $query = "select row_number() over (order by f.cuenta) as id,
                    trim(f.cuenta) as cuenta,
                    trim(f.nom_cue) as nom_cue,
                    f.asig_ini,
                    f.reformas,
                    f.codificado,
                    f.certificado,
                    f.comprometido,
                    f.devengado,
                    f.por_comprometer_real,
                    f.por_devengar,
                    f.pagado,
                    f.niv_cue,
                    f.ult_cue
                    from ced_presupuestaria(:company_code, :year, :date, :item_type, :all_items)
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
                            ) where f.niv_cue {$operator} :level {$filterByItem} {$filterByUnit}";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'date' => $date,
            'item_type' => $itemType,
            'all_items' => $allItems,
            'level' => $level
        ]));
    }

    public function budgetCard2(int $year, int $itemType = 1, int $level = 1, int $allItems = 0, string $item = '', string $executingUnit = '')
    {
        $filterByItem = '';
        if (isset($item) and $item != '') {
            $filterByItem = "and f.cuenta like '%{$item}%'";
        }

        $filterByUnit = '';
        if (isset($executingUnit) and $executingUnit != '' and $itemType == 1) {
            $filterByUnit = "and substring(f.cuenta, 14, 3) = '{$executingUnit}'";
        }
        $query = "select row_number() over (order by f.cuenta) as id,
                    trim(f.cuenta) as cuenta,
                    trim(f.nom_cue) as nom_cue,

                    f.por_devengar,

                    from ced_presupuestaria(:company_code, :year, :date, :item_type, :all_items)
                             as f(
                                  por_devengar double precision,

                            ) where f.cuenta={$item}";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
//            'date' => $date,
            'item_type' => $itemType,
            'all_items' => $allItems,
            'level' => $level
        ]));
    }


    /**
     * Obtiene los niveles de la estructura de Ingreso o Gasto
     *
     * @param int $year
     * @param int $type
     *
     * @return array
     */
    public function structureLevels(int $year, int $type = 1) // 1 => Tipo Gasto
    {
        $query = "SELECT niv_est, trim(des_est) as des_est  FROM prestcta WHERE identifi = :type and anio = :year order by niv_est;";
        return DB::connection('pgsql')->select($query, [
            'year' => $year,
            'type' => $type,
        ]);
    }

    /**
     * Buscar en la BD los proyectos en ejecución.
     *
     * @param FiscalYear $fiscalYear
     * @param int $executingUnitId
     *
     * @return mixed
     */
    public function findByFiscalYear(FiscalYear $fiscalYear, int $executingUnitId)
    {
        $query = ProjectFiscalYear::join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS],
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYear->id],
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $fiscalYear->year],
                ['plans.end_year', '>=', $fiscalYear->year],
                ['projects.executing_unit_id', '=', $executingUnitId],
            ])
            ->select('project_fiscal_years.*')
            ->with([
                'project.subprogram.parent.parent',
                'project.indicators.planIndicatorGoals',
                'activitiesProjectFiscalYear' => function ($query) {
                    $query->with([
                        'tasks.responsible' => function ($query) {
                            $query->where('active', true);
                        },
                        'tasks' => function ($query) {
                            $query->where('type', Task::ELEMENT_TYPE['MILESTONE']);
                        }
                    ]);
                }
            ]);

        return $query->get();
    }

    /**
     * Obtiene información del reporte Comparativo entre planificado y devengado.
     *
     * @param int $fiscalYearId
     * @param int $executingUnit
     *
     * @return mixed
     */
    public function projectsInProgressPlanningAccruedData(int $fiscalYearId, int $executingUnit = 0)
    {
        return ProjectFiscalYear::join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->when($executingUnit != 0, function ($query) use ($executingUnit) {
                return $query->where('projects.executing_unit_id', $executingUnit);
            })
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS],
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYearId],
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED]
            ])
            ->select('project_fiscal_years.*')
            ->with([
                'project',
                'activitiesProjectFiscalYear' => function ($query) {
                    $query->whereNull('activity_project_fiscal_years.deleted_at')
                        ->select('activity_project_fiscal_years.*')
                        ->with([
                            'budgetItems' => function ($query) {
                                $query->select(DB::raw('budget_items.*,
                                                                budget_classifier_spendings.full_code, budget_classifier_spendings.title, budget_items.amount,
                                                                financing_source_classifiers.description,
                                                               (select sum(bp.assigned) from budget_plannings bp where (bp.month = 1 or bp.month = 2 or bp.month = 3)
                                                               and bp.budget_item_id = budget_items.id) as trim_1,
                                                               (select sum(bp.assigned) from budget_plannings bp where (bp.month = 4 or bp.month = 5 or bp.month = 6)
                                                               and bp.budget_item_id = budget_items.id) as trim_2,
                                                               (select sum(bp.assigned) from budget_plannings bp where (bp.month = 7 or bp.month = 8 or bp.month = 9)
                                                               and bp.budget_item_id = budget_items.id) as trim_3,
                                                               (select sum(bp.assigned) from budget_plannings bp where (bp.month = 10 or bp.month = 11 or bp.month = 12)
                                                               and bp.budget_item_id = budget_items.id) as trim_4'))
                                    ->join('budget_classifier_spendings', 'budget_items.budget_classifier_id', '=', 'budget_classifier_spendings.id')
                                    ->join('financing_source_classifiers', 'budget_items.financing_source_id', '=', 'financing_source_classifiers.id');
                            }
                        ]);
                }
            ])->get();
    }

    /**
     * Consulta información de projectos en el sistema financiero
     *
     * @param Collection $projectFiscalYears
     * @param $projectCodes
     * @param $year
     *
     * @return Collection
     */
    public function getProjectBudgetProgress(Collection $projectFiscalYears, $projectCodes, $year)
    {
        $bindingsString = trim(str_repeat('?,', count($projectCodes)), ',');
        if ($bindingsString === "") {
            $bindingsString = "''";
        }

        $query = "select substring(a.cuenta, 4, 9) as project_code,
                   sum(case
                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                               and date_part('year', date(b.fec_apr)) = ?
                               and (date_part('month', date(b.fec_apr)) >= 1
                               and date_part('month', date(b.fec_apr)) <= 3))
                               then val_cre - val_deb
                           else 0 end) as accruedTrim_1,
                   sum(case
                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                               and date_part('year', date(b.fec_apr)) = ?
                               and (date_part('month', date(b.fec_apr)) >= 4
                               and date_part('month', date(b.fec_apr)) <= 6))
                               then val_cre - val_deb
                           else 0 end) as accruedTrim_2,
                   sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = ?
                                   and (date_part('month', date(b.fec_apr)) >= 7
                                   and date_part('month', date(b.fec_apr)) <=9))
                                   then val_cre - val_deb
                               else 0 end) as accruedTrim_3,
                   sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = ?
                                   and (date_part('month', date(b.fec_apr)) >= 10
                                   and date_part('month', date(b.fec_apr)) <= 12))
                                   then val_cre - val_deb
                               else 0 end) as accruedTrim_4,
                   sum(case
                               when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                   and date_part('year', date(b.fec_apr)) = ?)
                                   then val_cre - val_deb
                               else 0 end) as accrued,
                   sum(case when a.sig_tip = 'PR' then a.val_cre else 0 end) as assigned,
                   sum(case
                           when a.sig_tip = 'RE' then case
                                                      when val_cre < 0 then a.val_deb + a.val_cre
                                                      else a.val_deb - a.val_cre end
                                else 0 end) as reform
                  from prdetmov a
                  left join prcabmov b on a.codemp = b.codemp and a.anio = b.anio and a.sig_tip = b.sig_tip and a.acu_tip = b.acu_tip
                  where a.codemp = ?
                    and a.anio = ?
                    and a.asociac = 1
                    and b.estado = 3
                    and substring(a.cuenta, 4, 9) in ( {$bindingsString} )
                  group by 1
                  order by 1;";
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $results = collect(DB::connection('pgsql')->select($query, array_merge([$year, $year, $year, $year, $year, $sfgprov->company_code, $year], $projectCodes)));

        return $projectFiscalYears->map(function ($item) use ($results) {
            $item->setAttribute('trim_1', $item->activitiesProjectFiscalYear->sum(function ($act) {
                return $act->budgetItems->sum('trim_1');
            }));
            $item->setAttribute('trim_2', $item->activitiesProjectFiscalYear->sum(function ($act) {
                return $act->budgetItems->sum('trim_2');
            }));
            $item->setAttribute('trim_3', $item->activitiesProjectFiscalYear->sum(function ($act) {
                return $act->budgetItems->sum('trim_3');
            }));
            $item->setAttribute('trim_4', $item->activitiesProjectFiscalYear->sum(function ($act) {
                return $act->budgetItems->sum('trim_4');
            }));

            $project = $results->firstWhere('project_code', $item->project->getProgramSubProgramCode());
            if (!$project) {
                $item->setAttribute('accruedtrim_1', 0.00);
                $item->setAttribute('accruedtrim_2', 0.00);
                $item->setAttribute('accruedtrim_3', 0.00);
                $item->setAttribute('accruedtrim_4', 0.00);

                $item->setAttribute('budgetProgressTrim_1', 0.00);
                $item->setAttribute('budgetProgressTrim_2', 0.00);
                $item->setAttribute('budgetProgressTrim_3', 0.00);
                $item->setAttribute('budgetProgressTrim_4', 0.00);

                $item->setAttribute('indexTrim1', 0.00);
                $item->setAttribute('indexTrim1', 0.00);
                $item->setAttribute('indexTrim1', 0.00);
                return $item;
            }

            foreach ($project as $key => $value) {
                $item->setAttribute($key, $value);
            }

            $item->setAttribute('encoded', $item->assigned + $item->reform);
            $item->setAttribute('budgetExecutionProgress', self::getBudgetProgress($item->encoded, $item->accrued));

            $item->setAttribute('budgetProgressTrim_1', self::getBudgetProgress($item->trim_1, $item->accruedtrim_1));
            $item->setAttribute('budgetProgressTrim_2', self::getBudgetProgress($item->trim_2, $item->accruedtrim_2));
            $item->setAttribute('budgetProgressTrim_3', self::getBudgetProgress($item->trim_3, $item->accruedtrim_3));
            $item->setAttribute('budgetProgressTrim_4', self::getBudgetProgress($item->trim_4, $item->accruedtrim_4));

            $item->setAttribute('indexTrim1', $item->trim_1 != 0 ? ($item->accrued / $item->trim_1) : 0);
            $item->setAttribute('indexTrim1', ($item->trim_1 + $item->trim_2) != 0 ? ($item->accrued / ($item->trim_1 + $item->trim_2)) : 0);
            $item->setAttribute('indexTrim1', ($item->trim_1 + $item->trim_2 + $item->trim_3) != 0 ? ($item->accrued / ($item->trim_1 + $item->trim_2 + $item->trim_3)) : 0);

            return $item;
        });
    }

    /**
     * Calcular % avance presupuestario
     *
     * @param $planning
     * @param $accrued
     *
     * @return float
     */
    private function getBudgetProgress($planning, $accrued)
    {
        if ($planning) {
            return (float)number_format(($accrued * 100) / $planning, 2);
        } else {
            return 0.00;
        }
    }

    /**
     * Obtiene los movimientos financieros de una partida presupuestaria
     *
     * @param int $year
     * @param string $account
     *
     * @return \Illuminate\Support\Collection
     */
    public function budgetItemMovements(int $year, string $account)
    {
        $query = "select row_number() over (order by a.cuenta)                                                            as id,
                               a.cuenta                                                                                   as account,
                               b.sig_tip                                                                                  as voucher_type,
                               b.fec_apr                                                                                  as date,
                               b.sig_tip || ' - ' || b.acu_tip::numeric::integer                                          as voucher,
                               b.des_cab                                                                                  as description,
                               sum(case when a.sig_tip = 'PR' then a.val_cre else 0 end) as assigned,
                               sum(case
                                       when a.sig_tip = 'RE' then case
                                                                      when val_cre < 0 then a.val_deb + a.val_cre
                                                                      else a.val_deb - a.val_cre end
                                       else 0 end)                                                                        as reform,
                               sum((case when a.sig_tip IN ('CO') and b.comprom = 0 then a.val_cre else 0 end) +
                                   (case
                                        when a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE') and b.comprom = 0 then a.val_cre - a.val_deb
                                        else 0 end))                                                                      as committed,
                               sum(case when a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE') then val_cre - val_deb else 0 end) as accrued
                        from prcabmov b
                                 left join prdetmov a
                                           on a.codemp = b.codemp and a.anio = b.anio and a.sig_tip = b.sig_tip and a.acu_tip = b.acu_tip
                        where a.anio = :year
                          and a.codemp = :company_code
                          and b.estado = 3
                          and a.cuenta = :account
                        group by 2, 3, 4, 5, 6 order by 4;";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $movements = collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'account' => $account
        ]));

        $committed = 0;
        $accrued = 0;
        $encoded = 0;

        $movements->map(function ($mov) use (&$assigned, &$committed, &$accrued, &$encoded) {
            switch ($mov->voucher_type) {
                case 'PR':
                    $assigned = $mov->assigned;
                    $encoded = $mov->assigned;
                    $for_compromising = $mov->assigned;
                    $to_accrued = $mov->assigned;

                    $mov->encoded = $encoded;
                    $mov->for_compromising = $for_compromising;
                    $mov->to_accrued = $to_accrued;

                    break;
                case 'CO':
                    $committed += $mov->committed;
                    $for_compromising = $encoded - $committed;
                    $to_accrued = $encoded - $accrued;

                    $mov->for_compromising = $for_compromising;
                    $mov->to_accrued = $to_accrued;

                    break;
                case 'AS':
                    $accrued += $mov->accrued;
                    $for_compromising = $encoded - $committed;
                    $to_accrued = $encoded - $accrued;

                    $mov->for_compromising = $for_compromising;
                    $mov->to_accrued = $to_accrued;

                    break;
                case 'RE':
                    $encoded += $mov->reform;
                    $for_compromising = $encoded - $committed;
                    $to_accrued = $encoded - $accrued;

                    $mov->encoded = $encoded;
                    $mov->for_compromising = $for_compromising;
                    $mov->to_accrued = $to_accrued;

                    break;
            }
            return $mov;
        });

        return $movements;
    }

    /**
     * Obtiene información de una partida presupuestaria
     *
     * @param int $year
     * @param string $account
     *
     * @return array
     */
    public function getBudgetItemByAccount(int $year, string $account)
    {
        $query = "select *
                    from prplacta
                    where codemp = :company_code
                      and anio = :year
                      and cuenta = :account;";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'account' => $account
        ]));
    }

    /**
     * Retorna las Tareas/Hitos
     *
     * @param FiscalYear $currentFiscalYear
     * @param array $filter
     *
     * @return mixed
     */
    public function findByFiscalYearFilterByUser(FiscalYear $currentFiscalYear, array $filter)
    {
        $query = Task::join('activity_project_fiscal_years', 'tasks.activity_project_fiscal_year_id', '=', 'activity_project_fiscal_years.id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->join('departments', 'projects.responsible_unit_id', '=', 'departments.id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->whereNull('tasks.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $currentFiscalYear->year],
                ['plans.end_year', '>=', $currentFiscalYear->year],
                ['project_fiscal_years.fiscal_year_id', '=', $currentFiscalYear->id],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS]
            ])
            ->when($filter['status'] != Task::ALL, function ($query) use ($filter) {
                if ($filter['status'] == Task::STATUS_DELAYED) {
                    $query->where([
                        ['tasks.status', '=', Task::STATUS_PENDING],
                        ['tasks.date_end', '<', Carbon::now()]
                    ]);
                } elseif ($filter['status'] == Task::STATUS_PENDING) {
                    $query->where([
                        ['tasks.status', '=', Task::STATUS_PENDING],
                        ['tasks.date_end', '>=', Carbon::now()]
                    ]);
                } else {
                    $query->where('tasks.status', '=', $filter['status']);
                }
            })
            ->whereNotIn('tasks.status', [Task::STATUS_COMPLETED_ONTIME, Task::STATUS_COMPLETED_OUTOFTIME])
            ->select('tasks.*', 'projects.name as project_name', 'departments.name as responsibleUnit', 'activity_project_fiscal_years.name as activity')
            ->with([
                'responsible' => function ($query) {
                    $query->where('active', true);
                }
            ]);

        return $query;
    }

    /**
     * Retorna los Presupuestos participativos
     *
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     * @throws Exception
     */
    public function participatoryBudgetData(FiscalYear $fiscalYear)
    {
        $budgetItemsFromOperationalActivities = BudgetItem::join('operational_activities', 'operational_activities.id', '=', 'budget_items.operational_activity_id')
            ->join('current_expenditure_elements', 'operational_activities.current_expenditure_element_id', 'current_expenditure_elements.id')
            ->where('budget_items.fiscal_year_id', $fiscalYear->id)
            ->where('is_participatory_budget', true)
            ->select('budget_items.*')
            ->with([
                'budgetClassifier',
                'geographicLocation'
            ]);

        $budgetItems = BudgetItem::join('activity_project_fiscal_years', 'activity_project_fiscal_years.id', '=', 'budget_items.activity_project_fiscal_year_id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->where([
                ['budget_items.fiscal_year_id', '=', $fiscalYear->id],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS],
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED]
            ])
            ->where('budget_items.fiscal_year_id', $fiscalYear->id)
            ->where('is_participatory_budget', true)
            ->with([
                'budgetClassifier',
                'geographicLocation'
            ])
            ->select('budget_items.*')
            ->union($budgetItemsFromOperationalActivities)
            ->get();

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        if ($sfgprov->exist) {
            return self::remoteTotalsBudgetItem($budgetItems, $fiscalYear);
        } else {
            throw new Exception(trans('reports.exceptions.finance_system_not_found'), 1000);
        }
    }

    /**
     * Consulta el información agrupada de las partidas presupuestarias en la base de datos del sistema financiero
     *
     * @param Collection $budgetItems
     * @param FiscalYear $fiscalYear
     *
     * @return Collection
     */
    public function remoteTotalsBudgetItem(Collection $budgetItems, FiscalYear $fiscalYear)
    {
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $params = [$sfgprov->company_code, $fiscalYear->year];
        $codes = $budgetItems->pluck('code');
        $bindingsString = trim(str_repeat('?,', count($codes)), ',');
        if ($bindingsString === "") {
            $bindingsString = "''";
        }
        $filter = "and trim(a.cuenta) in ( {$bindingsString} )";
        $params = array_merge($params, $codes->toArray());

        $query = "select trim(a.cuenta) as cuenta,
                            sum(case when a.sig_tip = 'PR' then val_cre else 0 end)    as assigned,
                            sum(case when a.sig_tip = 'RE' then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end else 0 end) as total_reform,
                            sum(case when a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE') then val_cre - val_deb else 0 end)                                      as total_accrued
                  from prdetmov a
                  left join prcabmov b on a.codemp = b.codemp and a.anio = b.anio and a.sig_tip = b.sig_tip and a.acu_tip = b.acu_tip
                  where a.codemp = ?
                    and a.anio = ?
                    and a.asociac = 1
                    and b.estado = 3
                    {$filter}
                  group by 1
                  order by cuenta;";

        $financeBudgetItems = collect(DB::connection('pgsql')->select($query, $params));
        return $budgetItems->map(function ($item) use ($financeBudgetItems) {
            $bi = $financeBudgetItems->firstWhere('cuenta', $item->code);
            if (!$bi) {
                $item->setAttribute('assigned', 0);
                $item->setAttribute('total_reform', 0);
                $item->setAttribute('total_accrued', 0);
                $item->setAttribute('encoded', 0);
                return $item;
            }
            foreach ($bi as $key => $value) {
                $item->setAttribute($key, $value);
            }
            $item->setAttribute('encoded', $item->assigned + $item->total_reform);

            return $item;
        });
    }

    /**
     * Obtiene los niveles de la estructura de Ingreso o Gasto
     *
     * @param int $year
     * @param int $type
     *
     * @return array
     */
    public function structureLevelsByLevels(int $year, int $type = 1) // 1 => Tipo Gasto
    {
        $query = "SELECT niv_est, trim(des_est) as des_est  FROM prestcta WHERE niv_est in (7,8,9,10) and identifi = :type and anio = :year order by niv_est;";
        return DB::connection('pgsql')->select($query, [
            'year' => $year,
            'type' => $type,
        ]);
    }

    /**
     * Obtiene información presupuestaria de las partidas
     *
     * @param int $year
     * @param string $date
     *
     * @return Collection
     */
    public function budgetCardExpenses(int $year, string $date)
    {
        $query = "select f.nom_cue,
                       case
                           when SUBSTRING(trim(f.cuenta), 22, 1) = '5' then '5.00.00.00'
                           when SUBSTRING(trim(f.cuenta), 22, 1) = '7' then '7.00.00.00'
                           when SUBSTRING(trim(f.cuenta), 22, 1) = '8' then '8.00.00.00'
                           when SUBSTRING(trim(f.cuenta), 22, 1) = '9' then '9.00.00.00'
                           end                                            as partida_agrupacion,
                       rpad(SUBSTRING(trim(f.cuenta), 22, 4) || '.00.00',10,'.00') as partida,
                       sum(f.asig_ini)                                    as asig_ini,
                       sum(f.reformas)                                    as reformas,
                       sum(f.codificado)                                  as codificado,
                       sum(f.certificado)                                 as certificado,
                       sum(f.comprometido)                                as comprometido,
                       sum(f.devengado)                                   as devengado,
                       sum(f.por_comprometer)                             as por_comprometer,
                       sum(f.por_devengar)                                as por_devengar,
                       sum(f.pagado)                                      as pagado,
                       sum(f.niv_cue)                                     as niv_cue,
                       sum(f.devengado) * 100 / case when sum(f.codificado) = 0 then 1 else sum(f.codificado) end              as porciento_ejecucion
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
                            ) where f.niv_cue in (7,8) group by 1, 2, 3
                            order by 2,3  desc";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'date' => $date
        ]));
    }

    /**
     * Obtener infomación del reporte pac
     *
     * @param int $fiscalYearId
     *
     * @return BudgetItem[]|Builder[]|Collection
     */
    public function pacReport(int $fiscalYearId)
    {
        $operationalActivities = PublicPurchase::join('budget_items', 'budget_items.id', 'public_purchases.budget_item_id')
            ->join('operational_activities', 'budget_items.operational_activity_id', 'operational_activities.id')
            ->join('current_expenditure_elements', 'operational_activities.current_expenditure_element_id', 'current_expenditure_elements.id')
            ->where('budget_items.fiscal_year_id', $fiscalYearId)
            ->select('public_purchases.*')
            ->with([
                'cpcClassifier',
                'procedure',
                'budgetItem.budgetClassifier',
                'budgetItem.geographicLocation',
                'budgetItem.source',
                'budgetItem.institution',
                'budgetItem.operationalActivity.subprogram.parent.area',
                'budgetItem.operationalActivity.responsibleUnit',
                'budgetItem.operationalActivity.executingUnit'
            ]);

        return PublicPurchase::join('budget_items', 'budget_items.id', 'public_purchases.budget_item_id')
            ->join('activity_project_fiscal_years', 'budget_items.activity_project_fiscal_year_id', 'activity_project_fiscal_years.id')
            ->join('project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', 'project_fiscal_years.id')
            ->join('projects', 'project_fiscal_years.project_id', 'projects.id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['budget_items.fiscal_year_id', '=', $fiscalYearId],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS]
            ])
            ->select('public_purchases.*')
            ->with([
                'cpcClassifier',
                'procedure',
                'budgetItem.budgetClassifier',
                'budgetItem.geographicLocation',
                'budgetItem.source',
                'budgetItem.institution',
                'budgetItem.activityProjectFiscalYear.area',
                'budgetItem.activityProjectFiscalYear.projectFiscalYear',
                'budgetItem.activityProjectFiscalYear.component.project.responsibleUnit',
                'budgetItem.activityProjectFiscalYear.component.project.executingUnit',
                'budgetItem.activityProjectFiscalYear.component.project.subprogram.parent',
            ])
            ->union($operationalActivities)
            ->get();
    }

    /**
     * Obtiene los proyectos en ejecución
     *
     * @param int $fiscal_year_id
     *
     * @param string $date
     *
     * @return mixed
     */
    public function getExecutionProjects(int $fiscal_year_id, string $date)
    {
        return ProjectFiscalYear::join('projects as p', 'p.id', '=', 'project_fiscal_years.project_id')
            ->join('departments', 'departments.id', '=', 'p.executing_unit_id')
            ->whereNull('p.deleted_at')
            ->where([
                'project_fiscal_years.fiscal_year_id' => $fiscal_year_id,
                'project_fiscal_years.status' => ProjectFiscalYear::STATUS_IN_PROGRESS,
            ])
            ->select(
                'departments.name as executingUnit',
                'departments.code as executingUnitCode',
                'p.name as project_name',
                'project_fiscal_years.id as id',
                'project_fiscal_years.project_id as project_id'
            )
            ->with([
                'project.subprogram.parent',
                'activitiesProjectFiscalYear.tasks' => function ($q) use ($date) {
                    return $q->where(function ($q) use ($date) {
                        $q->where('tasks.date_end', '<=', DateTime::createFromFormat('!d-m-Y', $date))
                            ->orWhere('tasks.due_date', '<=', DateTime::createFromFormat('!d-m-Y', $date));
                    });
                }
            ])
            ->orderBy('departments.name')
            ->get();
    }

    /**
     * Obtiene los proyectos en ejecución
     *
     * @param int $fiscal_year_id
     *
     * @return mixed
     */
    public function getExecutionProjectsAdvanceInvestmentProjects(int $fiscal_year_id)
    {
        return ProjectFiscalYear::join('projects as p', 'p.id', '=', 'project_fiscal_years.project_id')
            ->join('departments', 'departments.id', '=', 'p.executing_unit_id')
            ->whereNull('p.deleted_at')
            ->where([
                'project_fiscal_years.fiscal_year_id' => $fiscal_year_id,
                'project_fiscal_years.status' => ProjectFiscalYear::STATUS_IN_PROGRESS,
            ])
            ->select(
                'departments.name as executingUnit',
                'p.name as project_name',
                'project_fiscal_years.id as id',
                'project_fiscal_years.project_id as project_id'
            )
            ->with(['project.subprogram.parent', 'activitiesProjectFiscalYear'])
            ->orderBy('departments.name')
            ->get();
    }

    /**
     * Obtiene presupuesto por categoría
     *
     * @param int $year
     * @param string $date
     * @param int $from
     * @param int $length
     * @param int $level
     *
     * @return array
     */
    public function progressExecutionProgress(int $year, string $date, int $from, int $length, int $level)
    {

        $query = "select substring(trim(f.cuenta), {$from}, {$length}) as codigo,
                       sum(f.asig_ini)   as asignado,
                       sum(f.codificado)   as codificado,
                       sum(f.devengado) as devengado,
                       sum(f.por_devengar) as por_devengar,
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
                            ) where f.niv_cue = :level group by 1";

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'date' => $date,
            'level' => $level
        ]));
    }

    /**
     * Retorna las Tareas/Hitos
     *
     * @param array $filters
     *
     * @return mixed
     */
    public function findTasksByFilters(array $filters)
    {
        return Task::join('activity_project_fiscal_years', 'tasks.activity_project_fiscal_year_id', '=', 'activity_project_fiscal_years.id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->join('departments', 'projects.responsible_unit_id', '=', 'departments.id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['project_fiscal_years.fiscal_year_id', '=', $filters['fiscal_year_id']],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS]
            ])
            ->when(isset($filters['fiscal_year_id']), function ($query) use ($filters) {
                $query->where('project_fiscal_years.fiscal_year_id', $filters['fiscal_year_id']);
            })
            ->when(isset($filters['responsible_unit_id']), function ($query) use ($filters) {
                $query->where('projects.responsible_unit_id', $filters['responsible_unit_id']);
            })
            ->when(isset($filters['project_fiscal_year_id']), function ($query) use ($filters) {
                $query->where('project_fiscal_years.id', $filters['project_fiscal_year_id']);
            })
            ->when(isset($filters['date_init']), function ($query) use ($filters) {
                $query->where('tasks.date_init', '>=', DateTime::createFromFormat('!d-m-Y', $filters['date_init']));
            })
            ->when(isset($filters['date_end']), function ($query) use ($filters) {
                $query->orWhere(function ($q) use ($filters) {
                    $q->where('tasks.date_end', '<=', DateTime::createFromFormat('!d-m-Y', $filters['date_end']))
                        ->orWhere('tasks.due_date', '<=', DateTime::createFromFormat('!d-m-Y', $filters['date_end']));
                });
            })
            ->when(isset($filters['assigned_user_id']), function ($query) use ($filters) {
                $query->join('users_manages_tasks', 'users_manages_tasks.task_id', '=', 'tasks.id');
                $query->where(function ($query) use ($filters) {
                    $query->orWhere('users_manages_tasks.user_id', $filters['assigned_user_id']);
                });
            })
            ->select('tasks.*', 'projects.name as project_name')
            ->with([
                'responsible' => function ($query) {
                    $query->where('active', true);
                },
                'files'
            ]);
    }

    /**
     * Obtener infomación del reporte de reformas y certificaciones
     *
     * @param $projectFiscalYear
     * @param $fiscalYear
     *
     * @return BudgetItem[]|Builder[]|Collection
     * @throws Exception
     */
    public function reformAndCertificationReport($projectFiscalYear, $fiscalYear)
    {

        $budgetItems = BudgetItem::selectRaw('budget_items.*,
                           (select bp.assigned from budget_plannings bp where bp.month = 1 and bp.budget_item_id = budget_items.id) as jan,
                           (select bp.assigned from budget_plannings bp where bp.month = 2 and bp.budget_item_id = budget_items.id) as feb,
                           (select bp.assigned from budget_plannings bp where bp.month = 3 and bp.budget_item_id = budget_items.id) as mar,
                           (select bp.assigned from budget_plannings bp where bp.month = 4 and bp.budget_item_id = budget_items.id) as apr,
                           (select bp.assigned from budget_plannings bp where bp.month = 5 and bp.budget_item_id = budget_items.id) as may,
                           (select bp.assigned from budget_plannings bp where bp.month = 6 and bp.budget_item_id = budget_items.id) as jun,
                           (select bp.assigned from budget_plannings bp where bp.month = 7 and bp.budget_item_id = budget_items.id) as jul,
                           (select bp.assigned from budget_plannings bp where bp.month = 8 and bp.budget_item_id = budget_items.id) as aug,
                           (select bp.assigned from budget_plannings bp where bp.month = 9 and bp.budget_item_id = budget_items.id) as sep,
                           (select bp.assigned from budget_plannings bp where bp.month = 10 and bp.budget_item_id = budget_items.id) as oct,
                           (select bp.assigned from budget_plannings bp where bp.month = 11 and bp.budget_item_id = budget_items.id) as nov,
                           (select bp.assigned from budget_plannings bp where bp.month = 12 and bp.budget_item_id = budget_items.id) as december')
            ->join('activity_project_fiscal_years', 'activity_project_fiscal_years.id', '=', 'budget_items.activity_project_fiscal_year_id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->where([
                ['project_fiscal_years.id', '=', $projectFiscalYear->id],
                ['budget_items.fiscal_year_id', '=', $fiscalYear->id],
                ['project_fiscal_years.status', '=', ProjectFiscalYear::STATUS_IN_PROGRESS],
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED]
            ])
            ->with([
                'geographicLocation',
                'activityProjectFiscalYear.component.project',
            ])->get();

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        if ($sfgprov->exist) {
            return self::remoteTotalsBudgetItem($budgetItems, $fiscalYear);
        } else {
            throw new Exception(trans('reports.exceptions.finance_system_not_found'), 1000);
        }
    }
}
