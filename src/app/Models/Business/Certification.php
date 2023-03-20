<?php

namespace App\Models\Business;

use App\Models\BaseModel;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\System\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Clase Certification
 *
 * @package App\Models\Business
 * @mixin IdeHelperCertification
 */
class Certification extends BaseModel
{
    use SoftDeletes;

    const STATUS_DRAFT = 'DRAFT';
    const STATUS_TO_REVIEW = 'TO_REVIEW';
    const STATUS_REJECTED = 'REJECTED';
    const STATUS_APPROVED = 'APPROVED';
    const STATUS_DIGITATED = 'DIGITATED';


    /**
     * @var string
     */
    protected $table = 'certifications';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var array
     */
    protected $fillable = [
        'number',
        'name',
        'status',
        'topic',
        'activity_id',
        'user_id',
        'fiscal_year_id',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(ActivityProjectFiscalYear::class, 'activity_id');
    }

    public function budgetItems(): MorphToMany
    {
        return $this->morphedByMany(BudgetItem::class, 'certifiable')->withPivot('amount');
    }

    public function publicPurchases(): MorphToMany
    {
        return $this->morphedByMany(PublicPurchase::class, 'certifiable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}