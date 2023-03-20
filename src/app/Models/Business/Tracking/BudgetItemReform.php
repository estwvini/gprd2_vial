<?php

namespace App\Models\Business\Tracking;

use App\Models\Business\BudgetItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Clase BudgetItemReform
 *
 * @property double old_value
 * @property double reform_value
 * @property double new_value
 * @property string type
 * @property Reform reform
 * @property BudgetItem budgetItem
 * @package App\Models\Business\Tracking
 * @mixin IdeHelperBudgetItemReform
 */
class BudgetItemReform extends Model
{
    // Amount change types
    const TYPE_ADDITION = 'ADDITION';
    const TYPE_SUBTRACTION = 'SUBTRACTION';

    protected $table = 'budget_items_reforms';

    public $timestamps = false;

    protected $fillable = [
        'reform_id',
        'budget_item_id',
        'old_value',
        'reform_value',
        'new_value',
        'type'
    ];

    /**
     * Obtener el ítem presupuestario.
     *
     * @return BelongsTo
     */
    public function budgetItem()
    {
        return $this->belongsTo(BudgetItem::class, 'budget_item_id');
    }

    /**
     * Obtener la reforma.
     *
     * @return BelongsTo
     */
    public function reform()
    {
        return $this->belongsTo(Reform::class, 'reform_id');
    }
}