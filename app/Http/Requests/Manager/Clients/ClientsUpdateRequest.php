<?php

namespace App\Http\Requests\Manager\Clients;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ClientsUpdateRequest extends FormRequest
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
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'packages' => ['sometimes', 'array'],
            'packages.*' => ['sometimes', 'integer', 'exists:package_services,id'],
            'account_type' => 'required|exists:social_account_types,id',
            'account_link' => 'required|url',
            'publication_links' => 'required|array',
            'publication_links.*' => 'required|url|max:255',
        ];

        if ($this->client?->email === $this->input('email')) {
            $rules['email'] = ['required', 'string', 'lowercase', 'email', 'max:255'];
        } else {
            $rules['email'] = ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'];
        }

        return $rules;
    }
}
