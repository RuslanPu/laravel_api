<?php

namespace App\Http\Requests\Manager\Clients;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class ClientsStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'account_type' => 'required|exists:social_account_types,id',
            'account_link' => 'required|url',
            'publication_links' => 'required|array',
            'publication_links.*' => 'required|url|max:255',
            'packages' => ['sometimes', 'array'],
            'packages.*' => ['sometimes', 'integer', 'exists:package_services,id'],
        ];
    }
}
