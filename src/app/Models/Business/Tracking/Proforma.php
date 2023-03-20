<?php

namespace App\Models\Business\Tracking;

use App\Models\BaseModel;

/**
 * Clase Proforma
 *
 * @property string company_code
 * @property integer year
 * @property string code
 * @property string type
 * @property string description
 * @property string last_level
 * @property integer level
 * @property string parent_code
 * @property string created_by
 * @package App\Models\Business\Tracking
 * @mixin IdeHelperProforma
 */
class Proforma extends BaseModel
{
    const TYPE_EXPENSE = '1';
    const TYPE_INCOME = '2';

    const EXPENSE_TYPE = 'Gasto';
    const INCOME_TYPE = 'Ingreso';

    const LAST_LEVEL = 'S';
    const NOT_LAST_LEVEL = 'N';

    const INCOME_LEVELS = 7;
    const EXPENSE_LEVELS = 20;

    protected $table = 'proformas';

    public $timestamps = true;

    protected $fillable = [
        'company_code',
        'year',
        'code',
        'type',
        'description',
        'last_level',
        'level',
        'parent_code',
        'created_by'
    ];
}