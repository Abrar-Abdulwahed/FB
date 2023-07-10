<?php

namespace App\Http\Requests\Admin\Ticket;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTicketRequest extends FormRequest
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
            'ticket_category_id'=>'required',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                // get user roles
                $roles = Auth::user()->roles->pluck('id');
                // admin role id is : 1
                if(in_array(1,$roles->toArray())){
                    $validator->errors()->add(
                        'subject',
                       'لا يمكن للأدمن انشاء تذاكر دعم فني',
                    );
                }
            }
        ];
    }
}
