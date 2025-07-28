<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TravelPreferencesRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'preferred_climate' => ['nullable', 'string', 'in:warm,mild,cold,no_preference'],
            'budget_range' => ['nullable', 'string', 'in:50-100,100-200,200-300,300-500,500+'],
            'interests' => ['nullable', 'array'],
            'interests.*' => ['string', 'in:adventure,culture,relaxation,food,nature,shopping'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'preferred_climate.in' => 'Please select a valid climate preference.',
            'budget_range.in' => 'Please select a valid budget range.',
            'interests.*.in' => 'Please select valid travel interests.',
        ];
    }
}
