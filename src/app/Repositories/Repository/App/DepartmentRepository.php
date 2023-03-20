<?php

namespace App\Repositories\Repository\App;

use App\Models\Admin\Department;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase DepartmentRepository
 *
 * @package App\Repositories\Repository\App
 */
class DepartmentRepository extends Repository
{
    /**
     * @var mixed
     */
    private $sfgprov;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @param App $app
     * @param Collection|null $collection
     * @param SettingRepository $settingRepository
     *
     * @throws RepositoryException
     */
    public function __construct(App $app, Collection $collection, SettingRepository $settingRepository)
    {
        parent::__construct($app, $collection);
        $this->settingRepository = $settingRepository;
    }

    /**
     * Especificar el nombre de la clase del modelo.
     *
     * @return string
     */
    public function model(): string
    {
        return Department::class;
    }

    /**
     *  Cantidad de proyectos e inversión por Departamentos
     *
     * @param int $year
     * @param string $date
     *
     * @return Collection
     */
    public function totalsByYear(int $year, string $date)
    {
        $query = "select trim(f.nom_cue)                                                                      as name,
                   substring(f.cuenta, 14, 3)                                                                 as code,
                   count(*)                                                                                   as project_count,
                   sum(f.codificado)                                                                          as encoded,
                   round((sum(f.codificado) / (SUM(sum(f.codificado)) OVER() ) * 100)::numeric, 2)            as percent
                    from ced_presupuestaria(:company_code, :year, :date, 1, 0)
                             as f(ult_cue character(1),
                                  cuenta character varying(250),
                                  nom_cue character(250),
                                  niv_cue numeric(6),
                                  asig_ini double precision,
                                  reformas double precision,
                                  codificado double precision,
                                  certificado double precision,
                                  certificado_real double precision,
                                  comprometido double precision,
                                  devengado double precision,
                                  por_comprometer double precision,
                                  por_comprometer_real double precision,
                                  por_devengar double precision,
                                  comprometido_mes double precision,
                                  devengado_mes double precision,
                                  recaudado double precision,
                                  pagado double precision,
                                  anticipo double precision,
                                  porcencom double precision,
                                  porcendev double precision,
                                  niv_ug character(10)
                            ) where f.niv_cue = 5 and substring(f.cuenta, 10, 3) != '999' group by 1,2;";

        $this->sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;

        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $this->sfgprov->company_code,
            'date' => $date
        ]));
    }

}
