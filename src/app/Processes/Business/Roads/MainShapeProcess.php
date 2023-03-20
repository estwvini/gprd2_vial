<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\MainShape;
use App\Models\Business\Roads\Shape;
use App\Repositories\Repository\Business\Roads\MainShapeRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;
use Throwable;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;


use function Psy\debug;

/**
 * Clase MainShapeProcess
 * @package App\Processes\Business\Roads
 */
class MainShapeProcess
{
    /**
     * @var MainShapeRepository
     */
    protected $mainShapeRepository;

    /**
     * Constructor de MainShapeProcess.
     *
     * @param MainShapeRepository $mainShapeRepository
     */
    public function __construct(
        MainShapeRepository $mainShapeRepository
    )
    {
        $this->mainShapeRepository = $mainShapeRepository;
    }

    /**
     * Cargar información de los shapes de una vía.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {     
        $user = currentUser();
        $actions = [];
        if ($user->can('show.main_shape')) {
            $actions['search'] = [
                'route' => 'show.main_shape',
                'tooltip' => trans('shape.labels.details')
            ];
        }
        if ($user->can('edit.main_shape')) {
            $actions['edit'] = [
                'route' => 'edit.main_shape',
                'tooltip' => trans('shape.labels.update')
            ];
        }
        if ($user->can('destroy.main_shape')) {
            $actions['trash'] = [
                'route' => 'destroy.main_shape',
                'tooltip' => trans('app.labels.delete'),
                'confirm_message' => trans('main_shape.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }
        $dataTable = DataTables::of($this->mainShapeRepository->getAll())
            ->setRowId('gid')
            ->addColumn('actions', function (MainShape $entity) use ($actions) {                
                $actions['edit']['params'] = [
                    'id' => $entity->gid
                ];
                $actions['trash']['params'] = [
                    'id' => $entity->gid
                ];
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->editColumn('is_primary', function ($entity) {
                $checked = $entity->is_primary ? 'checked' : '';
                return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
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
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $data = $this->mainShapeRepository->createFromArray($request->all());
        if (!$data[0] && !isset($data[1])) {
            throw new Exception(trans('main_shape.messages.errors.create'), 1000);
        }
        return [
            'view' => view('business.roads.main_shape.index')->render(),
            'message' => [
                'type' => $data[2],
                'text' => $data[1]
            ]
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de un shape.
     *
     * @param int $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $gid)
    {       
        $entity = $this->mainShapeRepository->findById($gid);
        if (!$entity) {
            throw  new Exception(trans('main_shape.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];       
    }

    /**
     * Buscar por Gid
     *
     * @param int $gid
     *
     * @return mixed
     */
    public function findById(int $gid)
    {
        return $this->mainShapeRepository->findById($gid);
    }

    /**
     * Actualizar la información de un shape.
     *
     * @param Request $request
     * @param int $gid
     *
     * @return array
     * @throws Throwable
     */
    public function update(Request $request, int $gid)
    {
        $entity = $this->mainShapeRepository->findById($gid);
        if (!$entity) {
            throw  new Exception(trans('main_shape.messages.exceptions.not_found'), 1000);
        }

        $type = 'success';
        $text = trans('main_shape.messages.success.updated');
        if ($request->is_primary) {
            $verify_shape = $this->shapeVerify();
            if (!count($verify_shape)) {      
                if ($entity->extension == Shape::EXTENSION_GEOJSON) {
                    $entity = $this->mainShapeRepository->updateFromArray($request->all(), $entity);
                    if (!$entity) {
                        throw new Exception(trans('main_shape.messages.errors.update'), 1000);
                    }
                } else {
                    $type = 'danger'; 
                    $text = trans('main_shape.messages.errors.file_extension_error');
                }
            } else {
                $type = 'danger';
                $text = trans('main_shape.messages.errors.status_error');
            }
        } else {
            $entity = $this->mainShapeRepository->updateFromArray($request->all(), $entity);
            if (!$entity) {
                throw new Exception(trans('main_shape.messages.errors.update'), 1000);
            }
        }
        return [
            'message' => [
                'type' => $type,
                'text' => $text
            ]
        ];
    }

    /**
     * Eliminar un shape.
     *
     * @param int $gid
     *
     * @return array
     * @throws Throwable
     */
    public function destroy(int $gid)
    {
        $entity = $this->mainShapeRepository->findById($gid);

        if (!$entity) {
            throw new Exception(trans('main_shape.messages.exceptions.not_found'), 1000);
        }

        if (!$this->mainShapeRepository->delete($entity)) {
            throw new Exception(trans('main_shape.messages.errors.delete'), 1000);
        }

        return [
            'view' => view('business.roads.main_shape.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('main_shape.messages.success.delete')
            ]
        ];
    }

    /**
     * Verificar si hay un shape principal
     *
     * @return mixed
     */
    public function shapeVerify()
    {
        return $this->mainShapeRepository->shapeCode();
    } 

     /**
     * Retornar data necesaria para mostrar todos los Shape de la provincia y query
     *
     * @return array
     */
    public function shapeQuery(array $filters): Response
    {
        $shapeId = '';
        $catId = '';
        if (isset($filters['shape_id'])) {
            $shapeId = $filters['shape_id'];
        }         
        if (isset($filters['cat_id'])) {
            $catId = $filters['cat_id'];
        }   
        $shape_query = $this->mainShapeRepository->shapeQuery($shapeId,$catId);                    
        return new Response(json_encode($shape_query), 200, ['Content-Type' => 'text/plain']);
    }

}