<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Catalogs\BudgetClassifier;
use App\Models\Business\Catalogs\Competence;
use App\Models\Business\Catalogs\FinancingSource;
use App\Models\Business\Catalogs\GeographicLocation;
use App\Models\Business\Catalogs\Institution;
use App\Models\Business\Catalogs\SpendingGuide;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\BudgetPlanning;
use App\Models\Business\Planning\OperationalActivity;
use App\Models\Business\Tracking\Reform;
use App\Models\System\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


/**
 * @mixin IdeHelperBudgetItemLocation
 */
class BudgetItemLocation extends BaseModel
{

    /**
     * @var string
     */
    protected $table = 'budget_item_locations';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'amount',
        'budget_item_id',
        'location_id',
        'user_id',
        'description',
    ];

    protected $with = [
        'location',
        'user'
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($item) {
            $item->user_id = currentUser()->id;
        });
    }

    public function budgetItem()
    {
        return $this->belongsTo(BudgetItem::class, 'budget_item_id');
    }

    public function location()
    {
        return $this->belongsTo(GeographicLocation::class, 'location_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
