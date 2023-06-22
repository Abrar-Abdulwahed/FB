<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'regex:/^[A-Za-z ]+$/', 'min:3', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'max:35', 'confirmed'],
            'roles' => ['required', 'array'],
            'is_banned' => ['required', 'in:0,1'],
            'banned_until' => ['required_if:is_banned,1', 'nullable', 'date'],
            'avatar' => ['nullable', 'image']
        ];
    }
}
