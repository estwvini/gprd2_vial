<?php

namespace App\Processes\App;

use App\Models\App\History\ActivityLocation;
use App\Models\App\History\Project;
use Illuminate\Support\Collection;

/**
 * Clase HistoryProcess
 *
 * @package App\Processes\App
 */
class HistoryProcess
{

    public function getProjects(int $year, string $departmentCode): Collection
    {
        return Project::query()->whereHas('executingUnit', function ($query) use ($departmentCode) {
            $query->where('code', $departmentCode);
        })
            ->where('year', $year)->get();
    }

    public function getProjectsByLocation(int $year, string $locationId): Collection
    {
        return Project::query()->join('app_dbh_activities', 'app_dbh_projects.id', 'app_dbh_activities.project_id')
            ->join('app_dbh_activity_locations', 'app_dbh_activities.id', 'app_dbh_activity_locations.activity_id')
            ->where('app_dbh_projects.year', $year)
            ->where('app_dbh_activity_locations.location_id', $locationId)
            ->distinct()
            ->select('app_dbh_projects.*')->get();
    }

    public function getDepartmentsTotals(int $year): Collection
    {
        return Project::query()->join('departments', 'departments.id', 'app_dbh_projects.executing_unit_id')
            ->join('app_dbh_activities', 'app_dbh_projects.id', 'app_dbh_activities.project_id')
            ->join('app_dbh_activity_locations', 'app_dbh_activities.id', 'app_dbh_activity_locations.activity_id')
            ->where('app_dbh_projects.year', $year)
            ->selectRaw('departments.id, departments.name, departments.code, sum(app_dbh_activity_locations.amount) as encoded')
            ->groupBy(['departments.id', 'departments.name', 'departments.code'])->get();
    }

    public function getLocationsTotals(int $year): Collection
    {
        return ActivityLocation::query()
            ->join('geographic_location_classifiers', 'app_dbh_activity_locations.location_id', 'geographic_location_classifiers.id')
            ->join('app_dbh_activities', 'app_dbh_activities.id', 'app_dbh_activity_locations.activity_id')
            ->join('app_dbh_projects', 'app_dbh_projects.id', 'app_dbh_activities.project_id')
            ->where('app_dbh_projects.year', $year)
            ->selectRaw('geographic_location_classifiers.id, geographic_location_classifiers.description, sum(app_dbh_activity_locations.amount) as amount')
            ->groupBy(['geographic_location_classifiers.id', 'geographic_location_classifiers.description'])->get();
    }
}