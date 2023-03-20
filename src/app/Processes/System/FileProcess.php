<?php

namespace App\Processes\System;

use App\Models\Business\Component;
use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\Planning\OperationalGoal;
use App\Models\Business\Project;
use App\Models\Business\Reprogramming;
use App\Models\Business\Task;
use App\Models\Business\Tracking\Operation;
use App\Models\System\File;
use App\Repositories\Repository\System\FileRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\JustificationRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Business\ComponentRepository;
use App\Repositories\Repository\Business\PlanRepository;

/**
 * Clase FileProcess
 * @package App\Processes\System
 */
class FileProcess
{
    /**
     * @var FileRepository
     */
    protected $fileRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var PlanIndicatorRepository
     */
    private $planIndicatorRepository;

    /**
     * @var JustificationRepository
     */
    private $justificationRepository;

    /**
     * @var PlanElementRepository
     */
    protected $planElementRepository;

    /**
     * @var ProjectRepository
     */
    protected $projectRepository;

    /**
     * @var ComponentRepository
     */
    protected $componentRepository;

    /**
     * @var PlanRepository
     */
    protected $planRepository;

    /**
     * Constructor de FileProcess.
     *
     * @param FileRepository $fileRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param PlanIndicatorRepository $planIndicatorRepository
     * @param JustificationRepository $justificationRepository
     * @param PlanElementRepository $planElementRepository
     * @param ProjectRepository $projectRepository
     * @param ComponentRepository $componentRepository
     * @param PlanRepository $planRepository
     */
    public function __construct(
        FileRepository $fileRepository,
        FiscalYearRepository $fiscalYearRepository,
        PlanIndicatorRepository $planIndicatorRepository,
        JustificationRepository $justificationRepository,
        PlanElementRepository $planElementRepository,
        ProjectRepository $projectRepository,
        ComponentRepository $componentRepository,
        PlanRepository $planRepository
    )
    {
        $this->fileRepository = $fileRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->planIndicatorRepository = $planIndicatorRepository;
        $this->justificationRepository = $justificationRepository;
        $this->planElementRepository = $planElementRepository;
        $this->projectRepository = $projectRepository;
        $this->componentRepository = $componentRepository;
        $this->planRepository = $planRepository;
    }

