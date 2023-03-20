<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;
use App\Models\Business\BudgetItem;
use App\Models\Business\Planning\Income;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase Institution
 *
 * @property mixed name
 * @property mixed code
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperInstitution
 */
class Institution extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'institutions';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'code'
    ];

    /**
     * Obtiene las partidas presupuestarias de gastos
     *
     * @return HasMany
     */
    public function budgetItems()
    {
        return $this->hasMany(BudgetItem::class, 'institution_id');
    }

    /**
     * Obtiene las partidas presupuestarias de ingresos
     *
     * @return HasMany
     */
    public function incomes()
    {
        return $this->hasMany(Income::class, 'institution_id');
    }

    /**
     * Obtiene el código de la institución sin -
     * @return mixed
     */
    public function cleanCode()
    {
        return str_replace('-', '', $this->code);
    }
}
