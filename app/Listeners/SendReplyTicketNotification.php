<?php

namespace App\Listeners;

use App\Mail\ReplyTicket;
use App\Events\ReplyTicketCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReplyTicketNotification
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
    public function handle(ReplyTicketCreatedEvent $event): void
    {
        $user = $event->user;
        try{
            $message = CustomMessage::active()->where('code', 'ticket.reply')->first();
            if($message){
                $mail = new ReplyTicket($user, $message);
                Mail::to($user->email)->send($mail);
            }
        }catch(\Exception $e){
            return;
        }
    }
}
