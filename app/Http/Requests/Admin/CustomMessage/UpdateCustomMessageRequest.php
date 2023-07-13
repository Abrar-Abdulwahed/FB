<?php

namespace App\Http\Requests\Admin\CustomMessage;

use App\Models\CustomMessage;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomMessageRequest extends FormRequest
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
            'code' => "required|string|max:25|unique:custom_messages,code," . $this->custom_message,
            'subject' => "required|string|max:25|unique:custom_messages,subject," . $this->custom_message,
            'language' => "required|string|max:5|in:ar,en",
            'message_email' => "required|string",
            'message_sms' => "nullable|string",
            'is_active' => ["required", function (string $attribute, mixed $value,  $fail)
            {
                if(!CustomMessage::findOrFail($this->custom_message)->disactivable() && $this->is_active === "off"){
                    $fail('لا يمكن أن تكون حالة هذه الرسالة غير مفعلة');
                }
            }],
        ];
    }
}
