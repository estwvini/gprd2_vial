<?php

namespace App\Processes\Configuration;

use App\Repositories\Repository\Configuration\PermissionRepository;
use Exception;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Throwable;

class PermissionProcess
{

    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    /**
     * @return string
     */
    public function process()
    {
        return 'App\Processes\Configuration\PermissionProcess';
    }


    public function __construct(
        PermissionRepository $permissionRepository
    )
    {
        $this->permissionRepository = $permissionRepository;
    }

    /**
     *
     * @return mixed
     */
    public function data()
    {
        $actions = [];

        $actions['search-plus'] = [
            'route' => 'show.permissions.configuration',
            'tooltip' => trans('configuration.permission.labels.details')
        ];


        $actions['edit'] = [
            'route' => 'edit.permissions.configuration',
            'tooltip' => trans('configuration.permission.labels.edit')
        ];

        return Datatables::eloquent(config('acl.permission')::query())
            ->setRowId('id')
            ->addColumn('bulk_action', function ($entity) {
                return "<input type='checkbox' name='table_records' class='bulk check-one' value='{$entity->id}' />";
            })
            ->addColumn('updated_at', function ($entity) {
                Carbon::setLocale(config('app.locale'));
                return $entity->updated_at->diffForHumans();
            })
            ->addColumn('actions', function ($entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['bulk_action', 'updated_at', 'actions'])
            ->make(true);
    }

    /**
     * @param Request $request
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function store(Request $request)
    {
        $entity = $this->permissionRepository->createFromArray($request->all());

        if (!$entity)
            throw new Exception(trans('app.messages.exceptions.unexpected'), 1000);

        $response = [
            'view' => view('configuration.permission.show', [
                'entity' => $entity
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('configuration.permission.messages.success.created')
            ]
        ];

        return $response;
    }


    /**
     * @param $id
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function show($id)
    {
        $entity = $this->permissionRepository->find($id);

        if (!$entity)
            throw new Exception(trans('configuration.permission.messages.exceptions.not_found'), 1000);

        $response['view'] = view('configuration.permission.show', [
            'entity' => $entity
        ])->render();

        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     * @throws Throwable
     */
    public function edit($id)
    {
        $entity = $this->permissionRepository->find($id);

        if (!$entity)
            throw new Exception(trans('configuration.permission.messages.exceptions.not_found'), 1000);

        $response['view'] = view('configuration.permission.update', [
            'entity' => $entity
        ])->render();

        return $response;
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function update(Request $request, $id)
    {
        $entity = $this->permissionRepository->find($id);

        if (!$entity)
            throw new Exception(trans('configuration.permission.messages.exceptions.not_found'), 1000);

        $name = $entity->name;
        $entity = $this->permissionRepository->updateFromArray($request->all(), $entity);

        if (!$entity)
            throw new Exception(trans('app.messages.exceptions.unexpected'), 1000);

        // update children name
        if ($name != $entity->name)
            $this->permissionRepository->updateChildrenName($entity, $name, $this->permissionRepository);

        $response = [
            'view' => view('configuration.permission.show', [
                'entity' => $entity
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('configuration.permission.messages.success.updated')
            ]
        ];

        return $response;
    }

    /**
     * @param $id
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function destroy($id)
    {
        $entity = $this->permissionRepository->find($id);

        if (!$entity)
            throw new Exception(trans('configuration.permission.messages.exceptions.not_found'), 1000);

        if (!$this->permissionRepository->delete($entity, $this->permissionRepository))
            throw new Exception(trans('app.messages.exceptions.unexpected'), 1000);

        $response = [
            'view' => view('configuration.permission.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('configuration.permission.messages.success.deleted')
            ]
        ];

        return $response;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function bulkDestroy(Request $request)
    {
        $entities = $this->permissionRepository->findByIds($request->ids);

        foreach ($entities as $entity)
            $this->permissionRepository->recursiveDelete($entity, $this->permissionRepository);

        $response['message'] = [
            'type' => 'success',
            'text' => trans('configuration.permission.messages.success.deleted_bulk')
        ];

        return $response;
    }


}