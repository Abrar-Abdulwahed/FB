<?php

namespace App\Notifications;

use App\Models\CustomMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class CustomVerifyEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verifyEmailMsg = CustomMessage::active()->where('code', 'verification.message')->first();
        if($verifyEmailMsg){
            return (new MailMessage)
                ->subject($verifyEmailMsg->subject)
                ->line(str_replace("userName", $notifiable->name, $verifyEmailMsg->text))
                ->action('تفعيل البريد الالكتروني', $this->url);
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
