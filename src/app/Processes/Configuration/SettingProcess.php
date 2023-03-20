<?php

namespace App\Processes\Configuration;

use App\Models\System\Setting;
use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Http\Request;
use DataTables;

class SettingProcess
{

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * SettingProcess constructor.
     * @param SettingRepository $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    /**
     * @return string
     */
    public function process()
    {
        return 'App\Processes\Configuration\SettingProcess';
    }

    /**
     * @return mixed
     */
    public function data()
    {
        $actions = [];

        $actions['edit'] = [
            'route' => 'edit.settings.configuration',
            'tooltip' => trans('configuration.setting.labels.edit')
        ];

        $dataTable = Datatables::eloquent(Setting::query())
            ->setRowId('id')
            ->addColumn('actions', function ($entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->editColumn('value', function ($entity) {
                return json_encode($entity->value, true);
            })
            ->rawColumns(['actions'])
            ->make(true);

        return $dataTable;

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function edit($id)
    {
        $entity = $this->settingRepository->find($id);
        if (!$entity)
            throw new \Exception(trans('configuration.setting.messages.exceptions.not_found'));

        $response['view'] = view('configuration.setting.update', [
            'entity' => $entity
        ])->render();

        return $response;
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        $entity = $this->settingRepository->find($id);
        if (!$entity)
            throw new \Exception(trans('configuration.setting.messages.exceptions.not_found'), 1000);

        $this->settingRepository->updateFromArray($request->all(), $entity);

        $response = [
            'view' => view('configuration.setting.index', [
                'entity' => $entity
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('configuration.setting.messages.success.updated')
            ]
        ];

        return $response;
    }

    /**
     * Obtiene el gad que está configurado.
     *
     * @return mixed
     */
    public function gad()
    {
        $gad = $this->settingRepository->findByKey('gad');

        return $gad->value;
    }

}