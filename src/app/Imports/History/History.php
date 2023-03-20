<?php

namespace App\Imports\History;

use App\Models\Admin\Department;
use App\Models\App\History\Activity;
use App\Models\App\History\Project;
use App\Models\App\History\ActivityLocation as Model;
use App\Models\Business\Catalogs\GeographicLocation;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class History implements ToCollection, WithHeadingRow, WithValidation, WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Model::create([
                'activity_id' => self::getActivity($row)->id,
                'location_id' => self::getLocation($row)->id,
                'amount' => $row['monto'],
                'beneficiaries' => $row['beneficiarios']
            ]);
        }
    }

    public function rules(): array
    {
        return [
            '*.codigo_proyecto' => ['required'],
            '*.nombre_proyecto' => ['required', 'min:2', 'max:300'],
            '*.actividad' => ['required', 'min:2', 'max:300'],
            '*.codigo_canton' => [
                'required',
                function ($attribute, $value, $fail) {
                    $location = GeographicLocation::where([
                        ['code', $value],
                        ['type', GeographicLocation::TYPE_CANTON]
                    ])->first();
                    if (!$location) {
                        $fail(trans('budget_item.messages.exceptions.location_not_found', ['code' => $value]));
                    }
                }
            ],
            '*.codigo_competencia' => [
                'required',
                function ($attribute, $value, $fail) {
                    $department = Department::where([
                        ['code', $value]
                    ])->first();
                    if (!$department) {
                        $fail('No existe la Competencia con el código ' . $value);
                    }
                }
            ],
            '*.monto' => ['required', 'numeric'],
            '*.anno' => ['required', 'numeric', Rule::in([2014, 2015, 2016, 2017, 2018, 2019])],
            '*.beneficiarios' => 'nullable|numeric'
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function getActivity($row)
    {
        return Activity::firstOrCreate(
            [
                'name' => $row['actividad'],
                'project_id' => self::getProject($row)->id,
            ]
        );
    }

    public function getProject($row)
    {
        $related = self::getRelatedProject($row);
        return Project::firstOrCreate(
            [
                'code' => $row['codigo_proyecto']
            ],
            [
                'name' => $row['nombre_proyecto'],
                'year' => $row['anno'],
                'executing_unit_id' => self::getExecutingUnit($row)->id,
                'project_related_id' => $related ? $related->id : null
            ]
        );
    }

    public function getRelatedProject($row)
    {
        return Project::where([
            ['code', $row['proyecto_relacionado']]
        ])->first();
    }

    public function getLocation($row)
    {
        return GeographicLocation::where([
            ['code', $row['codigo_canton']],
            ['type', GeographicLocation::TYPE_CANTON]
        ])->first();
    }

    public function getExecutingUnit($row)
    {
        return Department::where([
            ['code', $row['codigo_competencia']]
        ])->first();
    }
}
