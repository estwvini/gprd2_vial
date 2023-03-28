<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\Shape;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\ShapeRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

/**
 * Clase ShapeProcess
 * @package App\Processes\Business\Roads
 */
class ShapeProcess
{
    /**
     * @var ShapeRepository
     */
    protected $shapeRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * Constructor de ShapeProcess.
     *
     * @param ShapeRepository $shapeRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     */
    public function __construct(
        ShapeRepository $shapeRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
    )
    {
        $this->shapeRepository = $shapeRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
    }

    /**
     * Cargar información de los shapes de una vía.
     *
     * @param string $code
     * @param bool $show
     *
     * @return mixed
     * @throws Exception
     */
    public function data(string $code, bool $show = false)
    {
        $user = currentUser();
        $actions = [];
        if ($user->can('show.shape.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.shape.inventory_roads',
                'tooltip' => trans('shape.labels.details')
            ];
        }
        if ($user->can('edit.shape.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.shape.inventory_roads',
                'tooltip' => trans('shape.labels.update')
            ];
        }
        if ($user->can('destroy.shape.inventory_roads')) {
            $actions['trash'] = [
                'route' => 'destroy.shape.inventory_roads',
                'tooltip' => trans('app.labels.delete'),
                'confirm_message' => trans('shape.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }
        $dataTable = DataTables::of($this->shapeRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->editColumn('is_primary', function ($entity) use ($show) {
                $checked = $entity->is_primary ? 'checked' : '';
                $disabled = $show ? 'disabled' : '';

                return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked} {$disabled}/></label>";
            })
            ->addColumn('actions', function (Shape $entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions', 'is_primary'])
            ->make(true);
        return $dataTable;
    }

    /**
     * Almacenar nuevo shape para una vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $this->shapeRepository->createFromArray($request->all());
        if (!$data[0] && !isset($data[1])) {
            throw new Exception(trans('main_shape.messages.errors.create'), 1000);
        }

        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'shape' => true,
            'message' => [
                'type' => $data[2],
                'text' => $data[1]
            ]
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de un shape.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->shapeRepository->findById($id);
        if (!$entity) {
            throw  new Exception(trans('shape.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Buscar por Gid
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->shapeRepository->findById($id);
    }

    /**
     * Actualizar la información de un shape.
     *
     * @param Request $request
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $entity = $this->shapeRepository->findById($id);
        if (!$entity) {
            throw  new Exception(trans('shape.messages.exceptions.not_found'), 1000);
        }

        $type = 'success';
        $text = trans('shape.messages.success.updated');
        if ($request->is_primary) {
            $verify_shape = $this->shapeVerify($entity->codigo);
            if (!count($verify_shape)) {
                if ($entity->extension == Shape::EXTENSION_SHP) {
                    $entity = $this->shapeRepository->updateFromArray($request->all(), $entity);
                    if (!$entity) {
                        throw new Exception(trans('main_shape.messages.errors.update'), 1000);
                    }
                } else {
                    $type = 'danger';
                    $text = trans('main_shape.messages.errors.file_extension_error');
                }
            } else {
                $type = 'danger';
                $text = trans('shape.messages.errors.status_error');
            }
        } else {
            $entity = $this->shapeRepository->updateFromArray($request->all(), $entity);
            if (!$entity) {
                throw new Exception(trans('shape.messages.errors.update'), 1000);
            }
        }

        return [
            'entity' => [
                'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($entity->codigo),
                'shape' => true
            ],
            'message' => [
                'type' => $type,
                'text' => $text
            ]
        ];
    }

    /**
     * Eliminar un shape.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->shapeRepository->findById($id);

        if (!$entity) {
            throw new Exception(trans('shape.messages.exceptions.not_found'), 1000);
        }

        if (!$this->shapeRepository->delete($entity)) {
            throw new Exception(trans('shape.messages.errors.delete'), 1000);
        }

        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($entity->codigo),
            'shape' => true
        ];
    }

    /**
     * Verificar si hay un shape principal
     *
     * @param string $code
     *
     * @return mixed
     */
    public function shapeVerify(string $code)
    {
        return $this->shapeRepository->shapeCode($code);
    }
}