<?php

namespace App\Models\Business\Tracking;

use App\Models\Business\BudgetItem;
use App\Models\System\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * Clase Reform
 *
 * @property string name
 * @property string description
 * @property string path
 * @property double total_value
 * @property string type
 * @property User user
 * @property Collection budgetItems
 * @package App\Models\Business\Tracking
 * @mixin IdeHelperReform
 */
class Reform extends Model
{
    use SoftDeletes;

    // Reform types
    const TYPE_SUPPLEMENT = 'SUPPLEMENT';
    const TYPE_TRANSFER = 'TRANSFER';
    const TYPE_REDUCTION = 'REDUCTION';

    const TYPE_CREATE = 'CREATE';
    const TYPE_EDIT = 'EDIT';

    const TYPE = [
        self::TYPE_TRANSFER,
        self::TYPE_SUPPLEMENT,
        self::TYPE_REDUCTION
    ];

    protected $table = 'reforms';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'path',
        'total_value',
        'type'
    ];

    /**
     * Obtener el usuario creador de la reforma.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Obtener los ítems presupuestarios afectados por la reforma.
     *
     * @return BelongsToMany
     */
    public function budgetItems()
    {
        return $this->belongsToMany(BudgetItem::class, 'budget_items_reforms', 'reform_id', 'budget_item_id');
    }
}
