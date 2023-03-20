<?php

namespace App\Http\Controllers\App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BudgetLocationResource extends JsonResource
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
            'amount' => number_format($this->amount, 2),
            'amount_f' => $this->amount ? short_number($this->amount): 'N/D',
            'description' => $this->description,
        ];
    }
}
