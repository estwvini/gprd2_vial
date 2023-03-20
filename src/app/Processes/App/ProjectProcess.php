<?php

namespace App\Processes\App;

use App\Models\Business\Project;
use App\Repositories\Repository\App\ActivityRepository;
use App\Repositories\Repository\App\DepartmentRepository;
use App\Repositories\Repository\App\ProjectRepository;
use App\Repositories\Repository\Business\Catalogs\GeographicLocationRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Clase ProjectProcess
 *
 * @package App\Processes\App
 */
class ProjectProcess
{

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var ActivityRepository
     */
    private $activityRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var GeographicLocationRepository
     */
    private $geographicLocationRepository;

    /**
     * @param ProjectRepository $projectRepository
     * @param DepartmentRepository $departmentRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ActivityRepository $activityRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param GeographicLocationRepository $geographicLocationRepository
     */
    public function __construct(
        ProjectRepository $projectRepository,
        DepartmentRepository $departmentRepository,
        FiscalYearRepository $fiscalYearRepository,
        ActivityRepository $activityRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        GeographicLocationRepository $geographicLocationRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->departmentRepository = $departmentRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->activityRepository = $activityRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->geographicLocationRepository = $geographicLocationRepository;
    }

    public function show(int $project, int $year)
    {
        $date = Carbon::create($year, 12, 31)->format('Y-m-d');
        $fiscalYear = $this->fiscalYearRepository->findByField('year', $year)->first();
        $project = Project::find($project);

        $projectFiscalYear = $this->projectFiscalYearRepository->getProjectFiscalYear($project->id, $fiscalYear->id);
        $activities = $this->activityRepository->findByProject($projectFiscalYear->id);

        $activitiesCodes = [];
        $activities->each(function ($item) use (&$activitiesCodes) {
            $activitiesCodes[] = $item->getProgrammaticCode();
        });
        $activitiesBudget = $this->activityRepository->getActivitiesBudget($year, $date, $activitiesCodes);

        $activities->map(function ($item) use ($activitiesBudget) {
            $project = $activitiesBudget->firstWhere('code', $item->getProgrammaticCode());
            if (!$project) {
                return $item;
            }
            foreach ($project as $key => $value) {
                $item->setAttribute($key, $value);
            }
            $item->setAttribute('physical_progress', number_format($item->getProgress()));
            $item->setAttribute('budget_progress', $item->encoded ? number_format(($item->accrued * 100 / $item->encoded)) : '0');
            return $item;
        });
        $project->setRelation('activities', $activities);

        $projectBudget = $this->projectRepository->getProjectBudget($year, $date, [$project->full_cup])->first();
        if ($projectBudget) {
            $project->setAttribute('encoded', $projectBudget->encoded);
            $project->setAttribute('accrued', $projectBudget->accrued);
            $project->setAttribute('budget_progress', $projectBudget->encoded ? number_format($projectBudget->accrued * 100 / $projectBudget->encoded) : 0);
        }
        $project->setAttribute('physical_progress', number_format($projectFiscalYear->getProgress()));

        $project->load('reviews');

        return $project;
    }

    /**
     *
     * Listado de proyectos
     *
     * @param int $year
     * @param string $departmentCode
     *
     * @return Collection
     */
    public function getProjects(int $year, string $departmentCode): Collection
    {
        $date = Carbon::create($year, 12, 31)->format('Y-m-d');
        $projectCodes = [];
        $projects = collect([]);
        $fiscalYear = $this->fiscalYearRepository->findByField('year', $year)->first();

        if ($departmentCode != '') {
            $department = $this->departmentRepository->findByField('code', $departmentCode)->first();
            if ($department) {
                $projects = $this->projectRepository->findByExecutingUnit($fiscalYear->id, $department->id);
                $projectCodes = $projects->pluck('full_cup')->toArray();
            } else {
                $projectCodes[] = -1;
            }
        }
        return self::budgetProject($year, $date, $projectCodes, $projects);
    }

    public function getProjectsByLocation(int $year, string $locationId)
    {
        $date = Carbon::create($year, 12, 31)->format('Y-m-d');
        $projectCodes = [];
        $projects = collect([]);
        $fiscalYear = $this->fiscalYearRepository->findByField('year', $year)->first();

        if ($locationId) {
            $location = $this->geographicLocationRepository->find($locationId);
            $projects = $this->projectRepository->findByLocation($fiscalYear->id, $location->id);
            $projectCodes = $projects->pluck('full_cup')->toArray();
        } else {
            $projectCodes[] = -1;
        }

        return self::budgetProject($year, $date, $projectCodes, $projects);
    }

    private function budgetProject($year, $date, $projectCodes, $projects)
    {
        $projectBudget = $this->projectRepository->getProjectBudget($year, $date, $projectCodes);

        return $projects->map(function ($item) use ($projectBudget) {
            $project = $projectBudget->firstWhere('code', $item->full_cup);
            if (!$project) {
                return $item;
            }
            foreach ($project as $key => $value) {
                $item->setAttribute($key, $value);
            }
            return $item;
        });
    }

}