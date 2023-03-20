<?php

namespace App\Imports\Incomes;

use App\Models\Business\Catalogs\BudgetClassifier;
use App\Models\Business\Catalogs\FinancingSource;
use App\Models\Business\Catalogs\Institution;
use App\Models\Business\Planning\Income;
use App\Models\Business\Planning\Income as Model;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class IncomeItems implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts
{
    use Importable, SkipsErrors, SkipsFailures;

    public function model(array $row)
    {
        return new Model([
            'code' => $this->getIncomeCode($row),
            'budget_classifier_id' => $this->getBudgetClassifier($row)->id,
            'financing_source_id' => $this->getFinancingSource($row)->id,
            'institution_id' => $this->getInstitution($row)->id,
            'fiscal_year_id' => $this->getNextFiscalYear()->id,
            'justification' => $row['detalle_ingreso'],
            'distributor_code' => $row['codigo_distribuidor'],
            'distributor_name' => $row['nombre_distribuidor'],
            'value' => $row['valor']
        ]);
    }

    public function rules(): array
    {
        return [
            '*.item_presupuestario' => ['required', 'exists:budget_classifier_spendings,full_code'],
            '*.fuente_financiamiento' => ['required', 'exists:financing_source_classifiers,code'],
            '*.organismo' => ['required', 'exists:institutions,code'],
            '*.codigo_distribuidor' => ['required', 'digits:2'],
            '*.nombre_distribuidor' => ['required', 'max:200'],
            '*.detalle_ingreso' => ['required', 'max:200'],
            '*.valor' => ['required', 'numeric', 'gte:0', 'max:' . Income::MAX_ALLOWED_VALUE]
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    private function getIncomeCode($row)
    {
        return $row['item_presupuestario'] . '. ' . $row['fuente_financiamiento'] . '.' . $row['codigo_distribuidor'] . '.' . str_replace('-', '',
                $row['organismo']);
    }

    private function getBudgetClassifier($row)
    {
        return BudgetClassifier::where('full_code', $row['item_presupuestario'])->first();
    }

    private function getFinancingSource($row)
    {
        return FinancingSource::where('code', $row['fuente_financiamiento'])->first();
    }

    private function getInstitution($row)
    {
        return Institution::where('code', $row['organismo'])->first();
    }

    private function getNextFiscalYear()
    {
        $fiscalYearRepository = resolve(FiscalYearRepository::class);
        return $fiscalYearRepository->findNextFiscalYear();
    }
}
