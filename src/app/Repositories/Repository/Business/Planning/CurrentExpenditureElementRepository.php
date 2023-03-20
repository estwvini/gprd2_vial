<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\Planning\CurrentExpenditureElement;
use App\Models\Business\Planning\FiscalYear;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Carbon\Carbon;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase CurrentExpenditureElementRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class CurrentExpenditureElementRepository extends Repository
{
    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * Constructor de CurrentExpenditureElementRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param FiscalYearRepository $fiscalYearRepository
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection,
        FiscalYearRepository $fiscalYearRepository
    ) {
        parent::__construct($app, $collection);
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return CurrentExpenditureElement::class;
    }

    /**
     * Obtener de la BD el programa de gasto corriente correspondiente al año fiscal a planificar.
     *
     * @param FiscalYear $fiscalYear
     *
     * @return CurrentExpenditureElement|mixed
     * @throws Exception
     */
    public function findCurrentProgram(FiscalYear $fiscalYear)
    {
        if (!$fiscalYear) {
            $fiscalYear = $this->fiscalYearRepository->create(['year' => Carbon::now()->addYear()->year]);

            if (!$fiscalYear) {
                throw new Exception(trans('current_expenditure.messages.errors.index'), 1000);
            }
        }

        return $this->model->where(['fiscal_year_id' => $fiscalYear->id, 'type' => CurrentExpenditureElement::TYPE_PROGRAM])->first();
    }

    /**
     * Actualizar en la BD la información de un nuevo elemento de gasto corriente.
     *
     * @param array $data
     * @param CurrentExpenditureElement $entity
     *
     * @return CurrentExpenditureElement|null
     */
    public function updateFromArray(array $data, CurrentExpenditureElement $entity)
    {
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo elemento de gasto corriente.
     *
     * @param array $data
     *
     * @return CurrentExpenditureElement
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;

        DB::transaction(function () use ($data, &$entity) {

            if (isset($data['parent_id'])) {
                $data['fiscal_year_id'] = self::find($data['parent_id'])->fiscal_year_id;
            } else {
                $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

                if (!$fiscalYear) {
                    $fiscalYear = $this->fiscalYearRepository->create(['year' => Carbon::now()->addYear()->year]);

                    if (!$fiscalYear) {
                        throw new Exception(trans('current_expenditure.messages.errors.create', ['element' => trans('current_expenditure.labels' . $data['type'])]), 1000);
                    }
                }

                $data['fiscal_year_id'] = $fiscalYear->id;
            }

            $entity = $entity->create($data);
        }, 5);

        return $entity->fresh();
    }

    /**
     * Obtiene la estructura completa de gasto corriente (eager loading).
     *
     * @param CurrentExpenditureElement $currentExpenditureElement
     *
     * @return mixed
     */
    public function getCurrentExpenditureStructure(CurrentExpenditureElement $currentExpenditureElement)
    {
        return $this->model
            ->where('current_expenditure_elements.id', $currentExpenditureElement->id)
            ->with('children.activities')
            ->first();
    }

    /**
     * Obtiene la estructura completa de gasto corriente (eager loading).
     *
     * @param CurrentExpenditureElement $currentExpenditureElement
     *
     * @return mixed
     */
    public function getCurrentExpenditure(CurrentExpenditureElement $currentExpenditureElement)
    {
        return $this->model
            ->where('current_expenditure_elements.id', $currentExpenditureElement->id)
            ->with([
                'children.activities.budgetItems.publicPurchases.budgetPlannings',
                'children.activities.budgetItems.budgetPlannings',
            ])
            ->first();
    }

    /**
     * Genera un código autoincremental para subprogramas
     *
     * @param int $parentId
     *
     * @return string
     */
    public function generateSubprogramCode(int $parentId)
    {
        $maxCode = CurrentExpenditureElement::where(function ($query) use ($parentId) {
            $query->where('type', CurrentExpenditureElement::TYPE_SUBPROGRAM);
            $query->where('parent_id', $parentId);

        })->max('code');

        return sprintf("%02d", ((int)$maxCode + 1));
    }
}