<?php

namespace App\Processes\Business\Execution;

use App\Models\Business\Plan;
use App\Models\Business\Tracking\Reform;
use App\Processes\Business\Planning\ProjectProcess;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\PlanRepository;
use App\Repositories\Repository\Business\Tracking\BudgetProjectTrackingRepository;
use App\Repositories\Repository\Business\Tracking\ReformRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\System\FileRepository;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ReformProcess
 * @package App\Processes\Business\Execution
 */
class ReformProcess
{
    public const OPERATION_REFORM_TYPE = 'RE';

    /**
     * @var ReformRepository
     */
    protected $reformRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var ProjectProcess
     */
    private $projectProcess;

    /**
     * @var BudgetProjectTrackingRepository
     */
    private $budgetProjectTrackingRepository;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    private $activityProjectFiscalYearRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var FileRepository
     */
    private $fileRepository;

    /**
     * @var PlanRepository
     */
    private $planRepository;

    /**
     * Constructor de ReformProcess.
     *
     * @param ReformRepository $reformRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param SettingRepository $settingRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     * @param ProjectProcess $projectProcess
     * @param BudgetProjectTrackingRepository $budgetProjectTrackingRepository
     * @param BudgetItemRepository $budgetItemRepository
     * @param DepartmentRepository $departmentRepository
     * @param FileRepository $fileRepository
     * @param PlanRepository $planRepository
     */
    public function __construct(
        ReformRepository $reformRepository,
        FiscalYearRepository $fiscalYearRepository,
        SettingRepository $settingRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        ProjectProcess $projectProcess,
        BudgetProjectTrackingRepository $budgetProjectTrackingRepository,
        BudgetItemRepository $budgetItemRepository,
        DepartmentRepository $departmentRepository,
        FileRepository $fileRepository,
        PlanRepository $planRepository
    ) {
        $this->reformRepository = $reformRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->settingRepository = $settingRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->projectProcess = $projectProcess;
        $this->budgetProjectTrackingRepository = $budgetProjectTrackingRepository;
        $this->budgetItemRepository = $budgetItemRepository;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->departmentRepository = $departmentRepository;
        $this->fileRepository = $fileRepository;
        $this->planRepository = $planRepository;
    }

    /**
     * Obtiene información necesaria para la pantalla inicial de reformas
     *
     * @return array
     */
    public function index()
    {
        $checkPEI = $this->planRepository->getPlans(Plan::TYPE_PEI)->count();

        return compact('checkPEI');
    }

    /**
     * Buscar información de una reforma presupuestaria
     *
     * @param string $companyCode
     * @param int $year
     * @param string $operationType
     * @param int $operationNumber
     *
     * @return array
     * @throws Exception
     */
    public function show(string $companyCode, int $year, string $operationType, int $operationNumber)
    {

        try {
            $minDate = "{$year}-01-01";
            $maxDate = "{$year}-12-31";
            $entity = $this->reformRepository->findReform($companyCode, $year, $operationType, $operationNumber, true);
            $file = $this->fileRepository->findBy('name', $companyCode . '_' . $year . '_' . $operationType . '_' . $operationNumber);
        } catch (Throwable $e) {
            throw  new Exception(trans('reforms.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity,
            'minDate' => $minDate,
            'maxDate' => $maxDate,
            'file' => $file
        ];
    }

    /**
     * Buscar información para creación de reformas presupuestarias
     *
     * @return array
     * @throws Throwable
     */
    public function create()
    {

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('reforms.messages.exceptions.fiscal_year_not_found'));
        }

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $reform = $this->reformRepository->createReform($currentFiscalYear, $sfgprov->company_code, $sfgprov->user_code);

        if (!isset($reform[0])) {
            throw new Exception(trans('reforms.messages.exceptions.create'));
        }

        $reform[0]->details = collect([]);
        $minDate = "{$currentFiscalYear->year}-01-01";
        $maxDate = "{$currentFiscalYear->year}-12-31";
        $pageView = Reform::TYPE_CREATE;

        return [
            'executingUnits' => $this->departmentRepository->all(),
            'reform' => $reform[0],
            'minDate' => $minDate,
            'maxDate' => $maxDate,
            'pageView' => $pageView
        ];
    }

