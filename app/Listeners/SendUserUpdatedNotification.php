<?php

namespace App\Listeners;

use App\Events\UserUpdated;
use App\Mail\ChangePassword;
use App\Models\CustomMessage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use App\Services\CustomMessageService;
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
            try{
                $message = CustomMessageService::get('password.change_message');
                if($message){
                    $mail = new ChangePassword($user, $message);
                    Mail::to($user->email)->send($mail);
                }
            }catch(\Exception $e){
                return;
            }
        }
    }
}
