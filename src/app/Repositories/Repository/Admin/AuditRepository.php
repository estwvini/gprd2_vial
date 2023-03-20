<?php

namespace App\Repositories\Repository\Admin;

use Altek\Accountant\Models\Ledger;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

/**
 * Clase AuditRepository
 * @package App\Repositories\Repository\Admin
 */
class AuditRepository extends Repository
{

    /**
     * Constructor de AuditRepository.
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
     * Nombre del modelo de la clase.
     *
     * @return mixed|string
     */
    function model()
    {
        return Ledger::class;
    }

    /**
     * Obtiene todos los registros de actividades de los usuarios
     *
     * @param array $filters
     *
     * @return mixed
     */
    public function getAllWith(array $filters)
    {
        return $this->model
            ->when(isset($filters['department_id']), function ($query) use ($filters) {
                $query->join('users', 'ledgers.user_id', 'users.id')
                    ->join('department_has_users', 'department_has_users.user_id', 'users.id')
                    ->where('department_has_users.department_id', $filters['department_id']);
            })
            ->when(isset($filters['user_id']), function ($query) use ($filters) {
                $query->where('user_id', $filters['user_id']);
            })
            ->orderBy('created_at', 'desc')->with('user')
            ->with('user')
            ->select('ledgers.*');
    }
}