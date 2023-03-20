<?php

namespace App\Models\Business\Planning;

use App\Models\Admin\Department;
use App\Models\BaseModel;
use App\Models\Business\BudgetItem;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase OperationalActivity
 *
 * @property string code
 * @property string name
 * @property double total
 * @property Department responsibleUnit
 * @property Department executingUnit
 * @property CurrentExpenditureElement subprogram
 * @property Collection budgetItems
 * @package App\Models\Business\Planning
 * @mixin IdeHelperOperationalActivity
 */
class OperationalActivity extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'operational_activities';

    protected $fillable = [
        'current_expenditure_element_id',
        'code',
        'name',
        'responsible_unit_id',
        'executing_unit_id'
    ];

    /**
     * Obtiene el subprograma al que pertenece la actividad operacional.
     *
     * @return BelongsTo
     */
    public function subprogram()
    {
        return $this->belongsTo(CurrentExpenditureElement::class, 'current_expenditure_element_id');
    }

    /**
     * Obtiene la unidad responsable de la actividad operacional.
     *
     * @return BelongsTo
     */
    public function responsibleUnit()
    {
        return $this->belongsTo(Department::class, 'responsible_unit_id');
    }

    /**
     * Obtiene la unidad ejecutora de la actividad operacional.
     *
     * @return BelongsTo
     */
    public function executingUnit()
    {
        return $this->belongsTo(Department::class, 'executing_unit_id');
    }

    /**
     * Obtiene las partidas presupuestarias de una actividad operativa.
     *
     * @return HasMany
     */
    public function budgetItems()
    {
        return $this->hasMany(BudgetItem::class, 'operational_activity_id');
    }
}
