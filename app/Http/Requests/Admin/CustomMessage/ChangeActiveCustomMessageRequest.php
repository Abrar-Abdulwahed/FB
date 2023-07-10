<?php

namespace App\Http\Requests\Admin\CustomMessage;

use App\Models\CustomMessage;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ChangeActiveCustomMessageRequest extends FormRequest
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
                $msg = $this->route()->parameters['msg'];
                if(!$msg->disactivable() && $msg->is_active === 1){
                    $validator->errors()->add( 'is_active','لا يمكن أن تكون حالة هذه الرسالة غير مفعلة');
                }
            }
        ];
    }
}
