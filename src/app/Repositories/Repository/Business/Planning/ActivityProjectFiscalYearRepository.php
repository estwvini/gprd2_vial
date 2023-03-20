<?php

namespace App\Repositories\Repository\Business\Planning;

use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Task;
use App\Repositories\Library\Eloquent\Repository;
use App\Repositories\Library\Exceptions\RepositoryException;
use App\Repositories\Repository\Business\TaskRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use DateTime;
use Illuminate\Container\Container as App;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use JsonException;

/**
 * Clase ActivityProjectFiscalYearRepository
 * @package App\Repositories\Repository\Business\Planning
 */
class ActivityProjectFiscalYearRepository extends Repository
{

    protected SettingRepository $settingRepository;

    /**
     * @throws JsonException
     */
    private $sfgprov;

    /**
     * Constructor de ActivityProjectFiscalYearRepository.
     *
     * @param App $app
     * @param Collection $collection
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
     * @return mixed|string
     */
    function model()
    {
        return ActivityProjectFiscalYear::class;
    }

    /**
     * Actualizar en la BD la información de una actividad de un año fiscal.
     *
     * @param array $data
     * @param ActivityProjectFiscalYear $entity
     *
     * @return ActivityProjectFiscalYear|null
     */
    public function updateFromArray(array $data, ActivityProjectFiscalYear $entity)
    {
        if ($entity->projectFiscalYear->status == ProjectFiscalYear::STATUS_IN_PROGRESS and $entity->budgetItems()->count()) {
            unset($data['area_id']);
        }
        $entity->fill($data);
        $entity->save();

        return $entity->fresh();
    }

    /**
     * Almacenar en la BD una nueva actividad de un año fiscal.
     *
     * @param array $data
     *
     * @return ActivityProjectFiscalYear
     */
    public function createFromArray(array $data)
    {
        $entity = new $this->model;
        $activityProjectFiscalYear = $entity->create($data);
        return $activityProjectFiscalYear;
    }

    /**
     * Buscar actividades de un año fiscal de proyecto
     *
     * @param int $projectFiscalYearId
     *
     * @return Collection
     */
    public function findByProjectFiscalYear(int $projectFiscalYearId)
    {
        return $this->model->where('project_fiscal_year_id', $projectFiscalYearId)
            ->orderBy('code')
            ->get();
    }

    /**
     * Buscar actividades de un proyecto con información de las partidas presupuestarias
     *
     * @param int $projectFiscalYearId
     *
     * @return mixed
     */
    public function findByProjectWithItems(int $projectFiscalYearId)
    {
        return $this->model->where('project_fiscal_year_id', $projectFiscalYearId)->with(['budgetItems', 'component', 'area'])->orderBy('component_id')->orderBy('code')->get();
    }

    /**
     * Buscar información de actividades de un proyecto para un año fiscal
     *
     * @param int $projectFiscalYearId
     *
     * @return mixed
     */
    public function findByProjectWithBudgetDurationRelevance(int $projectFiscalYearId)
    {
        return $this->model->where('project_fiscal_year_id', $projectFiscalYearId)
            ->select(
                'id',
                DB::raw('COALESCE(duration, 0) as duration'),
                DB::raw('COALESCE(relevance, 0) as relevance'),
                DB::raw('(SELECT COALESCE(SUM(amount), 0) FROM budget_items WHERE budget_items.activity_project_fiscal_year_id = activity_project_fiscal_years.id) as budget'))
            ->get();
    }


    /**
     * Obtiene el progreso trimestral de una actividad
     *
     * @param ActivityProjectFiscalYear $activityProjectFiscalYear
     *
     * @return array
     */
    public function getQuarterlyProgress(ActivityProjectFiscalYear $activityProjectFiscalYear)
    {
        $q1 = 0;
        $q2 = 0;
        $q3 = 0;
        $q4 = 0;


        $activityProjectFiscalYear->tasks->each(function ($task) use (&$q1, &$q2, &$q3, &$q4) {

            if ($task->status === Task::STATUS_COMPLETED_ONTIME || $task->status === Task::STATUS_COMPLETED_OUTOFTIME) {
                $month = (int)date("m", strtotime($task->due_date));
                $quarter = ceil($month / 3);
                ${'q' . $quarter} += $task->weight_percentage;
            }
        });

        $q2 = $q1 + $q2;
        $q3 = $q2 + $q3;
        $q4 = $q3 + $q4;

        return [
            'q1' => number_format($q1, 2),
            'q2' => number_format($q2, 2),
            'q3' => number_format($q3, 2),
            'q4' => number_format($q4, 2),
            'q1Cumulative' => number_format($q1 * $activityProjectFiscalYear->weight_percentage / 100, 2),
            'q2Cumulative' => number_format($q2 * $activityProjectFiscalYear->weight_percentage / 100, 2),
            'q3Cumulative' => number_format($q3 * $activityProjectFiscalYear->weight_percentage / 100, 2),
            'q4Cumulative' => number_format($q4 * $activityProjectFiscalYear->weight_percentage / 100, 2),
        ];
    }

