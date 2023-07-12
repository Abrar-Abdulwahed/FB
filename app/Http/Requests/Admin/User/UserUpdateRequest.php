<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => ['nullable', 'string', 'min:6', 'max:35', 'confirmed'],
            'roles' => ['required', 'array', function (string $attribute, mixed $value,  $fail)
            {
                $id = $this->route()->parameters['user'];
                if(!in_array('1',$this->roles) &&  User::where('id','<>', $id)->whereHas('roles', fn($q) => $q->where('name','admin'))->count() == 0){
                    $fail('لابد أن يكون هناك مستخدم واحد على الأقل بدور أدمن');
                }
            }
            ],
            'is_banned' => ['required', 'in:0,1'],
            'banned_until' => ['nullable', 'date'],
            'avatar' => ['nullable', 'image'],
        ];
    }
}
