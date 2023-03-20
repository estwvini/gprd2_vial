<?php

namespace App\Http\Controllers\App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'description' => $this->description ?? 'N/D',
            'zone' => $this->zone ?? 'N/D',
            'qualitative_benefit' => $this->qualitative_benefit ?? 'N/D',
            'purpose' => $this->purpose ?? 'N/D',
            'date_init' => $this->date_init ?? 'N/D',
            'date_end' => $this->date_end ?? 'N/D',
            'month_duration' => $this->month_duration ?? 'N/D',
            'beneficiaries' => $this->getBeneficiaries() ?? 'N/D',
            'physical_progress' => $this->physical_progress ? $this->physical_progress . '%' : 'N/D',
            'encoded' => $this->encoded ? number_format($this->encoded, 2) : 'N/D',
            'encoded_f' => $this->encoded ? short_number($this->encoded) : 'N/D',
            'accrued' => $this->accrued ? number_format($this->accrued, 2) : 'N/D',
            'accrued_f' => $this->accrued ? short_number($this->accrued) : 'N/D',
            'budget_progress' => $this->budget_progress ? $this->budget_progress . '%' : 'N/D',
            'activities' => ActivityResource::collection($this->whenLoaded('activities')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
            'rating' => $this->rating() ?? 0
        ];
    }
}
