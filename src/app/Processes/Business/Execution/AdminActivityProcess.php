<?php

namespace App\Processes\Business\Execution;

use App\Events\SendMailAfterUpdateActivity;
use App\Models\Business\AdminActivity;
use App\Models\Business\Comment;
use App\Models\System\Role;
use App\Processes\System\FileProcess;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\AdminActivityRepository;
use App\Repositories\Repository\Business\CommentRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use DateTime;
use Exception;
use Nexmo\Call\Event;
use Yajra\DataTables\DataTables;

/**
 * Clase AdminActivityProcess
 *
 * @package App\Processes\Business\Execution
 */
class AdminActivityProcess
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
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var AdminActivityRepository
     */
    private $adminActivityRepository;

    /**
     * @var FileProcess
     */
    private $fileProcess;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * Constructor de PublicPurchaseProcess.
     *
     * @param UserRepository $userRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param DepartmentRepository $departmentRepository
     * @param AdminActivityRepository $adminActivityRepository
     * @param FileProcess $fileProcess
     * @param CommentRepository $commentRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(
        UserRepository $userRepository,
        FiscalYearRepository $fiscalYearRepository,
        DepartmentRepository $departmentRepository,
        AdminActivityRepository $adminActivityRepository,
        FileProcess $fileProcess,
        CommentRepository $commentRepository,
        SettingRepository $settingRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->departmentRepository = $departmentRepository;
        $this->adminActivityRepository = $adminActivityRepository;
        $this->fileProcess = $fileProcess;
        $this->commentRepository = $commentRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Retorna información para formulario de creación de actividades administrativas
     *
     * @return array
     */
    public function dataCreate()
    {
        $user = currentUser();
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        $minDate = "01-01-{$fiscalYear->year}";
        $maxDate = "31-12-{$fiscalYear->year}";

        $adminActRoles = $this->settingRepository->findByKey('admin_act_roles');

        if ($user->hasRole($adminActRoles->value['roles'])) {
            $users = $this->userRepository->findVisible();
        } elseif ($user->getDepartmentInCharge()) {
            $users = $this->userRepository->findUsersByDepartment($user->getDepartmentInCharge()->id, ['users.id', 'users.first_name', 'users.last_name']);
        } else {
            $users = [$user];
        }

        $responsibleUnits = $this->departmentRepository->findEnabled();

        return [
            'minDate' => $minDate,
            'maxDate' => $maxDate,
            'users' => $users,
            'responsibleUnits' => $responsibleUnits
        ];
    }

    /**
     * Retorna información para formulario de actualización de actividades administrativas
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function dataEdit(int $id)
    {

        $entity = $this->adminActivityRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('admin_activities.messages.exceptions.not_found'), 1000);
        }
        $entity->load([
            'comments' => function ($query) {
                $query->orderBy('created_at', 'desc')->with('user');
            }
        ]);
        return array_merge(self::dataCreate(), ['entity' => $entity]);
    }

    /**
     * Almacena nueva actividad administrativa
     *
     * @param array $data
     *
     * @return mixed
     * @throws ModelException
     * @throws Exception
     */
    public function update(array $data)
    {

        $entity = $this->adminActivityRepository->find($data['id']);

        if (!$entity) {
            throw new Exception(trans('admin_activities.messages.exceptions.not_found'), 1000);
        }

        self::processRequest($data);

        $entity = $this->adminActivityRepository->updateFromArray($data, $entity);

        if ($entity->status && $entity->status == AdminActivity::STATUS_COMPLETED) {
            \event(new SendMailAfterUpdateActivity($entity));
        }
        return $entity;
    }

    /**
     * Almacena nueva actividad administrativa
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function store(array $data)
    {
        self::processRequest($data);

        if (isset($data['frequency']) && $data['frequency'] !== '0') {
            self::storeRecurrentActivity($data);
            return true;
        }

        return $this->adminActivityRepository->create($data);
    }

    /**
     * Almacena actividades administrativas recurrentes
     *
     * @param array $data
     */
    private function storeRecurrentActivity(array $data)
    {
        $dateUntil = Carbon::parse(isset($data['frequency_limit']) ? Carbon::parse($data['frequency_limit']) : Carbon::parse('31-12-' . now()->year));
        $dateActivity = isset($data['date_init']) ? Carbon::parse($data['date_init']) : now();
        while ($dateActivity->lte($dateUntil)) {
            $data['date_init'] = $dateActivity;
            $data['date_end'] = $dateActivity;

            $this->adminActivityRepository->create($data);

            switch ($data['frequency']) {
                case '1':
                    $dateActivity->addDays($data['frequency_number']);
                    if ($dateActivity->isSaturday()) {
                        $dateActivity->addDays(2);
                        break;
                    }
                    if ($dateActivity->isSunday()) {
                        $dateActivity->addDays(1);
                    }
                    break;
                case '2':
                    $dateActivity->addWeeks($data['frequency_number']);
                    break;
                case '3':
                    $dateActivity->addMonths($data['frequency_number']);
                    break;
            }
        }
    }

    /**
     * Procesa los datos del formulario
     *
     * @param array $data
     *
     * @throws Exception
     */
    public function processRequest(array &$data)
    {
        if (isset($data['assigned_user_id'])) {
            $user = $this->userRepository->find($data['assigned_user_id']);
            if (!$user) {
                throw new Exception(trans('admin_activities.messages.exceptions.user_assigned_not_found'), 1000);
            }

            $department = $user->departments()->first();
            if ($department) {
                $data['responsible_unit_id'] = $department->id;
            } else {
                throw new Exception(trans('admin_activities.messages.exceptions.department_not_found'), 1000);
            }

        } else {
            throw new Exception(trans('admin_activities.messages.exceptions.user_assigned_not_found'), 1000);
        }

        if (isset($data['check_list'])) {
            $data['check_list'] = json_decode($data['check_list']);
            foreach ($data['check_list'] as &$item) {
                unset($item->editing);
            }
            $data['check_list'] = json_encode($data['check_list']);
        } else {
            $data['check_list'] = json_encode([]);
        }

        if (isset($data['date_init'])) {
            $init = DateTime::createFromFormat('d-m-Y', $data['date_init']);
            $data['date_init'] = $init->format('Y-m-d');
        }

        if (isset($data['date_end'])) {
            $end = DateTime::createFromFormat('d-m-Y', $data['date_end']);
            $data['date_end'] = $end->format('Y-m-d');
        }

        if (!isset($data['id'])) {
            $data['created_by_id'] = currentUser()->id;
        }

        if (isset($data['status']) && $data['status'] != AdminActivity::STATUS_CANCELED) {
            $data['reason_id'] = null;
        }

        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        if (!$fiscalYear) {
            throw new Exception(trans('admin_activities.messages.exceptions.fiscal_year_not_found'), 1000);
        }
        $data['fiscal_year_id'] = $fiscalYear->id;
    }

    /**
     * Crear un datatable con la información pertinente de las actividades administrativas.
     *
     * @param array $filters
     *
     * @return mixed
     * @throws Exception
     */
    public function data(array $filters)
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        $user = currentUser();
        $departmentInCharge = $user->getDepartmentInCharge();
        $adminActRoles = $this->settingRepository->findByKey('admin_act_roles');
        $viewAll = $user->hasRole($adminActRoles->value['roles']);

        return DataTables::of($this->adminActivityRepository->findByUser($fiscalYear, $viewAll, $user->id, $filters, $departmentInCharge))
            ->setRowId('id')
            ->editColumn('photo', function (AdminActivity $entity) {
                return $entity->assigned ? view('business.execution.admin_activities.partial.photo', ['entity' => $entity]) : '';
            })
            ->editColumn('assigned_user_id', function (AdminActivity $entity) {
                return $entity->assigned ? $entity->assigned->fullName() : '';
            })
            ->editColumn('responsibleUnit', function (AdminActivity $entity) {
                return $entity->responsibleUnit ? $entity->responsibleUnit->name : '';
            })
            ->editColumn('name', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.name', ['entity' => $entity]);
            })
            ->editColumn('status', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.status', ['entity' => $entity]);
            })
            ->editColumn('priority', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.priority', ['entity' => $entity]);
            })
            ->editColumn('date_init', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.date_init', ['entity' => $entity]);
            })
            ->editColumn('date_end', function (AdminActivity $entity) {
                return view('business.execution.admin_activities.partial.date_end', ['entity' => $entity]);
            })
            ->rawColumns(['name', 'status', 'priority', 'date_init', 'date_end', 'photo'])
            ->make(true);
    }

    /**
     * Almacena los archivos
     *
     * @param int $id
     * @param array $data
     *
     * @return AdminActivity
     * @throws Exception
     */
    public function upload(int $id, array $data)
    {
        $entity = $this->adminActivityRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('admin_activities.messages.exceptions.not_found'), 1000);
        }

        $userId = currentUser()->id;
        if (isset($data['file'])) {
            $file['file'] = $data['file'];
            $file['name'] = $data['file']->getClientOriginalName();
            $file['user_id'] = $userId;
            $file['is_road'] = 0;
            storeFile($file, $entity);
        }
        return $entity->fresh();
    }

    /**
     * Elimina un archivo de actividad
     *
     * @param int $idActivity
     * @param int $idFile
     *
     * @return AdminActivity
     * @throws Exception
     */
    public function destroyFile(int $idActivity, int $idFile)
    {
        $entity = $this->adminActivityRepository->find($idActivity);

        if (!$entity) {
            throw new Exception(trans('admin_activities.messages.exceptions.not_found'), 1000);
        }
        $this->fileProcess->destroy($idFile);

        return $entity->fresh();
    }

    /**
     * Almacena un comentqrio de una actividad
     *
     * @param int $idActivity
     * @param array $data
     *
     * @return AdminActivity
     * @throws Exception
     */
    public function storeComment(int $idActivity, array $data)
    {
        $entity = $this->adminActivityRepository->find($idActivity);

        if (!$entity) {
            throw new Exception(trans('admin_activities.messages.exceptions.not_found'), 1000);
        }

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

    /**
     * Retorna data para gráfica de estados de actividad
     *
     * @return mixed
     */
    public function chart_1()
    {
        $user = currentUser();
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        $departmentInCharge = $user->getDepartmentInCharge();
        $viewAll = $user->hasRole(Role::ADMIN) || $user->hasRole(Role::PLANNER);

        return $this->adminActivityRepository->findGroupByStatus($fiscalYear, $viewAll, $user->id, $departmentInCharge);
    }

    /**
     * Retorna data para gráfica de prioridad de actividad
     *
     * @return mixed
     */
    public function chart_2()
    {
        $user = currentUser();
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        $departmentInCharge = $user->getDepartmentInCharge();
        $viewAll = $user->hasRole(Role::ADMIN) || $user->hasRole(Role::PLANNER);

        return $this->adminActivityRepository->findGroupByPriority($fiscalYear, $viewAll, $user->id, $departmentInCharge);
    }

    /**
     *  Obtiene data para gráfica de actividades por usuario
     *
     * @return mixed
     */
    public function chart_3()
    {
        $user = currentUser();
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        $departmentInCharge = $user->getDepartmentInCharge();
        $viewAll = $user->hasRole(Role::ADMIN) || $user->hasRole(Role::PLANNER);

        return $this->adminActivityRepository->findGroupByUser($fiscalYear, $viewAll, $user->id, $departmentInCharge);
    }

    /**
     * Obtiene las actividades administrativas para el calendario
     *
     * @return mixed
     */
    public function calendar()
    {
        $user = currentUser();
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        $departmentInCharge = $user->getDepartmentInCharge();
        $viewAll = $user->hasRole(Role::ADMIN) || $user->hasRole(Role::PLANNER);

        return $this->adminActivityRepository->findByUser($fiscalYear, $viewAll, $user->id, [], $departmentInCharge)->get();
    }
}