<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;
use App\Models\Business\BudgetItem;
use App\Models\Business\Planning\Income;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Clase BudgetClassifier (Clasificador Presupuestario de Ingresos y Gastos)
 *
 * @property mixed code
 * @property string full_code
 * @property mixed level
 * @property mixed title
 * @property mixed description
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperBudgetClassifier
 */
class BudgetClassifier extends BaseModel
{

    use HasFactory;

    public const LEVEL_2 = 2;
    public const LEVEL_4 = 4;

    /**
     * @var string
     */
    protected $table = 'budget_classifier_spendings';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'code',
        'full_code',
        'title',
        'description',
        'level'
    ];

    /**
     * Obtener clasificador presupuestario padre.
     *
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(BudgetClassifier::class, 'parent_id');
    }

    /**
     * Obtener hijos de clasificador presupuestario.
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(BudgetClassifier::class, 'parent_id');
    }

    /**
     * Obtiene las partidas presupuestarias de gastos
     *
     * @return HasMany
     */
    public function budgetItems()
    {
        return $this->hasMany(BudgetItem::class, 'budget_classifier_id');
    }

    /**
     * Obtiene las partidas presupuestarias de ingresos
     *
     * @return HasMany
     */
    public function incomes()
    {
        return $this->hasMany(Income::class, 'budget_classifier_id');
    }
}
