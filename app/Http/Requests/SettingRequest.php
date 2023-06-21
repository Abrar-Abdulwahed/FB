<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'site_name'             => 'sometimes|string',
            'site_description'      => 'sometimes|string',
            'site_logo'             => 'nullable|image|mimes:png',
            'google_client_id'      => 'sometimes|string',
            'google_client_secret'  => 'sometimes|string',
            'fb_client_id'          => 'sometimes|string',
            'fb_client_secret'      => 'sometimes|string',
        ];
    }
}
