<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileValidation extends FormRequest
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
            //
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $this->user],
            'current_password'=>'nullable',
            'new_password'=>'nullable|min:8',
            'password_confirmation'=>'nullable|min:8|same:new_password',
        ];
    }
}
