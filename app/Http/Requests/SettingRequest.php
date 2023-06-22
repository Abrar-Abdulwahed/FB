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
            'site_name'             => 'required|string',
            'site_description'      => 'required|string',
            'site_logo'             => 'nullable|image|mimes:png',
            'active_site'           => 'required|in:active,inactive',
            'reason_locked'         => 'required_if:active_site,inactive|nullable',
            // 'services.google_client_id'      => 'required|string',
            // 'services.google_client_secret'  => 'required|string',
            // 'services.google_client_redirect'=> 'required|url',
            // 'services.facebook_client_id'          => 'required|string',
            // 'services.facebook_client_secret'      => 'required|string',
            // 'services.facebook_client_redirect'    => 'required|url',
            'recpatcha' => 'array',
            'recaptcha.api_site_key'    => 'required|string',
            'recaptcha.api_secret_key'  => 'required|string',
            // 'mail_mailer'           => 'required|string',
            // 'mail_host'             => 'required|string',
            // 'mail_port'             => 'required|numeric|digits:4',
            // 'mail_username'         => 'required|string',
            // 'mail_password'         => 'required|string',
            // 'mail_from_address'     => 'required|email',
            // 'mail_from_name'        => 'required|string',
        ];
    }
}
