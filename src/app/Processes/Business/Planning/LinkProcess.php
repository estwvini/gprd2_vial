<?php

namespace App\Processes\Business\Planning;

use App\Http\Controllers\Business\Planning\LinkController;
use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Repositories\Repository\Business\LinkRepository;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\PlanRepository;
use DataTables;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Throwable;

/**
 * Clase LinkProcess
 * @package App\Processes\Business\Planning
 */
class LinkProcess
{

    /**
     * @var PlanRepository
     */
    protected $planRepository;

    /**
     * @var PlanElementRepository
     */
    protected $planElementRepository;

    /**
     * @var LinkRepository
     */
    protected $linkRepository;

    /**
     * @var PlanIndicatorRepository
     */
    protected $planIndicatorRepository;

    /**
     * Constructor de PlanProcess.
     *
     * @param PlanRepository $planRepository
     * @param PlanElementRepository $planElementRepository
     * @param LinkRepository $linkRepository
     * @param PlanIndicatorRepository $planIndicatorRepository
     */
    public function __construct(
        PlanRepository $planRepository,
        PlanElementRepository $planElementRepository,
        LinkRepository $linkRepository,
        PlanIndicatorRepository $planIndicatorRepository
    ) {
        $this->planRepository = $planRepository;
        $this->planElementRepository = $planElementRepository;
        $this->linkRepository = $linkRepository;
        $this->planIndicatorRepository = $planIndicatorRepository;
    }


    /**
     * Obtener la clase de PlanProcess
     *
     * @return PlanProcess
     */
    public function process()
    {
        return LinkProcess::class;
    }

    /**
     * Muestra pantalla de articulaciones
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function linkPlan(int $id)
    {
        $entity = $this->planRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $initialElements = $this->planRepository->getInitialElements($entity);

        $planStructure = self::generateTreeStructure(collect($initialElements), [Plan::INITIAL_ELEMENT[$entity->scope][$entity->type]], $entity->type, []);

        $response['view'] = view('business.planning.link.link_plan', [
            'plan' => $entity,
            'json' => str_replace("\u0022", "\\\\\"", json_encode($planStructure, JSON_HEX_APOS | JSON_HEX_QUOT))
        ])->render();

        return $response;
    }

    /**
     * Genera la estructura de tipo arbol de un plan
     *
     * @param Collection $planElements
     * @param array $categories
     * @param string $planType
     * @param array $selectedNodes
     * @param PlanElement $parentElement
     *
     * @return array
     */
    private function generateTreeStructure(Collection $planElements, array $categories = [], string $planType, array $selectedNodes = [], PlanElement $parentElement = null)
    {
        $structure = [];
        foreach ($categories as $category) {

            if ($category != PlanElement::TYPE_OBJECTIVE && $category != PlanElement::TYPE_THRUST && $category != PlanElement::TYPE_INDICATOR) {
                continue;
            }

            if ($parentElement) {
                if ($category != PlanElement::TYPE_INDICATOR) {
                    // Get plan element children
                    $planElements = collect($this->planElementRepository->getChildren($parentElement, $category));
                } else {
                    // Get objective indicators
                    $planElements = collect($this->planElementRepository->getIndicators($parentElement));
                }
            }

            if (!$planElements->isEmpty()) {
                $structure[] = [
                    'text' => '<b>' . trans('plan_elements.titles.' . ($category == PlanElement::TYPE_INDICATOR ? PlanElement::TYPE_GOAL : $category)) . '</b>',
                    'selectable' => false,
                    'status' => [
                        'open' => $category == PlanElement::TYPE_INDICATOR ? false : true
                    ],
                    'children' => self::getChildrenStructure($planElements, $category, $planType, $selectedNodes, $parentElement)
                ];
            }
        }
        return $structure;
    }


