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
        // dd($this);
        // dd($this->has('google_enable'));
        return [
            'app_name'                   => 'required|string',
            'site_description'           => 'required|string',
            'site_logo'                  => 'nullable|image|mimes:png',
            'site_status'                => 'required|in:active,inactive',
            'reason_locked'              => 'required_if:site_status,inactive|nullable',
            'google_enable'              => 'nullable|string|in:on,off',
            'google_client_id'           => $this->has('google_enable')?'required' : 'nullable'. '|string',
            'google_client_secret'       => $this->has('google_enable')?'required' : 'nullable'. '|string',
            'google_client_redirect'     => $this->has('google_enable')?'required' : 'nullable'. '|url',
            'facebook_enable'            => 'nullable|string|in:on,off',
            'facebook_client_id'         => $this->has('facebook_enable')?'required' : 'nullable'. '|string',
            'facebook_client_secret'     => $this->has('facebook_enable')?'required' : 'nullable'. '|string',
            'facebook_client_redirect'   => $this->has('facebook_enable')?'required' : 'nullable'. '|url',
            'recaptcha_site_key'         => 'required|string',
            'recaptcha_secret_key'       => 'required|string',
            'mail_mailer'                => 'required|string|in:smtp,mailgun',
            'mail_host'                  => 'required|string',
            'mail_port'                  => 'required|numeric|digits:4',
            'mail_username'              => 'required|string',
            'mail_password'              => 'required|string',
            'mail_from_address'          => 'required|email',
            'mail_from_name'             => 'required|string',
        ];          
    }
}
