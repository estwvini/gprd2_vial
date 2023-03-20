<?php

namespace App\Repositories\Repository\Business;

use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Class PlanRepository
 * @package App\Repositories\Repository
 */
class PlanRepository extends Repository
{
    /**
     * Constructor de PlanRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * Especifica el nombre de la clase del modelo
     *
     * @return mixed
     */
    function model()
    {
        return Plan::class;
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
     * Obtener de la BD una colección de todos los planes
     *
     * @return mixed
     */
    public function exceptODSPND()
    {
        return $this->model
            ->where([
                ['name', '<>', 'ODS'],
                ['name', '<>', 'PND']
            ])->get();
    }

    /**
     * Actualizar en la BD la información del plan
     *
     * @param array $data
     * @param Plan $entity
     *
     * @return Plan|null
     */
    public function updateFromArray(array $data, Plan $entity)
    {
        DB::transaction(function () use ($data, $entity) {

            if (in_array($entity->type, [Plan::TYPE_PEI, Plan::TYPE_PDOT, Plan::TYPE_SECTORAL])) {
                if ($entity->status == Plan::STATUS_DRAFT) {
                    if ((isset($data['start_year']) && $data['start_year'] != $entity->start_year) || (isset($data['end_year']) && $data['end_year'] != $entity->end_year)) {
                        $objectives = $entity->planElements()->where('type', PlanElement::TYPE_OBJECTIVE)->with('indicators')->get();

                        $objectives->each(function ($objective) {
                            $objective->indicators->each(function ($indicator) {
                                $indicator->planIndicatorGoals()->delete();
                            });
                        });

                    }
                } else {
                    if (isset($data['end_year']) && $data['end_year'] != $entity->end_year) {
                        $objectives = $entity->planElements()->where('type', PlanElement::TYPE_OBJECTIVE)->with('indicators')->get();

                        $objectives->each(function ($objective) {
                            $objective->indicators->each(function ($indicator) {
                                $indicator->planIndicatorGoals()->where('year', '>', Carbon::now()->year)->delete();
                            });
                        });

                    }
                }
            }

            $entity->fill($data);
            $entity->save();

        }, 5);

        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo plan
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {

        $model = new $this->model;
        $plan = $model->create($data);

        return $plan;
    }

    /**
     * Eliminar lógicamente de la BD un plan
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function delete(Model $entity)
    {
        DB::transaction(function () use ($entity) {
            $objectives = $entity->planElements()->where('type', PlanElement::TYPE_OBJECTIVE)->get();

            foreach ($objectives as $objective) {
                $indicators = $objective->indicators()->get();

                $indicators->each(function ($indicator) {
                    $indicator->parentLinks()->detach();
                    $indicator->childLinks()->detach();
                });
            }

            $entity->delete();
        }, 5);

        return $entity->fresh();
    }

    /**
     * Obtener el plan activo segun tipo
     *
     * @param string $type
     *
     * @return bool|mixed|null
     */
    public function getPlans(string $type)
    {

        $entities = $this->model->where([
            ['type', '=', $type]
        ])->whereIn('status', [Plan::STATUS_APPROVED, Plan::STATUS_VERIFIED])
            ->get();

        return $entities;
    }

    /**
     * Obtiene los elementos iniciales de la estructura de un plan
     *
     * @param Plan $plan
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getInitialElements(Plan $plan)
    {
        return $plan->planElements()
            ->whereNull('parent_id')
            ->orderBy('code', 'asc')
            ->get();
    }

    /**
     * Obtiene el número de elementos (Ejes, Objetivos e Indicadores) relacionados a un plan
     *
     * @param Plan $plan
     *
     * @return array
     */
    public function countPlanElements(Plan $plan)
    {
        $thrustsCount = 0;
        $objectives = collect([]);
        $objectivesCount = 0;
        $indicatorsCount = 0;
        $projectsCount = 0;
        $objectivesWithIndicators = 0;
        $objectivesWithoutIndicators = 0;
        $noLinkedIndicators = 0;
        $objectivesWithoutProjects = 0;
        $programSubprogramsWithoutProjects = 0;

        $planStructure = self::getPlanStructure($plan);

        if ($planStructure->planElements->count() && $planStructure->planElements->first()->type == PlanElement::TYPE_THRUST) {
            $thrustsCount = $planStructure->planElements->count();

            $planStructure->planElements->each(function ($thrust) use (&$objectivesCount, &$objectives) {
                $objectivesCount += $thrust->children->count();
                $objectives = $objectives->merge($thrust->children);
            });
        } else {
            $objectivesCount = $planStructure->planElements->count();
            $objectives = $planStructure->planElements;
        }

        $objectives->each(function ($objective) use (
            $plan,
            &$indicatorsCount,
            &$projectsCount,
            &$objectivesWithIndicators,
            &$objectivesWithoutIndicators,
            &$noLinkedIndicators,
            &$objectivesWithoutProjects,
            &$programSubprogramsWithoutProjects
        ) {
            if ($objective->indicators->count()) {
                $indicatorsCount += $objective->indicators->count();
                $objectivesWithIndicators++;

                if (in_array($plan->type, [Plan::TYPE_PDOT, Plan::TYPE_SECTORAL, Plan::TYPE_PEI])) {
                    $objective->indicators->each(function ($indicator) use (&$noLinkedIndicators) {
                        if (!$indicator->parentLinks()->exists()) {
                            $noLinkedIndicators++;
                        }
                    });
                }
            } else {
                $objectivesWithoutIndicators++;
            }

            $programs = $objective->children->where('type', PlanElement::TYPE_PROGRAM);

            if ($programs->count()) {
                $flagProjects = false;
                $programs->each(function ($program) use (&$flagProjects, &$programSubprogramsWithoutProjects, &$projectsCount) {
                    $subprograms = $program->children;
                    if (!$subprograms->count()) {
                        $programSubprogramsWithoutProjects++;
                    }
                    $subprograms->each(function ($subprogram) use (&$flagProjects, &$programSubprogramsWithoutProjects, &$projectsCount) {
                        if ($subprogram->projects->count()) {
                            $flagProjects = true;
                            $projectsCount += $subprogram->projects->count();
                        } else {
                            $programSubprogramsWithoutProjects++;
                        }
                    });
                });
                if (!$flagProjects) {
                    $objectivesWithoutProjects++;
                }
            } else {
                $objectivesWithoutProjects++;
            }
        });

        return [
            'THRUST' => $thrustsCount,
            'OBJECTIVE' => $objectivesCount,
            'INDICATOR' => $indicatorsCount,
            'PROJECT' => $projectsCount,
            'additionalInfo' => [
                'OBJECTIVES_WITH_INDICATORS' => $objectivesWithIndicators,
                'OBJECTIVES_WITHOUT_INDICATORS' => $objectivesWithoutIndicators,
                'OBJECTIVES_WITHOUT_PROJECTS' => $objectivesWithoutProjects,
                'PROGRAM_SUBPROGRAM_WITHOUT_PROJECTS' => $programSubprogramsWithoutProjects,
                'NO_LINKED_INDICATORS' => $noLinkedIndicators
            ]
        ];
    }

    /**
     * Get available plans to link
     *
     * @param string $planType
     *
     * @return array
     */
    public function getAvailablePlansToLink(string $planType)
    {
        $links = Plan::LINKS[$planType];
        $response = [];

        foreach ($links as $link) {
            $plans = Plan::where(function ($query) use ($link) {
                if (in_array($link, [Plan::TYPE_PDOT, Plan::TYPE_SECTORAL])) {
                    $query->whereIn('status', [Plan::STATUS_APPROVED, Plan::STATUS_VERIFIED]);
                }
            })->where('type', $link)->get();

            if (!$plans->count()) {
                continue;
            }

            $plans->each(function ($plan) use (&$response) {
                $countElements = self::countPlanElements($plan);

                if ($countElements['INDICATOR'] > 0) {
                    $response[] = [
                        'name' => $plan->name,
                        'id' => $plan->id,
                        'type' => $plan->type
                    ];
                }
            });

        }

        return $response;
    }

    /**
     * Obtiene la estructura completa de un plan (eager loading)
     *
     * @param Plan $plan
     *
     * @return Plan|Builder|Model|object|null
     */
    public function getPlanStructure(Plan $plan)
    {
        return Plan::where('plans.id', $plan->id)->with([
            'planElements' => function ($query) use ($plan) {
                if (Plan::INITIAL_ELEMENT[$plan->scope][$plan->type] == PlanElement::TYPE_THRUST) {
                    $query->where('type', PlanElement::TYPE_THRUST)->with([
                        'children.indicators',
                        'children' => function ($query) {
                            $query->orderBy('code', 'asc');
                        },
                        'children.children' => function ($query) {
                            $query->orderBy('code', 'asc');
                        },
                        'children.children.children' => function ($query) {
                            $query->orderBy('code', 'asc');
                        },
                        'children.children.children.projects'
                    ]);
                } else {
                    $query->where('type', PlanElement::TYPE_OBJECTIVE)->with([
                        'indicators',
                        'children' => function ($query) {
                            $query->orderBy('code', 'asc');
                        },
                        'children.children' => function ($query) {
                            $query->orderBy('code', 'asc');
                        },
                        'children.children.projects'
                    ]);
                }
                $query->orderBy('code', 'asc');
            }
        ])->first();
    }

    /**
     * Obtiene la estructura completa de un plan vinculado a la estructura programática según el año fiscal (eager loading)
     *
     * @param Plan $plan
     * @param int $fiscalYearId
     *
     * @return Plan|Builder|Model|object|null
     */
    public function getProgrammaticStructure(Plan $plan, int $fiscalYearId)
    {
        return Plan::where('plans.id', $plan->id)->with([
            'planElements' => function ($query) use ($plan, $fiscalYearId) {
                $query->where('type', PlanElement::TYPE_OBJECTIVE)->with([
                    'children' => function ($query) {
                        $query->where('type', PlanElement::TYPE_PROGRAM)
                            ->orderBy('code', 'asc');
                    },
                    'children.children' => function ($query) {
                        $query->orderBy('code', 'asc');
                    },
                    'children.children.projects.getProjectFiscalYears' => function ($query) use ($fiscalYearId) {
                        $query->where('fiscal_year_id', $fiscalYearId)
                            ->whereNotIn('status', [ProjectFiscalYear::STATUS_REJECTED, ProjectFiscalYear::STATUS_TO_REVIEW, ProjectFiscalYear::STATUS_DRAFT]);
                    },
                    'children.children.projects.getProjectFiscalYears.activitiesProjectFiscalYear'
                ]);
                $query->orderBy('code', 'asc');
            }
        ])->first();
    }

    /**
     * Obtiene la estructura de un plan sectorial (eager loading)
     *
     * @param Plan $plan
     *
     * @return Plan|Builder|Model|object|null
     */
    public function getSectorialPlan(Plan $plan)
    {
        return $this->model->where('plans.id', $plan->id)->with([
            'planElements' => function ($query) use ($plan) {
                $query->where('type', PlanElement::TYPE_OBJECTIVE)->with([
                    'children' => function ($query) {
                        $query->where('type', PlanElement::TYPE_PROGRAM)
                            ->orderBy('code', 'asc');
                    },
                    'children.children' => function ($query) {
                        $query->orderBy('code', 'asc');
                    }
                ]);
                $query->orderBy('code', 'asc');
            }
        ])->first();
    }

    /**
     * Obtiene la estructura completa de un plan con articulaciones (eager loading)
     *
     * @param Plan $plan
     * @param Plan $linkedPlan
     *
     * @return array
     */
    public function getPlanStructureLinks(Plan $plan, Plan $linkedPlan)
    {
        return [
            'linkedPlan' => $linkedPlan,
            'planLinks' => Plan::where('plans.id', $plan->id)
                ->with([
                    'planElements' => function ($query) use ($plan, $linkedPlan) {
                        if (Plan::INITIAL_ELEMENT[$plan->scope][$plan->type] == PlanElement::TYPE_THRUST) {

                            $query->where('plan_elements.type', PlanElement::TYPE_THRUST);

                            $query->join('plan_elements AS children', 'children.parent_id', '=', 'plan_elements.id');

                            $query->join('plan_indicators AS indicator', function ($join) {
                                $join->on('indicator.indicatorable_id', '=', 'children.id')->where('indicator.indicatorable_type', '=', PlanElement::class);
                            });

                            self::queryCheckPlanElement($query, $linkedPlan);

                            $query->with([
                                'children' => function ($query) use ($linkedPlan) {
                                    $query->join('plan_indicators AS indicator', function ($join) {
                                        $join->on('indicator.indicatorable_id', '=', 'plan_elements.id')->where('indicator.indicatorable_type', '=', PlanElement::class);
                                    });
                                    $query->join('links AS link', 'link.child_indicator', '=', 'indicator.id');

                                    $query->join('plan_indicators AS linked_indicator', 'linked_indicator.id', '=', 'link.parent_indicator');

                                    $query->join('plan_elements AS objective', function ($join) use ($linkedPlan) {
                                        $join->on('objective.id', '=', 'linked_indicator.indicatorable_id')
                                            ->where('linked_indicator.indicatorable_type', '=', PlanElement::class)
                                            ->where('objective.plan_id', $linkedPlan->id);
                                    });
                                    $query->select('plan_elements.*')->distinct('plan_elements.id');

                                    self::queryIndicators($query, $linkedPlan);

                                }
                            ]);

                        } else {

                            $query->where('plan_elements.type', PlanElement::TYPE_OBJECTIVE);

                            $query->join('plan_indicators AS indicator', function ($join) {
                                $join->on('indicator.indicatorable_id', '=', 'plan_elements.id')->where('indicator.indicatorable_type', '=', PlanElement::class);
                            });

                            self::queryCheckPlanElement($query, $linkedPlan);

                            self::queryIndicators($query, $linkedPlan);
                        }
                        $query->orderBy('plan_elements.code', 'asc');
                    }
                ])->first()
        ];
    }

    /**
     * Agrega query para obtener indicadores
     *
     * @param $query
     * @param $linkedPlan
     */
    public function queryIndicators($query, $linkedPlan)
    {
        $query->with([
            'indicators' => function ($query) use ($linkedPlan) {
                $query->join('links AS link', 'link.child_indicator', '=', 'plan_indicators.id');

                $query->join('plan_indicators AS linked_indicator', 'linked_indicator.id', '=', 'link.parent_indicator');

                $query->join('plan_elements AS objective', function ($join) use ($linkedPlan) {
                    $join->on('objective.id', '=', 'linked_indicator.indicatorable_id')
                        ->where('linked_indicator.indicatorable_type', '=', PlanElement::class)
                        ->where('objective.plan_id', $linkedPlan->id);
                });
                $query->select('plan_indicators.*')->distinct('plan_indicators.id');

                $query->with([
                    'parentLinks' => function ($query) use ($linkedPlan) {
                        $query->join('plan_elements AS objective', function ($join) use ($linkedPlan) {
                            $join->on('objective.id', '=', 'plan_indicators.indicatorable_id')
                                ->where('plan_indicators.indicatorable_type', '=', PlanElement::class)
                                ->where('objective.plan_id', $linkedPlan->id);
                        });
                        $query->select('plan_indicators.*')->distinct('plan_indicators.id');

                        $query->with([
                            'indicatorable' => function ($query) use ($linkedPlan) {
                                $query->orderBy('code', 'asc');
                            },
                            'indicatorable.parent',
                            'indicatorable.plan'
                        ]);
                    }
                ]);
            }
        ]);
    }

    /**
     * Filtra los elementos de un plan en base a las articulaciones existentes
     *
     * @param $query
     * @param $linkedPlan
     */
    public function queryCheckPlanElement($query, $linkedPlan)
    {

        $query->join('links AS link', 'link.child_indicator', '=', 'indicator.id');

        $query->join('plan_indicators AS linked_indicator', 'linked_indicator.id', '=', 'link.parent_indicator');

        $query->join('plan_elements AS objective', function ($join) use ($linkedPlan) {
            $join->on('objective.id', '=', 'linked_indicator.indicatorable_id')
                ->where('linked_indicator.indicatorable_type', '=', PlanElement::class)
                ->where('objective.plan_id', $linkedPlan->id);
        });

        $query->select('plan_elements.*')->distinct('plan_elements.id');
    }

    /**
     * Cambia de tipo a un plan borrador para convertirlo en un plan principal
     *
     * @param Plan $plan
     */
    public function changeDraftPlanToMain(Plan $plan)
    {
        $draftPlan = $this->findByFields(['type' => $plan->type, 'incoming_plan' => 1])->first();

        if ($draftPlan) {
            $draftPlan->incoming_plan = 0;
            $draftPlan->save();
        }
    }
}