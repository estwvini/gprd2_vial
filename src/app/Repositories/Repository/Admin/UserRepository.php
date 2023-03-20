<?php

namespace App\Repositories\Repository\Admin;

use App\Models\System\User;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

/**
 * Clase UserRepository
 *
 * @package App\Repositories\Repository
 */
class UserRepository extends Repository
{
    /**
     * Constructor de UserRepository.
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
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Obtener de la BD una colección de usuarios que no tengan el rol desarrollador.
     *
     * @return mixed
     */
    public function findVisible()
    {
        return $this->model
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('slug', ['developer']);
            })
            ->where('username', '<>', 'bot')->get();
    }

    /**
     * Retorna todos los usuarios con sus reles,departamentos y modalidad de contratación
     *
     * @return mixed
     */
    public function getAllWith()
    {
        return $this->model
            ->whereDoesntHave('roles', function ($query) {
                $query->whereIn('slug', ['developer']);
            })
            ->where('username', '<>', 'bot')
            ->with(['roles', 'departments', 'hiringModality']);
    }

    /**
     * Obtener de la BD una colección de usuarios a través de un arreglo de IDs.
     *
     * @param array $ids
     * @param array $columns
     *
     * @return mixed
     */
    public function findByIds(array $ids, array $columns = ['*'])
    {
        return $this->model->whereIn('id', $ids)->get($columns);
    }

    /**
     * Obtener de la BD si el usuario es o no manager.
     *
     * @param $entity
     *
     * @return bool
     */
    public function isManager($entity)
    {
        return $entity->departments()->wherePivot('is_manager', 1)->first() !== null;
    }

    /**
     * Obtener de la BD una colección de todos los usuarios.
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Buscar en la BD los usuarios habilitados.
     *
     * @return mixed
     */
    public function findEnabled()
    {
        return $this->model->where('enabled', 1);
    }

    /**
     * Obtener de la BD una colección de todos los usuarios cuyo primer nombre coincida con el texto especificado.
     *
     * @param string $term
     *
     * @return mixed
     */
    public function findByFullNameLike(string $term)
    {
        return $this->model->where('first_name', 'like', '%' . $term . '%')->orWhere('last_name', 'like',
            '%' . $term . '%')->get(['id', 'first_name', 'last_name']);
    }

    /**
     * Obtener de la BD una colección de todos los usuarios activos cuyo rol posea los permisos especificados.
     *
     * @param string $slug
     *
     * @return mixed
     */
    public function findEnabledUsersByRoleSlug(string $slug)
    {
        return $this->model->whereHas('roles', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->where('enabled', 1)->orderBy('last_name', 'asc')->get();
    }

    /**
     * Obtener de la BD una colección de todos los usuarios cuyo rol posea los permisos especificados.
     *
     * @param string $slug
     *
     * @return mixed
     */
    public function findUsersByRoleSlug(string $slug)
    {
        return $this->model->whereHas('roles', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->orderBy('last_name', 'asc')->get();
    }

    /**
     * Obtener de la BD el conteo de la cantidad de usuarios.
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Obtener de la BD una colección de todos los usuarios eliminados lógicamente.
     *
     * @return mixed
     */
    public function trashed()
    {
        return $this->model->onlyTrashed()->get();
    }

    /**
     * Obtener de la BD una colección de todos los usuarios activos cuyo número de identificación coincida con el especificado.
     *
     * @param string $term
     *
     * @return mixed
     */
    public function findByNameOrDocumentLike(string $term)
    {
        return $this->model
            ->where(function ($query) use ($term) {
                $query->where('first_name', 'like', '%' . $term . '%')
                    ->orWhere('last_name', 'like', '%' . $term . '%')
                    ->orWhere('document', 'like', '%' . $term . '%');
            })
            ->where('enabled', 1)
            ->get();
    }

    /**
     * Actualizar en la BD la información de usuario.
     *
     * @param array $data
     * @param User $entity
     *
     * @return User|Model|null
     */
    public function updateFromArray(array $data, User $entity)
    {

        DB::transaction(function () use ($entity, $data) {

            if (!$entity instanceof Model) {
                throw new ModelException($this->model());
            }

            if (isset($data['username'])) {
                $entity->username = $data['username'];
            }

            $entity->identification_type = 'other';

            if (isset($data['identificationVerification'])) {

                $entity->identification_type = 'ced';
            }

            if (isset($data['first_name'])) {
                $entity->first_name = $data['first_name'];
            }

            if (isset($data['email'])) {
                $entity->email = $data['email'];
            }

            if (isset($data['last_name'])) {
                $entity->last_name = $data['last_name'];
            }

            if (isset($data['photo'])) {
                $photo = $data['photo'];

                $path = env('IMAGES_PATH');

                if ($entity->hasPhoto()) {
                    $photoPath = $path . $entity->photo;
                    if (file_exists($photoPath)) {
                        unlink($photoPath);
                    }
                }

                $fileName = time() . '.' . $photo->getClientOriginalExtension();
                Image::make($photo->getRealPath())->resize(256, 256)->save($path . $fileName);

                $entity->photo = $fileName;
            }

            if (isset($data['enabled_sent']) && $data['enabled_sent'] == 'true') {
                $entity->enabled = isset($data['enabled']);
            }

            if (isset($data['institution'])) {
                $entity->institution = $data['institution'];
            } else {
                $entity->institution = null;
            }

            if (isset($data['hiring_modality_id'])) {
                $entity->hiring_modality_id = $data['hiring_modality_id'];
            } else {
                $entity->hiring_modality_id = null;
            }

            $entity->save();

            if (isset($data['roles'])) {
                $entity->roles()->sync($data['roles']);
            }

            if (isset($data['department_id'])) {
                $entity->departments()->wherePivot('is_manager', false)->sync([$data['department_id']]);
            } else {
                $entity->departments()->wherePivot('is_manager', false)->detach();
            }

            if (isset($data['responsible_department_id'])) {
                $entity->departments()->wherePivot('is_manager', true)->sync([$data['responsible_department_id'] => ['is_manager' => true]]);
            } else {
                $entity->departments()->wherePivot('is_manager', true)->detach();
            }
        }, 5);

        return $entity->fresh();
    }

    /**
     * Almacenar en la BD un nuevo usuario.
     *
     * @param array $data
     *
     * @return User|Model|null
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model();
        $entity->remember_token = bcrypt(uniqid('', true));
        if (isset($data['username'])) {
            $entity->password = bcrypt($data['username']);
        }

        return $this->updateFromArray($data, $entity);
    }

    /**
     * Eliminar lógicamente de la BD a un usuario.
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws ModelException
     */
    public function delete(Model $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }
        if ($this->isManager($entity)) {

            return false;

        } else {

            return $entity->delete();
        }
    }

    /**
     * Modificar en la BD el estado de un usuario.
     *
     * @param $entity
     *
     * @return bool|null
     * @throws ModelException
     */
    public function changeStatus(User $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        $entity->enabled = !$entity->enabled;

        return $entity->save();
    }

    /**
     * Actualizar en la BD la contraseña.
     *
     * @param array $data
     * @param $entity
     *
     * @return bool
     * @throws ModelException
     */
    public function changePassword(array $data, $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        if ($data['password']) {
            $entity->password = bcrypt($data['password']);
        }

        $entity->changed_password = isset($data['changed_password']) && $data['changed_password'] == 'on';

        return $entity->save();
    }

    /**
     * Restablecer en la BD la contraseña.
     *
     * @param $entity
     *
     * @return bool
     * @throws ModelException
     */
    public function resetPassword($entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        $entity->password = bcrypt($entity->username);

        $entity->changed_password = 0;

        return $entity->save();
    }

    /**
     * Buscar los usuarios que no hayan sido asignados a un departamento
     *
     * @return Collection
     */
    public function findUsers()
    {
        $users = self::findVisible();

        $unassignedUsers = $users;
        foreach ($users as $key => $user) {
            if ($user->id == 1) {
                $unassignedUsers = collect($unassignedUsers)->forget($key);
            }
        }

        return $unassignedUsers;
    }

    /**
     * Obtiene los usuario líder activos de un departamento activo
     *
     * @param int $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findLeadersByDepartment(int $id, array $columns = ['*'])
    {
        return $this->model::join('role_user', 'users.id', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', 'roles.id')
            ->where(['users.enabled' => 1, 'roles.slug' => 'leader'])
            ->whereHas('departments', function ($query) use ($id) {
                $query->where(['departments.id' => $id, 'departments.enabled' => 1]);
            })->get($columns);
    }

    /**
     * Obtiene la consulta de usuarios activos de un departamento activo.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findUsersByDepartmentQuery(int $id)
    {
        return $this->model::join('role_user', 'users.id', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', 'roles.id')
            ->where('users.enabled', 1)
            ->whereNotIn('roles.slug', [User::ADMIN, User::DEVELOPER])
            ->whereHas('departments', function ($query) use ($id) {
                $query->where(['departments.id' => $id, 'departments.enabled' => 1]);
            });
    }

    /**
     * Obtiene los usuarios activos de un departamento activo
     *
     * @param int $id
     * @param array $columns
     *
     * @return mixed
     */
    public function findUsersByDepartment(int $id, array $columns = ['*'])
    {
        return $this->model::join('role_user', 'users.id', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', 'roles.id')
            ->where('users.enabled', 1)
            ->whereNotIn('roles.slug', [User::ADMIN, User::DEVELOPER])
            ->whereHas('departments', function ($query) use ($id) {
                $query->where(['departments.id' => $id, 'departments.enabled' => 1]);
            })->select('users.*')
            ->distinct('users.id')
            ->get($columns);
    }

    /**
     * Obtiene los usuarios habilitados por departamento con opción de búsqueda.
     *
     * @param int $id
     * @param string $query
     *
     * @return EloquentCollection
     */
    public function findUsersByDepartmentWithSearch(int $id, string $query = '')
    {
        if (empty($query)) {
            return $this->findUsersByDepartmentQuery($id)->limit(10)->get();
        } else {
            $search = '%' . $query . '%';
            return $this->findUsersByDepartmentQuery($id)
                ->where('first_name', 'LIKE', $search)
                ->orWhere('last_name', 'LIKE', $search)
                ->get();
        }
    }

}
