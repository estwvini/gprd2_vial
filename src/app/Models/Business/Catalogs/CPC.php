<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;
use App\Models\Business\PublicPurchase;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Clase CPC (Compras Públicas)
 *
 * @property mixed code
 * @property mixed description
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperCPC
 */
class CPC extends BaseModel
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'cpc_classifiers';

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
     * Obtiene las compras públicas
     *
     * @return HasMany
     */
    public function purchases()
    {
        return $this->hasMany(PublicPurchase::class, 'cpc_id');
    }
}
