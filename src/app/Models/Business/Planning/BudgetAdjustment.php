<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Clase BudgetAdjustment
 *
 * @package App\Models\Business\Planning
 * @mixin IdeHelperBudgetAdjustment
 */
class BudgetAdjustment extends BaseModel
{
    /**
     * @var string
     */
    protected $table = 'budget_adjustment';

    // Project statuses
    const STATUS_DRAFT = 'DRAFT';
    const STATUS_APPROVED = 'APPROVED';

    protected $fillable = [
        'prioritization_id',
        'status'
    ];

    /**
     * Obtener el proyecto priorizado.
     *
     * @return BelongsTo
     */
    public function prioritization()
    {
        return $this->belongsTo(Prioritization::class, 'prioritization_id');
    }
}
