<?php

namespace App\Repositories\Library\Contracts;


use Illuminate\Database\Eloquent\Model;

interface IRepositoryInterface
{
    /**
     * @param array $columns
     *
     * @return mixed
     */
    public function all($columns = array('*'));

    /**
     * @param int $perPage
     * @param array $columns
     *
     * @return mixed
     */
    public function paginate($perPage = 15, $columns = array('*'));

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param array $data
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $data, $id);

    /**
     * @param Model $entity
     *
     * @return mixed
     */
    public function delete(Model $entity);

    /**
     * Remove model by id
     * @param int $id
     * @return mixed
     */
    public function destroy(int $id);

    /**
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    public function find($id, $columns = array('*'));

    /**
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findBy($field, $value, $columns = array('*'));

    /**
     * @param       $field
     * @param       $value
     * @param array $columns
     *
     * @return mixed
     */
    public function findLike($field, $value, $columns = array('*'));

    /**
     * Find all by field and value
     * @param $field
     * @param null $value
     * @param array $columns
     * @return mixed
     */
    public function findByField($field, $value = null, $columns = array('*'));

}