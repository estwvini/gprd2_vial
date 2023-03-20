<?php

namespace App\Repositories\Repository\Business;

use App\Models\Admin\Department;
use App\Models\Business\AdminActivity;
use App\Models\Business\Planning\FiscalYear;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Exceptions\RepositoryException;
use DateTime;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Clase AdminActivityRepository
 *
 * @package App\Repositories\Repository\Business
 */
class AdminActivityRepository extends Repository
{

    /**
     * Constructor de TaskRepository.
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
     * Nombre del modelo de la clase
     *
     * @return mixed|string
     */
    function model()
    {
        return AdminActivity::class;
    }

    /**
     * Actualizar la entidad mediante un arreglo
     *
     * @param array $data
     * @param AdminActivity $entity
     *
     * @return mixed
     * @throws ModelException
     */
    public function updateFromArray(array $data, AdminActivity $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        $entity->fill($data);
        $entity->save();
        return $entity->fresh();
    }

    /**
     * Consulta base para obtener información de actividades administrativas
     *
     * @param FiscalYear $fiscalYear
     * @param Department $departmentInCharge
     * @param bool $viewAll
     * @param int $userId
     *
     * @return mixed
     */
    private function baseQuery(FiscalYear $fiscalYear, bool $viewAll, int $userId, Department $departmentInCharge = null)
    {
        return $this->model->join('fiscal_years', function ($join) use ($fiscalYear) {
            $join->on('fiscal_years.id', '=', 'admin_activities.fiscal_year_id')
                ->where('fiscal_years.id', '=', $fiscalYear->id);
        })->when(!$viewAll && $departmentInCharge, function ($query) use ($departmentInCharge) {
            $query->where('admin_activities.responsible_unit_id', $departmentInCharge->id);
        }, function ($query) use ($viewAll, $userId) {
            $query->when(!$viewAll, function ($query) use ($userId) {
                $query->where('admin_activities.assigned_user_id', $userId);
            });
        });
    }

