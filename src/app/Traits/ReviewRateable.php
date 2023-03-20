<?php

namespace App\Traits;

use App\Models\App\Client;
use App\Models\App\Review;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;

trait ReviewRateable
{

    /**
     * Retorna los cometarios del proyecto
     *
     * @return MorphMany
     */
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable')->whereNull('parent_id');
    }

    /**
     * Retorna los cometarios por autor
     *
     * @param int $authorId
     *
     * @return MorphMany
     */
    public function reviewsByAuthor(int $authorId): MorphMany
    {
        return $this->reviews()->whereHasMorph(
            'author',
            Client::class,
            function (Builder $query, $authorId) {
                $query->where('author_id', $authorId);
            }
        );
    }

    /**
     * @param false $onlyApproved
     *
     * @return Collection
     */
    public function averageReviews(bool $onlyApproved= false): Collection
    {
        $where = $onlyApproved ? [['approved', '1']] : [];

        return $this->reviews()
            ->selectRaw('AVG(rating) as averageReviews')
            ->where($where)
            ->pluck('averageReviewRateable');
    }

    /**
     * @return Collection
     *@var bool $onlyApproved
     *
     */
    public function countRating(bool $onlyApproved = false): Collection
    {
        return $this->reviews()
            ->selectRaw('count(rating) as countReviews')
            ->where($onlyApproved ? [['approved', '1']] : [])
            ->pluck('countReviewRateable');
    }
}