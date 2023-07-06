<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\CustomMessage;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $verifyEmailMsg = CustomMessage::active()->where('code', 'verification.message')->first();
        if($verifyEmailMsg){
            VerifyEmail::toMailUsing(function (object $notifiable, string $url) use ($verifyEmailMsg) {
                return (new MailMessage)
                    ->subject('تفعيل الايميل')
                    ->line(str_replace("userName", $notifiable->name, $verifyEmailMsg->text))
                    ->action('تفعيل البريد الالكتروني', $url);
            });
        }

        $resetPasswordMsg = CustomMessage::active()->where('code', 'password.reset_message')->first();
        if($resetPasswordMsg){
            ResetPassword::toMailUsing(function (object $notifiable, string $token) use ($resetPasswordMsg) {
                return (new MailMessage)
                    ->subject(Lang::get('Reset Password Notification'))
                    ->line(str_replace("userName", $notifiable->name, $resetPasswordMsg->text))
                    ->action(Lang::get('Reset Password'), url('/').'/password/reset/'.$token)
                    ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]));
            });
        }
    }
}
