<?php

namespace App\Repositories\Repository\Business;

use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Project;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\Business\Planning\OperationalGoalsRepository;
use Exception;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase PlanElementRepository
 * @package App\Repositories\Repository
 */
class PlanElementRepository extends Repository
{

    /**
     * @var PlanIndicatorRepository
     */
    protected $planIndicatorRepository;

    /**
     * @var OperationalGoalsRepository
     */
    protected $operationalGoalsRepository;

    /**
     * Constructor de PlanElementRepository.
     *
     * @param App $app
     * @param Collection $collection
     * @param PlanIndicatorRepository $planIndicatorRepository
     * @param OperationalGoalsRepository $operationalGoalsRepository
     *
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        Collection $collection,
        PlanIndicatorRepository $planIndicatorRepository,
        OperationalGoalsRepository $operationalGoalsRepository
    ) {
        parent::__construct($app, $collection);
        $this->planIndicatorRepository = $planIndicatorRepository;
        $this->operationalGoalsRepository = $operationalGoalsRepository;
    }

    /**
     * Especifica el nombre de la clase del modelo
     *
     * @return mixed
     */
    function model()
    {
        return PlanElement::class;
    }

    /**
     * Obtener de la BD una colección de todos los planes
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Obtener de la BD los elementos de un plan
     *
     * @param int $plan
     * @param string $elementType
     * @param int|null $parent
     *
     * @return mixed
     */
    public function findElements(int $plan, string $elementType, int $parent = null)
    {
        $query = $this->model
            ->where('plan_id', $plan)
            ->where('type', $elementType);

        if ($parent) {
            $query->where('parent_id', $parent);
        } else {
            $query->whereNull('parent_id');
        }

        return $query->get();
    }

