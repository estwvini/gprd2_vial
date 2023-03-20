<?php

namespace App\Http\Controllers\App\Resources;

use App\Models\App\Client;
use App\Processes\Configuration\SettingProcess;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $gadAuthor = resolve(SettingProcess::class)->gad()['province'];
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'comment' => $this->comment,
            'rating' => $this->rating,
            'created_at' => formatDate($this->created_at, 'd-m-Y m:s'),
            'author' => $this->author instanceof Client ? $this->author->full_name : trans('app/reviews.labels.gad_author') . ' ' . $gadAuthor,
            'author_id' => $this->author instanceof Client ? $this->author->id : null,
            'location' => $this->location ? $this->location->description : null,
            'replies' => ReviewResource::collection($this->replies)
        ];
    }
}
