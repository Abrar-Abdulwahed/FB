<?php

namespace App\Http\Requests\Admin\CustomMessage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomMessageRequest extends FormRequest
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
            'code' => "required|string|max:25|unique:custom_messages",
            'subject' => "required|string|max:25|unique:custom_messages",
            'type' => "required|string|max:5|in:sms,email",
            'language' => "required|string|max:5|in:ar,en",
            'text' => "required|string",
            'is_active' => "required",
        ];
    }
}
