<?php

namespace App\Processes\Business\Catalogs;

use App\Models\Business\Catalogs\SpendingGuide;
use App\Repositories\Repository\Business\Catalogs\SpendingGuideRepository;
use App\Repositories\Repository\Criteria\SpendingGuide\SpendingGuideEnabledTrue;
use Exception;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase SpendingGuideProcess
 * @package App\Processes\Business\Catalogs
 */
class SpendingGuideProcess
{
    /**
     * @var SpendingGuideRepository
     */
    protected $spendingGuideRepository;

    /**
     * Constructor de SpendingGuideProcess.
     *
     * @param SpendingGuideRepository $spendingGuideRepository
     */
    public function __construct(SpendingGuideRepository $spendingGuideRepository)
    {
        $this->spendingGuideRepository = $spendingGuideRepository;
    }

    /**
     * Cargar información de las orientación de gastos.
     *
     * @param array $data
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function data(array $data)
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('create.spending_guide.module_configuration_catalogs')) {
            $actions['plus'] = [
                'route' => 'create.spending_guide.module_configuration_catalogs',
                'btn_class' => 'btn-success'
            ];
        }

        if ($user->can('edit.spending_guide.module_configuration_catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.spending_guide.module_configuration_catalogs'
            ];
        }

        if ($user->can('destroy.spending_guide.module_configuration_catalogs')) {
            $actions['trash'] = [
                'route' => 'destroy.spending_guide.module_configuration_catalogs',
                'tooltip' => trans('app.labels.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        $parent_id = null;
        $filters = array_filter($data)['filters'];
        if (count($filters)) {
            if (isset($filters['category']) && $filters['category']) {
                $parent_id = $filters['category'];
            } elseif (isset($filters['addressing']) && $filters['addressing']) {
                $parent_id = $filters['addressing'];
            } elseif (isset($filters['spending']) && $filters['spending']) {
                $parent_id = $filters['spending'];
            }
        }

        $dataTable = DataTables::of($this->spendingGuideRepository->findAllOrdered($parent_id))
            ->setRowId('id')
            ->editColumn('level', function ($entity) {
                return trans('spending_guide.labels.level_' . ($entity->level));
            })
            ->editColumn('enabled', function ($entity) use ($user) {
                $checked = $entity->enabled ? 'checked' : '';

                if ($user->can('status.spending_guide.module_configuration_catalogs')) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                } else {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' disabled {$checked}/></label>";
                }
            })
            ->addColumn('actions', function ($entity) use ($actions, $user) {

                if (isset($actions['plus'])) {

                    if (!$entity->enabled) {
                        unset($actions['plus']);
                    } else {
                        if ($entity->level == 4) {
                            unset($actions['plus']);
                        } else {
                            // update tooltip message for create action
                            $actions['plus']['tooltip'] = trans('spending_guide.labels.create', ['type' => trans('spending_guide.labels.level_' . ($entity->level + 1))]);
                        }
                    }
                }

                // update tooltip message for edit action
                if ($actions['edit']) {
                    $actions['edit']['tooltip'] = trans('spending_guide.labels.edit', ['type' => trans('spending_guide.labels.level_' . $entity->level)]);
                }

                // update messages for destroy action
                if ($actions['trash']) {
                    $actions['trash']['tooltip'] = trans('spending_guide.labels.delete', ['type' => trans('spending_guide.labels.level_' . $entity->level)]);
                    $actions['trash']['confirm_message'] = trans('spending_guide.messages.confirm.delete', ['type' => trans('spending_guide.labels.level_' . $entity->level)]);
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['enabled', 'actions'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de orientación de gasto.
     *
     * @param int|null $id
     *
     * @return array
     */
    public function create(int $id = null)
    {
        $entity = $this->spendingGuideRepository->find($id);

        return [
            'entity' => $entity,
            'types' => SpendingGuide::levels(),
            'orientations' => $this->byLevels(1),
            'addressings' => [],
            'categories' => [],
            'subcategories' => []
        ];
    }

