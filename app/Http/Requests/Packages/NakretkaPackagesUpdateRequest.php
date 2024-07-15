<?php

namespace App\Http\Requests\Packages;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class NakretkaPackagesUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'managers' => 'required|array',
            'managers.*' => 'required|integer|exists:api_services,id',
            'services' => 'required|array',
            'services.*' => 'required|integer|exists:api_services,id',
            'quantities' => 'sometimes|array',
            'quantities.*' => 'sometimes|integer',
            'comments' => 'sometimes|array',
            'comments.*' => 'sometimes|string',
        ];
    }
}