    /**
     * Genera la estructura de los nodos hijos de un plan
     *
     * @param Collection $planElements
     * @param string $category
     * @param string $planType
     * @param array $selectedNodes
     * @param PlanElement|null $parentElement
     *
     * @return array
     */
    private function getChildrenStructure(Collection $planElements, string $category, string $planType, array $selectedNodes = [], PlanElement $parentElement = null)
    {
        return $planElements->map(function ($element) use ($category, $planType, $selectedNodes, $parentElement) {


            if ($category != PlanElement::TYPE_INDICATOR) {
                $selectable = false;
                $description = trans('plan_elements.labels.' . $element->type) . ' - ' . preg_replace('/\s+/', ' ', trim($element->description));
                $selected = false;
            } else {
                $selectable = true;
                $description = trans('plan_elements.labels.GOAL') . ' - ' . preg_replace('/\s+/', ' ', trim($element->goal_description));
                $selected = in_array($element->id, $selectedNodes);
            }

            $structure = [
                'text' => $description,
                'tooltip' => $description,
                'attributes' => [
                    'plan_type' => $planType,
                    'parent_id' => $parentElement ? $parentElement->id : null,
                    'element_id' => $element->id,
                ],
                'status' => [
                    'open' => ($category == PlanElement::TYPE_INDICATOR || $category == PlanElement::TYPE_OBJECTIVE) ? false : true,
                    'selected' => $selected
                ],
                'selectable' => $selectable,
                'children' => $category == PlanElement::TYPE_INDICATOR ? [] : self::generateTreeStructure(collect([]), PlanElement::NEXT_ELEMENT[$category], $planType,
                    $selectedNodes, $element)
            ];

            return $structure;
        })->toArray();
    }

    /**
     * Muestra las articulaciones de la meta de un plan
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function loadLinks(Request $request)
    {
        $data = $request->all();

        $indicator = $this->planIndicatorRepository->find($data['indicatorId']);

        if (!$indicator) {
            throw new Exception(trans('plan_indicators.messages.exceptions.not_found'), 1000);
        }

        $parentLinks = $indicator->parentLinks()->pluck('plan_indicators.id')->toArray();

        $plan = $this->planRepository->find($data['planId']);

        $initialElements = $this->planRepository->getInitialElements($plan);

        $planStructure = self::generateTreeStructure(collect($initialElements), [Plan::INITIAL_ELEMENT[$plan->scope][$plan->type]], $plan->type, $parentLinks);

        $response['view'] = view('business.planning.link.load_links', [
            'data' => $data,
            'plan' => $plan,
            'indicatorId' => $indicator->id,
            'objectiveId' => $data['objectiveId'],
            'parentLinks' => implode(',', $parentLinks),
            'json' => str_replace("\u0022", "\\\\\"", json_encode($planStructure, JSON_HEX_APOS | JSON_HEX_QUOT)),
            'childPlanName' => $data['childPlanName']
        ])->render();

        return $response;

    }


    /**
     * Almacena una articulación en la base de datos
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $entity = $this->planIndicatorRepository->find($data['child_indicator']);

        if (!$entity) {
            throw  new Exception(trans('plan_indicators.messages.exceptions.not_found'), 1000);
        }

        if (!$this->linkRepository->storeParentLinks($entity, isset($data['parent_indicators']) ? $data['parent_indicators'] : [])) {
            throw new Exception(trans('links.messages.errors.created'), 1000);
        }

        $linkController = resolve(LinkController::class);
        $response = $linkController->linkPlan($entity->indicatorable()->first()->plan()->first()->id);

        $response->setData([
            'view' => $response->getData()->view,
            'message' => [
                'type' => 'success',
                'text' => trans('links.messages.success.created')
            ]
        ]);

        return $response;
    }

    /**
     * Elimina una articulación de la base de datos
     *
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $data = $request->all();

        $entity = $this->planIndicatorRepository->find($data['childIndicator']);

        if (!$entity) {
            throw new Exception(trans('links.messages.exceptions.not_found'), 1000);
        }

        if (!$this->linkRepository->deleteParentLinks($entity, $data['targetPlan'])) {
            throw new Exception(trans('links.messages.errors.deleted'), 1000);
        }

        $linkController = resolve(LinkController::class);
        $response = $linkController->linkPlan($entity->indicatorable()->first()->plan()->first()->id);

        $response->setData([
            'view' => $response->getData()->view,
            'message' => [
                'type' => 'success',
                'text' => trans('links.messages.success.deleted')
            ]
        ]);

        return $response;
    }

    /**
     * Obtiene información básica de un indicador de un plan
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws Throwable
     */
    public function getIndicatorInfo(Request $request)
    {
        $data = $request->all();

        $indicator = $this->planIndicatorRepository->find($data['indicatorId']);

        if (!$indicator) {
            throw new Exception(trans('plan_indicators.messages.exceptions.not_found'), 1000);
        }

        $route = '';
        $planElementProcess = resolve(PlanElementProcess::class);

        $planElementProcess->getRoute($data['parentId'], $route);

        $availablePlans = $this->planRepository->getAvailablePlansToLink($data['planType']);

        $response['view'] = view('business.planning.link.load_indicator_info', [
            'indicator' => $indicator,
            'route' => $route,
            'objectiveId' => $data['parentId'],
            'availablePlans' => $availablePlans,
            'childPlanName' => $data['childPlanName']
        ])->render();

        return $response;
    }

