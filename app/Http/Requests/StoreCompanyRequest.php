<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         return [
            'name'        => ['required', 'string', 'max:255'],
            'website'     => ['nullable', 'url'],
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'email'       => ['nullable', 'email'],
            'phone'       => ['nullable', 'string', 'max:20'],
            'city'        => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Company name is required.',
            'website.url'   => 'Please enter a valid website URL.',
            'email.email'   => 'Please enter a valid email address.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'company name',
        ];
    }
}