    /**
     * Almacenar nueva orientación de gasto.
     *
     * @param array $data
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function store(array $data)
    {
        $entity = $this->spendingGuideRepository->createFromArray($this->processRequest($data));

        if (!$entity) {
            throw new Exception(trans('spending_guide.messages.errors.create'), 1000);
        }

        return $entity;
    }

    /**
     * Retornar data necesaria para mostrar la información de orientación de gasto.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function show(int $id)
    {
        $entity = $this->spendingGuideRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('spending_guide.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de orientación de gasto.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->spendingGuideRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('spending_guide.messages.exceptions.not_found'), 1000);
        }

        $updateCode = true;
        if (count($this->spendingGuideRepository->findLeafChildrenNotInUse($entity->id))) {
            $updateCode = false;
        }

        return [
            'entity' => $entity,
            'updateCode' => $updateCode
        ];
    }

    /**
     * Actualizar la información de orientación de gasto.
     *
     * @param array $data
     * @param int $id
     *
     * @return SpendingGuide
     * @throws Exception
     */
    public function update(array $data, int $id)
    {
        $entity = $this->spendingGuideRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('spending_guide.messages.exceptions.not_found'), 1000);
        }
        $updateCode = true;

        if (count($this->spendingGuideRepository->findLeafChildrenNotInUse($entity->id))) {
            unset($data['code']);
            $updateCode = false;
        } else {
            $data = $this->processRequest($data);
        }

        $entity = $this->spendingGuideRepository->updateFromArray($data, $entity, $updateCode);

        if (!$entity) {
            throw new Exception(trans('spending_guide.messages.errors.update'), 1000);
        }

        return $entity;
    }

    /**
     * Eliminar una orientación de gasto.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->spendingGuideRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('spending_guide.messages.exceptions.not_found'), 1000);
        }

        if ($entity->children()->count() > 0) {
            throw new Exception(trans('spending_guide.messages.exceptions.has_children'), 1000);
        }

        if (count($entity->budgetItems)) {
            throw new Exception(trans('spending_guide.messages.exceptions.has_budgetItems'), 1000);
        }

        $level = $entity->level;

        if (!$this->spendingGuideRepository->delete($entity)) {
            throw new Exception(trans('spending_guide.messages.errors.delete'), 1000);
        }

        return $level;
    }

    /**
     * Modificar el estado de orientación de gasto.
     *
     * @param int $id
     *
     * @return SpendingGuide|mixed|null
     * @throws Exception
     */
    public function status(int $id)
    {
        $entity = $this->spendingGuideRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('spending_guide.messages.exceptions.not_found'), 1000);
        }

        if ($entity->children()->where('enabled', 1)->count() > 0) {
            throw new Exception(trans('spending_guide.messages.exceptions.has_children'), 1000);
        }

        if (!$entity->enabled && isset($entity->parent_id) && !$entity->parent->enabled) {
            throw new Exception(trans('spending_guide.messages.exceptions.parent_disabled'), 1000);
        }

        $entity = $this->spendingGuideRepository->changeStatus($entity);

        if (!$entity) {
            throw new Exception(trans('spending_guide.messages.errors.update'), 1000);
        }

        return $entity;
    }

    /**
     * Valida y normaliza los datos de la petición
     *
     * @param array $data
     *
     * @return array
     *
     */
    private function processRequest(array $data)
    {
        $parent = null;
        if (isset($data['parent_id'])) {
            $parent = $this->spendingGuideRepository->find($data['parent_id']);
            $data['full_code'] = $parent->full_code . '.' . $data['code'];
        } else {
            $data['full_code'] = $data['code'];
        }

        return $data;
    }

    /**
     * Busca por el campo type y devuleve una lista
     *
     * @param int $level
     *
     * @return mixed
     */
    public function byLevels(int $level)
    {
        $this->spendingGuideRepository->pushCriteria(new SpendingGuideEnabledTrue());
        return $this->spendingGuideRepository->findByField('level', $level, ['id', 'code', 'description']);
    }

    /**
     * Busca por el id del padre
     *
     * @param int $id
     *
     * @return mixed
     */
    public function byParent(int $id)
    {
        $this->spendingGuideRepository->pushCriteria(new SpendingGuideEnabledTrue());
        return $this->spendingGuideRepository->findByField('parent_id', $id, ['id', 'code', 'description']);
    }
}
