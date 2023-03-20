<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\ConservationNeeds;
use App\Repositories\Repository\Business\Roads\ConservationNeedsRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;



/**
 * Clase ConservationNeedsProcess
 * @package App\Processes\Business\Roads
 */
class ConservationNeedsProcess
{
    /**
     * @var ConservationNeedsRepository
     */
    protected $conservationNeedsRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * @var CatalogRepository
     */
    protected $catalogRepository;

    /**
     * Constructor de ConservationNeedsProcess.
     *
     * @param ConservationNeedsRepository $conservationNeedsRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        ConservationNeedsRepository $conservationNeedsRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->conservationNeedsRepository = $conservationNeedsRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información de todas las necesidades de conservación de una vía.
     *
     * @param string $code
     *
     * @return mixed
     * @throws Exception
     */
    public function data(string $code)
    {
        $user = currentUser();
        $actions = [];
        if ($user->can('show.conservation_needs.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.conservation_needs.inventory_roads',
                'tooltip' => trans('conservation_needs.labels.details')
            ];
        }
        if ($user->can('edit.conservation_needs.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.conservation_needs.inventory_roads',
                'tooltip' => trans('conservation_needs.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->conservationNeedsRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (ConservationNeeds $entity) use ($actions) {
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions'])
            ->make(true);
        return $dataTable;
    }

    /**
     * Almacenar nueva necesidad de conservación para una vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->conservationNeedsRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('conservation_needs.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'conservation_needs' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información de una necesidad de conservación.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->conservationNeedsRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('conservation_needs.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de una necesidad de conservación.
     *
     * @param string $code
     *
     * @return array
     */
    public function create(string $code)
    {
        $typeConversationNeeds = $this->catalogRepository->listTypeConversationNeeds();
        return [
            'code' => $code,
            'typeConversationNeeds' => $typeConversationNeeds
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de una necesidad de conservación.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $typeConversationNeeds = $this->catalogRepository->listTypeConversationNeeds();
        $entity = $this->conservationNeedsRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('conservation_needs.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'typeConversationNeeds' => $typeConversationNeeds
        ];
    }

    /**
     * Actualizar la información de una necesidad de conservación de una vía.
     *
     * @param Request $request
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $gid)
    {
        $entity = $this->conservationNeedsRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('conservation_needs.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->conservationNeedsRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('conservation_needs.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'conservation_needs' => true
        ];
    }
}