<?php

namespace App\Repositories\Repository\Configuration;


use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\ModelException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuRepository extends Repository
{

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\System\Menu';
    }

    /**
     * Get the parents menu
     *
     * @return mixed
     */
    public function findParents()
    {
        $query = $this->model
            ->whereNull('parent_id')
            ->where('enabled', true);

        if (!currentUser()->hasRole('developer')) {
            $query->where('module_id', session()->get('module')->id);
        }

        $query->orderBy('weight', 'asc');
        return $query->get();
    }

    /**
     * Get children for parent menu
     *
     * @param $parentId
     *
     * @return mixed
     */
    public function findChildren($parentId)
    {
        return $this->model
            ->where('parent_id', $parentId)
            ->where('enabled', true)
            ->orderBy('weight', 'asc')
            ->get();
    }

    /**
     * Get a collection of models by array of ids
     *
     * @param array $ids
     * @param array $columns
     *
     * @return mixed
     */
    public function findByIds(array $ids, $columns = ['*'])
    {
        return $this->model->whereIn('id', $ids)->get($columns);
    }

    /**
     * Get the children menus for one Menu.
     *
     * @param $menuID
     *
     * @return array
     */
    public function getChildrenMenu($menuID)
    {
        $menu = $this->find($menuID);
        if ($menu) {
            return $menu->children()->where('enabled', 1)->orderBy('weight', 'asc')->get();
        }

        return [];
    }

    /**
     * Get all parents menus.
     * @return array
     */
    public function getParentsMenu()
    {
        return $this->model->where('parent_id', null)->where('enabled', 1)->orderBy('weight', 'asc')->get();
    }

    /**
     * Update entity from array of data
     *
     * @param array $data
     * @param null $entity
     *
     * @return mixed
     * @throws ModelException
     */
    public function updateFromArray(array $data, $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        $entity->parent_id = $data['parent_id'];
        $entity->label = $data['label'];
        $entity->slug = $data['slug'];
        $entity->icon = $data['icon'];
        $entity->weight = $data['weight'];

        $entity->enabled = isset($data['enabled']) && $data['enabled'] == 'on';

        $entity->save();

        return $entity->fresh();
    }

    /**
     * Create entity from array of data
     *
     * @param array $data
     *
     * @return mixed
     * @throws ModelException
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        return $this->updateFromArray($data, $entity);
    }

    /**
     * Delete model
     *
     * @param $entity
     *
     * @return bool|null
     * @throws ModelException
     * @throws \Exception
     */
    public function delete(Model $entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        // ...

        return $entity->delete();
    }

    /**
     * Change the model status
     *
     * @param $entity
     *
     * @return bool
     * @throws ModelException
     */
    public function changeStatus($entity)
    {
        if (!$entity instanceof Model) {
            throw new ModelException($this->model());
        }

        $entity->enabled = !$entity->enabled;

        return $entity->save();
    }

    /**
     * Buscar estructura de menu completa
     *
     * @return mixed
     */
    public function findMenuTree()
    {
        $moduleId = '';
        if (!currentUser()->hasRole('developer')) {
            $moduleId = " and module_id = " . session()->get('module')->id;
        }

        $query = "WITH RECURSIVE cte(id, parent_id, label, slug, weight, icon) AS
                   (
                       SELECT id, parent_id, label, slug, weight, icon
                       from menus
                       where parent_id is null
                         and enabled = true
                         {$moduleId}
                       UNION ALL
                       SELECT m.id,
                              m.parent_id,
                              m.label,
                              m.slug,
                              m.weight,
                              m.icon
                       from menus m
                                inner join cte on m.parent_id = cte.id
                       where m.enabled = true
                   )
                    select *
                    from cte order by weight;";

        return collect(DB::select($query));
    }
}