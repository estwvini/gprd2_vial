<?php

namespace App\Processes\Business\Catalogs;


use App\Models\Business\Catalogs\GeographicLocation;
use App\Repositories\Repository\Business\Catalogs\GeographicLocationRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\Criteria\GeographicLocation\GeographicLocationEnabledTrue;
use Exception;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase GeographicLocationProcess
 * @package App\Processes\Business\Catalogs
 */
class GeographicLocationProcess
{
    /**
     * @var GeographicLocationRepository
     */
    protected $geographicLocationRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * Constructor de GeographicLocationProcess.
     *
     * @param GeographicLocationRepository $geographicLocationRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(GeographicLocationRepository $geographicLocationRepository, SettingRepository $settingRepository)
    {
        $this->geographicLocationRepository = $geographicLocationRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Cargar información del catálogo geográfico.
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function data(array $data)
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('show.geographic_locations.module_configuration_catalogs')) {
            $actions['search'] = [
                'route' => 'show.geographic_locations.module_configuration_catalogs'
            ];
        }

        if ($user->can('create.geographic_locations.module_configuration_catalogs')) {
            $actions['plus'] = [
                'route' => 'create.geographic_locations.module_configuration_catalogs',
                'tooltip' => trans('geographic_locations.labels.create', ['type' => trans('geographic_locations.labels.PARISH')]),
                'btn_class' => 'btn-success'
            ];
        }

        if ($user->can('edit.geographic_locations.module_configuration_catalogs')) {
            $actions['edit'] = [
                'route' => 'edit.geographic_locations.module_configuration_catalogs'
            ];
        }

        if ($user->can('destroy.geographic_locations.module_configuration_catalogs')) {
            $actions['trash'] = [
                'route' => 'destroy.geographic_locations.module_configuration_catalogs',
                'btn_class' => 'btn-danger',
                'method' => 'delete'
            ];
        }

