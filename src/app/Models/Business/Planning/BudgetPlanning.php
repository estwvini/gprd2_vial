<?php

namespace App\Models\Business\Planning;

use App\Models\BaseModel;

/**
 * Clase BudgetPlanning
 *
 * @property int month
 * @property float encoded
 * @property float accrued
 * @property ProjectFiscalYear projectFiscalYear
 * @package App\Models\Business\Planning
 * @mixin IdeHelperBudgetPlanning
 */
class BudgetPlanning extends BaseModel
{

    const MONTH = [
        'jan' => 1,
        'feb' => 2,
        'mar' => 3,
        'apr' => 4,
        'may' => 5,
        'jun' => 6,
        'jul' => 7,
        'aug' => 8,
        'sep' => 9,
        'oct' => 10,
        'nov' => 11,
        'dec' => 12,
    ];

    const EMPTY_MONTH = ['jan' => 0, 'feb' => 0, 'mar' => 0, 'apr' => 0, 'may' => 0, 'jun' => 0, 'jul' => 0, 'aug' => 0, 'sep' => 0, 'oct' => 0, 'nov' => 0, 'dec' => 0];

    /**
     * @var string
     */
    protected $table = 'budget_plannings';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'month',
        'assigned',
        'budget_item_id',
        'public_purchase_id',
    ];
}