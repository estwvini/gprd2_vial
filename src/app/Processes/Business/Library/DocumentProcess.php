<?php

namespace App\Processes\Business\Library;

use App\Repositories\Repository\Business\Library\DocumentRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Exception;


/**
 * Clase DocumentProcess
 * @package App\Processes\Business\Library
 */
class DocumentProcess
{
    /**
     * @var DocumentRepository
     */
    protected $documentRepository;

    /**
     * Constructor de DocumentProcess.
     *
     * @param DocumentRepository $documentRepository
     */
    public function __construct(
        DocumentRepository $documentRepository
    ) {
        $this->documentRepository = $documentRepository;
    }

    /**
     * Cargar información del documento.
     *
     * @return mixed
     * @throws Exception
     */
    public function data(array $filter)
    {
        $user = currentUser();
        $document = $this->documentRepository->getAllWith($filter);
        $actions = [];

        if ($user->can('download.index.inventory_library')) {
            $actions['cloud-download'] = [
                'route' => 'download.index.inventory_library',
                'tooltip' => trans('files.labels.download'),
                'btn_class' => 'btn-success',
                'no_ajax' => true
            ];
        }
        if ($user->can('edit.inventory_library')) {
            $actions['edit'] = [
                'route' => 'edit.inventory_library',
                'tooltip' => trans('library.labels.update')
            ];
        }
        if ($user->can('destroy.inventory_library')) {
            $actions['trash'] = [
                'route' => 'destroy.inventory_library',
                'tooltip' => trans('app.labels.delete'),
                'confirm_message' => trans('library.messages.confirm.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }
        $dataTable = DataTables::of($document)
            ->setRowId('id')           
            ->addColumn('actions', function ($entity) use ($actions) {
                $actions['edit']['params'] = [
                    'id' => $entity->id
                ];
                $actions['trash']['params'] = [
                    'id' => $entity->id
                ];
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['name', 'actions'])
            ->make(true);
        return $dataTable;
    }

    /**
     * Almacenar nuevo documento.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $this->documentRepository->createFromArray($request->all());
        if (!$data[0] && !isset($data[1])) {
            throw new Exception(trans('library.messages.errors.create_document'), 1000);
        }
        return [
            'view' => view('dashboard.library.index', [
                'type_id' => $request->input('type')
            ])->render(),
            'message' => [
                'type' => $data[2],
                'text' => $data[1]
            ]
        ];
    }

     /**
     * Retornar data necesaria para mostrar el formulario de edición de un documento.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {       
        $entity = $this->documentRepository->findById($id);
        if (!$entity) {
            throw  new Exception(trans('library.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];       
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
        $entity = $this->documentRepository->findById($gid);
        if (!$entity) {
            throw  new Exception(trans('library.messages.exceptions.not_found'), 1000);
        }

        $type = 'success';
        $text = trans('library.messages.success.updated');
       
        $entity = $this->documentRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('library.messages.errors.update'), 1000);
        }
        
        return [
            'message' => [
                'type' => $type,
                'text' => $text
            ]
        ];
    }

    /**
     * Eliminar un documento.
     *
     * @param int $gid
     *
     * @return array
     * @throws Throwable
     */
    public function destroy(int $id)
    {
        $entity = $this->documentRepository->findById($id); 
        $file = $entity->path;
        $type_id =  $entity->type;            
        if (!$entity) {
            throw new Exception(trans('library.messages.exceptions.not_found'), 1000);
        }
        if (Storage::disk('inventory_documents')->exists($file)) {    
            Storage::disk('inventory_documents')->delete($file);   
        }
        if (!$this->documentRepository->destroy($id)) {
            throw new Exception(trans('library.messages.errors.delete'), 1000);
        }       
        return [
            'view' => view('dashboard.library.index',[
                'type_id' => $type_id])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('library.messages.success.delete')
            ]
        ];
    }
    
    /**
     * Retornar el documento por id.
     *
     * @return array
     */
    public function findById(int $id)
    {
        $document = $this->documentRepository->findById($id);
           
        return [
            'document' => $document           
        ];
    }

    /**
     * Descargar un archivo.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function download(int $id)
    {
        $entity = $this->documentRepository->findById($id);

        if (!$entity) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }
        if (!Storage::disk('inventory_documents')->exists($entity->path)) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        return Storage::disk('inventory_documents')->download($entity->path);
    }
}