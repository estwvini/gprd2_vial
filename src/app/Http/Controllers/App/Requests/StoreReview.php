<?php

namespace App\Http\Controllers\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReview extends FormRequest
{

    public function rules(): array
    {
        return [
            'author_id' => ['required', 'numeric'],
            'location_id' => ['sometimes', 'required', 'numeric'],
            'type' => [
                'required',
                'string',
                Rule::in(array_keys(config('api'))),
            ],
            'type_id' => ['required', 'numeric'],
            'comment' => 'required|string',
            'rating' => 'required|numeric|min:0|max:5',
        ];
    }

}