    /**
     * Cargar información de archivos anexos por plan.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataPlans(Request $request)
    {
        $user = currentUser();
        $actions = [];

        if ($request->plansSelect && $request->optionPlansSelect == FILE::FILTER_ZERO) {

            if ($user->can('download_attachments.index.files')) {
                $actions['cloud-download'] = [
                    'route' => 'download_attachments.index.files',
                    'tooltip' => trans('files.labels.download'),
                    'btn_class' => 'btn-success',
                    'no_ajax' => true
                ];
            }

            $query = $this->fileRepository->findJustificationsByPlanId($request->plansSelect);

            $dataTable = DataTables::of($query)
                ->setRowId('id')
                ->editColumn('name', function (File $entity) {
                    return $entity->name;
                })
                ->editColumn('created_at', function (File $entity) {
                    Carbon::setLocale(config('app.locale'));
                    return $entity->created_at->format('d/M/Y');
                })
                ->addColumn('user', function ($entity) {
                    return $entity->user->fullName();
                })
                ->addColumn('actions', function (File $entity) use ($actions) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                })
                ->rawColumns(['name', 'actions'])
                ->make(true);

            return $dataTable;

        } elseif ($request->optionPlansSelect && $request->strategicObjectivesPlansSelect == FILE::FILTER_ZERO) {

            if ($request->optionPlansSelect == FILE::FILTER_ONE || $request->optionPlansSelect == FILE::FILTER_THREE) {
                if ($user->can('download_indicators.index.files')) {
                    $actions['cloud-download'] = [
                        'route' => 'download_indicators.index.files',
                        'tooltip' => trans('files.labels.download'),
                        'btn_class' => 'btn-success',
                        'no_ajax' => true
                    ];
                }
            } else {
                if ($user->can('download_justifications.index.files')) {
                    $actions['cloud-download'] = [
                        'route' => 'download_justifications.index.files',
                        'tooltip' => trans('files.labels.download'),
                        'btn_class' => 'btn-success',
                        'no_ajax' => true
                    ];
                }
            }

            if ($request->optionPlansSelect && $request->plansSelect) {
                switch ($request->optionPlansSelect) {
                    case 1:
                        $query = $this->planIndicatorRepository->findIndicatorsByIdPlan(PlanElement::class, $request->plansSelect);
                        break;
                    case 2:
                        $query = $this->justificationRepository->findJustificationsByPlanId(Plan::class, $request->plansSelect);
                        break;
                    case 3:
                        $query = $this->planIndicatorRepository->findIndicatorsByIdPlanOperational(OperationalGoal::class, $request->plansSelect);
                        break;
                }
            } else {
                switch ($request->optionPlansSelect) {
                    case 1:
                        $query = $this->planIndicatorRepository->findAllIndicatorsPlan(PlanElement::class);
                        break;
                    case 2:
                        $query = $this->justificationRepository->findJustificationsAllPlan(Plan::class);
                        break;
                    case 3:
                        $query = $this->planIndicatorRepository->findAllIndicatorsPlanOperational(OperationalGoal::class);
                        break;
                }
            }

            $dataTable = DataTables::of($query)
                ->setRowId('id')
                ->editColumn('created_at', function ($entity) {
                    Carbon::setLocale(config('app.locale'));
                    return $entity->created_at->format('d/M/Y');
                })
                ->addColumn('user', function ($entity) {
                    return $entity->user->fullName();
                })
                ->addColumn('actions', function ($entity) use ($actions) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                })
                ->rawColumns(['name', 'actions'])
                ->make(true);

            return $dataTable;

        } elseif ($request->strategicObjectivesPlansSelect) {

            if ($user->can('download_indicators.index.files')) {
                $actions['cloud-download'] = [
                    'route' => 'download_indicators.index.files',
                    'tooltip' => trans('files.labels.download'),
                    'btn_class' => 'btn-success',
                    'no_ajax' => true
                ];
            }
            if ($request->plansSelect && $request->operationalGoalsPlansSelect == FILE::FILTER_ZERO) {
                $query = $this->planIndicatorRepository->findIndicatorsByIdPlanOperational(OperationalGoal::class, $request->plansSelect, $request->strategicObjectivesPlansSelect);
            } elseif ($request->operationalGoalsPlansSelect && $request->yearsPlansSelect == FILE::FILTER_ZERO) {
                $query = $this->planIndicatorRepository->findIndicatorsByIdPlanOperational(OperationalGoal::class, $request->plansSelect, $request->strategicObjectivesPlansSelect, $request->operationalGoalsPlansSelect);
            } elseif ($request->yearsPlansSelect) {
                $query = $this->planIndicatorRepository->findIndicatorsByIdPlanOperational(OperationalGoal::class, $request->plansSelect, $request->strategicObjectivesPlansSelect, $request->operationalGoalsPlansSelect, $request->yearsPlansSelect);
            } else {
                $query = $this->planIndicatorRepository->findIndicatorsByIdPlanOperational(OperationalGoal::class, null, $request->strategicObjectivesPlansSelect);
            }

            $dataTable = DataTables::of($query)
                ->setRowId('id')
                ->editColumn('created_at', function ($entity) {
                    Carbon::setLocale(config('app.locale'));
                    return $entity->created_at->format('d/M/Y');
                })
                ->addColumn('user', function ($entity) {
                    return $entity->user->fullName();
                })
                ->addColumn('actions', function ($entity) use ($actions) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                })
                ->rawColumns(['name', 'actions'])
                ->make(true);

            return $dataTable;

        } else {

            if ($user->can('download_attachments.index.files')) {
                $actions['cloud-download'] = [
                    'route' => 'download_attachments.index.files',
                    'tooltip' => trans('files.labels.download'),
                    'btn_class' => 'btn-success',
                    'no_ajax' => true
                ];
            }

            $query = $this->fileRepository->findAllFilesProjects();

            $dataTable = DataTables::of($query)
                ->setRowId('id')
                ->editColumn('name', function (File $entity) {
                    return $entity->name;
                })
                ->editColumn('created_at', function (File $entity) {
                    Carbon::setLocale(config('app.locale'));
                    return $entity->created_at->format('d/M/Y');
                })
                ->addColumn('user', function ($entity) {
                    return $entity->user->fullName();
                })
                ->addColumn('actions', function (File $entity) use ($actions) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                })
                ->rawColumns(['name', 'actions'])
                ->make(true);

            return $dataTable;
        }
    }

    /**
     * Cargar información de archivos anexos por proyecto.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataProjects(Request $request)
    {
        $user = currentUser();
        $actions = [];

        if ($request->projectsProjectsSelect && $request->componentsProjectsSelect == FILE::FILTER_ZERO) {

            if ($user->can('download_attachments.index.files')) {
                $actions['cloud-download'] = [
                    'route' => 'download_attachments.index.files',
                    'tooltip' => trans('files.labels.download'),
                    'btn_class' => 'btn-success',
                    'no_ajax' => true
                ];
            }

            $query = $this->fileRepository->findFilesByIdProject($request->projectsProjectsSelect);

            $dataTable = DataTables::of($query)
                ->setRowId('id')
                ->editColumn('created_at', function ($entity) {
                    Carbon::setLocale(config('app.locale'));
                    return $entity->created_at->format('d/M/Y');
                })
                ->addColumn('user', function ($entity) {
                    return $entity->user->fullName();
                })
                ->addColumn('actions', function ($entity) use ($actions) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                })
                ->rawColumns(['name', 'actions'])
                ->make(true);

            return $dataTable;

        } elseif ($request->componentsProjectsSelect) {

            if ($request->componentsProjectsSelect == FILE::FILTER_ONE) {
                if ($user->can('download_justifications.index.files')) {
                    $actions['cloud-download'] = [
                        'route' => 'download_justifications.index.files',
                        'tooltip' => trans('files.labels.download'),
                        'btn_class' => 'btn-success',
                        'no_ajax' => true
                    ];
                }
            } else {
                if ($user->can('download_indicators.index.files')) {
                    $actions['cloud-download'] = [
                        'route' => 'download_indicators.index.files',
                        'tooltip' => trans('files.labels.download'),
                        'btn_class' => 'btn-success',
                        'no_ajax' => true
                    ];
                }
            }
            switch ($request->componentsProjectsSelect) {
                case 1:
                    if ($request->projectsProjectsSelect) {
                        $query = $this->justificationRepository->findJustificationsByIdProjects(Project::class, $request->projectsProjectsSelect);
                    } else {
                        $query = $this->justificationRepository->findAllJustificationsProjects(Project::class);
                    }
                    break;
                case 2:
                    if ($request->projectsProjectsSelect) {
                        $query = $this->planIndicatorRepository->findIndicatorsByIdProject(Project::class, $request->projectsProjectsSelect);
                    } else {
                        $query = $this->planIndicatorRepository->findAllIndicatorsProject(Project::class);
                    }
                    break;
                case 3:
                    if ($request->projectsProjectsSelect) {
                        $query = $this->planIndicatorRepository->findIndicatorsByIdProject(Component::class, $request->projectsProjectsSelect);
                    } else {
                        $query = $this->planIndicatorRepository->findAllIndicatorsProject(Component::class);
                    }
                    break;
            }

            $dataTable = DataTables::of($query)
                ->setRowId('id')
                ->editColumn('created_at', function ($entity) {
                    Carbon::setLocale(config('app.locale'));
                    return $entity->created_at->format('d/M/Y');
                })
                ->addColumn('user', function ($entity) {
                    return $entity->user->fullName();
                })
                ->addColumn('actions', function ($entity) use ($actions) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                })
                ->rawColumns(['name', 'actions'])
                ->make(true);

            return $dataTable;

        } else {

            if ($user->can('download_attachments.index.files')) {
                $actions['cloud-download'] = [
                    'route' => 'download_attachments.index.files',
                    'tooltip' => trans('files.labels.download'),
                    'btn_class' => 'btn-success',
                    'no_ajax' => true
                ];
            }

            $query = $this->fileRepository->findAllFilesProjects();

            $dataTable = DataTables::of($query)
                ->setRowId('id')
                ->editColumn('name', function (File $entity) {
                    return $entity->name;
                })
                ->editColumn('created_at', function (File $entity) {
                    Carbon::setLocale(config('app.locale'));
                    return $entity->created_at->format('d/M/Y');
                })
                ->addColumn('user', function ($entity) {
                    return $entity->user->fullName();
                })
                ->addColumn('actions', function (File $entity) use ($actions) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                })
                ->rawColumns(['name', 'actions'])
                ->make(true);

            return $dataTable;
        }

    }

    /**
     * Cargar información de archivos anexos (ajustes) por proyecto.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function dataTracking(Request $request)
    {
        $user = currentUser();
        $actions = [];

        if ($request->componentsTrackingSelect) {

            if ($request->componentsTrackingSelect == FILE::FILTER_ONE) {
                if ($user->can('download_justifications.index.files')) {
                    $actions['cloud-download'] = [
                        'route' => 'download_justifications.index.files',
                        'tooltip' => trans('files.labels.download'),
                        'btn_class' => 'btn-success',
                        'no_ajax' => true
                    ];
                }
            } elseif ($request->componentsTrackingSelect == FILE::FILTER_TWO || $request->componentsTrackingSelect == FILE::FILTER_FOUR) {
                if ($user->can('download_attachments.index.files')) {
                    $actions['cloud-download'] = [
                        'route' => 'download_attachments.index.files',
                        'tooltip' => trans('files.labels.download'),
                        'btn_class' => 'btn-success',
                        'no_ajax' => true
                    ];
                }
            } else {
                if ($user->can('download_reforms.index.files')) {
                    $actions['cloud-download'] = [
                        'route' => 'download_reforms.index.files',
                        'tooltip' => trans('files.labels.download'),
                        'btn_class' => 'btn-success',
                        'no_ajax' => true
                    ];
                }
            }

            switch ($request->componentsTrackingSelect) {
                case 1:
                    $query = $this->justificationRepository->findAllJustificationsTracking(Operation::class);
                    break;
                case 2:
                    if ($request->projectsTrackingSelect) {
                        $query = $this->fileRepository->findFilesByIdTracking(Task::class, $request->projectsTrackingSelect);
                    } else {
                        $query = $this->fileRepository->findAllFilesTracking(Task::class);
                    }
                    break;
                case 3:
                    $query = $this->fileRepository->findAllTrackingReforms();
                    break;
                case 4:
                    $query = $this->fileRepository->findAllTrackingReprogramming(Reprogramming::class);
                    break;
            }

            $dataTable = DataTables::of($query)
                ->setRowId('id')
                ->editColumn('created_at', function ($entity) {
                    Carbon::setLocale(config('app.locale'));
                    return $entity->created_at->format('d/M/Y');
                })
                ->addColumn('user', function ($entity) {
                    return $entity->user->fullName();
                })
                ->addColumn('actions', function ($entity) use ($actions) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                })
                ->rawColumns(['name', 'actions'])
                ->make(true);

            return $dataTable;

        } else {

            if ($user->can('download_justifications.index.files')) {
                $actions['cloud-download'] = [
                    'route' => 'download_justifications.index.files',
                    'tooltip' => trans('files.labels.download'),
                    'btn_class' => 'btn-success',
                    'no_ajax' => true
                ];
            }

            $query = $this->justificationRepository->findAllJustificationsTracking(Operation::class);

            $dataTable = DataTables::of($query)
                ->setRowId('id')
                ->editColumn('created_at', function ($entity) {
                    Carbon::setLocale(config('app.locale'));
                    return $entity->created_at->format('d/M/Y');
                })
                ->addColumn('user', function ($entity) {
                    return $entity->user->fullName();
                })
                ->addColumn('name', function ($entity) {
                    return $entity->description;
                })
                ->addColumn('actions', function ($entity) use ($actions) {
                    return view('layout.partial.actions_tooltip', [
                        'entity' => $entity,
                        'actions' => $actions
                    ]);
                })
                ->rawColumns(['name', 'actions'])
                ->make(true);

            return $dataTable;
        }

    }

    /**
     * Almacenar nuevo archivo.
     *
     * @param Request $request
     *
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $entity = $this->fileRepository->createFromArray($this->normalizeData($data));

        if (!$entity) {
            throw new Exception(trans('files.messages.errors.create'), 1000);
        }
    }

    /**
     * Almacenar nuevo archivo.
     *
     * @param array $data
     * @param Model $model
     *
     * @return mixed
     * @throws Exception
     */
    public function storeGlobal(array $data, Model $model)
    {
        $entity = $this->fileRepository->createFromArrayGlobal($this->normalizeDataGlobal($data, $model), $model);

        if (!$entity) {
            throw new Exception(trans('files.messages.errors.create'), 1000);
        }

        return $entity;
    }

