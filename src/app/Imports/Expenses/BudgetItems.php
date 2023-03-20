<?php

namespace App\Imports\Expenses;

use App\Models\Admin\Department;
use App\Models\Business\BudgetItem;
use App\Models\Business\BudgetItem as Model;
use App\Models\Business\Catalogs\Area;
use App\Models\Business\Catalogs\BudgetClassifier;
use App\Models\Business\Catalogs\Competence;
use App\Models\Business\Catalogs\FinancingSource;
use App\Models\Business\Catalogs\GeographicLocation;
use App\Models\Business\Catalogs\Institution;
use App\Models\Business\Catalogs\SpendingGuide;
use App\Models\Business\Planning\CurrentExpenditureElement;
use App\Models\Business\Planning\OperationalActivity;
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
                'is_participatory_budget' => 0,
                'is_public_purchase' => in_array($row['compra_publica'], ['Si', 1]) ? 1 : 0,
                'operational_activity_id' => $this->getActivity($row)->id,
                'budget_classifier_id' => $this->getBudgetClassifier($row)->id,
                'geographic_location_id' => $this->getLocation($row)->id,
                'financing_source_id' => $this->getFinancingSource($row)->id,
                'guide_spending_id' => $this->getGuideSpending($row)->id,
                'institution_id' => $this->getInstitution($row)->id,
                'fiscal_year_id' => $this->getNextFiscalYear()->id,
                'competence_id' => $this->getCompetence()->id
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
            '*.area' => ['required', 'exists:areas,code'],
            '*.nombre_programa' => ['required'],
            '*.cod_sub_programa' => ['required', 'digits:2'],
            '*.nombre_sub_programa' => ['required'],
            '*.unidad_responsable' => ['required', 'exists:departments,code'],
            '*.unidad_ejecutora' => ['required', 'exists:departments,code'],
            '*.cod_act_operativa' => ['required'],
            '*.nombre_act_operativa' => ['required', 'min:3', 'max:500'],
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
        return $this->getArea($row)->code
            . '.' . $this->getProgram($row)->code
            . '.' . $this->getSubProgram($row)->code
            . '.' . BudgetItem::CODE_999
            . '.' . $row['unidad_ejecutora']
            . '.' . $row['cod_act_operativa']
            . '.' . $row['item_presupuestario']
            . '.' . $this->getCompetence()->code
            . '.' . $row['codigo_orientador_gasto']
            . '.' . $this->getLocation($row)->getFullCode()
            . '.' . $row['fuente_financiamiento']
            . '.' . str_replace('-', '', $row['codigo_institucion']);
    }

    public function getProgram($row)
    {
        return CurrentExpenditureElement::firstOrCreate(
            ['fiscal_year_id' => $this->getNextFiscalYear()->id, 'type' => CurrentExpenditureElement::TYPE_PROGRAM],
            [
                'code' => CurrentExpenditureElement::PROGRAM_DEFAULT_CODE,
                'type' => CurrentExpenditureElement::TYPE_PROGRAM,
                'name' => $row['nombre_programa'],
                'parent_id' => null,
                'area_id' => $this->getArea($row)->id,
            ]
        );
    }

    public function getSubProgram($row)
    {
        return CurrentExpenditureElement::firstOrCreate(
            [
                'fiscal_year_id' => $this->getNextFiscalYear()->id,
                'code' => $row['cod_sub_programa'],
                'type' => CurrentExpenditureElement::TYPE_SUBPROGRAM
            ],
            [
                'name' => $row['nombre_sub_programa'],
                'parent_id' => $this->getProgram($row)->id,
                'area_id' => null,
            ]
        );
    }

    public function getActivity($row)
    {
        return OperationalActivity::firstOrCreate(
            [
                'code' => $row['cod_act_operativa'],
                'current_expenditure_element_id' => self::getSubProgram($row)->id
            ],
            [
                'name' => $row['nombre_act_operativa'],
                'responsible_unit_id' => self::getUnit($row['unidad_responsable'])->id,
                'executing_unit_id' => self::getUnit($row['unidad_ejecutora'])->id
            ]
        );
    }

    public function getArea($row)
    {
        return Area::where('code', $row['area'])->first();
    }

    public function getUnit($code)
    {
        return Department::where('code', $code)->first();
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

    public function getCompetence()
    {
        return Competence::where('code', BudgetItem::FUN)->first();
    }
}
