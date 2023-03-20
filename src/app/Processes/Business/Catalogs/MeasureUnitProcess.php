<?php

namespace App\Processes\Business\Catalogs;

use App\Models\Business\Catalogs\MeasureUnit;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase MeasureUnitProcess
 * @package App\Processes\Business\Catalogs
 */
class MeasureUnitProcess
{
    /**
     * @var MeasureUnitRepository
     */
    protected $measureUnitRepository;

    /**
     * Constructor de MeasureUnitProcess.
     *
     * @param MeasureUnitRepository $measureUnitRepository
     */
    public function __construct(
        MeasureUnitRepository $measureUnitRepository
    ) {
        $this->measureUnitRepository = $measureUnitRepository;
    }

    /**
     * Cargar información de las unidades de medida.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('edit.measure_units.module_configuration_catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.measure_units.module_configuration_catalogs',
                'tooltip' => trans('measure_units.labels.update')
            ];
        }

        if ($user->can('destroy.measure_units.module_configuration_catalogs')) {
            $actions['trash'] = [
                'route' => 'destroy.measure_units.module_configuration_catalogs',
                'tooltip' => trans('measure_units.labels.delete'),
                'confirm_message' => trans('measure_units.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        $status = $user->can('status.index.measure_units.module_configuration_catalogs');

        $dataTable = DataTables::of($this->measureUnitRepository->findAll())
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
     * Almacenar nueva unidad de medida.
     *
     * @param Request $request
     *
     * @throws Exception
     */
    public function store(array $data)
    {
        if (!$this->measureUnitRepository->createFromArray($data)) {
            throw new Exception(trans('measure_units.messages.errors.create'), 1000);
        }
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de unidad de medida.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->measureUnitRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('measure_units.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity
        ];
    }

    /**
     * Actualizar la información de unidad de medida.
     *
     * @param Request $request
     * @param int $id
     *
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $entity = $this->measureUnitRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('measure_units.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();
        if (count($entity->indicators) || count($entity->purchases)) {
            unset($data['code']);
        }
        if (!$this->measureUnitRepository->updateFromArray($data, $entity)) {
            throw new Exception(trans('measure_units.messages.errors.update'), 1000);
        }
    }

    /**
     * Eliminar una unidad de medida.
     *
     * @param int $id
     *
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->measureUnitRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('measure_units.messages.exceptions.not_found'), 1000);
        }

        if ($entity->indicators()->count()) {
            throw new Exception(trans('measure_units.messages.exceptions.has_indicators'), 1000);
        }

        if ($entity->purchases()->count()) {
            throw new Exception(trans('measure_units.messages.exceptions.has_indicators'), 1000);
        }

        if (!$this->measureUnitRepository->delete($entity)) {
            throw new Exception(trans('measure_units.messages.errors.delete'), 1000);
        }
    }

    /**
     * Modificar el estado de unidad de medida.
     *
     * @param int $id
     *
     * @return MeasureUnit|mixed|null
     * @throws Exception
     */
    public function status(int $id)
    {
        $entity = $this->measureUnitRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('measure_units.messages.exceptions.not_found'), 1000);
        }

        if ($entity->indicators()->count()) {
            throw new Exception(trans('measure_units.messages.exceptions.has_indicators'), 1000);
        }

        $entity = $this->measureUnitRepository->changeStatus($entity);

        if (!$entity) {
            throw new Exception(trans('measure_units.messages.errors.update'), 1000);
        }

        return $entity;
    }
}