    /**
     * Muestra modal con la vista previa de las articulaciones realizadas
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function preview(Request $request)
    {
        $data = $request->all();

        $childIndicator = $this->planIndicatorRepository->find($data['childIndicator']);

        if (!$childIndicator) {
            throw new Exception(trans('plan_indicators.messages.exceptions.not_found'), 1000);
        }

        $route = '';
        $planElementProcess = resolve(PlanElementProcess::class);

        $planElementProcess->getRoute($data['objectiveId'], $route);

        $response['modal'] = view('business.planning.link.preview', [
            'childIndicator' => $childIndicator,
            'route' => $route,
            'parentIndicators' => isset($data['parentIndicators']) ? $data['parentIndicators'] : [],
            'childPlanName' => $data['childPlanName']
        ])->render();

        return $response;
    }

    /**
     * Carga tabla de articulaciones
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function loadPreviewTable(Request $request)
    {
        $data = $request->all();

        $dataTable = DataTables::of($this->planIndicatorRepository->getLinksInfo($data))
            ->setRowId('id')
            ->editColumn('goal_description', function (Collection $entity) {
                return Str::limit($entity['goal_description'], 200, '...');
            })
            ->make(true);

        return $dataTable;
    }


    /**
     * Genera estructura de articulaciónes de un plan mediante consultas eager loading
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function showPlanLinks(int $id)
    {
        $plan = $this->planRepository->find($id);

        if (!$plan) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $auxTabs = collect([]);

        // Reading possible plan links
        foreach (Plan::LINKS[$plan->type] as $linkType) {

            $linkedPlans = $this->planRepository->findByField('type', $linkType);

            $linksInfoCollection = collect();
            $linkedPlans->each(function ($linkedPlan) use (&$linksInfoCollection, $plan) {
                // Get full plan links structure using eager loading
                $linksInfoCollection->push($this->planRepository->getPlanStructureLinks($plan, $linkedPlan));
            });

            $linksInfoCollection->each(function ($linksInfo) use (&$auxTabs) {
                $objectives = collect([]);
                $hasThrusts = false;

                if ($linksInfo['planLinks']->planElements->count() && $linksInfo['planLinks']->planElements->first()->type == PlanElement::TYPE_THRUST) {
                    $hasThrusts = true;
                    $linksInfo['planLinks']->planElements->each(function ($thrust) use (&$objectives) {
                        $objectives = $objectives->merge($thrust->children);
                    });
                } else {
                    $objectives = $linksInfo['planLinks']->planElements;
                }

                // Reading each element to count its children and calculate the rowspans of the final table
                $objectives->each(function ($objective) use ($hasThrusts, $linksInfo) {
                    $objective->rowspan = 0;
                    $objective->indicators->each(function ($indicator) use (&$objective) {
                        $indicator->rowspan = $indicator->parentLinks->count() ?: 1;
                        $objective->rowspan += $indicator->parentLinks->count() ?: 1;
                    });

                    if ($hasThrusts) {
                        $thrust = $linksInfo['planLinks']->planElements->where('id', $objective->parent_id)->first();
                        if ($thrust->rowspan) {
                            $thrust->rowspan += $objective->rowspan ?: 1;
                        } else {
                            $thrust->rowspan = $objective->rowspan ?: 1;
                        }
                    }

                });

                // Final summary of plan elements rowspans
                $linksInfo['planLinks']->planElements->each(function ($planElement) use ($linksInfo) {
                    if ($linksInfo['planLinks']->rowspan) {
                        $linksInfo['planLinks']->rowspan += $planElement->rowspan ?: 1;
                    } else {
                        $linksInfo['planLinks']->rowspan = $planElement->rowspan ?: 1;
                    }
                });

                // Adding the modified structure to a new collection
                $auxTabs->push($linksInfo);
            });
        }

        $tabs = collect([]);

        // Reading each tab to build the table elements row by row
        $auxTabs->each(function ($auxTab) use (&$tabs) {

            $rows = collect([]);

            // Create an array of each elements with two attributes: text and rowspan that will be used to build the links table

            $info[] = ['text' => '<b>' . trans('plans.labels.vision') . ':</b> ' . $auxTab['planLinks']->vision, 'rowspan' => $auxTab['planLinks']->rowspan, 'planLink' => 1];
            $mainRowspan = $auxTab['planLinks']->rowspan;

            $lastObjective = null;
            $lastThrust = null;
            $linkedPlanVision = false;

            // Reading each plan element (thrust or objective)
            $auxTab['planLinks']->planElements->each(function ($planElement) use (
                &$info,
                &$rows,
                &$lastObjective,
                &$lastThrust,
                &$linkedPlanVision,
                $mainRowspan
            ) {

                $info[] = [
                    'text' => '<b>' . trans('plan_elements.labels.' . $planElement->type) . ':</b> ' . $planElement->code . ' - ' . $planElement->description,
                    'rowspan' => $planElement->rowspan,
                    'planLink' => 1
                ];

                if ($planElement->type === PlanElement::TYPE_THRUST) {
                    $planElement->children->each(function ($objective) use (&$info, &$rows, &$lastObjective, &$lastThrust, &$linkedPlanVision, $mainRowspan) {
                        $info[] = [
                            'text' => '<b>' . trans('plan_elements.labels.' . PlanElement::TYPE_OBJECTIVE) . ':</b> ' . $objective->code . ' - ' . $objective->description,
                            'rowspan' => $objective->rowspan,
                            'planLink' => 1
                        ];

                        // Process each objective with the same logic
                        self::processObjective(
                            $objective,
                            $info,
                            $rows,
                            $lastObjective,
                            $lastThrust,
                            $linkedPlanVision,
                            $mainRowspan
                        );
                    });
                } else {
                    self::processObjective(
                        $planElement,
                        $info,
                        $rows,
                        $lastObjective,
                        $lastThrust,
                        $linkedPlanVision,
                        $mainRowspan
                    );
                }

            });

            // Adding elements to a final collection
            $tabs->push(['rows' => $rows, 'linkedPlan' => $auxTab['linkedPlan']]);

        });
        if ($plan->type == Plan::TYPE_PND || $plan->type == Plan::TYPE_OTHER || $plan->type == Plan::TYPE_PDOT) {

            $colspan1 = 4;
            $colspan2 = 4;
        } else {

            $colspan1 = 3;
            $colspan2 = 5;
        }
        $response['view'] = view('business.planning.link.show_plan_links', [
            'tabs' => $tabs,
            'plan' => $plan,
            'colspan1' => $colspan1,
            'colspan2' => $colspan2
        ])->render();

        return $response;

    }

    /**
     * Procesa los objetivos de un plan para generar un arreglo con las filas que tendrá la tabla de articulaciones
     *
     * @param PlanElement $objective
     * @param array $info
     * @param Collection $rows
     * @param PlanElement|null $lastObjective
     * @param PlanElement|null $lastThrust
     * @param bool $linkedPlanVision
     * @param int $mainRowspan
     */
    private function processObjective(
        PlanElement $objective,
        array &$info,
        Collection &$rows,
        PlanElement &$lastObjective = null,
        PlanElement &$lastThrust = null,
        bool &$linkedPlanVision,
        int $mainRowspan
    ) {
        // Reading each objective indicator
        $objective->indicators->each(function ($indicator) use (
            &$info,
            &$rows,
            &$lastObjective,
            &$lastThrust,
            &$linkedPlanVision,
            $mainRowspan
        ) {
            $info[] = ['text' => '<b>' . trans('plan_elements.labels.' . PlanElement::TYPE_GOAL) . ':</b> ' . $indicator->goal_description, 'rowspan' => $indicator->rowspan, 'planLink' => 1];

            // Reading each indicator link
            $indicator->parentLinks->each(function ($linkedIndicator) use (
                &$info,
                &$rows,
                &$lastObjective,
                &$lastThrust,
                &$linkedPlanVision,
                $mainRowspan
            ) {

                $info[] = [
                    'text' => '<b>' . trans('plan_elements.labels.' . PlanElement::TYPE_GOAL) . ':</b> ' . $linkedIndicator->goal_description,
                    'rowspan' => $linkedIndicator->rowspan,
                    'planLink' => 0
                ];

                // Checks if the objetive changed
                if ($linkedIndicator->indicatorable != $lastObjective) {

                    if ($lastObjective) {
                        $row = $rows[$lastObjective->rowIndex];

                        if (isset($row['objective'])) {

                            $row['objective']['rowspan'] = $lastObjective->rowspan;

                            $rows->put($lastObjective->rowIndex, $row);
                        }
                    }

                    $lastObjective = $linkedIndicator->indicatorable;
                    $lastObjective->rowspan = 1;
                    $lastObjective->rowIndex = $rows->count();

                    $info['objective'] = [
                        'text' => '<b>' . trans('plan_elements.labels.' . PlanElement::TYPE_OBJECTIVE) . ':</b> ' . $lastObjective->code . ' - ' . $lastObjective->description,
                        'rowspan' => $lastObjective->rowspan,
                        'planLink' => 0
                    ];

                    // Building the linked plan section
                    if ($lastObjective->parent) {
                        // Checks if the thrust changed
                        if ($lastObjective->parent != $lastThrust) {

                            // Calculate the rowspan based on its children
                            if ($lastThrust) {
                                $row = $rows[$lastThrust->rowIndex];

                                if (isset($row['thrust'])) {

                                    $row['thrust']['rowspan'] = $lastThrust->rowspan;

                                    $rows->put($lastThrust->rowIndex, $row);
                                }
                            }

                            $lastThrust = $lastObjective->parent;
                            $lastThrust->rowspan = 1;
                            $lastThrust->rowIndex = $rows->count();

                            $info['thrust'] = [
                                'text' => '<b>' . trans('plan_elements.labels.' . PlanElement::TYPE_THRUST) . ':</b> ' . $lastThrust->code . ' - ' . $lastThrust->description,
                                'rowspan' => $lastThrust->rowspan,
                                'planLink' => 0
                            ];

                            // Adds the linked plan vision at the end of the table
                            if (!$linkedPlanVision) {
                                $info[] = [
                                    'text' => '<b>' . trans('plans.labels.vision') . ':</b> ' . $lastObjective->plan->vision,
                                    'rowspan' => $mainRowspan,
                                    'planLink' => 0
                                ];
                                $linkedPlanVision = true;
                            }

                        } else {
                            // Increments the rowspan on each iteration where the child does not change
                            $lastThrust->rowspan++;
                        }
                    } else {
                        // Adds the linked plan vision at the end of the table
                        if (!$linkedPlanVision) {
                            $info[] = [
                                'text' => '<b>' . trans('plans.labels.vision') . ':</b> ' . $lastObjective->plan->vision,
                                'rowspan' => $mainRowspan,
                                'planLink' => 0
                            ];
                            $linkedPlanVision = true;
                        }
                    }

                } else {
                    // Increments the rowspan on each iteration where the child does not change
                    $lastObjective->rowspan++;

                    if ($lastObjective->parent && $lastObjective->parent == $lastThrust) {
                        $lastThrust->rowspan++;
                    }
                }

                $rows->push($info);

                $info = [];
            });

            // Updating rowspan of the very last elements
            if ($lastObjective) {
                $row = $rows[$lastObjective->rowIndex];

                if (isset($row['objective'])) {

                    $row['objective']['rowspan'] = $lastObjective->rowspan;

                    $rows->put($lastObjective->rowIndex, $row);
                }
            }

            if ($lastThrust) {
                $row = $rows[$lastThrust->rowIndex];

                if (isset($row['thrust'])) {

                    $row['thrust']['rowspan'] = $lastThrust->rowspan;

                    $rows->put($lastThrust->rowIndex, $row);
                }
            }

        });
    }
}
