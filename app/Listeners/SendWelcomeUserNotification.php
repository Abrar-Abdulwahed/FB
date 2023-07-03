<?php

namespace App\Listeners;

use App\Mail\WelcomeUser;
use App\Models\CustomMessage;
use App\Events\WelcomeUserEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeUserNotification
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
    public function handle(WelcomeUserEvent $event): void
    {
        $user = $event->user;
        $message = CustomMessage::where('code', 'register.welcome_message')->first()->text;
        Mail::to($user->email)->send(new WelcomeUser($user, $message));
    }
}
