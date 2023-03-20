<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\Project;
use App\Models\System\File;
use App\Processes\System\FileProcess;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Business\ProjectRepository;
use Exception;
use Illuminate\Http\Request;

/**
 * Clase AttachmentsProcess
 * @package App\Processes\Business\Planning
 */
class AttachmentsProcess
{
    /**
     * @var ProjectRepository
     */
    protected $projectRepository;

    /**
     * @var ProjectProcess
     */
    protected $projectProcess;

    /**
     * @var FileProcess
     */
    protected $fileProcess;

    /**
     * Constructor de AttachmentsProcess.
     *
     * @param ProjectRepository $projectRepository
     * @param ProjectProcess $projectProcess
     * @param FileProcess $fileProcess
     */
    public function __construct(
        ProjectRepository $projectRepository,
        ProjectProcess $projectProcess,
        FileProcess $fileProcess
    )
    {
        $this->projectRepository = $projectRepository;
        $this->projectProcess = $projectProcess;
        $this->fileProcess = $fileProcess;
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de anexos.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function create(int $id)
    {
        $project = $this->projectRepository->find($id);

        if (!isset($project)) {
            throw new Exception(trans('attachments.messages.exceptions.project_not_found'), 1000);
        }

        return [
            'project' => $project,
            'files' => $project->files
        ];
    }

    /**
     * Almacenar anexos del proyecto.
     *
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $project = $this->projectRepository->find($data['project_id']);

        if (!$project) {
            throw new Exception(trans('attachments.messages.exceptions.project_not_found'), 1000);
        }

        foreach ($data['files'] as $file) {
            $file_road['file'] = $file;
            $file_road['name'] = $file->getClientOriginalName();
            $file_road['is_road'] = 0;
            $file_road['project_id'] = $data['project_id'];
            $file_road['_method'] = $data['_method'];
            $file_road['_token'] = $data['_token'];
            storeFile($file_road, $project);
        }
        $message = trans('attachments.messages.success.created');

        return [$project->fresh(), $message];
    }

    /**
     * Eliminar anexos del proyecto.
     *
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        $project = $this->projectRepository->find($data['project_id']);

        if (!$project) {
            throw new Exception(trans('attachments.messages.exceptions.project_not_found'), 1000);
        }

        $this->fileProcess->destroy($data['fileId']);

        return ['project' => $project->fresh()];
    }

    /**
     * Almacenar anexos viales del proyecto.
     *
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function storeRoads(Request $request)
    {
        $data = $request->all();
        $project = $this->projectRepository->find($data['project_id']);
        $message = '';
        $type_message = '';
        $enable = 1;

        if (!$project) {
            throw new Exception(trans('attachments.messages.exceptions.project_not_found'), 1000);
        }

        foreach ($data['files'] as $file) {
            if (!in_array(strtolower($file->getClientOriginalExtension()), File::EXTENSIONS_FILES)) {
                $message = trans('attachments.messages.errors.extension_invalid');
                $type_message = 'danger';
                $enable = 0;
                break;
            }
        }
        if ($enable) {
            foreach ($data['files'] as $file) {
                $file_road['file'] = $file;
                $file_road['name'] = $file->getClientOriginalName();
                $file_road['is_road'] = 1;
                $file_road['project_id'] = $data['project_id'];
                $file_road['_method'] = $data['_method'];
                $file_road['_token'] = $data['_token'];
                storeFile($file_road, $project);
            }
            $message = trans('attachments.messages.success.created');
            $type_message = 'success';
        }

        return [$project->fresh(), $message, $type_message];
    }

    /**
     * Eliminar anexos viales del proyecto.
     *
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function destroyRoads(Request $request)
    {
        $data = $request->all();
        $project = $this->projectRepository->find($data['project_id']);

        if (!$project) {
            throw new Exception(trans('attachments.messages.exceptions.project_not_found'), 1000);
        }

        $this->fileProcess->destroy($data['fileId']);

        return ['project' => $project->fresh()];
    }
}