<?php

namespace App\Processes\Business\Reports;

use App\Repositories\Repository\Business\Reports\RoadsReportsRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use Exception;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Log;

/**
 * Clase RoadsReportsProcess
 * @package App\Processes\Business\Reports
 */
class RoadsReportsProcess
{

    /**
     * @var RoadsReportsRepository
     */
    private $roadsReportsRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    private $generalCharacteristicsOfTrackRepository;

    /**
     * @var catalogRepository
     */
    private $catalogRepository;

    /**
     * Constructor de RoadsReportsProcess.
     *
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param RoadsReportsRepository $roadsReportsRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        RoadsReportsRepository $roadsReportsRepository,
        CatalogRepository $catalogRepository
    ) {
        $this->roadsReportsRepository = $roadsReportsRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Crear un datatable con la información de la red vial por el tipo de capa de rodadura.
     *
     * @return mixed
     * @throws Exception
     */
    public function dataRoadLength()
    {
        $data = collect([]);

        $cantons = $this->generalCharacteristicsOfTrackRepository->getCantons();

        if (!$cantons) {
            throw new Exception(trans('reports/roads/roads_reports.exceptions.cantons_not_found'), 1000);
        }

        foreach ($cantons as $canton) {
            $row = $this->calculateLengthBySurfaceType($canton->canton);
            $data->push($row);
        }

        $dataTable = DataTables::of($data);

        return $dataTable->make(true);
    }

    /**
     * Crear un datatable con la información del estado de la red vial por el tipo de capa de rodadura.
     *
     * @return mixed
     * @throws Exception
     */
    public function dataRoadStatus()
    {
        $data = collect([]);

        $cantons = $this->generalCharacteristicsOfTrackRepository->getCantons();
        $allStatus = $this->catalogRepository->listStateActive();
        $surfaceTypes = $this->catalogRepository->listSurfaceTypesActive();

        if (!$cantons) {
            throw new Exception(trans('reports/roads/roads_reports.exceptions.cantons_not_found'), 1000);
        } else if (!$allStatus) {
            throw new Exception(trans('reports/roads/roads_reports.exceptions.status_not_found'), 1000);
        } else if (!$surfaceTypes) {
            throw new Exception(trans('reports/roads/roads_reports.exceptions.surface_types_not_found'), 1000);
        }

        $rowCount = 0;
        foreach ($cantons as $canton) {
            $totalRow = collect(['status' => trans('reports/roads/roads_reports.labels.actual_total'), 'canton' => $canton->canton]);
            $group = collect([]);

            foreach ($allStatus as $status) {
                $row = $this->calculateLengthByStatus($canton->canton, $status->descrip);
                $group->push($row);
                $data->push($row);
            }

            // Add a Total Row for the canton
            foreach ($surfaceTypes as $surfaceType) {
                $totalBySurface = $group->sum($surfaceType->descrip);
                $totalRow->put($surfaceType->descrip, number_format($totalBySurface, 2));
            }

            $totalValue = array_sum($totalRow->all());
            $totalRow->put('total', number_format($totalValue, 2));

            $group->push($totalRow);
            $data->push($totalRow);

            $length = $group->count();

            // Add a Percentage value for each row of the canton
            for ($i = $rowCount; $i < $rowCount + $length; $i++) {
                if (($i + 1) % 4 === 0) {
                    $data[$i]->put('percentage', '100.00%');
                } else {
                    $percentage = ($data[$i]->get('total') * 100) / $totalValue;
                    $data[$i]->put('percentage', number_format($percentage, 2) . '%');
                    $data[$i]->put('total', number_format($data[$i]->get('total'), 2));                   
                }
            }
            $rowCount += $length;
        }
        $dataTable = DataTables::of($data);
        return $dataTable->make(true);
    }

