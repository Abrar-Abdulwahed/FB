<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore($this->user)],
            'password' => ['nullable', 'string', 'min:6', 'max:35', 'confirmed'],
            'roles' => ['required', 'array'],
            'is_banned' => ['required', 'in:true,false'],
            'datetime' => ['required_if:is_banned,true', 'nullable', 'date']
        ];
    }
}