        $dataTable = DataTables::of($this->geographicLocationRepository->filters($data['filters'])->findAllOrdered($data['filters']))
            ->setRowId('id')
            ->editColumn('code', function ($entity) {
                return $entity->getFullCode();
            })
            ->editColumn('enabled', function ($entity) use ($user) {
                $checked = $entity->enabled ? 'checked' : '';

                if ($user->can('status.geographic_locations.module_configuration_catalogs')) {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' {$checked}/></label>";
                } else {
                    return "<label><input type='checkbox' class='js-switch js-switch-enabled' disabled {$checked}/></label>";
                }
            })
            ->addColumn('canton', function ($entity) {
                switch ($entity->type):
                    case GeographicLocation::TYPE_CANTON:
                        return $entity->description;
                    case GeographicLocation::TYPE_PARISH:
                        return isset($entity->parent) ? $entity->parent->description : '';
                    default:
                        return '';
                endswitch;
            })
            ->addColumn('parish', function ($entity) {
                switch ($entity->type):
                    case GeographicLocation::TYPE_CANTON:
                        return '';
                    case GeographicLocation::TYPE_PARISH:
                        return $entity->description;
                    default:
                        return '';
                endswitch;
            })
            ->addColumn('type', function ($entity) {
                return trans('geographic_locations.labels.' . $entity->type);
            })
            ->addColumn('actions', function ($entity) use ($actions) {

                // remove create action if entity is parish
                if ($entity->type == GeographicLocation::TYPE_PARISH) {
                    unset($actions['plus']);
                } elseif (!$entity->enabled) {
                    unset($actions['plus']);
                }
                // update tooltip according to location type
                if (isset($actions['search'])) {
                    $actions['search']['tooltip'] = ($entity->type == GeographicLocation::TYPE_CANTON) ? trans('geographic_locations.labels.details',
                        ['type' => trans('geographic_locations.labels.CANTON')])
                        : trans('geographic_locations.labels.details', ['type' => trans('geographic_locations.labels.PARISH')]);
                }
                if (isset($actions['edit'])) {
                    $actions['edit']['tooltip'] = ($entity->type == GeographicLocation::TYPE_CANTON) ? trans('geographic_locations.labels.edit',
                        ['type' => trans('geographic_locations.labels.CANTON')])
                        : trans('geographic_locations.labels.edit', ['type' => trans('geographic_locations.labels.PARISH')]);
                }
                if (isset($actions['trash'])) {
                    $actions['trash']['tooltip'] = ($entity->type == GeographicLocation::TYPE_CANTON) ? trans('geographic_locations.labels.delete',
                        ['type' => trans('geographic_locations.labels.CANTON')])
                        : trans('geographic_locations.labels.delete', ['type' => trans('geographic_locations.labels.PARISH')]);
                    $actions['trash']['confirm_message'] = ($entity->type == GeographicLocation::TYPE_CANTON) ?
                        trans('geographic_locations.messages.confirm.delete', ['type' => trans('geographic_locations.labels.CANTON')])
                        : trans('geographic_locations.messages.confirm.delete', ['type' => trans('geographic_locations.labels.PARISH')]);
                }

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['enabled', 'actions', 'canton', 'parish', 'type'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de localización geográfica.
     *
     * @param int|null $id
     *
     * @return array
     */
    public function create(int $id = null)
    {
        return [
            'entity' => $this->geographicLocationRepository->find($id),
            'parentLocations' => $this->geographicLocationRepository->findAllEnabledParents(),
            'types' => GeographicLocation::types(),
            'provinces' => [],
            'cantons' => $this->byTypes(GeographicLocation::TYPE_CANTON),
            'parishes' => [],
            'province' => $this->currentProvince()

        ];
    }

    /**
     * Almacenar nueva localización geográfica.
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function store(array $data)
    {
        $entity = $this->geographicLocationRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('geographic_locations.messages.errors.create'), 1000);
        }

        return $entity;
    }

    /**
     * Retornar data necesaria para mostrar la información de localización geográfica.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function show(int $id)
    {
        $entity = $this->geographicLocationRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('geographic_locations.messages.exceptions.not_found'), 1000);
        }

        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de localización geográfica.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function edit(int $id)
    {
        $entity = $this->geographicLocationRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('geographic_locations.messages.exceptions.not_found'), 1000);
        }

        $parentLocations = $this->geographicLocationRepository->findAllEnabledParents($entity->id);

        return [
            'entity' => $entity,
            'parentLocations' => $parentLocations,
            'province' => $this->currentProvince()
        ];
    }

    /**
     * Actualizar la información de localización geográfica.
     *
     * @param Request $request
     * @param int $id
     *
     * @return GeographicLocation|mixed|null
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $entity = $this->geographicLocationRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('geographic_locations.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();
        if (count($entity->budgetItems)) {
            unset($data['code']);
        }

        $entity = $this->geographicLocationRepository->updateFromArray($data, $entity);

        if (!$entity) {
            throw new Exception(trans('geographic_locations.messages.errors.update'), 1000);
        }

        return $entity;
    }

    /**
     * Eliminar lógicamente una localización geográfica.
     *
     * @param int $id
     *
     * @return bool
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->geographicLocationRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('geographic_locations.messages.exceptions.not_found'), 1000);
        }

        if ($entity->children()->count()) {
            throw new Exception(trans('geographic_locations.messages.exceptions.has_children_geographic_locations'), 1000);
        }

        if (count($entity->budgetItems)) {
            throw new Exception(trans('geographic_locations.messages.exceptions.has_budgetItems'), 1000);
        }

        $hasParent = isset($entity->parent_id);

        if (!$this->geographicLocationRepository->delete($entity)) {
            throw new Exception(trans('geographic_locations.messages.errors.delete'), 1000);
        }

        return $hasParent;
    }

    /**
     * Modificar el estado de localización geográfica.
     *
     * @param $id
     *
     * @return mixed
     * @throws Exception
     */
    public function status($id)
    {
        $entity = $this->geographicLocationRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('geographic_locations.messages.exceptions.not_found'), 1000);
        }

        if ($entity->children()->where('enabled', 1)->count() > 0) {
            throw new Exception(trans('geographic_locations.messages.exceptions.has_children_geographic_locations'), 1000);
        }

        if (!$entity->enabled && isset($entity->parent_id) && !$entity->parent->enabled) {
            throw new Exception(trans('geographic_locations.messages.exceptions.parent_disabled'), 1000);
        }

        if (!$this->geographicLocationRepository->changeStatus($entity)) {
            throw new Exception(trans('geographic_locations.messages.errors.update'), 1000);
        }

        return $entity;
    }

    /**
     * Retorna la provincia actual
     * @return mixed
     */
    public function currentProvince()
    {
        $province = $this->settingRepository->findByKey('gad');

        if ($province and isset($province['value']['province'])) {
            return $province['value']['province'];
        }
        return '';
    }

    /**
     * Busca por el campo type y devuleve una lista
     *
     * @param string $type
     *
     * @return mixed
     */
    public function byTypes(string $type)
    {
        $this->geographicLocationRepository->pushCriteria(new GeographicLocationEnabledTrue());
        return $this->geographicLocationRepository->findByType($type);
    }

}
