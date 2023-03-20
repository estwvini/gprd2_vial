<?php

namespace App\Processes\Business\Catalogs;


use App\Repositories\Repository\Business\Catalogs\FinancingSourceRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase FinancingSourceProcess
 * @package App\Processes\Business\Catalogs
 */
class FinancingSourceProcess
{
    /**
     * @var FinancingSourceRepository
     */
    protected $financingSourceRepository;

    /**
     * Constructor de FinancingSourceProcess.
     *
     * @param FinancingSourceRepository $financingSourceRepository
     */
    public function __construct(
        FinancingSourceRepository $financingSourceRepository
    ) {
        $this->financingSourceRepository = $financingSourceRepository;
    }

    /**
     * Obtener el modelo del proceso de fuente de financiamiento.
     *
     * @return string
     */
    public function process()
    {
        return FinancingSourceProcess::class;
    }

    /**
     * Cargar información de las fuentes de financiamiento según el tipo.
     *
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('edit.financing_sources.module_configuration_catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.financing_sources.module_configuration_catalogs',
                'tooltip' => trans('financing_sources.labels.update')
            ];
        }

        if ($user->can('destroy.financing_sources.module_configuration_catalogs')) {
            $actions['trash'] = [
                'route' => 'destroy.financing_sources.module_configuration_catalogs',
                'tooltip' => trans('financing_sources.labels.delete'),
                'confirm_message' => trans('financing_sources.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        $status = $user->can('status.financing_sources.module_configuration_catalogs');

        $dataTable = DataTables::of($this->financingSourceRepository->all())
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
     * Almacenar nueva fuente de financiamiento.
     *
     * @param Request $request
     *
     * @throws Exception
     */
    public function store(array $data)
    {
        $entity = $this->financingSourceRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('financing_sources.messages.errors.create'), 1000);
        }
    }

    /**
     * Retornar data necesaria para mostrar la información de fuente de financiamiento.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function show(int $id)
    {
        $entity = $this->financingSourceRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('financing_sources.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de fuente de financiamiento.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->financingSourceRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('financing_sources.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity,
            'type' => $entity->type,
            'typeLang' => ($entity->type === 'INCOME') ? trans('financing_sources.labels.income') : trans('financing_sources.labels.expense')
        ];
    }

    /**
     * Actualizar la información de fuente de financiamiento.
     *
     * @param Request $request
     * @param int $id
     *
     * @throws Exception
     */
    public function update(array $data, int $id)
    {
        $entity = $this->financingSourceRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('financing_sources.messages.exceptions.not_found'), 1000);
        }

        if (count($entity->budgetItems) || count($entity->incomes)) {
            unset($data['code']);
        }

        $entity = $this->financingSourceRepository->updateFromArray($data, $entity);

        if (!$entity) {
            throw new Exception(trans('financing_sources.messages.errors.update'), 1000);
        }
    }

    /**
     * Eliminar una fuente de financiamiento.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->financingSourceRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('financing_sources.messages.exceptions.not_found'), 1000);
        }

        $type = $entity->type;

        if (count($entity->budgetItems) || count($entity->incomes)) {
            throw new Exception(trans('financing_sources.messages.validation.has_budgetItems'), 1000);
        }
        if (count($entity->incomes)) {
            throw new Exception(trans('financing_sources.messages.validation.has_incomes'), 1000);
        }
        if (!$this->financingSourceRepository->delete($entity)) {
            throw new Exception(trans('financing_sources.messages.errors.delete'), 1000);
        }

        return $type;
    }

    /**
     * Modificar el estado de fuente de financiamiento.
     *
     * @param int $id
     *
     * @return bool
     * @throws Exception
     */
    public function status(int $id)
    {
        $entity = $this->financingSourceRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('financing_sources.messages.exceptions.not_found'), 1000);
        }

        if (!$this->financingSourceRepository->changeStatus($entity)) {
            throw new Exception(trans('financing_sources.messages.errors.update'), 1000);
        }
        return $entity->enabled;
    }
}
