<?php

namespace App\Repositories\Repository\Configuration;


use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Library\Exceptions\RepositoryException;

class RoleRepository extends Repository
{
    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * RoleRepository constructor.
     * @param App $app
     * @param PermissionRepository $permissionRepository
     * @throws RepositoryException
     */
    public function __construct(
        App $app,
        PermissionRepository $permissionRepository)
    {
        parent::__construct($app);
        $this->permissionRepository = $permissionRepository;
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\System\Role';
    }

    public function findAll($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    /**
     * Buscar en la BD los roles habilitados.
     *
     * @return mixed
     */
    public function findEnabled()
    {
        return $this->model->where('enabled', 1)->get();
    }

    /**
     * Get assignable roles
     *
     * @return mixed
     */
    public function findAssignable()
    {
        return $this->model
            ->whereNotIn('slug', ['developer'])
            ->get();
    }

    /**
     * Get assignable roles without administrator role
     *
     * @return mixed
     */
    public function findAssignableWithoutAdministratorRole()
    {
        return $this->model->withoutHiddenRoles()->where('slug', '<>', 'administrator');
    }

    /**
     * Get a collection of models by array of ids
     *
     * @param array $ids
     * @param array $columns
     * @return mixed
     */
    public function findByIds(array $ids, $columns = ['*'])
    {
        return $this->model->whereIn('id', $ids)->get($columns);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findRoleBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * @param $name
     * @return bool
     */
    public function checkNameAvailability($name)
    {
        $names = $this->model->where("name", $name)->get(['name']);
        if (count($names) == 0)
            return true;
        else
            return false;
    }

    /**
     * Update entity from array of data
     *
     * @param array $data
     * @param null $entity
     * @return mixed
     * @throws ModelException
     */
    public function updateFromArray(array $data, $entity)
    {
        if (!$entity instanceof Model)
            throw new ModelException($this->model());

        $slug = $entity->slug;

        if (isset($data['name']))
            $entity->name = $data['name'];

        if (isset($data['slug']))
            $entity->slug = $data['slug'];

        if (isset($data['description']))
            $entity->description = $data['description'];

        if (isset($data['enabled_sent']))
            $entity->enabled = isset($data['enabled']) && $data['enabled'] == 'on';

        if (isset($data['editable_sent']))
            $entity->editable = isset($data['editable']) && $data['editable'] == 'on';

        if (null == $entity->slug)
            $entity->slug = str_slug($data['name']);

        $entity->save();

        if ($slug != $entity->slug)
            $this->updatePermissionsName($entity, $slug);

        return $entity->fresh();
    }

    /**
     * Create entity from array of data
     *
     * @param array $data
     * @return mixed
     * @throws ModelException
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $this->updateFromArray($data, $entity);
    }

    /**
     * Update associated permissions name
     *
     * @param $entity
     * @param $oldSlug
     * @throws ModelException
     */
    public function updatePermissionsName($entity, $oldSlug)
    {
        if (!$entity instanceof Model)
            throw new ModelException($this->model());

        foreach ($entity->permissions as $permission) {
            $name = str_replace($oldSlug, $entity->slug, $permission->name);
            $permission->name = $name;
            $permission->save();
        }
    }

    /**
     * Delete model
     *
     * @param $entity
     * @return bool|null
     * @throws ModelException
     * @throws \Exception
     */
    public function delete(Model $entity)
    {
        if (!$entity instanceof Model)
            throw new ModelException($this->model());

        $entity->permissions()->delete();
        $entity->permissions()->detach();
        $entity->users()->detach();

        return $entity->delete();
    }

    /**
     * Change model status
     *
     * @param $entity
     * @return bool|null
     * @throws ModelException
     */
    public function changeStatus($entity)
    {
        if (!$entity instanceof Model)
            throw new ModelException($this->model());

        $entity->enabled = !$entity->enabled;

        return $entity->save();
    }

    /**
     * Change model editable
     *
     * @param $entity
     * @return bool|null
     * @throws ModelException
     */
    public function changeEditable($entity)
    {
        if (!$entity instanceof Model)
            throw new ModelException($this->model());

        $entity->editable = !$entity->editable;

        return $entity->save();
    }

    /**
     * Recursive function for assign or revoke permissions
     *
     * @param array $value
     * @param bool $allTrue
     * @param bool $check
     * @param bool $allow
     * @return array|mixed
     */
    private function _changePermission($value, $allTrue = false, $check = false, $allow = false)
    {
        if (!is_array($value))
            return $value;

        if (array_key_exists('allowed', $value))
            $value['allowed'] = $allTrue ? true : ($check ? $allow : !($value['allowed']));

        if (array_key_exists('inner', $value)) {
            foreach ($value['inner'] as $key => $inner)
                $value['inner'][$key] = $this->_changePermission($inner, $allTrue, $check, $allow);
        }

        return $value;
    }

    /**
     * Assign or revoke permissions
     *
     * @param $permission
     * @param $action
     * @param string|null $filter1
     * @param string|null $filter2
     * @param string|null $filter3
     * @param string|null $filter4
     * @param string|null $filter5
     * @param string|null $filter6
     * @return mixed
     */
    public function changePermission($permission, $action, string $filter1 = null, string $filter2 = null, string $filter3 = null, string $filter4 = null, string $filter5 = null, string $filter6 = null)
    {
        $value = null;
        $actions = $permission->slug;
        $allTrue = false;

        if (array_key_exists($action, $actions)) {
            if ($filter6) {
                $value = $actions[$action]['inner'][$filter1]['inner'][$filter2]['inner'][$filter3]['inner'][$filter4]['inner'][$filter5]['inner'][$filter6];
            } elseif ($filter5) {
                $value = $actions[$action]['inner'][$filter1]['inner'][$filter2]['inner'][$filter3]['inner'][$filter4]['inner'][$filter5];
            } elseif ($filter4) {
                $value = $actions[$action]['inner'][$filter1]['inner'][$filter2]['inner'][$filter3]['inner'][$filter4];
            } elseif ($filter3) {
                $value = $actions[$action]['inner'][$filter1]['inner'][$filter2]['inner'][$filter3];
            } elseif ($filter2) {
                $value = $actions[$action]['inner'][$filter1]['inner'][$filter2];
            } elseif ($filter1) {
                $value = $actions[$action]['inner'][$filter1];
            } else {
                $value = $actions[$action];
            }
        } else if ($permission->inherit_id) {
            $parent = $this->permissionRepository->find($permission->inherit_id);
            $bases = $parent->slug;

            if (array_key_exists($action, $bases)) {
                $value = $bases[$action];
                $allTrue = true;
            }
        }

        if (is_array($value)) {
            if ($filter6) {
                $actions[$action]['inner'][$filter1]['inner'][$filter2]['inner'][$filter3]['inner'][$filter4]['inner'][$filter5]['inner'][$filter6] = $this->_changePermission($value, $allTrue);
            } elseif ($filter5) {
                $actions[$action]['inner'][$filter1]['inner'][$filter2]['inner'][$filter3]['inner'][$filter4]['inner'][$filter5] = $this->_changePermission($value, $allTrue);
            } elseif ($filter4) {
                $actions[$action]['inner'][$filter1]['inner'][$filter2]['inner'][$filter3]['inner'][$filter4] = $this->_changePermission($value, $allTrue);
            } elseif ($filter3) {
                $actions[$action]['inner'][$filter1]['inner'][$filter2]['inner'][$filter3] = $this->_changePermission($value, $allTrue);
            } elseif ($filter2) {
                $actions[$action]['inner'][$filter1]['inner'][$filter2] = $this->_changePermission($value, $allTrue);
            } elseif ($filter1) {
                $actions[$action]['inner'][$filter1] = $this->_changePermission($value, $allTrue);
            } else {
                $actions[$action] = $this->_changePermission($value, $allTrue);
            }
            $permission->slug = $actions;
            $permission->save();
        }

        return $permission->fresh();
    }

    /**
     * Assign or revoke all permissions
     *
     * @param $permission
     * @param $bases
     * @param bool $checked
     * @param string|null $filter1
     * @param string|null $filter2
     * @param string|null $filter3
     * @param string|null $filter4
     * @param string|null $filter5
     * @param string|null $filter6
     * @return mixed
     */
    public function changeAllPermissions($permission, $bases, $checked, string $filter1 = null, string $filter2 = null, string $filter3 = null, string $filter4 = null, string $filter5 = null, string $filter6 = null)
    {
        $actions = $permission->slug;
        foreach ($bases as $key1 => $value1) {
            if (is_array($value1)) {
                if ($filter6) {
                    if ($key1 === $filter1) {
                        foreach ($value1['inner'] as $key2 => $value2) {
                            if ($key2 === $filter2) {
                                foreach ($value2['inner'] as $key3 => $value3) {
                                    if ($key3 === $filter3) {
                                        foreach ($value3['inner'] as $key4 => $value4) {
                                            if ($key4 === $filter4) {
                                                foreach ($value4['inner'] as $key5 => $value5) {
                                                    if ($key5 === $filter5) {
                                                        foreach ($value5['inner'] as $key6 => $value6) {
                                                            if ($key6 === $filter6) {
                                                                $actions[$key1]['inner'][$key2]['inner'][$key3]['inner'][$key4]['inner'][$key5]['inner'][$key6] = $this->_changePermission($value6, false, true, $checked);
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } elseif ($filter5) {
                    if ($key1 === $filter1) {
                        foreach ($value1['inner'] as $key2 => $value2) {
                            if ($key2 === $filter2) {
                                foreach ($value2['inner'] as $key3 => $value3) {
                                    if ($key3 === $filter3) {
                                        foreach ($value3['inner'] as $key4 => $value4) {
                                            if ($key4 === $filter4) {
                                                foreach ($value4['inner'] as $key5 => $value5) {
                                                    if ($key5 === $filter5) {
                                                        $actions[$key1]['inner'][$key2]['inner'][$key3]['inner'][$key4]['inner'][$key5] = $this->_changePermission($value5, false, true, $checked);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } elseif ($filter4) {
                    if ($key1 === $filter1) {
                        foreach ($value1['inner'] as $key2 => $value2) {
                            if ($key2 === $filter2) {
                                foreach ($value2['inner'] as $key3 => $value3) {
                                    if ($key3 === $filter3) {
                                        foreach ($value3['inner'] as $key4 => $value4) {
                                            if ($key4 === $filter4) {
                                                $actions[$key1]['inner'][$key2]['inner'][$key3]['inner'][$key4] = $this->_changePermission($value4, false, true, $checked);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } elseif ($filter3) {
                    if ($key1 === $filter1) {
                        foreach ($value1['inner'] as $key2 => $value2) {
                            if ($key2 === $filter2) {
                                foreach ($value2['inner'] as $key3 => $value3) {
                                    if ($key3 === $filter3) {
                                        $actions[$key1]['inner'][$key2]['inner'][$key3] = $this->_changePermission($value3, false, true, $checked);
                                    }
                                }
                            }
                        }
                    }
                } elseif ($filter2) {
                    if ($key1 === $filter1) {
                        foreach ($value1['inner'] as $key2 => $value2) {
                            if ($key2 === $filter2) {
                                $actions[$key1]['inner'][$key2] = $this->_changePermission($value2, false, true, $checked);
                            }
                        }
                    }
                } elseif ($filter1) {
                    if ($key1 === $filter1) {
                        $actions[$key1] = $this->_changePermission($value1, false, true, $checked);
                    }
                } else {
                    $actions[$key1] = $this->_changePermission($value1, false, true, $checked);
                }
            }
        }

        $permission->slug = $actions;
        $permission->save();

        return $permission->fresh();
    }
}