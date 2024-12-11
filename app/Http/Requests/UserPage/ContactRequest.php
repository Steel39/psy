<?php

namespace App\Http\Requests\UserPage;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'connection' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png|max:2048',
        ];
    }
}
