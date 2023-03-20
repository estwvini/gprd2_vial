<?php

namespace App\Repositories\Repository\Business\Library;

use App\Models\Business\Library\Document;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use App\Models\System\File;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Clase DocumentRepository
 * @package App\Repositories\Repository\Business\Library
 */
class DocumentRepository extends Repository
{
    /**
     * Constructor de DocumentRepository.
     *
     * @param App $app
     * @param Collection $collection
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection)
    {
        parent::__construct($app, $collection);
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return mixed|string
     */
    function model()
    {
        return Document::class;
    }

    /**
     * Actualizar en la BD la información de un documento
     *
     * @param array $data
     * @param Document $entity
     *
     * @return Document|null
     */
    public function updateFromArray(array $data, Document $entity)
    {
        if (Storage::disk('inventory_documents')->exists($entity->path)) {    
            Storage::disk('inventory_documents')->delete($entity->path);   
        }
        $file = $data['document']; 
        $entity->fill($data);
        try {                
            $fileName = $file->getClientOriginalName();
            //$path = env('LIBRARY_DOCUMENT_PATH') . $fileName;
            $entity->path = $fileName;               
            $file->storeAs('', $fileName, 'inventory_documents');                                   
            $entity->save();
            return $entity->fresh();
        } catch (Exception $e) {
            Log::debug("exception:" . $e);
            return null;
        }    
    }

    /**
     * Almacenar en la BD un nuevo documento.
     *
     * @param array $data
     *
     * @return Document|null
     */
    public function createFromArray(array $data)
    {
        $file = $data['document']; 
        $enable = 1;
        $message = trans('library.messages.success.document_created');
        $type_message = 'success';
        if (strtolower($file->getClientOriginalExtension()) !== File::PDF_FILE_EXTENSION) {
            $message = trans('library.messages.errors.only_pdf');
            $type_message = 'danger';
            $enable = 0;
        }        
        if ($enable) {
            try {             
                $entity = new $this->model;
                $documentData['code'] = $data['code'];
                $documentData['name'] = $data['name'];
                $documentData['description'] = $data['description'];
                $documentData['type'] = $data['type'];
                $fileName = $file->getClientOriginalName();
                $documentData['path'] = $fileName;               
                $file->storeAs('', $fileName, 'inventory_documents');                                   
                $entity->create($documentData);
            } catch (Exception $e) {
                Log::debug("exception:" . $e);
                return [false];
            }    
            return [true, $message, $type_message];
        }
        return [false, $message, $type_message];              
    }
  
    /**
     * Obtener de la BD un documento por id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * Obtiene todos los registros de documento por tipo
     *
     * @param array $filters
     *
     * @return mixed
     */
    public function getAllWith(array $filters)
    {
        return $this->model
            ->where(function ($query) use ($filters) {
                if (isset($filters['type_id'])) {
                    $query->where('type', $filters['type_id']);
                }                
            })           
            ->select('id', 'code', 'name', 'description', 'type')
            ->orderBy('name')
            ->get();
    }

}