<?php

namespace App\Processes\Configuration;


use App\Models\System\Menu;
use App\Repositories\Repository\Configuration\MenuRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

class MenuProcess
{

    /**
     * @var MenuRepository
     */
    protected $menuRepository;

    public function __construct(
        MenuRepository $menuRepository
    )
    {
        $this->menuRepository = $menuRepository;
    }

    /**
     * @return string
     */
    public function process()
    {
        return 'App\Processes\Configuration\MenuProcess';
    }

    /**
     *
     * @return mixed
     */
    public function data()
    {
        $actions = [];

        $actions['search-plus'] = [
            'route' => 'show.menus.configuration',
            'tooltip' => trans('configuration.menu.labels.details')
        ];

        $actions['edit'] = [
            'route' => 'edit.menus.configuration',
            'tooltip' => trans('configuration.menu.labels.edit')
        ];

        $dataTable = Datatables::eloquent(Menu::query())
            ->setRowId('id')
            ->order(function ($query) {
                $query->orderBy('weight', 'asc');
            })
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
            ->editColumn('enabled', function ($entity) {
                $checked = $entity->enabled ? 'checked' : '';
                return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked} /></label>";
            })
            ->rawColumns(['bulk_action', 'updated_at', 'actions', 'enabled'])
            ->make(true);

        return $dataTable;

    }

    /**
     * @return mixed
     * @throws \Exception
     * @throws \Throwable
     */
    public function create()
    {
        $parents = $this->menuRepository->findParents();
        if (!$parents)
            throw new \Exception(trans('configuration.messages.errors.create'), 1000);

        $response['view'] = view('configuration.menu.create', [
            'parents' => $parents
        ])->render();

        return $response;
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $entity = $this->menuRepository->createFromArray($request->all());

        if (!$entity)
            throw new \Exception(trans('app.messages.exceptions.unexpected'));

        $response = [
            'view' => view('configuration.menu.show', [
                'entity' => $entity
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('configuration.menu.messages.success.created')
            ]
        ];

        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     * @throws \Throwable
     */
    public function show($id)
    {
        $entity = $this->menuRepository->find($id);

        if (!$entity)
            throw new \Exception(trans('configuration.menu.messages.exceptions.not_found'));

        $response['view'] = view('configuration.menu.show', [
            'entity' => $entity
        ])->render();

        return $response;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Throwable
     */
    public function edit($id)
    {
        $entity = $this->menuRepository->find($id);

        if (!$entity)
            throw new \Exception(trans('configuration.menu.messages.exceptions.not_found'));

        $parents = $this->menuRepository->findParents();

        $response['view'] = view('configuration.menu.update', [
            'entity' => $entity,
            'parents' => $parents
        ])->render();

        return $response;
    }

    /**
     * @param Request $request
     * @param $id
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    public function update(Request $request, $id)
    {
        $entity = $this->menuRepository->find($id);

        if (!$entity)
            throw new \Exception(trans('configuration.menu.messages.exceptions.not_found'), 1000);

        $entity = $this->menuRepository->updateFromArray($request->all(), $entity);

        if (!$entity)
            throw new \Exception(trans('app.messages.exceptions.unexpected'), 1000);

        $response = [
            'view' => view('configuration.menu.show', [
                'entity' => $entity
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('configuration.menu.messages.success.updated')
            ]
        ];

        return $response;
    }


    /**
     * @param $id
     * @return array
     * @throws \Exception
     * @throws \Throwable
     */
    public function destroy($id)
    {
        $entity = $this->menuRepository->find($id);

        if (!$entity)
            throw new \Exception(trans('configuration.menu.messages.exceptions.not_found'), 1000);

        if (!$this->menuRepository->delete($entity))
            throw new \Exception(trans('app.messages.exceptions.unexpected'), 1000);

        $response = [
            'view' => view('configuration.menu.index')->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('configuration.menu.messages.success.deleted')
            ]
        ];

        return $response;
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function bulkDestroy(Request $request)
    {

        $entities = $this->menuRepository->findByIds($request->ids);

        foreach ($entities as $entity)
            $this->menuRepository->delete($entity);

        $response['message'] = [
            'type' => 'success',
            'text' => trans('configuration.menu.messages.success.deleted_bulk')
        ];

        return $response;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Exception
     */
    public function status($id)
    {
        $entity = $this->menuRepository->find($id);

        if (!$entity)
            throw  new \Exception(trans('configuration.menu.messages.exceptions.not_found'), 1000);

        if (!$this->menuRepository->changeStatus($entity))
            throw new \Exception(trans('app.messages.exceptions.unexpected'), 1000);

        $response['message'] = [
            'type' => 'success',
            'text' => trans('configuration.menu.messages.success.updated')
        ];

        return $response;
    }


    /**
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function bulkStatus(Request $request)
    {
        $entities = $this->menuRepository->findByIds($request->ids);

        foreach ($entities as $entity)
            $this->menuRepository->changeStatus($entity);

        $response['message'] = [
            'type' => 'success',
            'text' => trans('configuration.menu.messages.success.updated_bulk')
        ];

        return $response;
    }

}