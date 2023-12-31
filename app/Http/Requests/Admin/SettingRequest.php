<?php

namespace App\Http\Requests\Admin;

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
            'app_name' => 'sometimes|required|string',
            'site_description' => 'sometimes|required|string',
            'site_logo' => 'nullable|image',
            'site_status' => 'sometimes|required|in:active,inactive',
            'reason_locked' => 'required_if:site_status,inactive|nullable',
            'google_enable' => 'required|string|in:on,off',
            'google_client_id' => 'required_if:google_enable,on|nullable|string',
            'google_client_secret' => 'required_if:google_enable,on|nullable|string',
            'facebook_enable' => 'required|string|in:on,off',
            'facebook_client_id' => 'required_if:facebook_enable,on|nullable|string',
            'facebook_client_secret' => 'required_if:facebook_enable,on|nullable|string',
            'captcha_enable'=> 'required|string|in:on,off',
            'recaptcha_site_key' => 'required_if:captcha_enable,on|nullable|string',
            'recaptcha_secret_key' => 'required_if:captcha_enable,on|nullable|string',
            'mail_mailer' => 'sometimes|required|string|in:smtp,sendmail',
            'mail_host' => 'sometimes|required|string',
            'mail_port' => 'sometimes|required|numeric|digits_between:3,4',
            'mail_username' => 'sometimes|required|string',
            'mail_password' => 'sometimes|required|string',
            'mail_from_address' => 'sometimes|required|email',
            'mail_from_name' => 'sometimes|required|string',
            'header_script' => 'nullable',
            'footer_script' => 'nullable',
            'email_confirm_enable'=>'required|string|in:on,off',
            'comment_enable'=>'sometimes|string|in:on,off',
            'short_link_enable'=>'required|string|in:on,off',
            'telegram_report_enable'=>'required|string|in:on,off',
            'telegram_chat_id'=>'required_if:telegram_report_enable,on|nullable|string',
            'telegram_token'=>'required_if:telegram_report_enable,on|nullable|string',
            'slack_report_enable'=>'required|string|in:on,off',
            'slack_url'=>'required_if:slack_report_enable,on|nullable|url|starts_with:https://hooks.slack.com/services/',
            'email_report_enable' => 'required|string|in:on,off',
            //
            'test_email'=> 'sometimes|required|email:rfc,dns',
        ];
    }
}
