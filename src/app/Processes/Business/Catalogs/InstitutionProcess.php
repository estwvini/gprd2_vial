<?php

namespace App\Processes\Business\Catalogs;

use App\Models\Business\Catalogs\Institution;
use App\Repositories\Repository\Business\Catalogs\InstitutionRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase InstitutionProcess
 * @package App\Processes\Business\Catalogs
 */
class InstitutionProcess
{
    /**
     * @var InstitutionRepository
     */
    protected $institutionRepository;

    /**
     * Constructor de InstitutionProcess.
     *
     * @param InstitutionRepository $institutionRepository
     */
    public function __construct(
        InstitutionRepository $institutionRepository
    ) {
        $this->institutionRepository = $institutionRepository;
    }

    /**
     * Cargar información de las instituciones.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('edit.institution.module_configuration_catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.institution.module_configuration_catalogs',
                'tooltip' => trans('institution.labels.update')
            ];
        }

        if ($user->can('destroy.institution.module_configuration_catalogs')) {
            $actions['trash'] = [
                'route' => 'destroy.institution.module_configuration_catalogs',
                'tooltip' => trans('institution.labels.delete'),
                'confirm_message' => trans('institution.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        $status = $user->can('status.index.institution.module_configuration_catalogs');

        $dataTable = DataTables::of($this->institutionRepository->findAll())
            ->setRowId('id')
            ->editColumn('enabled', function ($entity) use ($user, $status) {
                $checked = $entity->enabled ? 'checked' : '';

                if ($status) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                } else {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' disabled {$checked}/></label>";
                }
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['enabled', 'actions'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Almacenar nueva institucion.
     *
     * @param array $data
     *
     * @throws Exception
     */
    public function store(array $data)
    {
        if (!$this->institutionRepository->createFromArray($data)) {
            throw new Exception(trans('institution.messages.errors.create'), 1000);
        }
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de institucion.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->institutionRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('institution.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity
        ];
    }

    /**
     * Actualizar la información de institucion.
     *
     * @param Request $request
     * @param int $id
     *
     * @throws Exception
     */
    public function update(array $data, int $id)
    {
        $entity = $this->institutionRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('institution.messages.exceptions.not_found'), 1000);
        }

        if (count($entity->budgetItems) || count($entity->incomes)) {
            unset($data['code']);
        }

        if (!$this->institutionRepository->updateFromArray($data, $entity)) {
            throw new Exception(trans('institution.messages.errors.update'), 1000);
        }
    }

    /**
     * Eliminar una institucion.
     *
     * @param int $id
     *
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->institutionRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('institution.messages.exceptions.not_found'), 1000);
        }
        if (count($entity->budgetItems) || count($entity->incomes)) {
            throw new Exception(trans('institution.messages.validation.has_budgetItems'), 1000);
        }
        if (count($entity->incomes)) {
            throw new Exception(trans('institution.messages.validation.has_incomes'), 1000);
        }

        if (!$this->institutionRepository->delete($entity)) {
            throw new Exception(trans('institution.messages.errors.delete'), 1000);
        }
    }

    /**
     * Modificar el estado de institucion.
     *
     * @param int $id
     *
     * @return Institution|mixed|null
     * @throws Exception
     */
    public function status(int $id)
    {
        $entity = $this->institutionRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('institution.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->institutionRepository->changeStatus($entity);

        if (!$entity) {
            throw new Exception(trans('institution.messages.errors.update'), 1000);
        }

        return $entity;
    }
}
