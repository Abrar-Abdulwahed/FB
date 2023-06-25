<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            //dd($this->user),
            'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->ignore($this->setting)],
            'current_password'=>'required_with:new_password',
            'new_password'=>'nullable|min:8',
            'password_confirmation'=>'required_with:new_password|same:new_password',
        ];
    }
}