    /**
     * Buscar información para edición de reformas presupuestarias
     *
     * @param string $companyCode
     * @param int $year
     * @param string $operationType
     * @param int $operationNumber
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $companyCode, int $year, string $operationType, int $operationNumber)
    {

        try {
            $minDate = "{$year}-01-01";
            $maxDate = "{$year}-12-31";
            $reform = $this->reformRepository->findReform($companyCode, $year, $operationType, $operationNumber, true);
            $pageView = Reform::TYPE_EDIT;
        } catch (Throwable $e) {
            throw new Exception(trans('reforms.messages.exceptions.update'));
        }

        return [
            'executingUnits' => $this->departmentRepository->all(),
            'reform' => $reform,
            'minDate' => $minDate,
            'maxDate' => $maxDate,
            'pageView' => $pageView
        ];
    }

    /**
     * Actualiza una reformas presupuestarias
     *
     * @param array $data
     *
     * @throws Exception
     * @throws Throwable
     */
    public function update(array $data)
    {
        if (!isset($data['reform'])) {
            throw new Exception(trans('reforms.messages.exceptions.update'));
        }

        $reform = $data['reform'];

        $reform['fec_mod'] = now()->format('Y-m-d');
        $reform['tot_deb'] = 0;
        $reform['tot_cre'] = 0;

        if (isset($reform['budget_items'])) {
            $reform['budget_items'] = collect($reform['budget_items']);

            if ($reform['incremen'] == ReformRepository::REFORMS_TYPE_INCREASE_1) {
                $reform['budget_items'] = $reform['budget_items']->map(function ($item) use (&$reform) {
                    $reform['tot_deb'] += $item['val_deb'];
                    $reform['tot_cre'] += $item['val_cre'];

                    $item['val_deb'] = $item['val_deb'] + $item['val_cre'];
                    $item['val_cre'] = 0;
                    return $item;
                });
            } elseif ($reform['incremen'] == ReformRepository::REFORMS_TYPE_DECREASE_2) {
                $reform['budget_items'] = $reform['budget_items']->map(function ($item) use (&$reform) {
                    $reform['tot_deb'] += abs($item['val_deb']) * -1;
                    $reform['tot_cre'] += abs($item['val_cre']) * -1;

                    $item['val_deb'] = (abs($item['val_deb']) + abs($item['val_cre'])) * -1;
                    $item['val_cre'] = 0;
                    return $item;
                });
            } else {
                $reform['tot_deb'] = $reform['budget_items']->sum('val_deb');
                $reform['tot_cre'] = $reform['budget_items']->sum('val_cre');
            }
        } else {
            $reform['budget_items'] = collect([]);
            $reform['tot_deb'] = 0;
            $reform['tot_cre'] = 0;
        }

        if (round($reform['tot_deb'], 2) == round($reform['tot_cre'], 2)) {
            $reform['estado'] = ReformRepository::OPERATION_STATE_SQUARE_2;
        } else {
            $reform['estado'] = ReformRepository::OPERATION_STATE_DRAFT_1;
        }

        if (!$reform['des_cab']) {
            $reform['des_cab'] = '';
        }

        $reform['periodo'] = date('n', strtotime($reform['fec_apr']));

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $this->reformRepository->updateReform($reform, $sfgprov->user_code);
    }

