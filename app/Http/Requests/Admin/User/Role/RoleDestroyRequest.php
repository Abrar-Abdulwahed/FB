<?php

namespace App\Http\Requests\Admin\User\Role;

use App\Models\Role;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class RoleDestroyRequest extends FormRequest
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
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $id = $this->route()->parameters['role'];
                //dd($id);
                if($id==1 || $id==2){
                    $validator->errors()->add(
                        'roles',
                       ' ممنوع الحذف',
                    );
                }
            }
        ];
    }
}
