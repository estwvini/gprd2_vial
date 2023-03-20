<?php

namespace App\Models\Business\Catalogs;

use App\Models\BaseModel;
use App\Models\Business\BudgetItem;
use App\Repositories\Repository\Configuration\SettingRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Clase GeographicLocation
 *
 * @package App\Models\Business\Catalogs
 * @mixin IdeHelperGeographicLocation
 */
class GeographicLocation extends BaseModel
{

    use HasFactory;

    public const TYPE_CANTON = 'CANTON';
    public const TYPE_PARISH = 'PARISH';

    public const NO_CANTON = 1;
    public const NO_PARISH = 2;
    public const NO_LOCATION_CODE = '00';

    /**
     * @var string
     */
    protected $table = 'geographic_location_classifiers';

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
        'description',
        'type'
    ];

    /**
     * Obtener localización geográfica padre.
     *
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(GeographicLocation::class, 'parent_id');
    }

    /**
     * Obtener hijos de localización geográfica.
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(GeographicLocation::class, 'parent_id');
    }

    /**
     * Retorna el codigo completo de un elemento
     *
     * @param string $code
     *
     * @return mixed|string|null
     */
    public function getFullCode(string $code = null)
    {
        $parent = $this->parent()->first();

        if ($parent) {
            return $parent->getFullCode($parent->code . '.' . ($code ?? $this->code));
        } else {
            if ($this->id == self::NO_CANTON || $this->id == self::NO_PARISH) {
                return self::NO_LOCATION_CODE . '.' . ($code ?? $this->code);
            } else {
                $settingRepository = resolve(SettingRepository::class);
                return $settingRepository->findByKey('gad')->value['code'] . '.' . ($code ?? $this->code);
            }
        }
    }

    /**
     * Retorna los tipos de localizaciones
     *
     * @return array
     */
    public static function types()
    {
        return [
            'CANTON' => trans('geographic_locations.labels.' . 'CANTON'),
            'PARISH' => trans('geographic_locations.labels.' . 'PARISH')
        ];
    }

    /**
     * Obtiene las partidas presupuestarias de gastos
     *
     * @return HasMany
     */
    public function budgetItems()
    {
        return $this->hasMany(BudgetItem::class, 'geographic_location_id');
    }

    public function scopeType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeApp($query)
    {
        return $query->where('app', true);
    }
}
