<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Catalogs\CPC;
use App\Models\Business\Catalogs\MeasureUnit;
use App\Models\Business\Catalogs\Procedure;
use App\Models\Business\Planning\BudgetPlanning;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Clase PublicPurchase
 *
 * @property BudgetItem budgetItem
 * @property CPC cpcClassifier
 * @property bool is_international_fund
 * @property MeasureUnit measureUnit
 * @property Procedure procedure
 * @property float unit_price
 * @property float amount
 * @property string regime_type
 * @property string budget_type
 * @property string hiring_type
 * @property string c1
 * @property string c2
 * @property string c3
 * @package App
 * @mixin IdeHelperPublicPurchase
 */
class PublicPurchase extends BaseModel
{

    const REGIME_TYPES = ['COMÚN', 'ESPECIAL', 'PROCEDIMIENTOS ESPECIALES'];
    const BUDGET_TYPES = ['CORRIENTE', 'INVERSIÓN'];
    const HIRING_TYPES = ['BIEN', 'OBRA', 'SERVICIO', 'CONSULTORÍA'];
    const HIRING_ASSET = 'BIEN';
    const HIRING_WORK = 'OBRA';
    const HIRING_SERVICE = 'SERVICIO';
    const REGIME_COMMON = 'COMÚN';
    const YES = 'SI';
    const NO = 'NO';
    const MAX_ALLOWED_VALUE = 9999999999.99;
    const MIN_ALLOWED_VALUE = 0;
    const BUDGET_TYPE_CURRENT_EXPENDITURE = 'CORRIENTE';

    /**
     * @var string
     */
    protected $table = 'public_purchases';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'budget_item_id',
        'cpc_id',
        'is_international_fund',
        'regime_type',
        'budget_type',
        'hiring_type',
        'procedure_id',
        'measure_unit_id',
        'unit_price',
        'quantity',
        'amount',
        'amount_no_vat',
        'c1',
        'c2',
        'c3',
        'description'
    ];

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($item) {
            $item->budgetPlannings()->each(function ($planning) {
                $planning->delete();
            });

        });
    }

    /**
     * Obtiene la partida presupuestaria de una compra pública
     *
     * @return BelongsTo
     */
    public function budgetItem()
    {
        return $this->belongsTo(BudgetItem::class, 'budget_item_id');
    }

    /**
     * Obtiene la partida presupuestaria de una compra pública
     *
     * @return BelongsTo
     */
    public function cpcClassifier()
    {
        return $this->belongsTo(CPC::class, 'cpc_id');
    }

    /**
     * Obtiene el procedimiento de una compra pública
     *
     * @return BelongsTo
     */
    public function procedure()
    {
        return $this->belongsTo(Procedure::class, 'procedure_id');
    }

    /**
     * Obtener el usuario la unidad de medida.
     *
     * @return BelongsTo
     */
    public function measureUnit()
    {
        return $this->belongsTo(MeasureUnit::class, 'measure_unit_id');
    }

    /**
     * Obtener la planificación de una compra pública
     *
     * @return HasMany
     */
    public function budgetPlannings()
    {
        return $this->hasMany(BudgetPlanning::class, 'public_purchase_id');
    }

    public function certifications(): MorphToMany
    {
        return $this->morphToMany(Certification::class, 'certifiable');
    }
}
