<?php

namespace App\Http\Controllers\App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'name' => $this->name,
            'code' => $this->code,
            'project_count' => $this->project_count ?? '',
            'encoded' => number_format($this->encoded, 2),
            'encoded_f' => $this->encoded ? short_number($this->encoded) : 'N/D',
            'percent' => $this->percent ? $this->percent . '%' : 'N/D',
        ];
    }
}
