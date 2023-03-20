<?php

namespace App\Repositories\Repository\Admin;


use App\Models\Admin\Department;
use App\Repositories\Library\Eloquent\Repository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Clase DepartmentRepository
 * @package App\Repositories\Repository\Admin
 */
class DepartmentRepository extends Repository
{

    /**
     * Nombre del modelo de la clase.
     *
     * @return mixed|string
     */
    public function model()
    {
        return Department::class;
    }

    /**
     * Buscar todos los departmentos
     *
     * @return mixed
     */
    public function findAll()
    {
        return $this->model->get();
    }


    /**
     * Retorna el mayor codigo ingresado.
     *
     * @return mixed
     */
    public function maxValueCode()
    {
        return Department::withTrashed()->max('code');
    }

    /**
     * Buscar en la BD los departamentos habilitados.
     *
     * @return mixed
     */
    public function findEnabled()
    {
        return $this->model->where('enabled', 1)->orderBy('name', 'asc')->get();
    }

    /**
     * Buscar los departamentos hasta el nivel máximo de profundidad
     *
     * @param int $depth
     * @param int|null $id
     *
     * @return Collection
     */
    public function findMaxDepthEnabled(int $depth, int $id = null)
    {
        $firstLevelDepartments = $this->model->where(['enabled' => 1, 'parent_id' => null])->where(function ($query) use ($id) {
            if (isset($id)) {
                $query->where('id', '<>', $id);
            }
        })->get();

        return $this->getDepartmentsRecursively($firstLevelDepartments, $depth - 1, $id);

    }

    /**
     * Obtener todos los departamentos recursivamente hasta el máximo nivel de profundidad
     *
     * @param Collection $departments
     * @param int $depth
     * @param int|null $id
     *
     * @return Collection
     */
    private function getDepartmentsRecursively(Collection $departments, int $depth, int $id = null)
    {
        $allDepartments = $departments;

        while ($depth > 1) {

            foreach ($departments as $department) {

                $childrenDepartments = $department->childrenDepartments()->where('enabled', 1)->where(function ($query) use ($id) {
                    if (isset($id)) {
                        $query->where('id', '<>', $id);
                    }
                })->get();

                foreach ($childrenDepartments as $childrenDepartment) {
                    if (!collect($allDepartments)->contains($childrenDepartment)) {
                        $allDepartments = collect($allDepartments)->push($childrenDepartment);
                    }
                }
            }

            $depth--;
            return $this->getDepartmentsRecursively($allDepartments, $depth, $id);
        }

        return $allDepartments;
    }

    /**
     * Contar departmentos
     *
     * @return  mixed
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * Actualizar la entidad mediante un arreglo
     *
     * @param array $data
     * @param Department $entity
     *
     * @return Department|null
     */
    public function updateFromArray(array $data, Department $entity)
    {
        $entity->fill($data);
        $entity->save();

        return $entity->fresh();
    }

    /**
     * Crear una entidad mediante un arreglo
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model();
        return $entity->create($data);
    }

    /**
     * Cambiar estado de la entidad
     *
     * @param Department $entity
     *
     * @return bool
     */
    public function changeStatus(Department $entity)
    {
        $entity->enabled = !$entity->enabled;
        return $entity->save();
    }

    /**
     * Eliminar entidad
     *
     * @param Model $entity
     *
     * @return bool|mixed|null
     * @throws Exception
     */
    public function delete(Model $entity)
    {
        return $entity->delete();
    }

    /**
     * Obtiene los departamentos hijos
     *
     * @param int $id
     * @param array $columns
     *
     * @return mixed
     */
    public function childrenDepartments(int $id, array $columns = array('*'))
    {
        return $this->find($id, ['id'])->childrenDepartments()->enabled()->get($columns);
    }
}
