<?php

namespace App\Processes\Business\Execution;

use App\Models\Business\AdminActivity;
use App\Models\Business\Certification;
use App\Models\Business\Comment;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\System\Role;
use App\Processes\System\FileProcess;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\AdminActivityRepository;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\CommentRepository;
use App\Repositories\Repository\Business\Planning\ActivityProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\Reports\TrackingReportsRepository;
use App\Repositories\Repository\Business\Tracking\ReformRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use DateTime;
use Exception;
use Yajra\DataTables\DataTables;

/**
 * Clase CertificationProcess
 *
 * @package App\Processes\Business\Execution
 */
class CertificationProcess
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var ActivityProjectFiscalYearRepository
     */
    private $activityProjectFiscalYearRepository;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var TrackingReportsRepository
     */
    private $trackingReportsRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;


    /**
     * @var RettingRepository
     */
    private $reformRepository;

    /**
     * Constructor de PublicPurchaseProcess.
     *
     * @param UserRepository $userRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository
     * @param BudgetItemRepository $budgetItemRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param TrackingReportsRepository $trackingReportsRepository
     * @param SettingRepository $settingRepository
     * @param ReformRepository $reformRepository
     */

    public function __construct(
        UserRepository $userRepository,
        FiscalYearRepository $fiscalYearRepository,
        ActivityProjectFiscalYearRepository $activityProjectFiscalYearRepository,
        BudgetItemRepository $budgetItemRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        TrackingReportsRepository $trackingReportsRepository,
        SettingRepository $settingRepository,
        ReformRepository $reformRepository
    ) {
        $this->userRepository = $userRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->activityProjectFiscalYearRepository = $activityProjectFiscalYearRepository;
        $this->budgetItemRepository = $budgetItemRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->trackingReportsRepository = $trackingReportsRepository;
        $this->settingRepository = $settingRepository;
        $this->reformRepository = $reformRepository;
    }

    /**
     * Retorna información para formulario de creación de certificaciones
     *
     * @param int $projectId
     *
     * @return array
     */
    public function dataCreate(int $projectId): array
    {
        $activities = $this->activityProjectFiscalYearRepository->getActivitiesByProject($projectId);
        $project = $this->projectFiscalYearRepository->find($projectId);
        return [
            'activities' => $activities,
            'projectId' => $projectId,
            'project' => $project->project,
        ];
    }

    /**
     * Retorna información de partidas presupuestarias por actividad
     *
     * @param int $activityId
     * @param int|null $id
     *
     * @return mixed
     */
    public function items(int $activityId, int $id = null)
    {
        $items = $this->budgetItemRepository->findByField('activity_project_fiscal_year_id', $activityId);
        $budgetItems = collect([]);
        if ($id) {
            $certification = Certification::find($id);
            $certification->load('budgetItems');
            $budgetItems = $certification->budgetItems;
        }
        $accounts = $this->budgetItemRepository->budgetCardExpenses($this->fiscalYearRepository->findCurrentFiscalYear()->year, Carbon::now(), $items->pluck('code'));
        return $items->map(function ($item) use ($accounts, $budgetItems) {
            $itemRelated = $budgetItems->firstWhere('code', $item->code);
            if (!$itemRelated) {
                $item->setAttribute('certified', '');
            } else {
                $item->setAttribute('certified', $itemRelated->pivot->amount);
            }
            $itemRelated2 = $accounts->firstWhere('cuenta', $item->code);
            if (!$itemRelated2) {
                $item->setAttribute('for_compromising', '');
            } else {
                $item->setAttribute('for_compromising', $itemRelated2->por_comprometer);
            }
            return $item;
        });
    }

    /**
     * Retorna información para formulario de actualización de certificaciones
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function dataEdit(int $id): array
    {
        $entity = Certification::find($id);
        $provinceName = $this->settingRepository->findByKey('gad')->value['province'];
        $entity->load([
            'activity',
            'budgetItems',
        ]);
        return array_merge(self::dataCreate($entity->activity->projectFiscalYear->id),
            ['entity' => $entity, 'id' => $id, 'provinceName' => $provinceName]);
    }

    /**
     * Actualiza nueva certificación
     *
     * @param int $id
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function update(int $id, array $data)
    {
        $certification = Certification::find($id);
        self::processRequest($data);
        $certification->fill($data);
        $certification->save();
        $certification = $certification->fresh();
        $certification->budgetItems()->sync($data['items']);

        return $certification;
    }

    /**
     * Almacena nueva certificación
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function store(array $data)
    {
        self::processRequest($data);

        $certification = Certification::create($data);
        $certification->budgetItems()->attach($data['items']);

        return $certification;
    }

    /**
     * Almacena nueva certificación
     *
     * @param int $id
     * @param string $status
     *
     * @return mixed
     */
    public function status(int $id, string $status, int $user_id)
    {
        $certification = Certification::find($id);
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        if (!$currentFiscalYear) {
            throw new Exception(trans('reforms.messages.exceptions.fiscal_year_not_found'));
        }
        if ($status == Certification::STATUS_DIGITATED) {
            $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
            $reform = $this->reformRepository->createReformCertification($currentFiscalYear, $sfgprov->company_code, $this->sfgprov->user_code, $certification);
        }
        $certification->status = $status;
        $certification->user_id = $user_id;
        $certification->save();
        $certification = $certification->fresh();

        return $certification;
    }

    /**
     * @param array $data
     *
     * @throws Exception
     */
    private function processRequest(array &$data)
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!isset($data['id'])) {
            $data['number'] = Certification::where('fiscal_year_id', $fiscalYear->id)->get()->max('number') + 1;
            $data['user_id'] = currentUser()->id;
            $data['status'] = Certification::STATUS_DRAFT;
        } else {
            unset($data['number']);
            unset($data['user_id']);
            unset($data['status']);
        }

        $items = [];
        foreach ($data as $input => $value) {
            if (strpos($input, 'item_') !== false && $value) {
                $id = explode('_', $input)[1];
                $items[$id] = ['amount' => $value];
            }
        }

        $data['items'] = $items;
        $data['fiscal_year_id'] = $fiscalYear->id;
    }

    /**
     * Crear un datatable con la información pertinente de las certificaiones
     *
     * @param array $filters
     *
     * @return mixed
     * @throws Exception
     */
    public function data(array $filters = [])
    {
        $query = Certification::with('activity.projectFiscalYear.project');
        if (isset($filters['project_id'])) {
            $query->join('activity_project_fiscal_years', 'activity_project_fiscal_years.id', 'certifications.activity_id')
                ->join('project_fiscal_years', 'project_fiscal_years.id', 'activity_project_fiscal_years.project_fiscal_year_id')
                ->select('certifications.*')
                ->where('project_fiscal_years.id', $filters['project_id']);
        }
        if (isset($filters['status'])) {
            $query->whereIn('status', $filters['status']);
        }

        return DataTables::of($query->orderByDesc('number'))
            ->setRowId('id')
            ->addColumn('activity', function (Certification $entity) {
                return $entity->activity->name;
            })
            ->addColumn('project', function (Certification $entity) {
                return $entity->activity->projectFiscalYear->project->name;
            })
            ->editColumn('created_at', function (Certification $entity) {
                return date('Y-m-d H:i', strtotime($entity->created_at));
            })
            ->editColumn('status', function (Certification $entity) {
                return view('business.execution.certifications.partials.status', ['entity' => $entity]);
            })
            ->editColumn('created_at', function (Certification $entity) {
                return date('Y-m-d H:i', strtotime($entity->created_at));
            })
            ->addColumn('editable', function (Certification $entity) {
                if ($entity->status === Certification::STATUS_APPROVED ||
                    $entity->status === Certification::STATUS_DIGITATED ||
                    $entity->status === Certification::STATUS_TO_REVIEW
                ) {
                    return false;
                } else {
                    return true;
                }
            })
            ->rawColumns(['status', 'priority', 'date_init', 'date_end', 'photo'])
            ->make(true);
    }


    /**
     * Almacena un comentqrio de una certificación
     *
     * @param int $id
     * @param array $data
     *
     * @throws Exception
     */
    public function storeComment(int $id, array $data)
    {
        $entity = Certification::find($id);

        $data['user_id'] = currentUser()->id;

        $comment = new Comment;
        $comment->fill($data);
        $entity->comments()->save($comment);

        $entity->load([
            'comments' => function ($query) {
                $query->orderBy('created_at', 'desc')->with('user');
            }
        ]);

        return $entity;
    }

}
