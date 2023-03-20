<?php

namespace App\Processes\Business\Catalogs;

use App\Models\Business\Catalogs\BudgetClassifier;
use App\Repositories\Repository\Business\Catalogs\BudgetClassifierRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase BudgetClassifierProcess
 * @package App\Processes\Business\Catalogs
 */
class BudgetClassifierProcess
{
    /**
     * @var BudgetClassifierRepository
     */
    protected $budgetClassifierRepository;

    /**
     * Constructor de BudgetClassifierProcess.
     *
     * @param BudgetClassifierRepository $budgetClassifierRepository
     */
    public function __construct(
        BudgetClassifierRepository $budgetClassifierRepository
    ) {
        $this->budgetClassifierRepository = $budgetClassifierRepository;
    }

    /**
     * Cargar información de los clasificadores presupuestarios.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('show.budget_classifiers.module_configuration_catalogs')) {
            $actions['search'] = [
                'route' => 'show.budget_classifiers.module_configuration_catalogs'
            ];
        }

        if ($user->can('create.budget_classifiers.module_configuration_catalogs')) {
            $actions['plus'] = [
                'route' => 'create.budget_classifiers.module_configuration_catalogs',
                'btn_class' => 'btn-success'
            ];
        }

        if ($user->can('edit.budget_classifiers.module_configuration_catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.budget_classifiers.module_configuration_catalogs'
            ];
        }

        if ($user->can('destroy.budget_classifiers.module_configuration_catalogs')) {
            $actions['trash'] = [
                'route' => 'destroy.budget_classifiers.module_configuration_catalogs',
                'tooltip' => trans('app.labels.delete'),
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        $status = $user->can('status.budget_classifiers.module_configuration_catalogs');

        $dataTable = DataTables::of($this->budgetClassifierRepository->findAllOrdered())
            ->setRowId('id')
            ->addColumn('level_description', function ($entity) {
                switch ($entity->level) {
                    case 1:
                        return trans('budget_classifiers.labels.level_1');
                        break;
                    case 2:
                        return trans('budget_classifiers.labels.level_2');
                        break;
                    case 3:
                        return trans('budget_classifiers.labels.level_3');
                        break;
                    default:
                        return trans('budget_classifiers.labels.level_default');
                        break;
                }
            })
            ->editColumn('enabled', function ($entity) use ($status) {
                $checked = $entity->enabled ? 'checked' : '';

                if ($status) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                } else {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' disabled {$checked}/></label>";
                }
            })
            ->addColumn('actions', function ($entity) use ($actions, $user) {

                if (!$entity->enabled) {
                    unset($actions['plus']);
                }

                // update tooltip message for edit action
                if (isset($actions['search'])) {
                    if ($entity->level > 3) {
                        $actions['search']['tooltip'] = trans('budget_classifiers.labels.details', ['type' => trans('budget_classifiers.labels.level_default')]);
                    } else {
                        $actions['search']['tooltip'] = trans('budget_classifiers.labels.details', ['type' => trans('budget_classifiers.labels.level_' . $entity->level)]);
                    }
                }

                // update tooltip message for create action
                if (isset($actions['plus'])) {
                    if ($entity->level == 4) {
                        unset($actions['plus']);
                    } elseif (($entity->level + 1) > 3) {
                        $actions['plus']['tooltip'] = trans('budget_classifiers.labels.create_default');
                    } else {
                        $actions['plus']['tooltip'] = trans('budget_classifiers.labels.create', ['type' => trans('budget_classifiers.labels.level_' . ($entity->level + 1))]);
                    }
                }

                // update tooltip message for edit action
                if (isset($actions['edit'])) {
                    if ($entity->level > 3) {
                        $actions['edit']['tooltip'] = trans('budget_classifiers.labels.edit_default');
                    } else {
                        $actions['edit']['tooltip'] = trans('budget_classifiers.labels.edit', ['type' => trans('budget_classifiers.labels.level_' . $entity->level)]);
                    }
                }

                // update messages for destroy action
                if (isset($actions['trash'])) {
                    if ($entity->level > 3) {
                        $actions['trash']['tooltip'] = trans('budget_classifiers.labels.delete_default');
                        $actions['trash']['confirm_message'] = trans('budget_classifiers.messages.confirm.delete_default');
                    } else {
                        $actions['trash']['tooltip'] = trans('budget_classifiers.labels.delete', ['type' => trans('budget_classifiers.labels.level_' . $entity->level)]);
                        $actions['trash']['confirm_message'] = trans('budget_classifiers.messages.confirm.delete',
                            ['type' => trans('budget_classifiers.labels.level_' . $entity->level)]);
                    }
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['level_description', 'code', 'enabled', 'actions'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de clasificador presupuestario.
     *
     * @param int|null $id
     *
     * @return array
     */
    public function create(int $id = null)
    {
        return [
            'entity' => $this->budgetClassifierRepository->find($id)
        ];
    }

