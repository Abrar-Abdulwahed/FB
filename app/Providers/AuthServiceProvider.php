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
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            $message = CustomMessage::where('code', 'verification.message')->first();
            return (new MailMessage)
                ->subject($message->subject)
                ->line(str_replace("userName", $notifiable->name, $message->text))
                ->action('تفعيل البريد الالكتروني', $url);
        });

        ResetPassword::toMailUsing(function (object $notifiable, string $token) {
            $message = CustomMessage::where('code', 'password.reset_message')->first();
            return (new MailMessage)
                ->subject($message->subject)
                ->line(str_replace("userName", $notifiable->name, $message->text))
                ->action(Lang::get('Reset Password'), url('/').'/password/reset/'.$token)
                ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]));
        });
    }
}
