<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\Income;
use App\Processes\Business\Planning\IncomeProcess;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\SFGPROV\ProformaRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase IncomeRepository
 * @package App\Repositories\Repository\Business\Catalogs
 */
class IncomeRepository extends Repository
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
     * Constructor de IncomeRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ProformaRepository $proformaRepository
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection,
        FiscalYearRepository $fiscalYearRepository,
        ProformaRepository $proformaRepository
    ) {
        parent::__construct($app, $collection);
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->proformaRepository = $proformaRepository;
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    public function model()
    {
        return Income::class;
    }

    /**
     * Obtener de la BD una colección de todos los ingresos.
     *
     * @param string $module
     *
     * @return mixed
     */
    public function findAll(string $module)
    {
        switch ($module) {
            case Income::MODULE['BUDGET']:
                $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
                break;
            case Income::MODULE['PROGRAMMATIC_STRUCTURE']:
                $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
                break;
        }

        if ($fiscalYear) {
            return $this->model->where('fiscal_year_id', $fiscalYear->id)->orderBy('code')->get();
        } else {
            return collect();
        }
    }

    /**
     * Actualizar en la BD la información de un ingreso.
     *
     * @param array $data
     * @param Income $entity
     *
     * @return Income|null
     */
    public function updateFromArray(array $data, Income $entity)
    {
        DB::transaction(function () use ($data, &$entity) {
            $currentCode = $entity->code;

            $entity->fill($data);
            $entity->save();

            // If it is modifying incomes structure
            if ($entity && $data['module'] == Income::MODULE['PROGRAMMATIC_STRUCTURE'] && $currentCode != $data['code']) {

                $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
                $incomeProcess = resolve(IncomeProcess::class);
                $incomeStructure = $incomeProcess->buildNewIncomeStructure($entity, $fiscalYear);

                if ($incomeStructure->count() && api_available()) {
                    // Sync new income structure with financial system database
                    $this->proformaRepository->syncStructure($incomeStructure, $currentCode, $fiscalYear->year);
                }
            }

        }, 5);

        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo ingreso.
     *
     * @param array $data
     *
     * @return Income
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model();

        DB::transaction(function () use ($data, &$entity) {

            switch ($data['module']) {
                case Income::MODULE['BUDGET']:
                    $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
                    break;
                case Income::MODULE['PROGRAMMATIC_STRUCTURE']:
                    $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
                    break;
            }

            if (!$fiscalYear) {
                $fiscalYear = $this->fiscalYearRepository->create(['year' => Carbon::now()->addYear()->year]);

                if (!$fiscalYear) {
                    throw new Exception(trans('income.messages.errors.created'), 1000);
                }
            }

            $data['fiscal_year_id'] = $fiscalYear->id;

            $entity = $entity->create($data);

            // If it is modifying incomes structure
            if ($entity && $data['module'] == Income::MODULE['PROGRAMMATIC_STRUCTURE']) {

                $incomeProcess = resolve(IncomeProcess::class);
                $incomeStructure = $incomeProcess->buildNewIncomeStructure($entity, $fiscalYear);

                if ($incomeStructure->count() && api_available()) {
                    // Sync new income structure with financial system database
                    $this->proformaRepository->syncStructure($incomeStructure);
                }
            }

        }, 5);

        return $entity->fresh();
    }

    /**
     * Obtener de la BD una colección de todos los ingresos para un año fiscal.
     *
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function findByFiscalYear(FiscalYear $fiscalYear)
    {
        return $this->model
            ->where('fiscal_year_id', $fiscalYear->id)
            ->with('budget_classifier', 'financing_source')
            ->get();
    }

    /**
     * Elimina un registro de la base de datos
     *
     * @param int $id
     * @param $module
     *
     * @return mixed|void
     */
    public function customDestroy(int $id, $module)
    {
        DB::transaction(function () use ($id, $module) {
            $entity = $this->model->find($id);
            $code = $entity->code;

            $this->model->destroy($id);

            if ($entity && $module == Income::MODULE['PROGRAMMATIC_STRUCTURE'] && api_available()) {
                $this->proformaRepository->destroy($code, $entity->fiscal_year->year);
            }
        }, 5);

        return true;
    }

}
