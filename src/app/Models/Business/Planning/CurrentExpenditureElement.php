<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;
use App\Models\Business\Catalogs\Area;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Clase CurrentExpenditureElement
 *
 * @property string code
 * @property string name
 * @property string type
 * @property Area Area
 * @property FiscalYear|null fiscalYear
 * @property CurrentExpenditureElement parent
 * @property Collection|null children
 * @property Collection|null activities
 * @package App\Models\Business\Planning
 * @mixin IdeHelperCurrentExpenditureElement
 */
class CurrentExpenditureElement extends BaseModel
{
    use SoftDeletes;

    const TYPE_PROGRAM = 'PROGRAM';
    const TYPE_SUBPROGRAM = 'SUBPROGRAM';
    const TYPE_OPERATIONAL_ACTIVITY = 'OPERATIONAL_ACTIVITY';

    const PROGRAM_DEFAULT_CODE = '01';

    const INITIAL_ELEMENT = self::TYPE_PROGRAM;

    const NEXT_ELEMENT = [
        self::TYPE_PROGRAM => self::TYPE_SUBPROGRAM,
        self::TYPE_SUBPROGRAM => self::TYPE_OPERATIONAL_ACTIVITY
    ];

    protected $table = 'current_expenditure_elements';

    public $timestamps = true;

    protected $fillable = [
        'parent_id',
        'fiscal_year_id',
        'area_id',
        'code',
        'name',
        'area',
        'type'
    ];

    /**
     * Obtener el año fiscal.
     *
     * @return BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    /**
     * Obtener el año fiscal.
     *
     * @return BelongsTo
     */
    public function fiscalYear()
    {
        return $this->belongsTo(FiscalYear::class, 'fiscal_year_id');
    }

    /**
     * Obtener el programa (padre).
     *
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(CurrentExpenditureElement::class, 'parent_id');
    }

    /**
     * Obtener los subprogramas (hijos).
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(CurrentExpenditureElement::class, 'parent_id', 'id');
    }

    /**
     * Obtener las actividades operativas de un subprograma.
     *
     * @return HasMany
     */
    public function activities()
    {
        return $this->hasMany(OperationalActivity::class, 'current_expenditure_element_id');
    }
}
