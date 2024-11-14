<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
class QuestionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'name' => 'requred|string|max:255',
            'email' => 'email|required',
            'contact' => 'nullable|string}|max:255',
            'question' => 'rerquired|text|max:1024',
        ];
    }

}
