<?php

namespace App\Processes\Business\Catalogs;

use App\Repositories\Repository\Business\Catalogs\ActivityTypeRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ActivityTypeProcess
 *
 * @package App\Processes\Business\Catalogs
 */
class ActivityTypeProcess
{
    /**
     * @var ActivityTypeRepository
     */
    protected $activityTypeRepository;

    /**
     * Constructor de ActivityTypeProcess.
     *
     * @param ActivityTypeRepository $activityTypeRepository
     */
    public function __construct(ActivityTypeRepository $activityTypeRepository)
    {
        $this->activityTypeRepository = $activityTypeRepository;
    }

    /**
     * Cargar información de los tipos de actividades.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('edit.activity_type.module_configuration_catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.activity_type.module_configuration_catalogs',
                'tooltip' => trans('activity_type.labels.update')
            ];
        }

        if ($user->can('destroy.activity_type.module_configuration_catalogs')) {
            $actions['trash'] = [
                'route' => 'destroy.activity_type.module_configuration_catalogs',
                'tooltip' => trans('activity_type.labels.delete'),
                'confirm_message' => trans('activity_type.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        return DataTables::of($this->activityTypeRepository->all())
            ->setRowId('id')
            ->addColumn('actions', function ($entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Almacenar nuevo tipo de actividad.
     *
     * @param Request $request
     *
     * @throws Exception
     */
    public function store(array $data)
    {
        if (!$this->activityTypeRepository->createFromArray($data)) {
            throw new Exception(trans('activity_type.messages.errors.create'), 1000);
        }
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición del tipo de actividad.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->activityTypeRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('activity_type.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity
        ];
    }

    /**
     * Actualizar la información del tipo de actividad.
     *
     * @param Request $request
     * @param int $id
     *
     * @throws Exception
     */
    public function update(array $data, int $id)
    {
        $entity = $this->activityTypeRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('activity_type.messages.exceptions.not_found'), 1000);
        }

        if (!$this->activityTypeRepository->updateFromArray($data, $entity)) {
            throw new Exception(trans('activity_type.messages.errors.update'), 1000);
        }
    }

    /**
     * Eliminar un tipo de actividad.
     *
     * @param int $id
     *
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->activityTypeRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('activity_type.messages.exceptions.not_found'), 1000);
        }
        if (count($entity->adminActivities)) {
            throw new Exception(trans('activity_type.messages.validation.has_activities'), 1000);
        }

        if (!$this->activityTypeRepository->destroy($entity->id)) {
            throw new Exception(trans('activity_type.messages.errors.delete'), 1000);
        }
    }
}