    /**
     * Obtiene las actividades por usuario
     *
     * @param FiscalYear $fiscalYear
     * @param bool $viewAll
     * @param int $userId
     * @param array $filters
     * @param Department $departmentInCharge
     *
     * @return mixed
     */
    public function findByUser(FiscalYear $fiscalYear, bool $viewAll, int $userId, array $filters, Department $departmentInCharge = null)
    {
        return self::baseQuery($fiscalYear, $viewAll, $userId, $departmentInCharge)
            ->when(isset($filters['fiscal_year_id']), function ($query) use ($filters) {
                $query->where('fiscal_year_id', $filters['fiscal_year_id']);
            })
            ->when(isset($filters['responsible_unit_id']), function ($query) use ($filters) {
                $query->where('responsible_unit_id', $filters['responsible_unit_id']);
            })
            ->when(isset($filters['assigned_user_id']), function ($query) use ($filters) {
                $query->where('assigned_user_id', $filters['assigned_user_id']);
            })
            ->when(isset($filters['activity_type_id']), function ($query) use ($filters) {
                $query->where('activity_type_id', $filters['activity_type_id']);
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(isset($filters['priority']), function ($query) use ($filters) {
                $query->where('priority', $filters['priority']);
            })
            ->when(isset($filters['assigned_by_me']) and filter_var($filters['assigned_by_me'], FILTER_VALIDATE_BOOLEAN), function ($query) use ($filters, $userId) {
                $query->where('created_by_id', $userId);
            })
            ->orderBy('id', 'desc')->select('admin_activities.*');
    }

    /**
     * Obtiene cantidad de actividades por estado
     *
     * @param FiscalYear $fiscalYear
     * @param Department $departmentInCharge
     * @param bool $viewAll
     * @param int $userId
     */
    public function findGroupByStatus(FiscalYear $fiscalYear, bool $viewAll, int $userId, Department $departmentInCharge = null)
    {
        $first = self::baseQuery($fiscalYear, $viewAll, $userId, $departmentInCharge)->groupBy('status')
            ->selectRaw("case
                           when status = 'DRAFT' then 'Pendiente'
                           when status = 'COMPLETED' then 'Completada'
                           when status = 'CANCELED' then 'Cancelada'
                           when status = 'IN_PROGRESS' then 'En curso' end as status,
                        count(*) as                                         quantity");
        return self::baseQuery($fiscalYear, $viewAll, $userId, $departmentInCharge)->selectRaw("'Con retraso' as status,
                                                               SUM(if(date_end < now() and status != 'COMPLETED', 1, 0)) as count")
            ->orderBy('status')->union($first)->get();
    }

    /**
     * Obtiene cantidad de actividades por prioridad
     *
     * @param FiscalYear $fiscalYear
     * @param Department $departmentInCharge
     * @param bool $viewAll
     * @param int $userId
     */
    public function findGroupByPriority(FiscalYear $fiscalYear, bool $viewAll, int $userId, Department $departmentInCharge = null)
    {
        return self::baseQuery($fiscalYear, $viewAll, $userId, $departmentInCharge)->groupBy('priority')
            ->selectRaw("case
                           when priority = 4 then 'Urgente'
                           when priority = 3 then 'Importante'
                           when priority = 2 then 'Media'
                           when priority = 1 then 'Baja' end as priority,
                       SUM(if(status = 'DRAFT', 1, 0)) AS draft,
                       SUM(if(status = 'COMPLETED', 1, 0)) AS completed,
                       SUM(if(status = 'IN_PROGRESS', 1, 0)) AS in_progress,
                       SUM(if(status = 'CANCELED', 1, 0)) AS canceled,
                       SUM(if(date_end < now() and status != 'COMPLETED', 1, 0)) AS delay")->get();
    }

    /**
     * Obtiene cantidad de actividades por usuario
     *
     * @param FiscalYear $fiscalYear
     * @param Department $departmentInCharge
     * @param bool $viewAll
     * @param int $userId
     */
    public function findGroupByUser(FiscalYear $fiscalYear, bool $viewAll, int $userId, Department $departmentInCharge = null)
    {
        return self::baseQuery($fiscalYear, $viewAll, $userId, $departmentInCharge)
            ->join('users', 'users.id', 'admin_activities.assigned_user_id')
            ->selectRaw("CONCAT(users.first_name, ' ', users.last_name) as user,
                       SUM(if(status = 'DRAFT', 1, 0)) AS draft,
                       SUM(if(status = 'COMPLETED', 1, 0)) AS completed,
                       SUM(if(status = 'IN_PROGRESS', 1, 0)) AS in_progress,
                       SUM(if(status = 'CANCELED', 1, 0)) AS canceled,
                       SUM(if(date_end < now() and status != 'COMPLETED', 1, 0)) AS delay")
            ->groupBy('user')->get();
    }

    /**
     * Obtiene cantidad de actividades por unidad responsable
     *
     * @param FiscalYear $fiscalYear
     * @param bool $viewAll
     * @param int $userId
     * @param bool $includeAll
     * @param Department|null $departmentInCharge
     */
    public function findGroupByResponsibleUnit(FiscalYear $fiscalYear, bool $viewAll, int $userId, bool $includeAll, Department $departmentInCharge = null)
    {
        $query = self::baseQuery($fiscalYear, $viewAll, $userId, $departmentInCharge);
        if ($includeAll) {
            $query->rightJoin('departments', 'departments.id', 'admin_activities.responsible_unit_id');
        } else {
            $query->join('departments', 'departments.id', 'admin_activities.responsible_unit_id');
        }
        return $query
            ->selectRaw("departments.id as id,
                        departments.code as code,
                        departments.name as responsibleUnit,
                       SUM(if(status = 'DRAFT', 1, 0)) AS draft,
                       SUM(if(status = 'COMPLETED', 1, 0)) AS completed,
                       SUM(if(status = 'IN_PROGRESS', 1, 0)) AS in_progress,
                       SUM(if(status = 'CANCELED', 1, 0)) AS canceled,
                       SUM(if(date_end < now() and status != 'COMPLETED', 1, 0)) AS delay")
            ->groupBy('id', 'code', 'responsibleUnit')->get();
    }

    /**
     * Obtiene las actividades administrativas según filtros
     *
     * @param array $filters
     *
     * @return mixed
     */
    public function findAllByFilters(array $filters)
    {
        return $this->model
            ->when(isset($filters['fiscal_year_id']), function ($query) use ($filters) {
                $query->where('fiscal_year_id', $filters['fiscal_year_id']);
            })
            ->when(isset($filters['responsible_unit_id']), function ($query) use ($filters) {
                $query->where('responsible_unit_id', $filters['responsible_unit_id']);
            })
            ->when(isset($filters['assigned_user_id']), function ($query) use ($filters) {
                $query->where('assigned_user_id', $filters['assigned_user_id']);
            })
            ->when(isset($filters['activity_type_id']), function ($query) use ($filters) {
                $query->where('activity_type_id', $filters['activity_type_id']);
            })
            ->when(isset($filters['status']), function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(isset($filters['priority']), function ($query) use ($filters) {
                $query->where('priority', $filters['priority']);
            })->with(['assigned', 'responsibleUnit', 'activityType', 'comments']);
    }

    /**
     * Obtiene cantidad de actividades por prioridad
     *
     * @param FiscalYear $fiscalYear
     * @param bool $viewAll
     * @param int $userId
     * @param int $responsibleUnitId
     * @param Department|null $departmentInCharge
     */
    public function findGroupByPriorityAndResponsibleUnit(FiscalYear $fiscalYear, bool $viewAll, int $userId, int $responsibleUnitId, Department $departmentInCharge = null)
    {
        return self::baseQuery($fiscalYear, $viewAll, $userId, $departmentInCharge)->groupBy('priority')
            ->selectRaw("case
                           when priority = 4 then 'Urgente'
                           when priority = 3 then 'Importante'
                           when priority = 2 then 'Media'
                           when priority = 1 then 'Baja' end as priority,
                       SUM(if(status = 'DRAFT', 1, 0)) AS draft,
                       SUM(if(status = 'COMPLETED', 1, 0)) AS completed,
                       SUM(if(status = 'IN_PROGRESS', 1, 0)) AS in_progress,
                       SUM(if(status = 'CANCELED', 1, 0)) AS canceled,
                       SUM(if(date_end < now() and status != 'COMPLETED', 1, 0)) AS delay")
            ->where('responsible_unit_id', $responsibleUnitId)->get();
    }

    /**
     * Obtiene las actividades administrativas según filtros
     *
     * @param array $filters
     *
     * @return mixed
     */
    public function findAllByFiltersWithFiles(array $filters)
    {
        return $this->findAllByFilters($filters)
            ->when(isset($filters['date_init']), function ($query) use ($filters) {
                $query->where('date_init', '>=', DateTime::createFromFormat('!d-m-Y', $filters['date_init']));
            })
            ->when(isset($filters['date_end']), function ($query) use ($filters) {
                $query->where('date_end', '<=', DateTime::createFromFormat('!d-m-Y', $filters['date_end']));
            })->with('files');
    }
}