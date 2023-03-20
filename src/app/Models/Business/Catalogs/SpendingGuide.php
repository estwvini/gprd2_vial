<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;
use App\Models\Business\BudgetItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Clase SpendingGuide (Orientación del Gasto)
 *
 * @property string full_code
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperSpendingGuide
 */
class SpendingGuide extends BaseModel
{
    use HasFactory;

    public const LEVEL_1 = 1;
    public const LEVEL_2 = 2;
    public const LEVEL_3 = 3;
    public const LEVEL_4 = 4;

    /**
     * @var string
     */
    protected $table = 'guide_spending_classifiers';

    /**
     * Indicates if the model should be timestamped.
     *
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
        'description',
        'level'
    ];

    /**
     * Obtener orientación del gasto padre.
     *
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(SpendingGuide::class, 'parent_id');
    }

    /**
     * Obtener hijos de orientación del gasto.
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(SpendingGuide::class, 'parent_id');
    }

    /**
     * Retorna nombre de los niveles
     *
     * @return array
     */
    public static function levels()
    {
        return [
            self::LEVEL_1 => trans('spending_guide.labels.level_1'),
            self::LEVEL_2 => trans('spending_guide.labels.level_2'),
            self::LEVEL_3 => trans('spending_guide.labels.level_3'),
            self::LEVEL_4 => trans('spending_guide.labels.level_4')
        ];
    }

    /**
     * Obtiene las partidas presupuestarias de gastos
     *
     * @return HasMany
     */
    public function budgetItems()
    {
        return $this->hasMany(BudgetItem::class, 'guide_spending_id');
    }
}
