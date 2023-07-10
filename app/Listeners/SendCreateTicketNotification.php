<?php

namespace App\Listeners;

use App\Mail\CreateTicket;
use App\Events\TicketCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCreateTicketNotification
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
    public function handle(TicketCreatedEvent $event): void
    {
        $user = $event->user;
        $message = CustomMessage::active()->where('code', 'ticket.create')->first();
        if($message){
            $mail = new CreateTicket($user, $message);
            Mail::to($user->email)->send($mail);
        }
    }
}
