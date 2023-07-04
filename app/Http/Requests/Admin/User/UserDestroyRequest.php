<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserDestroyRequest extends FormRequest
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
            
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $id = $this->route()->parameters['user'];
                if(User::where('id','<>', $id)->whereHas('roles', fn($q) => $q->where('name','admin'))->count() == 0){
                    $validator->errors()->add(
                        'roles',
                        'لابد أن يكون هناك مستخدم واحد على الأقل بدور أدمن',
                    );
                }
            }
        ];
    }
}
