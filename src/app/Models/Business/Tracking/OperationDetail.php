<?php

namespace App\Models\Business\Tracking;

use App\Models\BaseModel;

/**
 * Clase OperationDetail
 *
 * @property string company_code
 * @property integer year
 * @property string voucher_type
 * @property integer number
 * @property integer sequential
 * @property string code
 * @property double income_amount
 * @property double expense_amount
 * @property integer type
 * @property integer status
 * @property integer period
 * @property string created_by
 * @package App\Models\Business\Tracking
 * @mixin IdeHelperOperationDetail
 */
class OperationDetail extends BaseModel
{
    protected $table = 'budget_items_operations_details';

    public $timestamps = true;

    protected $fillable = [
        'company_code',
        'year',
        'voucher_type',
        'number',
        'sequential',
        'code',
        'income_amount',
        'expense_amount',
        'type',
        'status',
        'period',
        'created_by'
    ];
}