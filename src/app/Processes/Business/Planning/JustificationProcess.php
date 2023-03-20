<?php

namespace App\Processes\Business\Planning;

use App\Models\System\File;
use App\Repositories\Repository\Business\Planning\JustificationRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase JustificationProcess
 * @package App\Processes\Business\Planning
 */
class JustificationProcess
{
    /**
     * @var JustificationRepository
     */
    protected $justificationRepository;

    /**
     * Constructor de JustificationProcess.
     *
     * @param JustificationRepository $justificationRepository
     */
    public function __construct(
        JustificationRepository $justificationRepository
    ) {
        $this->justificationRepository = $justificationRepository;
    }
    
    /**
     * Almacenar nueva justificación.
     *
     * @param array $data
     * @param Model $model
     * @param bool $suffix
     *
     * @return mixed
     * @throws Exception
     */
    public function store(array $data, Model $model, bool $suffix = false)
    {
        $entity = $this->justificationRepository->createFromArray($this->normalizeData($data, $model, $suffix));

        if (!$entity) {
            throw new Exception(trans('justifications.messages.errors.create'), 1000);
        }

        return $entity;
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de archivo.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function edit(int $id)
    {
        $entity = $this->justificationRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity,
            'extension' => (new Filesystem())->extension($entity->path)
        ];
    }

    /**
     * Eliminar lógicamente un archivo.
     *
     * @param int $id
     *
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->justificationRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        if (!$this->justificationRepository->delete($entity)) {
            throw new Exception(trans('files.messages.errors.delete'), 1000);
        }
    }

    /**
     * Normalizar la información para almacenar en la BD.
     *
     * @param array $data
     * @param Model $model
     * @param bool $suffix
     *
     * @return array
     */
    private function normalizeData(array $data, Model $model, bool $suffix)
    {
        if ($suffix) {
            $data['action'] = $data['actionMultiple'];
            $data['justificationDescription'] = $data['justificationDescriptionMultiple'];
            $data['justificationFile'] = $data['justificationFileMultiple'];
            $data['justificationDocumentReference'] = $data['justificationDocumentReferenceMultiple'];
            unset($data['actionMultiple']);
            unset($data['justificationDescriptionMultiple']);
            unset($data['justificationFileMultiple']);
            unset($data['justificationDocumentReferenceMultiple']);
        }

        // upload file
        if (isset($data['justificationFile'])) {
            $data['path'] = $data['justificationFile']->store(with($model)->getTable() . '/' . $model->id, 'justifications');
            unset($data['justificationFile']);
        }

        if (isset($data['justificationDescription'])) {
            $data['description'] = $data['justificationDescription'];
            unset($data['justificationDescription']);
        }

        if (isset($data['justificationDocumentReference'])) {
            $data['document_reference'] = $data['justificationDocumentReference'];
            unset($data['justificationDocumentReference']);
        }

        $data['user_id'] = currentUser()->id;

        return $data;
    }

    /**
     * Descargar el archivo de una justificación.
     *
     * @param int $id
     *
     * @return string
     * @throws Exception
     */
    public function download(int $id)
    {
        $entity = $this->justificationRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('justifications.messages.exceptions.not_found'), 1000);
        }

        if (!Storage::disk('justifications')->exists($entity->path)) {
            throw new Exception(trans('justifications.messages.exceptions.file_not_found'), 1000);
        }

        return Storage::disk('justifications')->download($entity->path);
    }
}