    /**
     * Crear un datatable con la información de la red vial de la longitud total por cantón.
     *
     * @return mixed
     * @throws Exception
     */
    public function dataRoadTotalLength()
    {
        $data = $this->roadsReportsRepository->roadTotalLength();

        if (!$data) {
            throw new Exception(trans('reports/roads/roads_reports.exceptions.total_length_not_found'), 1000);
        }

        $dataLength = $data->count();
        // Total length of all cantons
        $total = $data->sum('length');

        // Add a column with calculated percentage of total
        for ($i = 0; $i < $dataLength; $i++) {
            $data[$i]->number = $i + 1;
            $length = $data[$i]->length;
            $data[$i]->percentage = number_format(($length * 100) / $total, 2) . '%';
        }

        $dataTable = DataTables::of($data);

        return $dataTable->with('total', number_format($total, 2))->make(true);
    }

    /**
     * Crear un datatable con la información de la longitud total de la red vial por el estado de la vía.
     *
     * @return mixed
     * @throws Exception
     */
    public function dataRoadGeneralStatus()
    {
        $data = $this->roadsReportsRepository->roadTotalLength();
        $status = $this->catalogRepository->listStateActive();
        if (!$data) {

            throw new Exception(trans('reports/roads/roads_reports.exceptions.total_length_not_found'), 1000);
        } else if (!$status) {
            throw new Exception(trans('reports/roads/roads_reports.exceptions.status_not_found'), 1000);
        }

        $dataCollection = $this->calculateTotalLengthByStatus($data, $status);

        $dataTable = DataTables::of($dataCollection);

        return $dataTable->make(true);
    }

    /**
     * Calcula la longitud de la red vial cantonal por tipo de capa de rodadura
     *
     * @param string $canton
     *
     * @return Collection
     */
    public function calculateLengthBySurfaceType(string $canton)
    {
        $surfaceTypes = $this->catalogRepository->listSurfaceTypesActive();
        $reportCollection = collect(['canton' => $canton]);

        foreach ($surfaceTypes as $surfaceType) {

            $roadLength = $this->roadsReportsRepository->calculateLengthBySurfaceType($canton, $surfaceType);

            $reportCollection->put($surfaceType->descrip, number_format($roadLength, 2));
        }

        $total = array_sum($reportCollection->all());
        $reportCollection->put('total', number_format($total, 2));

        return $reportCollection;
    }

    /**
     * Calcula la longitud de la red vial cantonal según el estado de la vía y el tipo de capa de rodadura.
     *
     * @param string $canton
     * @param string $status
     *
     * @return Collection
     */
    public function calculateLengthByStatus(string $canton, string $status)
    {
        $surfaceTypes = $this->catalogRepository->listSurfaceTypesActive();
        $reportCollection = collect(['status' => $status]);
        $reportCollection->put('canton', $canton);

        foreach ($surfaceTypes as $surfaceType) {

            $roadLength = $this->roadsReportsRepository->calculateLengthByStatus($canton, $status, $surfaceType);
            $reportCollection->put($surfaceType->descrip, number_format($roadLength, 2));

        }

        $total = array_sum($reportCollection->all());
        $reportCollection->put('total', $total);

        return $reportCollection;
    }

    /**
     * Calcula la longitud total de la red vial cantonal según el estado de la vía por cantón.
     *
     * @param Collection $data
     * @param Collection $status
     *
     * @return Collection
     */
    public function calculateTotalLengthByStatus(Collection $data, Collection $status)
    {
        $reportCollection = collect([]);

        for ($i = 0; $i < $data->count(); $i++) {
            $row['canton'] = $data[$i]->canton;
            $row['length'] = $data[$i]->length;

            foreach ($status as $singleStatus) {
                $value = $this->roadsReportsRepository->roadTotalLengthByStatus($data[$i]->canton, $singleStatus);
                $row[$singleStatus->descrip] = number_format($value, 2);
            }

            $reportCollection->push($row);
        }

        return $reportCollection;
    }
}