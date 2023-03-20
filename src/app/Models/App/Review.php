<?php

namespace App\Models\App;


use App\Models\BaseModel;
use App\Models\Business\Catalogs\GeographicLocation;
use App\Models\Business\Project;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use phpDocumentor\Reflection\Types\True_;

/**
 * @mixin IdeHelperReview
 */
class Review extends BaseModel
{

    protected $fillable = [
        'comment',
        'rating',
        'reviewable_type'
    ];

    protected $table = 'app_reviews';

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['author', 'replies'];

    /**
     * Retorna las respuestas al comentario padre.
     *
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Review::class, 'parent_id');
    }

    /**
     * Retorna el comentario padre.
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'parent_id');
    }

    /**
     * Retorna el usuario que hizo el comentario.
     *
     * @return MorphTo
     */
    public function author(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * El modelo al que pertenece el comentario.
     *
     * @return MorphTo
     */
    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Retorna la ubicación
     *
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(GeographicLocation::class, 'location_id');
    }

    /**
     * Cometarios por autor y tipo
     *
     * @param $query
     * @param int $authorId
     * @param string $type
     *
     * @return mixed
     */
    public function scopeByAuthorAndType($query, int $authorId, string $type)
    {
        return $query->where([
            ['author_type', '=', Client::class],
            ['author_id', '=', $authorId],
            ['reviewable_type', '=', $type]
        ]);
    }

    public function scopeOfClients($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeFilterBySubjectResponsible($query)
    {
        return $query->when(currentUser()->can('view_all.index.reviews'), function ($q) {
            $q->join('app_subjects', function ($join) {
                $join->on('app_reviews.reviewable_id', '=', 'app_subjects.id')->where([
                    ['app_reviews.reviewable_type', '=', Subject::class],
                    ['app_subjects.responsible_id', '=', currentUser()->id]
                ]);
            });
        })->select('app_reviews.*');

    }

    public function scopeFilterByProjectResponsible($query)
    {
        return $query->when(currentUser()->can('view_all.index.reviews'), function ($q) {
            $q->join('projects', function ($join) {
                $join->on('app_reviews.reviewable_id', '=', 'projects.id')->where([
                    ['app_reviews.reviewable_type', '=', Project::class]
                ]);
            })->join('departments', 'departments.id', '=', 'projects.responsible_unit_id')
                ->join('department_has_users', 'department_has_users.department_id', 'departments.id')
                ->where([
                    ['department_has_users.user_id', '=', currentUser()->id],
                    ['department_has_users.is_manager', '=', true],
                ]);
        })->whereNull('app_reviews.parent_id')->select('app_reviews.*');
    }

    public function scopePublic($query)
    {
        return $query->where('approved', 1);
    }

    public function scopeNotPublic($query)
    {
        return $query->where('approved', 0);
    }

    public function scopeResponses($query)
    {
        return $query->whereNotNull('parent_id')->whereNotNull('author_type');
    }
}