    /**
     * Actualizar en la BD la información del plan
     *
     * @param array $data
     * @param PlanElement $entity
     *
     * @return PlanElement|null
     */
    public function updateFromArray(array $data, PlanElement $entity)
    {

        $entity->fill($data);
        $entity->save();

        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo elemento de un plan
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $model = new $this->model;
        $plan_element = $model->create($data);

        return $plan_element;
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
            $this->planIndicatorRepository->bulkDelete($entity->indicators());
            $this->operationalGoalsRepository->bulkDelete($entity->operationalGoals);
            $entity->delete();
        }, 5);

        return $entity->fresh();
    }

    /**
     * Obtiene los elementos hijo visibles en articulaciones
     *
     * @param PlanElement $element
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getVisibleChildren(PlanElement $element)
    {
        return $element->children()
            ->where('type', '<>', PlanElement::TYPE_STRATEGY)
            ->where('type', '<>', PlanElement::TYPE_PROGRAM)
            ->get();
    }


    /**
     * Obtiene los elementos hijo de un elemento de un plan
     *
     * @param PlanElement $element
     * @param string|null $planElementType
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getChildren(PlanElement $element, string $planElementType = null)
    {
        $query = $element->children();

        if ($planElementType) {
            $query->where('type', $planElementType);
        }

        $query->orderBy('code', 'asc');

        return $query->get();
    }


    /**
     * Obtiene los indicadores relacionados a un objetivo de un plan
     *
     * @param PlanElement $objective
     *
     * @return mixed
     */
    public function getIndicators(PlanElement $objective)
    {
        return $objective->indicators;
    }

    /**
     * Obtiene los proyectos relacionados a un subprograma de un plan
     *
     * @param PlanElement $objective
     *
     * @return mixed
     */
    public function getProjects(PlanElement $subprogram)
    {
        return $subprogram->projects;
    }

    /**
     * Genera un código autoincremental para programas y subprogramas
     *
     * @param int $planId
     * @param string $type
     * @param int $parentId
     *
     * @return string
     */
    public function generateCode(int $planId, string $type, int $parentId)
    {
        $maxCode = PlanElement::where(function ($query) use ($planId, $type, $parentId) {
            $query->where('type', $type);
            $query->where('plan_id', $planId);

            if ($type == PlanElement::TYPE_SUBPROGRAM) {
                $query->where('parent_id', $parentId);
            }

        })->max('code');

        return ($type == PlanElement::TYPE_PROGRAM && !isset($maxCode)) ? PlanElement::PROGRAM_START_CODE : sprintf("%02d", ((int)$maxCode + 1));
    }

    /**
     * Genera un código autoincremental para proyectos
     *
     * @param int $planElementId
     *
     * @return string
     */
    public function generateProjectCode(int $planElementId)
    {
        $maxCode = Project::where('plan_element_id', $planElementId)->max('cup');

        return sprintf("%03d", ((int)$maxCode + 1));
    }

    /**
     * Buscar por tipo y por plan
     *
     * @param array $filters
     * @param int $planId
     *
     * @return mixed
     */
    public function getObjectivesWithIndicators(array $filters, int $planId)
    {
        return $this->model
            ->join('plan_indicators', function ($join) use ($filters) {
                $join->on('plan_indicators.indicatorable_id', 'plan_elements.id')
                    ->where([
                        'plan_indicators.measurement_frequency_per_year' => PlanIndicator::FREQUENCY_FILTER_EQUIVALENCE[$filters['frequency']],
                        'plan_indicators.indicatorable_type' => PlanElement::class
                    ]);
            })
            ->join('plan_indicator_goals', function ($join) use ($filters) {
                $join->on('plan_indicator_goals.plan_indicator_id', 'plan_indicators.id')
                    ->where('plan_indicator_goals.year', $filters['year']);
            })
            ->where([
                'plan_elements.type' => PlanElement::TYPE_OBJECTIVE,
                'plan_id' => $planId
            ])
            ->groupBy('plan_elements.id')
            ->select('plan_elements.*')
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

    /**
     * Buscar objetivos del PEI por año.
     *
     * @param string $year
     *
     * @return mixed
     */
    public function dataObjectivesTrackingPEI(string $year)
    {
        return $this->model
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->join('plan_indicators', 'plan_indicators.indicatorable_id', '=', 'plan_elements.id')
            ->join('plan_indicator_goals', 'plan_indicator_goals.plan_indicator_id', '=', 'plan_indicators.id')
            ->where([
                ['plan_elements.type', '=', PlanElement::TYPE_OBJECTIVE],
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $year],
                ['plans.end_year', '>=', $year],
                ['plan_indicator_goals.year', '=', $year]
            ])
            ->groupBy('plan_elements.id')
            ->select('plan_elements.*')
            ->get();
    }

    /**
     * Buscar objetivos del PDOT por año.
     *
     * @param string $year
     *
     * @return mixed
     */
    public function dataObjectivesTrackingPDOT(string $year)
    {
        return $this->model
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->join('plan_indicators', 'plan_indicators.indicatorable_id', '=', 'plan_elements.id')
            ->join('plan_indicator_goals', 'plan_indicator_goals.plan_indicator_id', '=', 'plan_indicators.id')
            ->where([
                ['plan_elements.type', '=', PlanElement::TYPE_OBJECTIVE],
                ['plans.type', '=', Plan::TYPE_PDOT],
                ['plans.status', '=', Plan::STATUS_VERIFIED],
                ['plans.start_year', '<=', $year],
                ['plans.end_year', '>=', $year],
                ['plan_indicator_goals.year', '=', $year]
            ])
            ->groupBy('plan_elements.id')
            ->select('plan_elements.*')
            ->get();
    }

    /**
     * Obtiene los objetivos operativos del PEI actual
     *
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function getOperationalGoalsStructure(FiscalYear $fiscalYear)
    {
        return $this->model::join('plans', 'plans.id', 'plan_elements.plan_id')
            ->where([
                ['plan_elements.type', '=', PlanElement::TYPE_OBJECTIVE],
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $fiscalYear->year],
                ['plans.end_year', '>=', $fiscalYear->year]
            ])
            ->select('plan_elements.id', 'plan_elements.code', 'plan_elements.description')
            ->with([
                'operationalGoals' => function ($query) use ($fiscalYear) {
                    $query->where('operational_goals.fiscal_year_id', $fiscalYear->id);
                },
                'operationalGoals.indicators'
            ])
            ->get();
    }

    /**
     * Obtiene los objetivos operativos que tienen indicadores del PEI actual.
     *
     * @param FiscalYear $fiscalYear
     *
     * @return mixed
     */
    public function dataOperationalGoalsTracking(FiscalYear $fiscalYear)
    {
        return $this->model::join('plans', 'plans.id', 'plan_elements.plan_id')
            ->join('plan_indicators', 'plan_indicators.indicatorable_id', '=', 'plan_elements.id')
            ->join('plan_indicator_goals', 'plan_indicator_goals.plan_indicator_id', '=', 'plan_indicators.id')
            ->where([
                ['plan_elements.type', '=', PlanElement::TYPE_OBJECTIVE],
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plans.start_year', '<=', $fiscalYear->year],
                ['plans.end_year', '>=', $fiscalYear->year],
                ['plan_indicator_goals.year', '=', $fiscalYear->year]
            ])
            ->groupBy('plan_elements.id')
            ->select('plan_elements.*')
            ->orderBy('id')
            ->with([
                'operationalGoals' => function ($query) use ($fiscalYear) {
                    $query->where('operational_goals.fiscal_year_id', $fiscalYear->id);
                },
                'operationalGoals.indicators'
            ])
            ->get();
    }

    /**
     * Buscar objetivos del Plan Sectorial por año.
     *
     * @param int $id
     * @param string $year
     *
     * @return mixed
     */
    public function dataObjectivesTrackingSectoral(int $id, string $year)
    {
        return $this->model
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->join('plan_indicators', 'plan_indicators.indicatorable_id', '=', 'plan_elements.id')
            ->join('plan_indicator_goals', 'plan_indicator_goals.plan_indicator_id', '=', 'plan_indicators.id')
            ->where([
                'plan_elements.type' => PlanElement::TYPE_OBJECTIVE,
                'plans.id' => $id,
                'plans.status' => Plan::STATUS_VERIFIED,
                'plan_indicator_goals.year' => $year
            ])
            ->groupBy('plan_elements.id')
            ->select('plan_elements.*')
            ->get();
    }

    /**
     * Obtener de la BD una colección de todos los objetivos estratégicos de los planes
     *
     * @return mixed
     */
    public function findAllStrategic()
    {
        return $this->model::join('plans', 'plans.id', 'plan_elements.plan_id')
            ->where([
                'plan_elements.type' => PlanElement::TYPE_OBJECTIVE,
                'plans.type' => Plan::TYPE_PEI
            ])
            ->select('plan_elements.description', 'plan_elements.id')
            ->get();
    }
}