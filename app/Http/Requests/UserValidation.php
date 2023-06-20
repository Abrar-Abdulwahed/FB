<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidation extends FormRequest
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
    public function onCreate(){
        return [
            'name' => ['required', 'alpha','min:4', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6','max:35', 'confirmed'],
        ];
    }

    public function onUpdate(){
        return [
            'name' => ['required', 'alpha','min:4', 'max:10'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ];
    }
    
    public function rules(): array
    {
        return request()->isMethod('post') || request()->isMethod('put') ?
        $this->onUpdate() : $this->onCreate();
    }
}
