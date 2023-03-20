<?php

namespace App\Models\Business\Tracking;

use App\Models\BaseModel;
use App\Models\Business\Planning\Justification;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

/**
 * Clase Operation
 *
 * @property string company_code
 * @property integer year
 * @property string voucher_type
 * @property integer number
 * @property string description
 * @property double total_debit
 * @property double total_credit
 * @property string date_assignment
 * @property string date_approval
 * @property string date_created
 * @property string created_by
 * @property integer status
 * @property integer period
 * @property Collection justifications
 * @package App\Models\Business\Tracking
 * @mixin IdeHelperOperation
 */
class Operation extends BaseModel
{
    protected $table = 'budget_items_operations';

    public $timestamps = true;

    const PROFORMA_TYPE = 'PR';
    const PROFORMA_DEFAULT_NUMBER = 1;
    const PROFORMA_DEFAULT_PERIOD = 1;
    const PROFORMA_APPROVED_STATUS = 3;

    protected $fillable = [
        'company_code',
        'year',
        'voucher_type',
        'number',
        'description',
        'total_debit',
        'total_credit',
        'date_assignment',
        'date_approval',
        'date_created',
        'created_by',
        'status',
        'period'
    ];

    /**
     * Obtener las justificaciones de un elemento del plan.
     *
     * @return MorphMany
     */
    public function justifications()
    {
        return $this->morphMany(Justification::class, 'justifiable');
    }
}