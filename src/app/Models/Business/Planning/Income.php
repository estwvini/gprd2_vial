<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;
use App\Models\Business\Catalogs\BudgetClassifier;
use App\Models\Business\Catalogs\FinancingSource;
use App\Models\Business\Catalogs\Institution;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase Income
 *
 * @package App\Models\Business\Planning
 * @mixin IdeHelperIncome
 */
class Income extends BaseModel
{
    use SoftDeletes;

    const MODULE = [
        'BUDGET' => 'BUDGET',
        'PROGRAMMATIC_STRUCTURE' => 'PROGRAMMATIC_STRUCTURE'
    ];

    const MAX_ALLOWED_VALUE = 9999999999.99;

    /**
     * @var string
     */
    protected $table = 'incomes';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'fiscal_year_id',
        'budget_classifier_id',
        'financing_source_id',
        'institution_id',
        'loan_id',
        'justification',
        'legal_base',
        'value',
        'distributor_code',
        'distributor_name'
    ];

    /**
     * Obtiene el año fiscal de un ingreso.
     *
     * @return BelongsTo
     */
    public function fiscal_year()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id');
    }

    /**
     * Obtiene el clasificador presupuestario
     *
     * @return BelongsTo
     */
    public function budget_classifier()
    {
        return $this->belongsTo(BudgetClassifier::class, 'budget_classifier_id');
    }

    /**
     * Obtiene la fuente de financiamento
     *
     * @return BelongsTo
     */
    public function financing_source()
    {
        return $this->belongsTo(FinancingSource::class, 'financing_source_id');
    }

    /**
     * Obtiene el organismo
     *
     * @return BelongsTo
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    /**
     * Obtiene la fuente del préstamo
     *
     * @return BelongsTo
     */
    public function loan()
    {
        return $this->belongsTo(BudgetClassifier::class, 'loan_id');
    }
}