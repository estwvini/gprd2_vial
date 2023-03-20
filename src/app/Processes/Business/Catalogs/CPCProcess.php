<?php

namespace App\Processes\Business\Catalogs;

use App\Models\Business\Catalogs\CPC;
use App\Repositories\Repository\Business\Catalogs\CPCRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase CPCProcess
 * @package App\Processes\Business\Catalogs
 */
class CPCProcess
{
    /**
     * @var CPCRepository
     */
    protected $cpcRepository;

    /**
     * Constructor de CPCProcess.
     *
     * @param CPCRepository $cpcRepository
     */
    public function __construct(
        CPCRepository $cpcRepository
    ) {
        $this->cpcRepository = $cpcRepository;
    }

    /**
     * Obtener el modelo del proceso de compras públicas.
     *
     * @return string
     */
    public function process()
    {
        return CPCProcess::class;
    }

    /**
     * Cargar información de las compras públicas.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('edit.cpc.module_configuration_catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.cpc.module_configuration_catalogs',
                'tooltip' => trans('cpc.labels.update')
            ];
        }

        if ($user->can('destroy.cpc.module_configuration_catalogs')) {
            $actions['trash'] = [
                'route' => 'destroy.cpc.module_configuration_catalogs',
                'tooltip' => trans('cpc.labels.delete'),
                'confirm_message' => trans('cpc.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }
        $status = $user->can('status.cpc.module_configuration_catalogs');

        $dataTable = DataTables::of($this->cpcRepository->findAll())
            ->setRowId('id')
            ->editColumn('enabled', function ($entity) use ($status) {
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
     * Almacenar nueva compra pública.
     *
     * @param Request $request
     *
     * @throws Exception
     */
    public function store(array $data)
    {
        if (!$this->cpcRepository->createFromArray($data)) {
            throw new Exception(trans('cpc.messages.errors.create'), 1000);
        }
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de compra pública.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->cpcRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('cpc.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity
        ];
    }

    /**
     * Actualizar la información de compra pública.
     *
     * @param Request $request
     * @param int $id
     *
     * @throws Exception
     */
    public function update(array $data, int $id)
    {
        $entity = $this->cpcRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('cpc.messages.exceptions.not_found'), 1000);
        }
        if (count($entity->purchases)) {
            unset($data['code']);
        }

        if (!$this->cpcRepository->updateFromArray($data, $entity)) {
            throw new Exception(trans('cpc.messages.errors.update'), 1000);
        }
    }

    /**
     * Eliminar una compra pública.
     *
     * @param int $id
     *
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->cpcRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('cpc.messages.exceptions.not_found'), 1000);
        }

        if (count($entity->purchases)) {
            throw new Exception(trans('cpc.messages.validation.has_purchases'), 1000);
        }

        if (!$this->cpcRepository->delete($entity)) {
            throw new Exception(trans('cpc.messages.errors.delete'), 1000);
        }
    }

    /**
     * Modificar el estado de compra pública.
     *
     * @param int $id
     *
     * @return CPC|mixed|null
     * @throws Exception
     */
    public function status(int $id)
    {
        $entity = $this->cpcRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('cpc.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->cpcRepository->changeStatus($entity);

        if (!$entity) {
            throw new Exception(trans('cpc.messages.errors.update'), 1000);
        }

        return $entity;
    }
}
