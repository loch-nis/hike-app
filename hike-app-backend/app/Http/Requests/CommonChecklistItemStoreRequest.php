<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommonChecklistItemStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'min:1', 'max:32'],
        ];
    }
}
