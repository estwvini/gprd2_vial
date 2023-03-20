<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Catalogs\BudgetClassifier;
use App\Models\Business\Catalogs\Competence;
use App\Models\Business\Catalogs\FinancingSource;
use App\Models\Business\Catalogs\GeographicLocation;
use App\Models\Business\Catalogs\Institution;
use App\Models\Business\Catalogs\SpendingGuide;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\BudgetPlanning;
use App\Models\Business\Planning\OperationalActivity;
use App\Models\Business\Tracking\Reform;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Clase BudgetItem
 *
 * @property mixed id
 * @property ActivityProjectFiscalYear activityProjectFiscalYear
 * @property BudgetClassifier budgetClassifier
 * @property GeographicLocation geographicLocation
 * @property FinancingSource source
 * @property SpendingGuide spendingGuide
 * @property Institution institution
 * @property BudgetClassifier loan
 * @property mixed is_participatory_budget
 * @property mixed amount
 * @property mixed is_public_purchase
 * @property OperationalActivity operationalActivity
 * @property mixed competence
 * @property string name
 * @package App
 * @mixin IdeHelperBudgetItem
 */
class BudgetItem extends BaseModel
{

    const YES = 'SI';
    const NO = 'NO';
    const FUN = '000';
    const FUN_DESCRIPTION = 'Otra';
    const CODE_99 = '99';
    const CODE_999 = '999';
    const CODE_0 = '0';
    const CODE_00 = '00';
    const CODE_000 = '000';
    const CODE_999999 = '99.99.99.99';
    const CODE_000000 = '00.00.00';
    const NONE = 'Ninguno';
    const CODE_9999999 = '9999999';

    const MAX_ALLOWED_VALUE = 9999999999.99;
    const MIN_ALLOWED_VALUE = 0;

    const ACTIVITY_TYPE_OPERATIONAL = 'OPERATIONAL';
    const ACTIVITY_TYPE_PROJECT = 'PROJECT';

    const STATUS_REVIEWED = 'REVIEWED';

    const PERCENTAGE_OF_CONTROL = 0.30;

    const CRITERIA = ['area', 'ur', 'ue'];

    const MODULE = [
        'BUDGET' => 'BUDGET',
        'PROGRAMMATIC_STRUCTURE' => 'PROGRAMMATIC_STRUCTURE'
    ];

    /**
     * @var string
     */
    protected $table = 'budget_items';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'amount',
        'is_participatory_budget',
        'is_public_purchase',
        'activity_project_fiscal_year_id',
        'budget_classifier_id',
        'geographic_location_id',
        'financing_source_id',
        'guide_spending_id',
        'institution_id',
        'loan_id',
        'operational_activity_id',
        'fiscal_year_id',
        'competence_id',
        'description',
        'name',
        'status',
    ];

    protected $appends = ['total_budget_location'];

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($item) {
            $item->publicPurchases()->each(function ($purchase) {
                $purchase->delete();
            });
            $item->budgetPlannings()->each(function ($planning) {
                $planning->delete();
            });
        });
    }

    /**
     * Obtiene el año fiscal
     *
     * @return BelongsTo
     */
    public function activityProjectFiscalYear()
    {
        return $this->belongsTo(ActivityProjectFiscalYear::class, 'activity_project_fiscal_year_id');
    }

    /**
     * Obtiene el clasificador presupuestario de una partida presupuestaria
     *
     * @return BelongsTo
     */
    public function budgetClassifier()
    {
        return $this->belongsTo(BudgetClassifier::class, 'budget_classifier_id');
    }

    /**
     * Obtiene la actividad operativa de una partida presupuestaria.
     *
     * @return BelongsTo
     */
    public function operationalActivity()
    {
        return $this->belongsTo(OperationalActivity::class, 'operational_activity_id');
    }

    /**
     * Obtiene la ubicación de una partida presupuestaria
     *
     * @return BelongsTo
     */
    public function geographicLocation()
    {
        return $this->belongsTo(GeographicLocation::class, 'geographic_location_id');
    }

    /**
     * Obtiene la fuente de financiamiento de una partida presupuestaria
     *
     * @return BelongsTo
     */
    public function source()
    {
        return $this->belongsTo(FinancingSource::class, 'financing_source_id');
    }

    /**
     * Obtiene la orientación del gasto de una partida presupuestaria
     *
     * @return BelongsTo
     */
    public function spendingGuide()
    {
        return $this->belongsTo(SpendingGuide::class, 'guide_spending_id');
    }

    /**
     * Obtiene la institución de una partida presupuestaria
     *
     * @return BelongsTo
     */
    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    /**
     * Obtiene el origen del prestamo de una partida presupuestaria
     *
     * @return BelongsTo
     */
    public function loan()
    {
        return $this->belongsTo(BudgetClassifier::class, 'loan_id');
    }

    /**
     * Obtiene las compras públicas de una partida presupuestaria.
     *
     * @return HasMany
     */
    public function publicPurchases()
    {
        return $this->hasMany(PublicPurchase::class, 'budget_item_id');
    }

    /**
     * Obtener la planificación de una partida presupuestaria
     *
     * @return HasMany
     */
    public function budgetPlannings()
    {
        return $this->hasMany(BudgetPlanning::class, 'budget_item_id');
    }

    /**
     * Obtener las reformas efectuadas en el ítem presupuestario.
     *
     * @return BelongsToMany
     */
    public function reforms()
    {
        return $this->belongsToMany(Reform::class, 'budget_items_reforms', 'budget_item_id', 'reform_id');
    }

    /**
     * Obtener la competencia de la partida presupuestaria.
     *
     * @return BelongsTo
     */
    public function competence()
    {
        return $this->belongsTo(Competence::class, 'competence_id');
    }

    public function certifications(): MorphToMany
    {
        return $this->morphToMany(Certification::class, 'certifiable');
    }

    /**
     * @return HasMany
     */
    public function budgetLocations()
    {
        return $this->hasMany(BudgetItemLocation::class, 'budget_item_id');
    }

    public function budgetByLocation()
    {
        $budgets = [];

        foreach ($this->budgetLocations->groupBy('location_id') as $location) {
            $budgets[] = [
                'location' => $location->first()->location->description,
                'amount' => number_format($location->sum('amount'), 2)
            ];
        }
        return $budgets;
    }

    public function getTotalBudgetLocationAttribute()
    {
        $total = 0;
        foreach ($this->budgetLocations->groupBy('location_id') as $location) {
            $total += $location->sum('amount');
        }
        return $total;

    }
}
