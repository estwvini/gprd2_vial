<?php

namespace App\Processes\Business\Catalogs;

use App\Repositories\Repository\Business\Catalogs\ReasonRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ReasonProcess
 *
 * @package App\Processes\Business\Catalogs
 */
class ReasonProcess
{
    /**
     * @var ReasonRepository
     */
    protected $reasonRepository;

    /**
     * Constructor de ReasonProcess.
     *
     * @param ReasonRepository $reasonRepository
     */
    public function __construct(ReasonRepository $reasonRepository)
    {
        $this->reasonRepository = $reasonRepository;
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

        if ($user->can('edit.reasons.module_configuration_catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.reasons.module_configuration_catalogs',
                'tooltip' => trans('reasons.labels.update')
            ];
        }

        if ($user->can('destroy.reasons.module_configuration_catalogs')) {
            $actions['trash'] = [
                'route' => 'destroy.reasons.module_configuration_catalogs',
                'tooltip' => trans('reasons.labels.delete'),
                'confirm_message' => trans('reasons.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        return DataTables::of($this->reasonRepository->all())
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
        if (!$this->reasonRepository->createFromArray($data)) {
            throw new Exception(trans('reasons.messages.errors.create'), 1000);
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
        $entity = $this->reasonRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('reasons.messages.exceptions.not_found'), 1000);
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
    public function update(Request $request, int $id)
    {
        $entity = $this->reasonRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('reasons.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();

        if (!$this->reasonRepository->updateFromArray($data, $entity)) {
            throw new Exception(trans('reasons.messages.errors.update'), 1000);
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
        $entity = $this->reasonRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('reasons.messages.exceptions.not_found'), 1000);
        }
        if (count($entity->adminActivities)) {
            throw new Exception(trans('reasons.messages.validation.has_activities'), 1000);
        }

        if (!$this->reasonRepository->destroy($entity->id)) {
            throw new Exception(trans('reasons.messages.errors.delete'), 1000);
        }
    }
}