    /**
     * Actualizar la entidad mediante un arreglo
     *
     * @param array $data
     * @param array $entities
     *
     * @return mixed|bool
     */
    public function bulkUpdateFromArray(array $data, array $entities)
    {
        DB::transaction(function () use ($data, $entities) {
            $taskRepository = resolve(TaskRepository::class);

            foreach ($entities as $index => $entity) {
                self::updateFromArray($data[$index], $entity);

                if (isset($data[$index]['responsible'])) {
                    $entity->responsible()->sync($data[$index]['responsible']);
                }

                if (isset($data[$index]['date_init']) && isset($data[$index]['date_end'])) {
                    $entity->tasks()->each(function ($task) use ($data, $index, $taskRepository) {

                        if ($task->date_init && Carbon::parse($data[$index]['date_init']) > Carbon::parse($task->date_init)) {

                            $duration = null;
                            if ($task->type == Task::ELEMENT_TYPE['TASK']) {
                                $date1 = new DateTime($data[$index]['date_init']);
                                $date2 = new DateTime($task->date_end);

                                $diff = $date1->diff($date2);

                                $duration = $diff->days ?: 1;
                            }

                            $taskRepository->updateFromArray([
                                'task' => [
                                    'date_init' => $data[$index]['date_init'],
                                    'duration' => $duration
                                ]
                            ], $task);
                        }
                        if ($task->date_end && Carbon::parse($data[$index]['date_init']) > Carbon::parse($task->date_end)) {
                            $duration = null;
                            if ($task->type == Task::ELEMENT_TYPE['TASK']) {
                                $date1 = new DateTime($data[$index]['date_init']);
                                $date2 = new DateTime($task->date_end);

                                $diff = $date1->diff($date2);

                                $duration = $diff->days ?: 1;
                            }
                            $taskRepository->updateFromArray([
                                'task' => [
                                    'date_end' => $data[$index]['date_init'],
                                    'duration' => $duration
                                ]
                            ], $task);
                        } elseif ($task->date_end && Carbon::parse($data[$index]['date_end']) < Carbon::parse($task->date_end)) {
                            $duration = null;
                            if ($task->type == Task::ELEMENT_TYPE['TASK']) {
                                $date1 = new DateTime($task->date_init);
                                $date2 = new DateTime($data[$index]['date_end']);

                                $diff = $date1->diff($date2);

                                $duration = $diff->days ?: 1;
                            }
                            $taskRepository->updateFromArray([
                                'task' => [
                                    'date_end' => $data[$index]['date_end'],
                                    'duration' => $duration
                                ]
                            ], $task);
                        }
                    });
                }

            }
        }, 5);

        return true;
    }

    /**
     * Obtiene las actividades del año fiscal de un proyecto y sus partidas relacionadas
     *
     * @param int $projectFiscalYearId
     *
     * @return mixed
     */
    public function getActivitiesBudgetItems(int $projectFiscalYearId)
    {
        return $this->model
            ->with('budgetItems')
            ->where('activity_project_fiscal_years.project_fiscal_year_id', $projectFiscalYearId)
            ->get();
    }

    /**
     * Genera un código autoincremental para actividades
     *
     * @param int $projectFiscalYearId
     *
     * @return string
     */
    public function generateActivityCode(int $projectFiscalYearId)
    {
        $maxCode = $this->model->where('project_fiscal_year_id', $projectFiscalYearId)->max('code');

        return sprintf("%03d", ((int)$maxCode + 1));
    }

    /**
     * Buscar actividades por año fiscar y fechas de inicio y fin
     *
     * @param int $projectFiscalYearId
     * @param string|null $date_init
     * @param string|null $date_end
     *
     * @return mixed
     */
    public function findByProjectFiscalYearDates(int $projectFiscalYearId, string $date_init = null, string $date_end = null)
    {
        return $this->model->where('project_fiscal_year_id', $projectFiscalYearId)
            ->where(function ($query) use ($date_init, $date_end) {
                $query->where('date_init', '<', $date_init)
                    ->orWhere('date_end', '>', $date_end);
            })
            ->with([
                'tasks' => function ($q) use ($date_init, $date_end) {
                    $q->where('date_init', '<', $date_init)
                        ->orWhere('date_end', '>', $date_end);
                }
            ])->get();
    }

    /**
     * Obtiene presupuesto por categoría
     *
     * @param int $year
     * @param string $date
     * @param int $from
     * @param int $length
     * @param int $level
     * @param string $projectCode
     * @param int $type
     *
     * @return array
     */
    public function activitiesProjectEncoded(int $year, string $date, int $from, int $length, int $level, string $projectCode, int $type = 1)
    {

        $sfgprov = json_decode($this->settingRepository->findByKey('gad'))->value->sfgprov;
        $query = "select f.cuenta as cuenta,
                       substring(trim(f.cuenta), {$from}, {$length}) as codigo,
                       sum(f.asig_ini)   as asignado,
                       sum(f.codificado)   as codificado,
                       sum(f.devengado) as devengado,
                       sum(f.por_devengar) as por_devengar,
                       sum(f.devengado) * 100 / case when sum(f.codificado) = 0 then 1 else sum(f.codificado) end as porciento_ejecucion
                    from ced_presupuestaria(:company_code, :year, :date, :type, 0)
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
                            ) where f.niv_cue = :level and substring(f.cuenta, 4, 9) = :projectCode group by 1, 2 order by 3 desc";

        return collect(DB::connection('pgsql')->select($query, [
            'year' => $year,
            'company_code' => $sfgprov->company_code,
            'date' => $date,
            'type' => $type,
            'level' => $level,
            'projectCode' => $projectCode
        ]));
    }

    /**
     * Obtiene actividades de un proyecto.
     *
     * @param int $projectFiscalYearId
     *
     * @return \Illuminate\Support\Collection
     */
    public function getActivitiesByProject(int $projectFiscalYearId)
    {
        return ActivityProjectFiscalYear::where('project_fiscal_year_id', $projectFiscalYearId)
            ->with([
                'responsible' => function ($query) {
                    $query->where('active', true);
                },
                'tasks' => function ($query) {
                    $query->orderByRaw('ISNULL(date_init), date_init ASC');
                },
                'tasks.responsible' => function ($query) {
                    $query->where('active', true);
                }
            ])->orderBy('date_init', 'ASC')->get();
    }
}
