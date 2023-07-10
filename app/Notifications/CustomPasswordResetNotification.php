<?php

namespace App\Notifications;

use App\Models\CustomMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Lang;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomPasswordResetNotification extends ResetPassword
{
    use Queueable;

    public $token;
    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $resetPasswordMsg = CustomMessage::active()->where('code', 'password.reset_message')->first();
        if($resetPasswordMsg){
            return (new MailMessage)
                ->subject($resetPasswordMsg->subject)
                ->line(str_replace("userName", $notifiable->name, $resetPasswordMsg->text))
                ->action(Lang::get('Reset Password'), route('password.reset', $this->token))
                ->line(Lang::get('This password reset link will expire in :count minutes.', ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]));
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