    /**
     * Desaprobar una reforma presupuestaria
     *
     * @param string $companyCode
     * @param int $year
     * @param string $operationType
     * @param int $operationNumber
     *
     * @return array
     * @throws Exception
     */
    public function disapprove(string $companyCode, int $year, string $operationType, int $operationNumber)
    {

        try {
            $response = [
                'success' => true,
                'items' => [],
                'message' => [
                    'type' => 'success',
                    'text' => trans('reforms.messages.success.disapproved')
                ]
            ];

            $entity = $this->reformRepository->findReform($companyCode, $year, $operationType, $operationNumber, true);

            $period = date('n', strtotime($entity->fec_apr));

            $accountingPeriod = $this->reformRepository->findAccountingPeriod($year, $companyCode, $period);

            if ($accountingPeriod[0]->estado == 2) {
                $response['success'] = false;
                $response['message'] = [
                    'type' => 'error',
                    'text' => trans('reforms.messages.exceptions.accounting_period_closed_disapproved')
                ];
                return $response;
            }

            if ($entity->incremen == ReformRepository::REFORMS_TYPE_TRANSFER_0) {
                $entity->details->each(function ($item) use (&$response) {
                    if ($item->val_deb and $item->val_deb > 0 and ($item->balance - $item->val_deb) < 0) {
                        $response['items'][] = $item;
                        $response['success'] = false;
                        $response['message'] = [
                            'type' => 'error',
                            'text' => trans('reforms.messages.exceptions.balance_disapproved')
                        ];
                    }
                });
            } elseif ($entity->incremen == ReformRepository::REFORMS_TYPE_INCREASE_1) {
                $entity->details->each(function ($item) use (&$response) {
                    if ($item->val_deb and $item->val_deb > 0 and ($item->balance - $item->val_deb) < 0) {
                        $response['items'][] = $item;
                        $response['success'] = false;
                        $response['message'] = [
                            'type' => 'error',
                            'text' => trans('reforms.messages.exceptions.balance_disapproved')
                        ];
                    }
                });
            }

            if (!$response['success']) {
                return $response;
            }

            $entity->estado = 2;
            $this->reformRepository->updateStatusReform($entity);

            $entity = $this->fileRepository->findBy('name', $companyCode . '_' . $year . '_' . $operationType . '_' . $operationNumber);

            if ($entity) {
                $this->fileRepository->destroy($entity->id);
            }

            return $response;
        } catch (Throwable $e) {
            throw  new Exception(trans('reforms.messages.exceptions.not_found'), 1000);
        }
    }

