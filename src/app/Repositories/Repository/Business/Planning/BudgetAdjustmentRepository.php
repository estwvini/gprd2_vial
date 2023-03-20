<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\BudgetItem;
use App\Models\Business\Catalogs\GeographicLocation;
use App\Models\Business\Planning\BudgetAdjustment;
use App\Models\Business\Planning\CurrentExpenditureElement;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\OperationalActivity;
use App\Models\Business\Planning\Prioritization;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Tracking\Operation;
use App\Models\Business\Tracking\OperationDetail;
use App\Models\Business\Tracking\Proforma;
use App\Processes\Business\Planning\ProjectFiscalYearProcess;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase BudgetAdjustmentRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class BudgetAdjustmentRepository extends Repository
{
    /**
     * @var ProjectFiscalYearProcess
     */
    private $projectFiscalYearProcess;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var PrioritizationTemplateRepository
     */
    private $prioritizationTemplateRepository;

    /**
     * Constructor de BudgetAdjustmentRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param ProjectFiscalYearProcess $projectFiscalYearProcess
     * @param SettingRepository $settingRepository
     * @param PrioritizationTemplateRepository $prioritizationTemplateRepository
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection,
        ProjectFiscalYearProcess $projectFiscalYearProcess,
        SettingRepository $settingRepository,
        PrioritizationTemplateRepository $prioritizationTemplateRepository
    ) {
        parent::__construct($app, $collection);
        $this->projectFiscalYearProcess = $projectFiscalYearProcess;
        $this->settingRepository = $settingRepository;
        $this->prioritizationTemplateRepository = $prioritizationTemplateRepository;
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return BudgetAdjustment::class;
    }

    /**
     * Buscar ajuste presupuestario por el id del año fiscal
     *
     * @param int $idFiscalYear
     *
     * @return
     */
    function findBudgetAdjutmentForFiscalYear(int $idFiscalYear)
    {
        return $this->model
            ->join('prioritizations', 'prioritizations.id', '=', 'budget_adjustment.prioritization_id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'prioritizations.project_fiscal_year_id')
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('fiscal_years', 'fiscal_years.id', '=', 'project_fiscal_years.fiscal_year_id')
            ->whereNull('projects.deleted_at')
            ->with('prioritization.projectFiscalYear.project')
            ->select('budget_adjustment.*')
            ->where('fiscal_years.id', $idFiscalYear)
            ->get();
    }

    /**
     * Buscar ajuste presupuestario por el id del año fiscal
     *
     * @param int $idFiscalYear
     * @param array $projects
     *
     * @return int
     */
    function investmentExpenses(int $idFiscalYear, array $projects)
    {
        $value = 0;
        foreach ($projects as $project) {

            $entity = $project->prioritization->projectFiscalYear;
            $id = $entity->project->id;

            $value += self::investmentExpense($idFiscalYear, $id);
        }

        return !is_null($value) ? $value : 0;
    }

    /**
     * Buscar ajuste presupuestario por el id del año fiscal y wl id del proyecto
     *
     * @param int $idFiscalYear
     * @param int $id
     *
     * @return int
     */
    function investmentExpense(int $idFiscalYear, int $id)
    {
        $value = ProjectFiscalYear::join('activity_project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', '=', 'project_fiscal_years.id')
            ->join('projects', 'projects.id', '=', 'project_fiscal_years.project_id')
            ->join('budget_items', 'budget_items.activity_project_fiscal_year_id', '=', 'activity_project_fiscal_years.id')
            ->whereNull('projects.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->where([['project_fiscal_years.fiscal_year_id', $idFiscalYear], ['project_fiscal_years.project_id', '=', $id]])
            ->sum('budget_items.amount');

        return !is_null($value) ? $value : 0;
    }

    /**
     * Buscar ajuste presupuestario por el id del año fiscal
     *
     * @param int $idFiscalYear
     *
     * @param Prioritization $prioritization
     *
     * @return int
     */
    function investmentExpensesPrioritization(int $idFiscalYear, Prioritization $prioritization)
    {
        $id = $prioritization->projectFiscalYear->project->id;
        $value = self::investmentExpense($idFiscalYear, $id);

        return !is_null($value) ? $value : 0;
    }

    /**
     * Calcular gastos corrientes
     *
     * @param int $idFiscalYear
     *
     * @return int
     */
    function currentExpenses(int $idFiscalYear)
    {
        $value = CurrentExpenditureElement::join('operational_activities', 'operational_activities.current_expenditure_element_id', '=', 'current_expenditure_elements.id')
            ->join('budget_items', 'budget_items.operational_activity_id', '=', 'operational_activities.id')
            ->where([['current_expenditure_elements.fiscal_year_id', $idFiscalYear], ['current_expenditure_elements.type', '=', CurrentExpenditureElement::TYPE_SUBPROGRAM]])
            ->sum('budget_items.amount');
        return !is_null($value) ? $value : 0;
    }

    /**
     * Crear ajuste presupuestario con un estado específico.
     *
     * @param string $status
     * @param array $prioritizationIds
     *
     * @return BudgetAdjustment|mixed
     */
    function bulkCreate(string $status, array $prioritizationIds)
    {
        DB::transaction(function () use ($status, $prioritizationIds) {

            foreach ($prioritizationIds as $id) {
                $budgetAdjustment = new $this->model;
                $budgetAdjustment->prioritization_id = $id;
                $budgetAdjustment->status = $status;
                $budgetAdjustment->save();

                if (BudgetAdjustment::STATUS_APPROVED === $status) {
                    if (ProjectFiscalYear::STATUS_REVIEWED !== $budgetAdjustment->prioritization->projectFiscalYear->status) {
                        throw new Exception(trans('budget_adjustment.messages.exceptions.invalid_status'), 1000);
                    }
                    $this->projectFiscalYearProcess->status($budgetAdjustment->prioritization->projectFiscalYear->id);
                }
            }

        }, 5);
    }

    /**
     * Revertir el ajuste presupuestario en la BD.
     *
     * @param array $prioritizationIds
     * @param Collection $budgetAdjustments
     */
    function bulkRollback(array $prioritizationIds, Collection $budgetAdjustments)
    {
        DB::transaction(function () use ($prioritizationIds, $budgetAdjustments) {

            if ($budgetAdjustments->count()) {
                foreach ($budgetAdjustments as $entity) {
                    $entity->delete();
                }
            }

            foreach ($prioritizationIds as $id) {
                $budgetAdjustment = new $this->model;
                $budgetAdjustment->prioritization_id = $id;
                $budgetAdjustment->status = BudgetAdjustment::STATUS_DRAFT;
                $budgetAdjustment->save();

                $budgetAdjustment->prioritization->projectFiscalYear->status = ProjectFiscalYear::STATUS_REVIEWED;
                $budgetAdjustment->prioritization->projectFiscalYear->save();
            }

        }, 5);
    }

    /**
     * Crear en la BD una proforma nueva de acuerdo a un año fiscal.
     *
     * @param Collection $incomes
     * @param Collection $budgetItems
     * @param FiscalYear $fiscalYear
     *
     * @return Operation
     */
    public function createProforma(Collection $incomes, Collection $budgetItems, FiscalYear $fiscalYear)
    {
        $operation = new Operation();
        $provinceName = $this->settingRepository->findByKey('gad')->value['province'];
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;

        DB::transaction(function () use ($incomes, $budgetItems, $fiscalYear, &$operation, $provinceName, $sfgprov) {

            $incomeTotal = number_format($incomes->sum('value'), 2, '.', '');
            $expenseTotal = number_format($budgetItems->sum('amount'), 2, '.', '');
            $sequential = 1;

            if ($incomeTotal !== $expenseTotal) {
                throw new Exception(trans('budget_adjustment.messages.exceptions.invalid_adjustment'), 1000);
            }

            // Insert into budget item operations table
            $operation = Operation::firstOrCreate(
                [
                    'company_code' => $sfgprov->company_code,
                    'year' => $fiscalYear->year,
                    'voucher_type' => Operation::PROFORMA_TYPE,
                    'number' => Operation::PROFORMA_DEFAULT_NUMBER,
                    'description' => trans('budget_item_operation.default_description', ['year' => $fiscalYear->year]),
                    'total_debit' => $incomeTotal,
                    'total_credit' => $expenseTotal,
                    'created_by' => $sfgprov->user_code,
                    'status' => Operation::PROFORMA_APPROVED_STATUS,
                    'period' => Operation::PROFORMA_DEFAULT_PERIOD
                ],
                [
                    'date_assignment' => Carbon::now(),
                    'date_approval' => Carbon::now(),
                    'date_created' => Carbon::now()
                ]);

            foreach ($incomes as $income) {
                $currentLevel = Proforma::INCOME_LEVELS;
                $parentCode = self::getParentCode($income->code);
                $budgetClassifier = $income->budget_classifier;
                $source = $income->financing_source;

                // Insert incomes into operation details table
                OperationDetail::firstOrCreate([
                    'company_code' => $sfgprov->company_code,
                    'year' => $fiscalYear->year,
                    'voucher_type' => Operation::PROFORMA_TYPE,
                    'number' => Operation::PROFORMA_DEFAULT_NUMBER,
                    'sequential' => $sequential++,
                    'code' => $income->code,
                    'income_amount' => $income->value,
                    'expense_amount' => 0.00,
                    'type' => Proforma::TYPE_INCOME,
                    'status' => Operation::PROFORMA_APPROVED_STATUS,
                    'period' => Operation::PROFORMA_DEFAULT_PERIOD,
                    'created_by' => $sfgprov->user_code
                ]);

                $description = $income->justification ? $income->justification : $budgetClassifier->title;

                // Insert incomes into proforma
                Proforma::firstOrCreate([
                    'company_code' => $sfgprov->company_code,
                    'year' => $fiscalYear->year,
                    'code' => $income->code,
                    'type' => Proforma::TYPE_INCOME,
                    'description' => $description,
                    'last_level' => Proforma::LAST_LEVEL,
                    'level' => $currentLevel--,
                    'parent_code' => $parentCode,
                    'created_by' => $sfgprov->user_code
                ]);

                while ($currentLevel > 0) {

                    $description = '';

                    switch ($currentLevel) {
                        case '6': // Distribuidor
                            $description = $income->distributor_name;
                            break;
                        case '5': // Fuente Financiamiento
                            $description = $source->description;
                            break;
                        case '4':// Budget classifier element code
                        case '3':// Budget classifier element code
                        case '2':// Budget classifier element code
                        case '1':// Budget classifier element code
                            $description = $budgetClassifier->title;
                            if ($budgetClassifier->parent) {
                                $budgetClassifier = $budgetClassifier->parent;
                            }
                            break;
                    }
                    // Insert tree into proforma
                    Proforma::firstOrCreate([
                        'company_code' => $sfgprov->company_code,
                        'year' => $fiscalYear->year,
                        'code' => $parentCode,
                        'type' => Proforma::TYPE_INCOME,
                        'description' => $description,
                        'last_level' => Proforma::NOT_LAST_LEVEL,
                        'level' => $currentLevel--,
                        'parent_code' => $parentCode = self::getParentCode($parentCode),
                        'created_by' => $sfgprov->user_code
                    ]);
                }
            }

            foreach ($budgetItems as $budgetItem) {
                $currentLevel = Proforma::EXPENSE_LEVELS;
                $parentCode = self::getParentCode($budgetItem->code);
                $spendingGuide = $budgetItem->spendingGuide;
                $budgetClassifier = $budgetItem->budgetClassifier;
                $location = $budgetItem->geographicLocation;
                $activity = $description = $budgetItem->operational_activity_id ? $budgetItem->operationalActivity : $budgetItem->activityProjectFiscalYear;
                $source = $budgetItem->source;

                // Insert budget items into operation details table
                OperationDetail::firstOrCreate([
                    'company_code' => $sfgprov->company_code,
                    'year' => $fiscalYear->year,
                    'voucher_type' => Operation::PROFORMA_TYPE,
                    'number' => Operation::PROFORMA_DEFAULT_NUMBER,
                    'sequential' => $sequential++,
                    'code' => $budgetItem->code,
                    'income_amount' => 0.00,
                    'expense_amount' => $budgetItem->amount,
                    'type' => Proforma::TYPE_EXPENSE,
                    'status' => Operation::PROFORMA_APPROVED_STATUS,
                    'period' => Operation::PROFORMA_DEFAULT_PERIOD,
                    'created_by' => $sfgprov->user_code
                ]);

                // Insert budget items into proforma
                Proforma::firstOrCreate([
                    'company_code' => $sfgprov->company_code,
                    'year' => $fiscalYear->year,
                    'code' => $budgetItem->code,
                    'type' => Proforma::TYPE_EXPENSE,
                    'description' => $budgetItem->name,
                    'last_level' => Proforma::LAST_LEVEL,
                    'level' => $currentLevel--,
                    'parent_code' => $parentCode,
                    'created_by' => $sfgprov->user_code
                ]);

                while ($currentLevel > 0) {

                    $description = '';

                    switch ($currentLevel) {
                        case '19':// Fuente Financiamiento
                            $description = $source->description;
                            break;
                        case '18':// Geographic location code Parish
                        case '17':// Geographic location code Canton
                        case '16':// Geographic location code Province
                            $description = ($currentLevel == 16 && $location->code != GeographicLocation::NO_LOCATION_CODE) ? $provinceName : $location->description;
                            if ($location->parent) {
                                $location = $location->parent;
                            }
                            break;
                        case '15':// Spending guide subcategory code
                        case '14':// Spending guide category code
                        case '13':// Spending guide direction code
                        case '12':// Spending guide orientation code
                            $description = $spendingGuide->description;
                            if ($spendingGuide->parent) {
                                $spendingGuide = $spendingGuide->parent;
                            }
                            break;
                        case '11':// FUN code
                            if ($budgetItem->competence) {
                                $description = $budgetItem->competence->name;
                            } else {
                                $description = BudgetItem::FUN_DESCRIPTION;
                            }
                            break;
                        case '10':// Budget classifier element code
                        case '9':// Budget classifier subgroup code
                        case '8':// Budget classifier group code
                        case '7':// Budget classifier nature code
                            $description = $budgetClassifier->title;
                            if ($budgetClassifier->parent) {
                                $budgetClassifier = $budgetClassifier->parent;
                            }
                            break;
                        case '6':// Activity code
                            $description = $activity->name;
                            break;
                        case '5':// Executing unit code
                            $description = $activity instanceof OperationalActivity ? $activity->executingUnit->name : $activity->component->project->executingUnit->name;
                            break;
                        case '4':// Project fiscal year code
                            $description = $activity instanceof OperationalActivity ? $activity->subprogram->name : $activity->component->project->name;
                            break;
                        case '3':// Subprogram code
                            $description = $activity instanceof OperationalActivity ? $activity->subprogram->name : $activity->component->project->subprogram->description;
                            break;
                        case '2':// Program code
                            $description = $activity instanceof OperationalActivity ? $activity->subprogram->parent->name : $activity->component->project->subprogram->parent->description;
                            break;
                        case '1':// Area code
                            $description = $activity instanceof OperationalActivity ? $activity->subprogram->parent->area->area : $activity->area->area;
                            break;
                    }

                    // Insert budget items tree into proforma
                    Proforma::firstOrCreate([
                        'company_code' => $sfgprov->company_code,
                        'year' => $fiscalYear->year,
                        'code' => $parentCode,
                        'type' => Proforma::TYPE_EXPENSE,
                        'description' => $description,
                        'last_level' => Proforma::NOT_LAST_LEVEL,
                        'level' => $currentLevel--,
                        'parent_code' => $parentCode = self::getParentCode($parentCode),
                        'created_by' => $sfgprov->user_code
                    ]);
                }
            }

            // Block prioritization template used in current fiscal year
            $this->prioritizationTemplateRepository->blockTemplate($this->prioritizationTemplateRepository->findByFiscalYear($fiscalYear));
        }, 5);

        return $operation;
    }

    /**
     * Crear en la MEMORIA una proforma nueva de acuerdo a un año fiscal.
     *
     * @param Collection $incomes
     * @param Collection $budgetItems
     * @param FiscalYear $fiscalYear
     *
     * @return array
     * @throws Exception
     */
    public function previewProforma(Collection $incomes, Collection $budgetItems, FiscalYear $fiscalYear)
    {
        $previewProformaFirstOrCreate = array();

        $incomeTotal = number_format($incomes->sum('value'), 2, '.', '');
        $expenseTotal = number_format($budgetItems->sum('amount'), 2, '.', '');

        if ($incomeTotal !== $expenseTotal) {
            throw new Exception(trans('budget_adjustment.messages.exceptions.invalid_adjustment'), 1000);
        }

        $provinceName = $this->settingRepository->findByKey('gad')->value['province'];
        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        foreach ($incomes as $count => $income) {
            $currentLevel = Proforma::INCOME_LEVELS;
            $parentCode = self::getParentCode($income->code);
            $budgetClassifier = $income->budget_classifier;
            $source = $income->financing_source;

            $description = $income->justification ? $income->justification : $budgetClassifier->title;

            //incomes in proforma
            $previewProforma = array(
                'company_code' => $sfgprov->company_code,
                'year' => $fiscalYear->year,
                'code' => $income->code,
                'type' => Proforma::INCOME_TYPE,
                'description' => $description,
                'last_level' => Proforma::LAST_LEVEL,
                'level' => $currentLevel--,
                'parent_code' => $parentCode,
                'created_by' => $sfgprov->user_code,
                'income_amount' => $income->value
            );
            array_push($previewProformaFirstOrCreate, $previewProforma);

            while ($currentLevel > 0) {

                $description = '';

                switch ($currentLevel) {
                    case '6': // Distribuidor
                        $description = $income->distributor_name;
                        break;
                    case '5': // Fuente Financiamiento
                        $description = $source->description;
                        break;
                    case '4':// Budget classifier element code
                    case '3':// Budget classifier element code
                    case '2':// Budget classifier element code
                    case '1':// Budget classifier element code
                        $description = $budgetClassifier->title;
                        if ($budgetClassifier->parent) {
                            $budgetClassifier = $budgetClassifier->parent;
                        }
                        break;
                }
                //tree in proforma
                $previewProforma = array(
                    'company_code' => $sfgprov->company_code,
                    'year' => $fiscalYear->year,
                    'code' => $parentCode,
                    'type' => Proforma::INCOME_TYPE,
                    'description' => $description,
                    'last_level' => Proforma::NOT_LAST_LEVEL,
                    'level' => $currentLevel--,
                    'parent_code' => $parentCode = self::getParentCode($parentCode),
                    'created_by' => $sfgprov->user_code
                );
                array_push($previewProformaFirstOrCreate, $previewProforma);
            }
        }

        foreach ($budgetItems as $count => $budgetItem) {
            $currentLevel = Proforma::EXPENSE_LEVELS;
            $parentCode = self::getParentCode($budgetItem->code);
            $spendingGuide = $budgetItem->spendingGuide;
            $budgetClassifier = $budgetItem->budgetClassifier;
            $location = $budgetItem->geographicLocation;
            $activity = $description = $budgetItem->operational_activity_id ? $budgetItem->operationalActivity : $budgetItem->activityProjectFiscalYear;
            $source = $budgetItem->source;

            //budget items in proforma
            $previewProforma = array(
                'company_code' => $sfgprov->company_code,
                'year' => $fiscalYear->year,
                'code' => $budgetItem->code,
                'type' => Proforma::EXPENSE_TYPE,
                'description' => $budgetItem->name,
                'last_level' => Proforma::LAST_LEVEL,
                'level' => $currentLevel--,
                'parent_code' => $parentCode,
                'created_by' => $sfgprov->user_code,
                'expense_amount' => $budgetItem->amount
            );
            array_push($previewProformaFirstOrCreate, $previewProforma);

            while ($currentLevel > 0) {

                $description = '';

                switch ($currentLevel) {
                    case '19':// Fuente Financiamiento
                        $description = $source->description;
                        break;
                    case '18':// Geographic location code Parish
                    case '17':// Geographic location code Canton
                    case '16':// Geographic location code Province
                        $description = ($currentLevel == 16 && $location->code != GeographicLocation::NO_LOCATION_CODE) ? $provinceName : $location->description;
                        if ($location->parent) {
                            $location = $location->parent;
                        }
                        break;
                    case '15':// Spending guide subcategory code
                    case '14':// Spending guide category code
                    case '13':// Spending guide direction code
                    case '12':// Spending guide orientation code
                        $description = $spendingGuide->description;
                        if ($spendingGuide->parent) {
                            $spendingGuide = $spendingGuide->parent;
                        }
                        break;
                    case '11':// FUN code
                        if ($budgetItem->competence) {
                            $description = $budgetItem->competence->name;
                        } else {
                            $description = BudgetItem::FUN_DESCRIPTION;
                        }
                        break;
                    case '10':// Budget classifier element code
                    case '9':// Budget classifier subgroup code
                    case '8':// Budget classifier group code
                    case '7':// Budget classifier nature code
                        $description = $budgetClassifier->title;
                        if ($budgetClassifier->parent) {
                            $budgetClassifier = $budgetClassifier->parent;
                        }
                        break;
                    case '6':// Activity code
                        $description = $activity->name;
                        break;
                    case '5':// Executing unit code
                        $description = $activity instanceof OperationalActivity ? $activity->executingUnit->name : $activity->component->project->executingUnit->name;
                        break;
                    case '4':// Project fiscal year code
                        $description = $activity instanceof OperationalActivity ? $activity->subprogram->name : $activity->component->project->name;
                        break;
                    case '3':// Subprogram code
                        $description = $activity instanceof OperationalActivity ? $activity->subprogram->name : $activity->component->project->subprogram->description;
                        break;
                    case '2':// Program code
                        $description = $activity instanceof OperationalActivity ? $activity->subprogram->parent->name : $activity->component->project->subprogram->parent->description;
                        break;
                    case '1':// Area code
                        $description = $activity instanceof OperationalActivity ? $activity->subprogram->parent->area->area : $activity->area->area;
                        break;
                }

                //budget items tree in proforma
                $previewProforma = array(
                    'company_code' => $sfgprov->company_code,
                    'year' => $fiscalYear->year,
                    'code' => $parentCode,
                    'type' => Proforma::EXPENSE_TYPE,
                    'description' => $description,
                    'last_level' => Proforma::NOT_LAST_LEVEL,
                    'level' => $currentLevel--,
                    'parent_code' => $parentCode = self::getParentCode($parentCode),
                    'created_by' => $sfgprov->user_code
                );
                array_push($previewProformaFirstOrCreate, $previewProforma);
            }
        }
        return $previewProformaFirstOrCreate;
    }

    /**
     * Obtener el código padre para el ítem de la proforma.
     *
     * @param string $code
     *
     * @return array|string
     */
    private function getParentCode(string $code)
    {
        $parentCode = explode('.', $code);
        unset($parentCode[count($parentCode) - 1]);
        $parentCode = implode('.', $parentCode);

        return $parentCode;
    }
}
