<?php

namespace App\Http\Controllers\App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'responsible' => $this->responsible && $this->responsible->first() ? $this->responsible->first()->fullName(): 'N/D',
            'encoded' => number_format($this->encoded, 2) ?? 'N/D',
            'encoded_f' => $this->encoded ? short_number($this->encoded): 'N/D',
            'accrued' => number_format($this->accrued, 2) ?? 'N/D',
            'accrued_f' => $this->accrued ? short_number($this->accrued): 'N/D',
            'budget_progress' => $this->budget_progress ?? 'N/D',
            'physical_progress' => $this->physical_progress ?? 'N/D'
        ];
    }
}
