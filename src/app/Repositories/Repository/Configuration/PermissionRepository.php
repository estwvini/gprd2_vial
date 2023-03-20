<?php

namespace App\Repositories\Repository\Configuration;


use App\Repositories\Library\Eloquent\Repository;
use Illuminate\Container\Container as App;
use App\Repositories\Library\Exceptions\ModelException;
use Illuminate\Database\Eloquent\Model;

class PermissionRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return config('acl.permission');
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
     * @param $id
     *
     * @return mixed
     */
    public function findChildren($id)
    {
        return $this->model->where('inherit_id', '=', $id)->get();
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
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        /* Test data */
        if (isset($data['inherit_id'])) {
            $entity->inherit_id = $data['inherit_id'];
        }

        if (isset($data['name'])) {
            $entity->name = $data['name'];
        }

        if (isset($data['label'])) {
            $entity->label = $data['label'];
        }

        if (isset($data['slug'])) {
            $entity->slug = json_decode($data['slug'], true);
        }

        if (isset($data['description'])) {
            $entity->description = $data['description'];
        }

        /* Test slug */
        if (null == $entity->slug) {
            $entity->slug = '';
        }

        $entity->save();

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
     * Update children name
     *
     * @param $entity
     * @param $oldName
     * @param $permissionRepository
     * @throws ModelException
     */
    public function updateChildrenName($entity, $oldName, &$permissionRepository)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        // get permissions
        $children = $permissionRepository->findChildren($entity->id);

        foreach ($children as $child) {
            $name = str_replace($oldName, $entity->name, $child->name);
            $child->name = $name;
            $child->save();

            $this->updateChildrenName($child, $oldName, $permissionRepository);
        }
    }

    /**
     * Delete entity and their children
     *
     * @param $entity
     * @param $permissionRepository
     * @return bool|null
     * @throws ModelException
     * @throws \Exception
     */
    public function recursiveDelete($entity, &$permissionRepository)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        // detach roles and users
        $entity->roles()->detach();
        $entity->users()->detach();

        // get and delete children
        $children = $permissionRepository->findChildren($entity->id);

        foreach ($children as $child) {
            $this->recursiveDelete($child, $permissionRepository);
        }

        return $entity->delete();
    }
}