    /**
     * Aprobar una reforma presupuestaria
     *
     * @param string $companyCode
     * @param int $year
     * @param string $operationType
     * @param int $operationNumber
     * @param array $data
     *
     * @return array
     * @throws Exception
     */
    public function approve(string $companyCode, int $year, string $operationType, int $operationNumber, array $data)
    {
        try {

            $response = [
                'success' => true,
                'items' => [],
                'message' => [
                    'type' => 'success',
                    'text' => trans('reforms.messages.success.approved')
                ]
            ];

            $period = date('n', strtotime($data['approved_date']));

            $accountingPeriod = $this->reformRepository->findAccountingPeriod($year, $companyCode, $period);

            if (!count($accountingPeriod)) {
                $response['success'] = false;
                $response['message'] = [
                    'type' => 'error',
                    'text' => trans('reforms.messages.exceptions.accounting_period_not_exist')
                ];
                return $response;
            } elseif ($accountingPeriod[0]->estado == 2) {
                $response['success'] = false;
                $response['message'] = [
                    'type' => 'error',
                    'text' => trans('reforms.messages.exceptions.accounting_period_closed')
                ];
                return $response;
            }

            $entity = $this->reformRepository->findReform($companyCode, $year, $operationType, $operationNumber, true);

            if (!$entity->details->count()) {
                $response['success'] = false;
                $response['message'] = [
                    'type' => 'error',
                    'text' => trans('reforms.messages.exceptions.approve_not_details')
                ];
                return $response;
            }

            $totDebit = 0;
            $totCredit = 0;
            if ($entity->incremen == ReformRepository::REFORMS_TYPE_TRANSFER_0) {
                $entity->details->each(function ($item) use (&$response, &$totCredit, &$totDebit) {
                    $totCredit += $item->val_cre;
                    $totDebit += $item->val_deb;

                    if ($item->val_cre and $item->val_cre > 0 and ($item->balance - $item->val_cre) < 0) {
                        $response['items'][] = $item;
                        $response['success'] = false;
                        $response['message'] = [
                            'type' => 'error',
                            'text' => trans('reforms.messages.exceptions.balance')
                        ];
                    }
                });
            } elseif ($entity->incremen == ReformRepository::REFORMS_TYPE_DECREASE_2) {
                $entity->details->each(function ($item) use (&$response, &$totCredit, &$totDebit) {
                    if ($item->asociac == ReformRepository::BUDGET_ITEM_EXPENSE) {
                        $totCredit += $item->val_deb;
                    } else {
                        $totDebit += $item->val_deb;

                        if ($item->val_deb and ($item->balance - abs($item->val_deb)) < 0) {
                            $response['items'][] = $item;
                            $response['success'] = false;
                            $response['message'] = [
                                'type' => 'error',
                                'text' => trans('reforms.messages.exceptions.balance')
                            ];
                        }
                    }
                });
            } else {
                $entity->details->each(function ($item) use (&$totCredit, &$totDebit) {
                    if ($item->asociac == ReformRepository::BUDGET_ITEM_EXPENSE) {
                        $totCredit += $item->val_deb;
                    } else {
                        $totDebit += $item->val_deb;
                    }
                });
            }

            if (round($totCredit, 2) != round($totDebit, 2)) {
                $response['success'] = false;
                $response['message'] = [
                    'type' => 'error',
                    'text' => trans('reforms.messages.exceptions.approve')
                ];
            }

            if (!$response['success']) {
                return $response;
            }

            $entity->estado = ReformRepository::OPERATION_STATE_APPROVED_3;
            $entity->periodo = $period;
            $entity->fec_apr = $data['approved_date'];
            $entity->tot_deb = $totDebit;
            $entity->tot_cre = $totCredit;
            $this->reformRepository->updateStatusReform($entity);

            // save file
            $fileRepository = resolve(FileRepository::class);

            $fileName = $companyCode . '_' . $year . '_' . $operationType . '_' . $operationNumber;
            $file = [
                'user_id' => currentUser()->id,
                'name' => $fileName,
                'path' => $data['file']->store($year, 'reforms')
            ];

            $fileRepository->create($file);

            // update projects reform date
            $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

            if (!$currentFiscalYear) {
                throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'));
            }

            $projectFiscalYears = $this->projectFiscalYearRepository->findAllTraceableByCurrentUser($currentFiscalYear, false);

            $projectFiscalYears->each(function ($projectFiscalYear) use ($entity) {
                $update = false;
                $entity->details->each(function ($item) use (&$update, $projectFiscalYear) {
                    if (substr($item->cuenta, 3, 9) == $projectFiscalYear->project->getProgramSubProgramCode()) {
                        $update = true;
                    }
                });
                if ($update && !$projectFiscalYear->reform_date) {
                    $projectFiscalYear->reform_date = $entity->fec_apr;
                    $projectFiscalYear->save();
                }
            });

            return $response;
        } catch (Throwable $e) {
            Log::error($e);
            throw  new Exception(trans('reforms.messages.exceptions.not_found'), 1000);
        }
    }

