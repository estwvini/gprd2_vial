<?php

namespace App\Repositories\Library\Eloquent;


use App\Repositories\Library\Contracts\ICriteriaInterface;
use App\Repositories\Library\Contracts\IRepositoryInterface;
use App\Repositories\Library\Criteria\Criteria;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Container\Container as App;

abstract class Repository implements IRepositoryInterface, ICriteriaInterface
{

    /**
     * @var App
     */
    private $app;

    /**
     * @var
     */
    protected $model;

    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    /**
     * Repository constructor.
     *
     * @param App $app
     * @param Collection $collection
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection = NULL)
    {
        $this->app = $app;
        $this->criteria = isset($collection) ? $collection : new Collection();
        $this->resetScope();
        $this->makeModel();
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public abstract function model();

    /**
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = array('*'))
    {
        $this->applyCriteria();

        return $this->model->get($columns);
    }

    /**
     * @param int $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 1, $columns = array('*'))
    {
        $this->applyCriteria();

        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * @param array $data
     * @param        $id
     * @param string $attribute
     *
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    /**
     * @param Model $entity
     *
     * @return mixed
     */
    public function delete(Model $entity)
    {
        return $this->model->destroy($entity);
    }


    /**
     * Remove model by id
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = array('*'))
    {
        $this->applyCriteria();

        return $this->model->find($id, $columns);
    }

    /**
     * @param       $attribute
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = array('*'))
    {
        $this->applyCriteria();

        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findLike($attribute, $value, $columns = array('*'))
    {
        $this->applyCriteria();
        return $this->model->where($attribute, 'like', $value . '%')->first($columns);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws RepositoryException
     */
    public function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * @return $this
     */
    public function resetScope()
    {
        $this->skipCriteria(false);

        return $this;
    }

    /**
     * Remove all criteria
     * @return $this
     * @throws RepositoryException
     */
    public function resetCriteria()
    {
        $this->criteria = new Collection();
        $this->makeModel();

        return $this;
    }

    /**
     * @param bool $status
     *
     * @return $this
     */
    public function skipCriteria($status = true)
    {
        $this->skipCriteria = $status;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCriteria()
    {
        return $this->criteria;
    }

    /**
     * @param Criteria $criteria
     *
     * @return $this
     */
    public function getByCriteria(Criteria $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);

        return $this;
    }

    /**
     * Find all by field and value
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findByField($field, $value = null, $columns = ['*'])
    {
        $this->applyCriteria();
        return $this->model->where($field, '=', $value)->get($columns);
    }

    /**
     * Find all by field and value
     *
     * @param array $fields
     * @param array $columns
     *
     * @return mixed
     */
    public function findByFields(array $fields, $columns = ['*'])
    {
        $this->applyCriteria();
        return $this->model->where($fields)->get($columns);
    }

        /**
     * @param Criteria $criteria
     *
     * @return $this
     */
    public function pushCriteria(Criteria $criteria)
    {
        $this->criteria->push($criteria);

        return $this;
    }

    /**
     *
     * @return $this
     */
    public function applyCriteria()
    {
        if ($this->skipCriteria === true) {
            return $this;
        }

        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof Criteria) {
                $this->model = $criteria->apply($this->model, $this);
            }
        }

        return $this;
    }

    /**
     * Validates if the entity exists based on the $fields. $current works when validating on updates.
     * @param $fields array
     * @param $current int
     *
     * @return bool
     */
    public function exists($fields, $current = null)
    {
        return $this->model->where(function ($query) use ($fields, $current) {
            foreach ($fields as $key => $value) {
                $query->where($key, $value);
            }
            if ($current)
                $query->where('id', '<>', $current);
        })->count() === 0 ? false : true;
    }
}