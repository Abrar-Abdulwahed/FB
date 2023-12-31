<?php

namespace App\Listeners;

use App\Mail\WelcomeUser;
use App\Models\CustomMessage;
use App\Events\WelcomeUserEvent;
use App\Models\UserEmailHistory;
use Illuminate\Support\Facades\Mail;
use App\Services\CustomMessageService;
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
        try{
            $message = CustomMessageService::get('register.welcome_message');
            if($message){
                $mail = new WelcomeUser($user, $message);
                Mail::to($user->email)->send($mail);
            }
        }catch(\Exception $e){
            return;
        }

    }
}
