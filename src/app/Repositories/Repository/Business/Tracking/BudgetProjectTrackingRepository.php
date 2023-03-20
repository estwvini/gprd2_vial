<?php

namespace App\Repositories\Repository\Business\Tracking;

use App\Models\Business\BudgetItem;
use App\Models\Business\Planning\FiscalYear;
use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class BudgetProjectTrackingRepository
 * @package App\Repositories\Repository\Business\Tracking
 */
class BudgetProjectTrackingRepository
{

    public const SELECT_ACCRUED_MONTHLY = "trim(a.cuenta) as cuenta,
                                   sum(case when a.sig_tip = 'PR' then val_cre else 0 end)    as assigned,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as reform,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year)
                                               then val_cre - val_deb
                                           else 0 end) as total_amount_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 1)
                                               then val_cre - val_deb
                                           else 0 end) as jan_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 2)
                                               then val_cre - val_deb
                                           else 0 end) as feb_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 3)
                                               then val_cre - val_deb
                                           else 0 end) as mar_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 4)
                                               then val_cre - val_deb
                                           else 0 end) as apr_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 5)
                                               then val_cre - val_deb
                                           else 0 end) as may_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 6)
                                               then val_cre - val_deb
                                           else 0 end) as jun_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 7)
                                               then val_cre - val_deb
                                           else 0 end) as jul_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 8)
                                               then val_cre - val_deb
                                           else 0 end) as aug_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 9)
                                               then val_cre - val_deb
                                           else 0 end) as sep_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 10)
                                               then val_cre - val_deb
                                           else 0 end) as oct_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 11)
                                               then val_cre - val_deb
                                           else 0 end) as nov_accrued,
                                   sum(case
                                           when (a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE')
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 12)
                                               then val_cre - val_deb
                                           else 0 end) as dec_accrued";

    public const SELECT_REFORMS_MONTHLY = "trim(a.cuenta) as cuenta,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as total_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 1)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as jan_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 2)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as feb_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 3)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as mar_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 4)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as apr_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 5)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as may_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 6)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as jun_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 7)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as jul_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 8)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as aug_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 9)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as sep_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 10)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) oct_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 11)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as nov_reform,
                                   sum(case
                                           when (a.sig_tip = 'RE'
                                               and date_part('year', date(b.fec_apr)) = :year
                                               and date_part('month', date(b.fec_apr)) = 12)
                                               then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end
                                           else 0 end) as dec_reform";

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * Constructor de BudgetProjectTrackingRepository.
     *
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * Obtener infomación del avance presupuestario
     *
     * @param FiscalYear $fiscalYear
     *
     * @return BudgetItem[]|Builder[]|Collection
     */
    public function budgetProgress(FiscalYear $fiscalYear)
    {
        $budgetItems = BudgetItem::where('fiscal_year_id', $fiscalYear->id)
            ->with([
                'budgetClassifier',
                'activityProjectFiscalYear.area',
                'activityProjectFiscalYear.projectFiscalYear',
                'activityProjectFiscalYear.component.project.responsibleUnit',
                'activityProjectFiscalYear.component.project.subprogram.parent',
                'operationalActivity.subprogram.parent.area',
                'operationalActivity.responsibleUnit'
            ])->get();

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        if ($sfgprov->exist) {
            return self::remoteBudgetItem($budgetItems, $fiscalYear, self::SELECT_ACCRUED_MONTHLY);
        } else {
            return []; // TODO Completar consulta en la base de datos local
        }
    }

    /**
     * Buscar información de partidas presupuestarias por proyecto y año fiscal
     *
     * @param array $projectsFiscalYearIds
     * @param FiscalYear $fiscalYear
     *
     * @return Collection
     */
    public function findByProjectFiscalYearMonthly(array $projectsFiscalYearIds, FiscalYear $fiscalYear)
    {
        $budgetItems = BudgetItem::join('activity_project_fiscal_years', 'budget_items.activity_project_fiscal_year_id', 'activity_project_fiscal_years.id')
            ->join('project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', 'project_fiscal_years.id')
            ->selectRaw('budget_items.*')
            ->whereIn('project_fiscal_years.id', $projectsFiscalYearIds)
            ->with(['budgetClassifier', 'activityProjectFiscalYear', 'budgetLocations'])
            ->get();

        if (api_available()) {
            return self::remoteBudgetItem($budgetItems, $fiscalYear, self::SELECT_ACCRUED_MONTHLY);
        }

        return collect([]);
    }

    /**
     * Buscar información de partidas presupuestarias por proyecto y año fiscal
     *
     * @param array $projectsFiscalYearIds
     * @param FiscalYear $fiscalYear
     *
     * @return Collection
     */
    public function findByProjectFiscalYearTotals(array $projectsFiscalYearIds, FiscalYear $fiscalYear)
    {
        $budgetItems = BudgetItem::join('activity_project_fiscal_years', 'budget_items.activity_project_fiscal_year_id', 'activity_project_fiscal_years.id')
            ->join('project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', 'project_fiscal_years.id')
            ->selectRaw('budget_items.*,
                           (select bp.assigned from budget_plannings bp where bp.month = 1 and bp.budget_item_id = budget_items.id) as jan_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 2 and bp.budget_item_id = budget_items.id) as feb_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 3 and bp.budget_item_id = budget_items.id) as mar_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 4 and bp.budget_item_id = budget_items.id) as apr_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 5 and bp.budget_item_id = budget_items.id) as may_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 6 and bp.budget_item_id = budget_items.id) as jun_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 7 and bp.budget_item_id = budget_items.id) as jul_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 8 and bp.budget_item_id = budget_items.id) as aug_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 9 and bp.budget_item_id = budget_items.id) as sep_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 10 and bp.budget_item_id = budget_items.id) as oct_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 11 and bp.budget_item_id = budget_items.id) as nov_assigned,
                           (select bp.assigned from budget_plannings bp where bp.month = 12 and bp.budget_item_id = budget_items.id) as dec_assigned')
            ->whereIn('project_fiscal_years.id', $projectsFiscalYearIds)
            ->with([
                'budgetClassifier',
                'activityProjectFiscalYear.component.project.responsibleUnit',
                'activityProjectFiscalYear.component.project.executingUnit',
                'activityProjectFiscalYear.area',
            ])
            ->get();

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        if ($sfgprov->exist) {
            return self::remoteTotalsBudgetItem($budgetItems, $fiscalYear);
        } else {
            return collect([]); // TODO Completar consulta en la base de datos local
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
        if ($bindingsString === '') {
            $bindingsString = "''";
        }
        $filter = "and trim(a.cuenta) in ( {$bindingsString} )";
        $params = array_merge($params, $codes->toArray());

        $query = "select trim(a.cuenta) as cuenta,
                            sum(case when a.sig_tip = 'PR' then val_cre else 0 end)    as assigned,
                            sum(case when a.sig_tip = 'RE' then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end else 0 end) as total_reform,
                            sum((case when a.sig_tip IN ('CE') then a.val_cert else 0 end))                                                                 as total_certificate,
                            sum((case when a.sig_tip IN ('CO') and b.comprom = 0 then a.val_cre else 0 end) +
                                                                        (case
                                                                              when a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE') and b.comprom = 0 then a.val_cre - a
                                                                                  .val_deb
                                                                              else 0 end))                                                                  as total_committed,
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
                return $item;
            }
            foreach ($bi as $key => $value) {
                $item->setAttribute($key, $value);
            }

            $item->setAttribute('affected', false);

            if ($item->last_total_reform != $item->total_reform) {
                $item->setAttribute('affected', true);
            }

            return $item;
        });
    }

    /**
     * Consulta el información de las partidas presupuestarias en la base de datos del sistema financiero
     *
     * @param Collection $budgetItems
     * @param FiscalYear $fiscalYear
     * @param string $select
     *
     * @return Collection
     */
    public function remoteBudgetItem(Collection $budgetItems, FiscalYear $fiscalYear, string $select)
    {
        $query = 'select ' . $select . '
                  from prdetmov a
                  left join prcabmov b on a.codemp = b.codemp and a.anio = b.anio and a.sig_tip = b.sig_tip and a.acu_tip = b.acu_tip
                  where a.codemp = :company_code
                    and a.anio = :year
                    and a.asociac = 1
                    and b.estado = 3
                  group by 1
                  order by cuenta;';

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $financeBudgetItems = collect(DB::connection('pgsql')->select($query, ['company_code' => $sfgprov->company_code, 'year' => $fiscalYear->year]));

        $budgetItems = $budgetItems->map(function ($item) use ($financeBudgetItems) {
            $bi = $financeBudgetItems->firstWhere('cuenta', $item->code);
            if (!$bi) {
                return $item;
            }
            foreach ($bi as $key => $value) {
                $item->setAttribute($key, $value);
            }
            return $item;
        });

        return $budgetItems;
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
        if ($bindingsString === '') {
            $bindingsString = "''";
        }

        $query = "select substring(a.cuenta, 4, 9) as project_code,
                   sum(case when a.sig_tip = 'PR' then val_cre else 0 end) as assigned,
                   sum(case when a.sig_tip NOT IN ('PR', 'RE', 'CO', 'CE') then val_cre - val_deb else 0 end) as accrued,
                   sum(case when a.sig_tip = 'RE' then case when val_cre < 0 then a.val_deb + a.val_cre else a.val_deb - a.val_cre end else 0 end) as reforms
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
        $results = collect([]);
        if (api_available()) {
            $results = collect(DB::connection('pgsql')->select($query, array_merge([$sfgprov->company_code, $year], $projectCodes)));
        }

        return $projectFiscalYears->map(function ($item) use ($results) {
            $project = $results->firstWhere('project_code', $item->project->getProgramSubProgramCode());
            if (!$project) {
                $item->setAttribute('assigned', 0.00);
                $item->setAttribute('accrued', 0.00);
                $item->setAttribute('reforms', 0.00);
                $item->setAttribute('budgetProgress', 0.00);
                return $item;
            }
            foreach ($project as $key => $value) {
                $item->setAttribute($key, $value);
            }
            if ($item->assigned + $item->reforms) {
                $item->setAttribute('budgetProgress', (float)number_format(($item->accrued * 100) / ($item->assigned + $item->reforms), 2));
            } else {
                $item->setAttribute('budgetProgress', 0.00);
            }
            return $item;
        });
    }
}
