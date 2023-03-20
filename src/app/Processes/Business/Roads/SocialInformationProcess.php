<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\SocialInformation;
use App\Repositories\Repository\Business\Roads\SocialInformationRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;

/**
 * Clase SocialInformationProcess
 * @package App\Processes\Business\Roads
 */
class SocialInformationProcess
{
    /**
     * @var SocialInformationRepository
     */
    protected $socialInformationRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * @var CatalogRepository
     */
    protected $catalogRepository;
    /**
     * Constructor de SocialInformationProcess.
     *
     * @param SocialInformationRepository $socialInformationRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        SocialInformationRepository $socialInformationRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->socialInformationRepository = $socialInformationRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información de las informaciones sociales de la vía.
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
        if ($user->can('show.social_information.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.social_information.inventory_roads',
                'tooltip' => trans('social_information.labels.details')
            ];
        }
        if ($user->can('edit.social_information.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.social_information.inventory_roads',
                'tooltip' => trans('social_information.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->socialInformationRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (SocialInformation $entity) use ($actions) {
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
     * Almacenar nueva información social para una vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->socialInformationRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('social_information.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'social_information' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información social de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->socialInformationRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('social_information.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de información social de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $typesPopulation = $this->catalogRepository->listTypesPopulation();
        $entity = $this->socialInformationRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('social_information.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'typesPopulation' => $typesPopulation
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de información social de una vía.
     *
     * @param string $gid
     *
     * @return array
     */
    public function create(string $code)
    {
        $typesPopulation = $this->catalogRepository->listTypesPopulation();

        return [
            'code' => $code,
            'typesPopulation' => $typesPopulation
        ];
    }

    /**
     * Actualizar la información de información social de una vía.
     *
     * @param Request $request
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $gid)
    {
        $entity = $this->socialInformationRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('social_information.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->socialInformationRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('social_information.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'social_information' => true
        ];
    }
}