    /**
     * Actualizar la información de archivo.
     *
     * @param Request $request
     * @param int $id
     *
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $entity = $this->fileRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();

        // remove old file from server
        if (isset($data['file']) && Storage::disk('files')->exists($entity->path)) {
            Storage::disk('files')->delete($entity->path);
        }

        $entity = $this->fileRepository->updateFromArray($this->normalizeData($request->all(), $entity), $entity);

        if (!$entity) {
            throw new Exception(trans('files.messages.errors.update'), 1000);
        }
    }

    /**
     * Eliminar lógicamente un archivo.
     *
     * @param int $id
     *
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->fileRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        if (!$this->fileRepository->destroy($entity->id)) {
            throw new Exception(trans('files.messages.errors.delete'), 1000);
        }
    }

    /**
     * Normalizar la información para almacenar en la BD.
     *
     * @param array $data
     * @param File|null $file
     *
     * @return array
     */
    private function normalizeData(array $data, File $file = null)
    {
        if (isset($file)) {
            $data['user_id'] = $file->user_id;
            $data['fileable_type'] = $file->fileable_type;
            $data['fileable_id'] = $file->fileable_id;
        }

        if (!isset($data['user_id'])) {
            $data['user_id'] = currentUser()->id;
        }
        if (!isset($data['fileable_type'])) {
            $data['fileable_type'] = 'files';
        }
        if (!isset($data['fileable_id'])) {
            $data['fileable_id'] = 1;
        }

        // upload file
        if (isset($data['file'])) {
            $data['path'] = $data['file']->store($data['fileable_type'] . '/' . $data['fileable_id'], 'files');
            unset($data['file']);
        }

        return $data;
    }