    /**
     * Almacenar nuevo clasificador presupuestario.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $this->processRequest($request->all());

        $entity = $this->budgetClassifierRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('budget_classifiers.messages.errors.create'), 1000);
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
            $parent = $this->budgetClassifierRepository->find($data['parent_id']);
            if ($data['level'] == BudgetClassifier::LEVEL_2) {
                $data['code'] = $parent->code . $data['code'];
            }
            $data['full_code'] = $parent->full_code . '.' . $data['code'];
        } else {
            $data['full_code'] = $data['code'];
        }

        return $data;
    }

    /**
     * Retornar data necesaria para mostrar la información de clasificador presupuestario.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function show(int $id)
    {
        $entity = $this->budgetClassifierRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('budget_classifiers.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de clasificador presupuestario.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $entity = $this->budgetClassifierRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('budget_classifiers.messages.exceptions.not_found'), 1000);
        }

        $updateCode = true;
        if (count($this->budgetClassifierRepository->findLeafChildrenNotInUse($entity->id))) {
            $updateCode = false;
        }

        return [
            'entity' => $entity,
            'updateCode' => $updateCode
        ];
    }

    /**
     * Actualizar la información de clasificador presupuestario.
     *
     * @param array $data
     * @param int $id
     *
     * @return BudgetClassifier|mixed|null
     * @throws Exception
     */
    public function update(array $data, int $id)
    {
        $entity = $this->budgetClassifierRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('budget_classifiers.messages.exceptions.not_found'), 1000);
        }
        $updateCode = true;

        if (count($this->budgetClassifierRepository->findLeafChildrenNotInUse($entity->id))) {
            unset($data['code']);
            $updateCode = false;
        } else {
            $data = $this->processRequest($data);
        }
        $entity = $this->budgetClassifierRepository->updateFromArray($data, $entity, $updateCode);

        if (!$entity) {
            throw new Exception(trans('budget_classifiers.messages.errors.update'), 1000);
        }

        return $entity;
    }

    /**
     * Eliminar un clasificador presupuestario.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->budgetClassifierRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('budget_classifiers.messages.exceptions.not_found'), 1000);
        }

        if ($entity->children()->count() > 0) {
            throw new Exception(trans('budget_classifiers.messages.exceptions.has_children'), 1000);
        }
        if (count($entity->budgetItems)) {
            throw new Exception(trans('budget_classifiers.messages.exceptions.has_budgetItems'), 1000);
        }
        if (count($entity->incomes)) {
            throw new Exception(trans('budget_classifiers.messages.exceptions.has_incomes'), 1000);
        }

        $level = $entity->level;

        if (!$this->budgetClassifierRepository->delete($entity)) {
            throw new Exception(trans('budget_classifiers.messages.errors.delete'), 1000);
        }

        return $level;
    }

    /**
     * Modificar el estado de clasificador presupuestario.
     *
     * @param int $id
     *
     * @return BudgetClassifier|mixed|null
     * @throws Exception
     */
    public function status(int $id)
    {
        $entity = $this->budgetClassifierRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('budget_classifiers.messages.exceptions.not_found'), 1000);
        }

        if ($entity->children()->where('enabled', 1)->count() > 0) {
            throw new Exception(trans('budget_classifiers.messages.exceptions.has_children'), 1000);
        }

        if (!$entity->enabled && isset($entity->parent_id) && !$entity->parent->enabled) {
            throw new Exception(trans('budget_classifiers.messages.exceptions.parent_disabled'), 1000);
        }

        $entity = $this->budgetClassifierRepository->changeStatus($entity);

        if (!$entity) {
            throw new Exception(trans('budget_classifiers.messages.errors.update'), 1000);
        }

        return $entity;
    }
}
