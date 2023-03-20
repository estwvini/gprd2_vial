<?php

namespace App\Processes\Admin;

use App\Repositories\Repository\Admin\ThresholdRepository;
use Exception;
use Throwable;

/**
 * Clase ThresholdProcess
 * @package App\Processes\Admin
 */
class ThresholdProcess
{
    /**
     * @var ThresholdRepository
     */
    protected $thresholdRepository;

    /**
     * Constructor de ThresholdProcess.
     *
     * @param ThresholdRepository $thresholdRepository
     */
    public function __construct(
        ThresholdRepository $thresholdRepository
    ) {
        $this->thresholdRepository = $thresholdRepository;
    }

    /**
     * Obtener el modelo del proceso de umbrales.
     *
     * @return string
     */
    public function process()
    {
        return ThresholdProcess::class;
    }

    /**
     * Mostrar el formulario de edición de umbrales.
     *
     * @return array
     * @throws Throwable
     */
    public function edit()
    {
        $entities = $this->thresholdRepository->findAll();
        if (!$entities) {
            throw  new Exception(trans('thresholds.threshold.messages.exceptions.not_found'), 1000);
        }
        $response['view'] = view('admin.threshold.update', [
            'entities' => $entities
        ])->render();

        return $response;
    }

    /**
     * Actualizar la información de los umbrales.
     *
     * @param array $data
     *
     * @return array
     * @throws Exception
     */
    public function update(array $data)
    {
        $entities = $this->thresholdRepository->updateAll($data);

        if (!$entities) {
            throw new Exception(trans('thresholds.threshold.messages.errors.update'), 1000);
        }

        return [
            'view' => view('admin.threshold.update', ['entities' => $entities])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('thresholds.threshold.messages.success.updated')
            ]
        ];
    }
}