    /**
     * Buscar proyectos por unidad responsable
     *
     * @param int $executingUnitId
     *
     * @return mixed
     * @throws Exception
     */
    public function projectsByExecutingUnit(int $executingUnitId)
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('reforms.messages.exceptions.fiscal_year_not_found'));
        }

        $projects = $this->projectFiscalYearRepository->findByExecutingUnit($currentFiscalYear, $executingUnitId)->get();

        $projects = $projects->map(function ($item) {
            $item->setAttribute('fullCode', $item->project->getProgramSubProgramCode());
            return $item;
        });

        return $projects;
    }

    /**
     * Buscar actividades por proyectos
     *
     * @param int $projectId
     *
     * @return mixed
     * @throws Exception
     */
    public function activitiesByProject(int $projectId)
    {
        return $this->activityProjectFiscalYearRepository->findByProjectFiscalYear($projectId);
    }

    /**
     * Crear un datatable con información de reformas.
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function data(array $data)
    {
        $user = currentUser();
        $actions = [];

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('reforms.messages.exceptions.fiscal_year_not_found'));
        }

        if ($user->can('show.reforms.reforms_reprogramming.execution')) {
            $actions['search'] = [
                'route' => 'show.reforms.reforms_reprogramming.execution',
                'tooltip' => trans('reforms.labels.show'),
                'btn_class' => 'btn-success'
            ];
        }

        if ($user->can('edit.reforms.reforms_reprogramming.execution')) {
            $actions['edit'] = [
                'route' => 'edit.reforms.reforms_reprogramming.execution',
                'tooltip' => trans('reforms.labels.edit'),
                'btn_class' => 'btn-warning'
            ];
        }

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $reforms = $this->reformRepository->getOperationByTypeAndYear($currentFiscalYear->year, self::OPERATION_REFORM_TYPE, $sfgprov->company_code, $data);

        return DataTables::of($reforms)
            ->editColumn('operation_number', function ($entity) {
                return $entity->operation_type . ' - ' . $entity->operation_number;
            })
            ->editColumn('state', function ($entity) {
                $class = $entity->state == ReformRepository::OPERATION_STATE_DRAFT ? 'danger' : ($entity->state == ReformRepository::OPERATION_STATE_SQUARE ? 'warning' : 'success');
                return "<span class='label label-{$class}'>{$entity->state}</span>";
            })
            ->editColumn('total_credit', function ($entity) {
                return number_format($entity->total_credit, 2);
            })
            ->editColumn('total_debit', function ($entity) {
                return number_format($entity->total_debit, 2);
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                if (isset($actions['search'])) {
                    $actions['search']['params'] = [
                        'companyCode' => $entity->company_code,
                        'year' => $entity->year,
                        'operationType' => $entity->operation_type,
                        'operationNumber' => $entity->operation_number
                    ];
                }

                if (isset($actions['edit']) and $entity->state != ReformRepository::OPERATION_STATE_APPROVED) {
                    $actions['edit']['params'] = [
                        'companyCode' => $entity->company_code,
                        'year' => $entity->year,
                        'operationType' => $entity->operation_type,
                        'operationNumber' => $entity->operation_number
                    ];
                } else {
                    unset($actions['edit']);
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions', 'state'])
            ->make(true);
    }

    /**
     * Crear un datatable con información de reformas.
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function dataBudgetItems(array $data)
    {

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('reforms.messages.exceptions.fiscal_year_not_found'));
        }

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $budgetItems = $this->reformRepository->findAllBudgetItems($currentFiscalYear->year, $sfgprov->company_code, $data);

        return DataTables::of($budgetItems)
            ->addColumn('description', function ($entity) {
                $labelDist = trans('reforms.labels.distributor');
                if ($entity->identifi == 2) {
                    $dist = '<br/> ' . "<strong>$labelDist: </strong>" . $entity->cuenta_p;
                } else {
                    $dist = '';
                }
                $cuenta = $entity->cuenta;
                if ($entity->is_new) {
                    return "<span class='label fs-sm label-warning'>$cuenta</span>" . ' <br/> ' . $entity->nom_cue . "$dist";
                }

                return $entity->cuenta . ' <br/> ' . $entity->nom_cue . "$dist";
            })
            ->addColumn('balance', function ($entity) {
                return number_format($entity->balance, 2);
            })
            ->addColumn('actions', function () {
                $tooltip = trans('reforms.messages.actions.select');
                return "<a href='#' class='btn btn-success btn-xs' data-toggle='tooltip' data-placement='top' data-original-title='$tooltip'><i class='fa fa-check'></i></a>";
            })
            ->rawColumns(['actions', 'description'])
            ->make(true);
    }

    /**
     * Buscar partida presupuestaria
     *
     * @param string $code
     *
     * @return Collection
     */
    public function searchItem(string $code)
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        return $this->budgetItemRepository->findByFiscalYearAndCode($currentFiscalYear, $code);

    }
}
