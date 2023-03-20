<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\PlanIndicator;
use App\Models\Business\Planning\OperationalGoal;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase OperationalGoalsRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class OperationalGoalsRepository extends Repository
{
    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * Constructor de OperationalGoalsRepository.
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
    )
    {
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
        return OperationalGoal::class;
    }

    /**
     * Actualizar en la BD la información de un nuevo elemento de gasto corriente.
     *
     * @param array $data
     * @param OperationalGoal $entity
     *
     * @return OperationalGoal
     */
    public function updateFromArray(array $data, OperationalGoal $entity)
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
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;

        DB::transaction(function () use ($data, &$entity) {

            $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

            if (!$fiscalYear) {
                $fiscalYear = $this->fiscalYearRepository->create(['year' => Carbon::now()->addYear()->year]);

                if (!$fiscalYear) {
                    throw new Exception(trans('operational_goals.messages.errors.create'), 1000);
                }
            }

            $data['fiscal_year_id'] = $fiscalYear->id;

            $entity = $entity->create($data);
        }, 5);

        return $entity->fresh();
    }

    /**
     * Eliminar lógicamente de la BD un elemento de un plan y todos los elementos relacionados al mismo
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(Model $entity)
    {
        DB::transaction(function () use ($entity) {

            $planIndicatorRepository = $api = resolve(PlanIndicatorRepository::class);
            $planIndicatorRepository->bulkDelete($entity->indicators());

            $entity->delete();
        }, 5);

        return $entity->fresh();
    }

    /**
     * Elimina una colección de objetivos operativos
     *
     * @param Collection $operational_goals
     *
     * @return bool
     */
    public function bulkDelete(Collection $operational_goals)
    {
        DB::transaction(function () use ($operational_goals) {

            $operational_goals->each(function ($goal) {
                self::delete($goal);
            });

        }, 5);

        return true;
    }

    /**
     * Obtiene los objetivos operativos de un año con sus indicadores
     *
     * @param array $filters
     * @param int $fiscalYearId
     *
     * @return mixed
     */
    public function getOperationalGoalsWithIndicators(array $filters, int $fiscalYearId = null)
    {
        return $this->model
            ->join('plan_indicators', function ($join) use ($filters) {
                $join->on('plan_indicators.indicatorable_id', 'operational_goals.id')
                    ->where([
                        'plan_indicators.measurement_frequency_per_year' => PlanIndicator::FREQUENCY_FILTER_EQUIVALENCE[$filters['frequency']],
                        'plan_indicators.indicatorable_type' => OperationalGoal::class
                    ]);
            })
            ->join('plan_indicator_goals', function ($join) use ($filters) {
                $join->on('plan_indicator_goals.plan_indicator_id', 'plan_indicators.id')
                    ->where('plan_indicator_goals.year', $filters['year']);
            })
            ->groupBy('operational_goals.id')
            ->select('operational_goals.*')
            ->where('operational_goals.fiscal_year_id', $fiscalYearId)
            ->with([
                'indicators' => function ($query) use ($filters) {
                    $query->where('plan_indicators.measurement_frequency_per_year', PlanIndicator::FREQUENCY_FILTER_EQUIVALENCE[$filters['frequency']])
                        ->with([
                            'planIndicatorGoals' => function ($query) use ($filters) {
                                $query->where('plan_indicator_goals.year', $filters['year']);

                                if ($filters['frequency'] == PlanIndicator::FILTER_SECOND_SEMESTER) {
                                    $query->orderBy('plan_indicator_goals.id', 'DESC');
                                }
                            }
                        ]);
                }
            ])
            ->get();
    }
}