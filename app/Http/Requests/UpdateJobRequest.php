<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
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
             'company_id' => 'required|exists:companies,id',

            'job_category_id' => 'required|exists:job_categories,id',

            'title' => 'required|string|max:255',

            'location' => 'required|string|max:255',

            'job_type' => 'required|in:Full Time,Part Time,Contract,Internship,Remote',

            'experience' => 'nullable|string|max:100',

            'salary_min' => 'nullable|numeric|min:0',

            'salary_max' => 'nullable|numeric|gte:salary_min',

            'description' => 'required|string',

            'last_date' => 'nullable|date|after:today',

            'is_active' => 'nullable|boolean',
        ];
    }
}
