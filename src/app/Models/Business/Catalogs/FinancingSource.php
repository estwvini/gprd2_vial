<?php
declare(strict_types=1);

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;
use App\Models\Business\BudgetItem;
use App\Models\Business\Planning\Income;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Clase FinancingSource
 *
 * @property mixed code
 * @property mixed type
 * @property mixed description
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperFinancingSource
 */
class FinancingSource extends BaseModel
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'financing_source_classifiers';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'description'
    ];

    /**
     * Inicializar modelo
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderCode', function (Builder $builder) {
            $builder->orderBy('code', 'asc');
        });
    }

    /**
     * Obtiene las partidas presupuestarias de gastos
     *
     * @return HasMany
     */
    public function budgetItems()
    {
        return $this->hasMany(BudgetItem::class, 'financing_source_id');
    }

    /**
     * Obtiene las partidas presupuestarias de ingresos
     *
     * @return HasMany
     */
    public function incomes()
    {
        return $this->hasMany(Income::class, 'financing_source_id');
    }
}
