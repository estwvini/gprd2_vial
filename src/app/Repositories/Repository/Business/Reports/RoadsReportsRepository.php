<?php

namespace App\Repositories\Repository\Business\Reports;

use App\Models\Business\Roads\Catalogs\Catalog;
use App\Models\Business\Roads\CharacteristicsOfTrack;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase RoadsReportsRepository
 * @package App\Repositories\Repository\Business\Reports
 */
class RoadsReportsRepository
{

    /**
     * Obtiene la suma de la longitud de un tipo de capa de rodadura por cantón.
     *
     * @param string $canton
     * @param Catalog $catalog
     *
     * @return int|mixed
     */
    public function calculateLengthBySurfaceType(string $canton, Catalog $rollingSurfaceType)
    {
        $length = CharacteristicsOfTrack
                    ::join('sch_road.road_caracteristicas_generales_via', 'road_caracteristicas_via.codigo', '=', 'road_caracteristicas_generales_via.codigo')
                    ->select('canton', DB::raw('SUM(longitud) as longitud'), 'tsuperf')
                    ->groupBy('canton', 'tsuperf')
                    ->having('canton', '=', $canton, 'and')
                    ->having('tsuperf', '=', $rollingSurfaceType->descrip)
                    ->get();

        if ($length->isEmpty()) {
            return 0;
        }

        return $length->pluck('longitud')[0];
    }

    /**
     * Obtiene la suma de la longitud de un tipo de capa de rodadura según estado de la vía de un cantón.
     *
     * @param string $canton
     * @param string $status
     * @param Catalog $rollingSurfaceType
     *
     * @return int|mixed
     */
    public function calculateLengthByStatus(string $canton, string $status, Catalog $rollingSurfaceType)
    {
        $length = CharacteristicsOfTrack
            ::join('sch_road.road_caracteristicas_generales_via', 'road_caracteristicas_via.codigo', '=', 'road_caracteristicas_generales_via.codigo')
            ->select('esuperf', 'canton', 'tsuperf', DB::raw('SUM(longitud) as longitud'))
            ->groupBy('canton', 'esuperf', 'tsuperf')
            ->having('canton', '=', $canton, 'and')
            ->having('esuperf', '=', $status, 'and')
            ->having('tsuperf', '=', $rollingSurfaceType->descrip)
            ->get();

        if ($length->isEmpty()) {
            return 0;
        }
        return $length->pluck('longitud')[0];
    }

    /**
     * Obtiene la tabla de la longitud total de la red vial por cantón.
     *
     * @return Collection
     */
    public function roadTotalLength()
    {
        $query = CharacteristicsOfTrack
            ::join('sch_road.road_caracteristicas_generales_via', 'road_caracteristicas_via.codigo', '=', 'road_caracteristicas_generales_via.codigo')
            ->select('canton', DB::raw('ROUND(cast(SUM(longitud) as numeric), 2) as length'))
            ->groupBy('canton')
            ->get();

        return $query;
    }

    /**
     * Obtiene de la BD una tabla de la longitud total de la red vial cantonal por estado de la vía.
     *
     * @param string $canton
     * @param Catalog $status
     *
     * @return double
     */
    public function roadTotalLengthByStatus(string $canton, Catalog $status)
    {
        $query = CharacteristicsOfTrack
            ::join('sch_road.road_caracteristicas_generales_via', 'road_caracteristicas_via.codigo', 'road_caracteristicas_generales_via.codigo')
            ->select(DB::raw('SUM(longitud) as longitud'))
            ->groupBy('canton', 'esuperf')
            ->having('canton', '=', $canton, 'and')
            ->having('esuperf', '=', $status->descrip)
            ->get();

        if ($query->isEmpty()) {
            return 0;
        }

        return $query->pluck('longitud')[0];
    }


}
