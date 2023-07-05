<?php

namespace App\Listeners;

use App\Events\UserUpdated;
use App\Mail\ChangePassword;
use App\Models\CustomMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendUserUpdatedNotification
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
    public function handle(UserUpdated $event): void
    {
        if ($event->user->isDirty('password') && $event->user->wasChanged('password')) {
            $user = $event->user;
            $message = CustomMessage::where('code', 'password.change_message')->first();
            $mail = new ChangePassword($user, $message->text);
            Mail::to($user->email)->send($mail);
        }
    }
}
