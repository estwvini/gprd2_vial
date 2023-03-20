<?php

namespace App\Repositories\Repository\Business;

use App\Models\BaseModel;
use App\Models\Business\BudgetItem;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\OperationalActivity;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Processes\Business\Execution\BudgetItemProcess;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\SFGPROV\ProformaRepository;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase BudgetItemRepository
 * @package App\Repositories\Repository\Business
 */
class BudgetItemRepository extends Repository
{

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var ProformaRepository
     */
    protected $proformaRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * Constructor de BudgetItemRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ProformaRepository $proformaRepository
     * @param SettingRepository $settingRepository
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection,
        FiscalYearRepository $fiscalYearRepository,
        ProformaRepository $proformaRepository,
        SettingRepository $settingRepository
    ) {
        parent::__construct($app, $collection);
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->proformaRepository = $proformaRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Nombre del modelo de la clase
     *
     * @return mixed|string
     */
    public function model()
    {
        return BudgetItem::class;
    }

    /**
     * Actualizar en la BD la información de una partida presupuestaria
     *
     * @param array $data
     * @param BudgetItem $entity
     * @param ProjectFiscalYear|null $projectFiscalYear
     *
     * @return BudgetItem|null
     */
    public function updateFromArray(array $data, BudgetItem $entity, ProjectFiscalYear $projectFiscalYear = null)
    {
        DB::transaction(function () use (&$data, &$entity, $projectFiscalYear) {
            $currentCode = $entity->code;

            if (isset($data['guide_spending_id'])) {
                $data['guide_spending_id'] = $data['guide_spending_id'] == 0 ? null : $data['guide_spending_id'];
            }
            if (isset($data['financing_source_id'])) {
                $data['financing_source_id'] = $data['financing_source_id'] == 0 ? null : $data['financing_source_id'];
            }
            $entity->fill($data);
            $entity->save();

            // If it is modifying expenses structure
            if ($entity && isset($data['module']) && $data['module'] == BudgetItem::MODULE['PROGRAMMATIC_STRUCTURE'] && $currentCode != $data['code'] && api_available()) {

                if ($entity->operational_activity_id || ($projectFiscalYear && $projectFiscalYear->status === ProjectFiscalYear::STATUS_IN_PROGRESS)) {
                    $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
                    $budgetItemProcess = resolve(BudgetItemProcess::class);
                    $budgetItemsStructure = $budgetItemProcess->buildNewBudgetItemsStructure(collect([$entity]), $fiscalYear);

                    if ($budgetItemsStructure->count()) {
                        // Sync new expense structure with financial system database
                        $this->proformaRepository->syncStructure($budgetItemsStructure, $currentCode, $fiscalYear->year);
                    }
                }
            }
        }, 5);
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva partida presupuestaria
     *
     * @param array $data
     * @param Model $activity
     * @param ProjectFiscalYear $projectFiscalYear |null
     *
     * @return BudgetItem|null
     */
    public function createFromArray(array $data, Model $activity, ProjectFiscalYear $projectFiscalYear = null)
    {
        $entity = new BudgetItem();
        DB::transaction(function () use ($data, &$entity, $activity, $projectFiscalYear) {
            if ($activity instanceof OperationalActivity) {
                $data['operational_activity_id'] = $activity->id;
                $data['fiscal_year_id'] = $activity->subprogram->fiscal_year_id;
            } else {
                $data['activity_project_fiscal_year_id'] = $activity->id;
                $data['fiscal_year_id'] = $projectFiscalYear->fiscal_year_id;
            }
            $data['guide_spending_id'] = $data['guide_spending_id'] == 0 ? null : $data['guide_spending_id'];
            $data['financing_source_id'] = $data['financing_source_id'] == 0 ? null : $data['financing_source_id'];
            $entity->fill($data);
            $entity->save();

            // If it is modifying expenses structure
            if ($entity && isset($data['module']) && $data['module'] == BudgetItem::MODULE['PROGRAMMATIC_STRUCTURE'] && api_available()) {

                if ($activity instanceof OperationalActivity || ($projectFiscalYear && $projectFiscalYear->status === ProjectFiscalYear::STATUS_IN_PROGRESS)) {

                    $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
                    $budgetItemProcess = resolve(BudgetItemProcess::class);
                    $budgetItemsStructure = $budgetItemProcess->buildNewBudgetItemsStructure(collect([$entity]), $fiscalYear);

                    if ($budgetItemsStructure->count()) {
                        // Sync new expense structure with financial system database
                        $this->proformaRepository->syncStructure($budgetItemsStructure);
                    }
                }
            }

        }, 5);

        return $entity->fresh();
    }

    /**
     * Elimina una partida y su planificación presupuestaria
     *
     * @param Model $entity
     *
     * @return mixed
     */
    public function delete(Model $entity)
    {
        $entity->budgetPlannings()->delete();

        return self::destroy($entity->id);
    }

    /**
     * Obtener de la BD una colección de todos los ítems presupuestarios para un año fiscal.
     *
     * @param FiscalYear $fiscalYear
     * @param string $status
     *
     * @return mixed
     */
    public function findByFiscalYear(FiscalYear $fiscalYear, string $status, array $filter = [])
    {
        $budgetItemsFromOperationalActivities = $this->model
            ->where('fiscal_year_id', $fiscalYear->id)
            ->whereNotNull('operational_activity_id')
            ->when(isset($filter['executing_unit']), function ($query) use ($filter) {
                $query->whereHas('operationalActivity', function ($query) use ($filter) {
                    $query->where('operational_activities.executing_unit_id', $filter['executing_unit']);
                });
            })
            ->when(count($filter), function ($query) use ($filter) {
                $query->when(isset($filter['status']), function ($query) use ($filter) {
                    $query->where('status', BudgetItem::STATUS_REVIEWED);
                }, function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', '!=', BudgetItem::STATUS_REVIEWED)
                            ->orWhereNull('status');
                    });
                });
            })
            ->with('budgetClassifier', 'operationalActivity.subprogram.parent.area',
                'operationalActivity.responsibleUnit', 'operationalActivity.executingUnit', 'geographicLocation', 'source', 'spendingGuide');

        return $this->model
            ->where('budget_items.fiscal_year_id', $fiscalYear->id)
            ->join('activity_project_fiscal_years', 'budget_items.activity_project_fiscal_year_id', 'activity_project_fiscal_years.id')
            ->join('project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', 'project_fiscal_years.id')
            ->join('projects', 'project_fiscal_years.project_id', 'projects.id')
            ->join('prioritizations', 'prioritizations.project_fiscal_year_id', 'project_fiscal_years.id')
            ->join('budget_adjustment', 'budget_adjustment.prioritization_id', 'prioritizations.id')
            ->where('budget_adjustment.status', $status)
            ->whereNull('projects.deleted_at')
            ->when(isset($filter['executing_unit']), function ($query) use ($filter) {
                $query->where('projects.executing_unit_id', $filter['executing_unit']);
            })
            ->when(count($filter), function ($query) use ($filter) {
                $query->when(isset($filter['status']), function ($query) use ($filter) {
                    $query->where('budget_items.status', BudgetItem::STATUS_REVIEWED);
                }, function ($query) {
                    $query->where(function ($query) {
                        $query->where('budget_items.status', '!=', BudgetItem::STATUS_REVIEWED)
                            ->orWhereNull('budget_items.status');
                    });
                });
            })
            ->select('budget_items.*')
            ->with('activityProjectFiscalYear.area', 'activityProjectFiscalYear.component.project.executingUnit',
                'activityProjectFiscalYear.component.project.responsibleUnit', 'budgetClassifier', 'geographicLocation', 'source', 'spendingGuide')
            ->union($budgetItemsFromOperationalActivities)
            ->get();
    }

    /**
     *
     * @param int $fiscalYearId
     * @param array $filter
     *
     * @return mixed
     */
    public function getAllByYear(int $fiscalYearId, array $filter = [])
    {
        $budgetItemsFromOperationalActivities = $this->model
            ->where('fiscal_year_id', $fiscalYearId)
            ->whereNotNull('operational_activity_id')
            ->when(isset($filter['executing_unit']), function ($query) use ($filter) {
                $query->whereHas('operationalActivity', function ($query) use ($filter) {
                    $query->where('operational_activities.executing_unit_id', $filter['executing_unit']);
                });
            })
            ->when(count($filter), function ($query) use ($filter) {
                $query->when(isset($filter['status']), function ($query) use ($filter) {
                    $query->where('status', BudgetItem::STATUS_REVIEWED);
                }, function ($query) {
                    $query->where(function ($query) {
                        $query->where('status', '!=', BudgetItem::STATUS_REVIEWED)
                            ->orWhereNull('status');
                    });
                });
            })
            ->with('operationalActivity');

        return $this->model
            ->where('budget_items.fiscal_year_id', $fiscalYearId)
            ->join('activity_project_fiscal_years', 'budget_items.activity_project_fiscal_year_id', 'activity_project_fiscal_years.id')
            ->join('project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', 'project_fiscal_years.id')
            ->join('projects', 'project_fiscal_years.project_id', 'projects.id')
            ->whereNull('projects.deleted_at')
            ->when(isset($filter['executing_unit']), function ($query) use ($filter) {
                $query->where('projects.executing_unit_id', $filter['executing_unit']);
            })
            ->when(count($filter), function ($query) use ($filter) {
                $query->when(isset($filter['status']), function ($query) use ($filter) {
                    $query->where('budget_items.status', BudgetItem::STATUS_REVIEWED);
                }, function ($query) {
                    $query->where(function ($query) {
                        $query->where('budget_items.status', '!=', BudgetItem::STATUS_REVIEWED)
                            ->orWhereNull('budget_items.status');
                    });
                });
            })
            ->select('budget_items.*')
            ->with('activityProjectFiscalYear')
            ->union($budgetItemsFromOperationalActivities);
    }

    /**
     *
     * Retorna los valores presupuestarios agrupado por tipo de gasto
     *
     * @param int $fiscalYearId
     * @param array $filter
     * @param int $level
     *
     * @return Collection
     */
    public function getByExpenseType(int $fiscalYearId, array $filter = [], int $level = 1): Collection
    {
        $reviewed = BudgetItem::STATUS_REVIEWED;
        $executingUnit = '';
        $executingUnitForProjects = '';

        $params = [
            'fiscalYear' => $fiscalYearId,
            'fiscalYear1' => $fiscalYearId,
            'fiscalYear2' => $fiscalYearId,
            'level' => $level
        ];

        if (count($filter)) {
            if (isset($filter['status'])) {
                $status = " and budget_items.status = '{$reviewed}'";
            } else {
                $status = " and (budget_items.status != '{$reviewed}' or budget_items.status is null)";
            }
        }

        if (isset($filter['executing_unit'])) {
            $executingUnit = ' and exists(select *
                                            from operational_activities
                                            where budget_items.operational_activity_id = operational_activities.id
                                              and operational_activities.executing_unit_id = :executingUnit
                                              and operational_activities.deleted_at is null)';

            $executingUnitForProjects = ' and projects.executing_unit_id = :executingUnit2';
            $params['executingUnit'] = $filter['executing_unit'];
            $params['executingUnit2'] = $filter['executing_unit'];
        }

        $query = "WITH RECURSIVE cte(id, parent_id, code, level, title, total) AS
                   (
                       SELECT bcs.id, bcs.parent_id, bcs.full_code, bcs.level, bcs.title, bi.amount
                       from budget_classifier_spendings bcs
                                inner join budget_items bi on bcs.id = bi.budget_classifier_id
                       where fiscal_year_id = :fiscalYear
                         and bi.id in (
                           select `budget_items`.id
                           from `budget_items`
                                    inner join `activity_project_fiscal_years` on `budget_items`.`activity_project_fiscal_year_id` = `activity_project_fiscal_years`.`id`
                                    inner join `project_fiscal_years` on `activity_project_fiscal_years`.`project_fiscal_year_id` = `project_fiscal_years`.`id`
                                    inner join `projects` on `project_fiscal_years`.`project_id` = `projects`.`id`
                           where `budget_items`.`fiscal_year_id` = :fiscalYear1
                             and `projects`.`deleted_at` is null
                             {$executingUnitForProjects}
                             {$status}
                           union
                           select id
                           from `budget_items`
                           where `fiscal_year_id` = :fiscalYear2
                             and `operational_activity_id` is not null
                             {$executingUnit}
                             {$status}
                       )
                       UNION ALL
                       SELECT b.id, b.parent_id, b.full_code, b.level, b.title, cte.total
                       from budget_classifier_spendings b
                                inner join cte on b.id = cte.parent_id
                   )
                    select cte.code, cte.title, sum(total) as total
                    from cte
                    where level = :level
                    group by 1, 2";

        return collect(DB::select($query, $params));
    }

    /**
     * Obtener de la BD una colección de todos los gastos corrientes para el próximo año fiscal menos el id de entrada.
     *
     * @param int $budgetItemId
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function findByFiscalYearCurrentExpensesEdit(int $budgetItemId, FiscalYear $fiscalYear)
    {
        return $this->model
            ->join('operational_activities', 'budget_items.operational_activity_id', 'operational_activities.id')
            ->join('current_expenditure_elements', 'operational_activities.current_expenditure_element_id', 'current_expenditure_elements.id')
            ->join('fiscal_years', 'current_expenditure_elements.fiscal_year_id', 'fiscal_years.id')
            ->where('fiscal_years.year', $fiscalYear->year)
            ->where('budget_items.id', '!=', $budgetItemId)
            ->select('budget_items.amount')
            ->get();
    }

    /**
     * Actualiza a cero los montos de las partidas presupuestarias seleccionadas
     *
     * @param Collection $budgetItems
     */
    public function resetAmount(Collection $budgetItems)
    {
        $this->model::whereIn('id', $budgetItems)
            ->update(['amount' => 0]);
    }

    /**
     * Elimina un registro de la base de datos
     *
     * @param int $id
     * @param $module
     * @param int $year
     *
     * @return mixed|void
     */
    public function customDestroy(int $id, $module, int $year)
    {
        DB::transaction(function () use ($id, $module, $year) {
            $entity = $this->model->find($id);
            $code = $entity->code;

            $this->model->destroy($id);

            if ($entity && $module == BudgetItem::MODULE['PROGRAMMATIC_STRUCTURE'] && api_available()) {
                $this->proformaRepository->destroy($code, $year);
            }
        }, 5);

        return true;
    }

    /**
     * Obtiene las partidas presupuestarias de un proyecto en un año específico
     *
     * @param int $projectFiscalYearId
     *
     * @return mixed
     */
    public function getItemsByProjectFiscalYear(int $projectFiscalYearId)
    {
        return $this->model::join('activity_project_fiscal_years', 'activity_project_fiscal_years.id', 'budget_items.activity_project_fiscal_year_id')
            ->where('activity_project_fiscal_years.project_fiscal_year_id', $projectFiscalYearId)
            ->select('budget_items.*')
            ->with([
                'activityProjectFiscalYear.responsible' => function ($query) {
                    $query->where('active', true);
                },
                'budgetClassifier',
                'publicPurchases',
                'budgetPlannings'
            ])
            ->get();
    }

    /**
     * Obtiene las partidas presupuestarias de un proyecto en un años fiscales
     *
     * @param int $projectFiscalYearId
     *
     * @return Collection
     */
    public function findByProjectFiscalYear(int $projectFiscalYearId)
    {
        return $this->model::join('activity_project_fiscal_years', 'activity_project_fiscal_years.id', 'budget_items.activity_project_fiscal_year_id')
            ->where('activity_project_fiscal_years.project_fiscal_year_id', $projectFiscalYearId)
            ->select('budget_items.*')
            ->with(['publicPurchases.budgetPlannings', 'budgetPlannings'])
            ->get();
    }

    /**
     * Obtener partida presupuestaria
     *
     * @param FiscalYear $fiscalYear
     * @param string $code
     *
     * @return BaseModel|BudgetItem|Builder|Model|object|null
     */
    public function findByFiscalYearAndCode(FiscalYear $fiscalYear, string $code)
    {
        return BudgetItem::where([
            ['fiscal_year_id', '=', $fiscalYear->id],
            ['code', '=', $code],
        ])->first();
    }

    /**
     * Obtiene las partidas presupuestarias de gasto permanente
     *
     * @param int $fiscalYearId
     *
     * @return mixed
     */
    public function findCurrentExpenditureItems(int $fiscalYearId)
    {
        return $this->model
            ->where('fiscal_year_id', $fiscalYearId)
            ->whereNotNull('operational_activity_id')
            ->with('budgetClassifier',
                'operationalActivity.subprogram.parent.area',
                'operationalActivity.responsibleUnit',
                'operationalActivity.executingUnit',
                'geographicLocation',
                'source',
                'institution',
                'spendingGuide',
                'budgetPlannings')
            ->get();
    }

    /**
     * Obtiene las partidas presupuestarias de un proyecto
     *
     * @param int $projectFiscalYearId
     *
     * @return Collection
     */
    public function findByProject(int $projectFiscalYearId)
    {
        return $this->model::join('activity_project_fiscal_years', 'activity_project_fiscal_years.id', 'budget_items.activity_project_fiscal_year_id')
            ->where('activity_project_fiscal_years.project_fiscal_year_id', $projectFiscalYearId)
            ->select('budget_items.*')
            ->with([
                'activityProjectFiscalYear.area',
                'activityProjectFiscalYear.component.project.executingUnit',
                'activityProjectFiscalYear.component.project.responsibleUnit',
                'budgetClassifier',
                'geographicLocation',
                'source',
                'spendingGuide',
                'institution',
                'budgetPlannings',
                'competence'
            ])
            ->get();
    }

    /**
     * Obtiene las las cuentas y montos de las partidas presupuestarias
     *
     * @param int $year
     * @param string $date
     * @param Collection $items
     *
     * @return Collection
     */
    public function budgetCardExpenses(int $year, string $date, Collection $items)
    {
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $params = [$sfgprov->company_code, $year, $date];
        $bindingsString = trim(str_repeat('?,', count($items)), ',');
        if ($bindingsString === '') {
            $bindingsString = "''";
        }
        $params = array_merge($params, $items->toArray());
        $query = "select
                trim(f.cuenta) as cuenta,
                trim(f.nom_cue) as nom_cue,
                f.por_comprometer                from ced_presupuestaria(?, ?, ?, 1, 0)
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
                        ) where f.niv_cue =20 and f.cuenta in ( {$bindingsString} )";
        return collect(DB::connection('pgsql')->select($query, $params));
    }

    public function findIn($attribute, array $value, $columns = array('*'))
    {
        return $this->model->whereIn($attribute, $value)->get($columns);
    }
}