    /**
     * Normalizar la información para almacenar en la BD.
     *
     * @param array $data
     * @param Model $model
     *
     * @return array
     */
    private function normalizeDataGlobal(array $data, Model $model)
    {
        // upload file
        if (isset($data['file'])) {
            $data['path'] = $data['file']->store(with($model)->getTable() . '/' . $model->id, 'files');
            unset($data['file']);
        }

        $data['user_id'] = currentUser()->id;

        return $data;
    }

    /**
     * Descargar un archivo.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function download(int $id)
    {
        $entity = $this->fileRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        if (!Storage::disk('files')->exists($entity->path)) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        return Storage::disk('files')->download($entity->path);
    }

    /**
     * Descargar un archivo.
     *
     * @param string $name
     * @param string $disk
     *
     * @return mixed
     * @throws Exception
     */
    public function downloadByName(string $name, string $disk)
    {
        $entity = $this->fileRepository->findBy('name', $name);

        if (!$entity) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        if (!Storage::disk($disk)->exists($entity->path)) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        return Storage::disk($disk)->download($entity->path, $entity->name . '.' . pathinfo($entity->path, PATHINFO_EXTENSION));
    }

    /**
     * Cargar data necesaria para las vistas.
     *
     * @return array
     *
     * @throws Exception
     */
    public function documentsRepository()
    {

        $years = $this->fiscalYearRepository->all();
        if (!$years) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        $allPlans = $this->planRepository->exceptODSPND();
        $allProjects = $this->projectRepository->findAll();

        $findAllPlansOperational = $this->planElementRepository->findAllStrategic();

        return [
            'years' => $years,
            'allProjects' => $allProjects,
            'allPlans' => $allPlans,
            'findAllPlansOperational' => $findAllPlansOperational
        ];
    }
}