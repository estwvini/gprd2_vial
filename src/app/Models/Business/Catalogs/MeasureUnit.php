<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;
use App\Models\Business\PlanIndicator;
use App\Models\Business\PublicPurchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase MeasureUnit
 *
 * @property mixed name
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperMeasureUnit
 */
class MeasureUnit extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'measure_units';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'abbreviation'
    ];

    /**
     * Obtener los indicadores asociados
     *
     * @return HasMany
     */
    public function indicators()
    {
        return $this->hasMany(PlanIndicator::class, 'measure_unit_id');
    }

    /**
     * Obtiene las compras públicas asociadas
     *
     * @return HasMany
     */
    public function purchases()
    {
        return $this->hasMany(PublicPurchase::class, 'measure_unit_id');
    }
}
