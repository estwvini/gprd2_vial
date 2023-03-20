<?php

namespace App\Imports\Projects;

use App\Models\Business\BudgetItem;
use App\Models\Business\BudgetItem as Model;
use App\Models\Business\Catalogs\Area;
use App\Models\Business\Catalogs\BudgetClassifier;
use App\Models\Business\Catalogs\Competence;
use App\Models\Business\Catalogs\FinancingSource;
use App\Models\Business\Catalogs\GeographicLocation;
use App\Models\Business\Catalogs\Institution;
use App\Models\Business\Catalogs\SpendingGuide;
use App\Models\Business\Component;
use App\Models\Business\Plan;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Project;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BudgetItems implements ToCollection, WithHeadingRow, WithValidation, WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    const MONTH = [
        'enero' => 1,
        'febrero' => 2,
        'marzo' => 3,
        'abril' => 4,
        'mayo' => 5,
        'junio' => 6,
        'julio' => 7,
        'agosto' => 8,
        'septiembre' => 9,
        'octubre' => 10,
        'noviembre' => 11,
        'diciembre' => 12,
    ];

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $entity = Model::create([
                'code' => $this->getItemCode($row),
                'name' => $row['nombre'],
                'description' => $row['descripcion'],
                'amount' => $row['valor'],
                'is_participatory_budget' => in_array($row['presupuesto_participativo'], ['Si', 1]) ? 1 : 0,
                'is_public_purchase' => in_array($row['compra_publica'], ['Si', 1]) ? 1 : 0,
                'activity_project_fiscal_year_id' => $this->getActivity($row)->id,
                'budget_classifier_id' => $this->getBudgetClassifier($row)->id,
                'geographic_location_id' => $this->getLocation($row)->id,
                'financing_source_id' => $this->getFinancingSource($row)->id,
                'guide_spending_id' => $this->getGuideSpending($row)->id,
                'institution_id' => $this->getInstitution($row)->id,
                'fiscal_year_id' => $this->getNextFiscalYear()->id,
                'competence_id' => $this->getCompetence($row)->id
            ]);

            $plannings = [];

            foreach (self::MONTH as $month => $value) {
                if (isset($row[$month]) && $row[$month]) {
                    $plannings[] = [
                        'month' => $value,
                        'assigned' => $row[$month],
                        'budget_item_id' => $entity->id
                    ];
                }
            }
            $entity->budgetPlannings()->createMany($plannings);
        }
    }

    public function rules(): array
    {
        return [
            '*.prog_subp_proy' => [
                'required',
                function ($attribute, $value, $fail) {
                    $project = Project::where('full_cup', $value)->first();
                    if (!$project) {
                        $fail(trans('budget_item.messages.exceptions.project_not_found', ['code' => $value]));
                    }
                }
            ],
            '*.componente' => ['required', 'min:2', 'max:500'],
            '*.area' => ['required', 'exists:areas,code'],
            '*.codigo_act' => ['required', 'digits:3'],
            '*.nombre_act' => ['required', 'min:3', 'max:400'],
            '*.item_presupuestario' => ['required', 'exists:budget_classifier_spendings,full_code'],
            '*.nombre' => ['required'],
            '*.descripcion' => ['required', 'max:500'],
            '*.valor' => ['required', 'numeric', 'gte:0', 'max:' . BudgetItem::MAX_ALLOWED_VALUE],
            '*.codigo_parroquia' => [
                'required',
                function ($attribute, $value, $fail) {
                    $location = GeographicLocation::where([
                        ['code', $value],
                        ['type', GeographicLocation::TYPE_PARISH]
                    ])->first();
                    if (!$location) {
                        $fail(trans('budget_item.messages.exceptions.location_not_found', ['code' => $value]));
                    }
                }
            ],
            '*.fuente_financiamiento' => ['required', 'exists:financing_source_classifiers,code'],
            '*.codigo_orientador_gasto' => ['required', 'exists:guide_spending_classifiers,full_code'],
            '*.codigo_institucion' => ['required', 'exists:institutions,code'],
            '*.competencia' => ['required', 'exists:competences,code'],
            '*.presupuesto_participativo' => ['required', Rule::in(['Si', 'No', 1, 0])],
            '*.compra_publica' => ['required', Rule::in(['Si', 'No', 1, 0])],

            '*.enero' => 'nullable|numeric|gt:0',
            '*.febrero' => 'nullable|numeric|gt:0',
            '*.marzo' => 'nullable|numeric|gt:0',
            '*.abril' => 'nullable|numeric|gt:0',
            '*.mayo' => 'nullable|numeric|gt:0',
            '*.junio' => 'nullable|numeric|gt:0',
            '*.julio' => 'nullable|numeric|gt:0',
            '*.agosto' => 'nullable|numeric|gt:0',
            '*.septiembre' => 'nullable|numeric|gt:0',
            '*.octubre' => 'nullable|numeric|gt:0',
            '*.noviembre' => 'nullable|numeric|gt:0',
            '*.diciembre' => 'nullable|numeric|gt:0',
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    private function getItemCode($row)
    {
        return $this->getActivity($row)->area->code
            . '.' . $row['prog_subp_proy']
            . '.' . $this->getProject($row)->executingUnit->code
            . '.' . $row['codigo_act']
            . '.' . $row['item_presupuestario']
            . '.' . $row['competencia']
            . '.' . $row['codigo_orientador_gasto']
            . '.' . $this->getLocation($row)->getFullCode()
            . '.' . $row['fuente_financiamiento']
            . '.' . str_replace('-', '', $row['codigo_institucion']);
    }

    public function getProject($row)
    {
        return Project::join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['projects.full_cup', '=', $row['prog_subp_proy']]
            ])
            ->select('projects.*')
            ->with('executingUnit')
            ->first();
    }

    public function getProjectFiscalYear($row)
    {
        return ProjectFiscalYear::where([
            ['project_id', self::getProject($row)->id],
            ['fiscal_year_id', self::getNextFiscalYear()->id]
        ])->first();
    }

    public function getActivity($row)
    {
        return ActivityProjectFiscalYear::updateOrCreate(
            [
                'code' => $row['codigo_act'],
                'project_fiscal_year_id' => self::getProjectFiscalYear($row)->id
            ],
            [
                'name' => $row['nombre_act'],
                'has_budget' => true,
                'area_id' => self::getArea($row)->id,
                'component_id' => self::getComponent($row)->id,
            ]
        );
    }

    public function getArea($row)
    {
        return Area::where('code', $row['area'])->first();
    }

    public function getComponent($row)
    {
        return Component::firstOrCreate(
            [
                'project_id' => self::getProject($row)->id,
                'name' => $row['componente']
            ]
        );
    }

    public function getNextFiscalYear()
    {
        $fiscalYearRepository = resolve(FiscalYearRepository::class);
        return $fiscalYearRepository->findNextFiscalYear();
    }

    public function getBudgetClassifier($row)
    {
        return BudgetClassifier::where('full_code', $row['item_presupuestario'])->first();
    }

    public function getLocation($row)
    {
        return GeographicLocation::where([
            ['code', $row['codigo_parroquia']],
            ['type', GeographicLocation::TYPE_PARISH]
        ])->first();
    }

    public function getFinancingSource($row)
    {
        return FinancingSource::where('code', $row['fuente_financiamiento'])->first();
    }

    public function getGuideSpending($row)
    {
        return SpendingGuide::where('full_code', $row['codigo_orientador_gasto'])->first();
    }

    public function getInstitution($row)
    {
        return Institution::where('code', $row['codigo_institucion'])->first();
    }

    public function getCompetence($row)
    {
        return Competence::where('code', $row['competencia'])->first();
    }
}
