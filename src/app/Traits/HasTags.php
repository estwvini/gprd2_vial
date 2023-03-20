<?php

namespace App\Traits;

use App\Models\Business\Tag;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasTags
{

    protected $queuedTags = [];

    public static function bootHasTags()
    {
        static::created(function ($taggableModel) {
            if (count($taggableModel->queuedTags) === 0) {
                return;
            }

            $taggableModel->attachTags($taggableModel->queuedTags);

            $taggableModel->queuedTags = [];
        });

        static::deleted(function ($deletedModel) {
            $tags = $deletedModel->tags()->get();

            $deletedModel->detachTags($tags);
        });
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function setTagsAttribute($tags)
    {
        if (!$this->exists) {
            $this->queuedTags = $tags;
            return;
        }

        $this->syncTags($tags);
    }

    public function attachTags($tags)
    {
        $tags = Tag::findOrCreate($tags);

        $this->tags()->syncWithoutDetaching($tags->pluck('id')->toArray());

        return $this;
    }

    public function attachTag($tag)
    {
        return $this->attachTags([$tag]);
    }

    public function syncTags($tags)
    {

        $tags = Tag::findOrCreate($tags);

        $this->tags()->sync($tags->pluck('id')->toArray());

        return $this;
    }

    public function detachTags($tags)
    {
        collect($tags)->each(function (Tag $tag) {
            $this->tags()->detach($tag);
        });
        return $this;
    }

    public function detachTag($tag)
    {
        return $this->detachTags([$tag]);
    }
}