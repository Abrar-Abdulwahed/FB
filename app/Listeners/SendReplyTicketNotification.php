<?php

namespace App\Listeners;

use App\Mail\ReplyTicket;
use Illuminate\Support\Facades\Mail;
use App\Services\CustomMessageService;
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

        $reply = $event->ticket_reply;
        $ticket = $reply->ticket;
        $user = $ticket->user; // user of the ticket itself
        try{
            $message = CustomMessageService::get('ticket.reply');
            if($message){
                $mail = new ReplyTicket($user, $reply, $message);
                Mail::to($user->email)->send($mail);
            }
        }catch(\Exception $e){
            return;
        }
    }
}
