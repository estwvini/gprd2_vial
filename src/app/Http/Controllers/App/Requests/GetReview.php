<?php

namespace App\Http\Controllers\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetReview extends FormRequest
{

    public function rules(): array
    {
        return [
            'author_id' => ['required', 'numeric'],
            'type' => [
                'required',
                'string',
                Rule::in(array_keys(config('api'))),
            ],
        ];
    }

}