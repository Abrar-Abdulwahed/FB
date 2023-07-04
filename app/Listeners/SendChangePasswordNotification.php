<?php

namespace App\Listeners;

use App\Mail\ChangePassword;
use App\Models\CustomMessage;
use App\Models\UserEmailHistory;
use App\Events\ChangePasswordEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendChangePasswordNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ChangePasswordEvent $event): void
    {
        
        $user = $event->user;
        $message = CustomMessage::where('code', 'password.change_message')->first();
        $mail = new ChangePassword($user, $message->text);
        Mail::to($user->email)->send($mail);
    }
}
