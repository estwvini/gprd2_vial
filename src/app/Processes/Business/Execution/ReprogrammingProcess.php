<?php

namespace App\Processes\Business\Execution;

use App\Models\Business\Plan;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Reprogramming;
use App\Models\System\Role;
use App\Processes\System\FileProcess;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\PlanRepository;
use App\Repositories\Repository\Business\ReprogrammingRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\DataTables\DataTables;

/**
 * Clase ReprogrammingProcess
 * @package App\Processes\Business\Execution
 */
class ReprogrammingProcess
{
    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var ReprogrammingRepository
     */
    private $reprogrammingRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var PlanRepository
     */
    private $planRepository;

    /**
     * Constructor de ReprogrammingProcess.
     *
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ReprogrammingRepository $reprogrammingRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param SettingRepository $settingRepository
     * @param PlanRepository $planRepository
     */
    public function __construct(
        FiscalYearRepository $fiscalYearRepository,
        ReprogrammingRepository $reprogrammingRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        SettingRepository $settingRepository,
        PlanRepository $planRepository
    ) {
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->reprogrammingRepository = $reprogrammingRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->settingRepository = $settingRepository;
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
     * Cargar información de proyectos
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('edit.reprogramming.reforms_reprogramming.execution')) {
            $actions['edit'] = [
                'route' => 'edit.reprogramming.reforms_reprogramming.execution',
                'tooltip' => trans('reprogramming.labels.edit')
            ];
        }

        if ($user->can('show.reprogramming.reforms_reprogramming.execution')) {
            $actions['search'] = [
                'route' => 'show.reprogramming.reforms_reprogramming.execution',
                'tooltip' => trans('reprogramming.labels.show')
            ];
        }

        if ($user->can('project.reprogramming.reforms_reprogramming.execution')) {
            $actions['refresh'] = [
                'route' => 'project.reprogramming.reforms_reprogramming.execution',
                'tooltip' => trans('reprogramming.labels.project_update'),
                'btn_class' => 'btn-warning'
            ];
        }

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'));
        }

        $dataTable = DataTables::of($this->reprogrammingRepository->findByFiscalYear($currentFiscalYear->id))
            ->setRowId('id')
            ->editColumn('status', function (Reprogramming $entity) {
                $status = trans('reprogramming.labels.status_' . $entity->status);
                $class = $entity->status == Reprogramming::STATUS_DRAFT ? 'warning' : 'success';

                return "<span class='label label-{$class}'>{$status}</span>";
            })
            ->editColumn('created_at', function (Reprogramming $entity) {
                return Carbon::parse($entity->created_at)->format('d-m-Y');
            })
            ->editColumn('approved_date', function (Reprogramming $entity) {
                if ($entity->approved_date) {
                    return Carbon::parse($entity->approved_date)->format('d-m-Y');
                }
                return '';
            })
            ->addColumn('project', function (Reprogramming $entity) {
                return $entity->projectFiscalYear->project ? $entity->projectFiscalYear->project->name : '';
            })
            ->addColumn('actions', function (Reprogramming $entity) use ($actions) {
                if ($entity->status == Reprogramming::STATUS_APPROVED) {
                    unset($actions['edit'], $actions['refresh']);
                }
                if (isset($actions['refresh'])) {
                    $actions['refresh']['params'] = [
                        'projectFiscalYearId' => $entity->projectFiscalYear->id
                    ];
                }
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(reprogramming.created_at,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->filterColumn('approved_date', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(reprogramming.approved_date,'%d-%m-%Y') like ?", ["%$keyword%"]);
            })
            ->rawColumns(['status', 'actions'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene información necesaria para el formulario de nueva reprogramación
     *
     * @return array
     * @throws Exception
     */
    public function create()
    {

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'));
        }

        return [$this->reprogrammingRepository->nextCode($currentFiscalYear->id), self::loadProjects($currentFiscalYear)];
    }

    /**
     * Obtiene información necesaria para el formulario de nueva reprogramación
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->reprogrammingRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('reprogramming.messages.exceptions.not_found'), 1000);
        }

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('project_tracking.messages.exceptions.fiscal_year_not_found'));
        }

        return [$entity, self::loadProjects($currentFiscalYear)];
    }

    /**
     * Obtiene información necesaria para el formulario de detalles de reprogramación
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function show(int $id)
    {
        $entity = $this->reprogrammingRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('reprogramming.messages.exceptions.not_found'), 1000);
        }

        return $entity;
    }

    /**
     * Obtiene los proyectos en ejecución sin reformas ejecutadas
     *
     * @param FiscalYear $currentFiscalYear
     *
     * @return Collection
     */
    public function loadProjects(FiscalYear $currentFiscalYear)
    {

        $filter = true;
        if (currentUser()->hasRole(Role::ADMIN) or currentUser()->hasRole(Role::PLANNER)) {
            $filter = false;
        }

        $projectFiscalYears = $this->projectFiscalYearRepository->findByFiscalYearFilterByUser($currentFiscalYear, $filter);

        $projectCodes = [];
        $projectFiscalYears->each(function ($projectFiscalYear) use (&$projectCodes) {
            $projectCodes[] = $projectFiscalYear->project->getProgramSubProgramCode();
        });

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $projectFiscalYears = $this->projectFiscalYearRepository->findProjectsWithReforms($sfgprov->company_code, $currentFiscalYear->year, $projectCodes,
            $projectFiscalYears, false);

        return $projectFiscalYears;
    }

    /**
     * Almacena una nueva reprogramación
     *
     * @param array $data
     *
     * @return mixed
     * @throws ModelException
     * @throws Exception
     */
    public function store(array $data)
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $data['status'] = Reprogramming::STATUS_DRAFT;
        $data['code'] = $this->reprogrammingRepository->nextCode($fiscalYear->id);

        $entity = $this->reprogrammingRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('reprogramming.messages.errors.create'), 1000);
        }

        $fileData = [
            'file' => $data['file'],
            'name' => Carbon::now()->timestamp . '_reprogramming_attachment_' . $entity->id
        ];

        storeFile($fileData, $entity);

        return $entity;
    }

    /**
     * Actualiza una reprogramación
     *
     * @param Request $request
     * @param int $id
     *
     * @return mixed
     * @throws ModelException
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {

        $data = $request->all();
        $entity = $this->reprogrammingRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('reprogramming.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->reprogrammingRepository->updateFromArray($data, $entity);

        if (!$entity) {
            throw new Exception(trans('reprogramming.messages.errors.update'), 1000);
        }

        if (isset($data['file']) && $data['file']) {
            $attachment = $entity->file();

            $fileData = [
                'file' => $data['file'],
                'name' => Carbon::now()->timestamp . '_reprogramming_attachment_' . $entity->id
            ];

            if ($attachment) {
                resolve(FileProcess::class)->destroy($attachment->id);
            }

            storeFile($fileData, $entity);
        }

        return $entity;
    }

    /**
     * Modificar el estado de una reprogramación
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function status(int $id)
    {
        $entity = $this->reprogrammingRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('reprogramming.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->reprogrammingRepository->updateFromArray([
            'status' => Reprogramming::STATUS_APPROVED,
            'approved_date' => now()->format('Y-m-d')
        ], $entity);

        if (!$entity) {
            throw new Exception(trans('reprogramming.messages.errors.update'), 1000);
        }

        return $entity;
    }
}
