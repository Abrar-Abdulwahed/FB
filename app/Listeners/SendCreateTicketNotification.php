<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\CreateTicket;
use App\Events\TicketCreatedEvent;
use Illuminate\Support\Facades\Mail;
use App\Services\CustomMessageService;
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
        $ticket = $event->ticket;
        $user = $ticket->user;
        try{
            $message = CustomMessageService::get('ticket.create');
            if($message){
                $mail = new CreateTicket($ticket, $message);
                Mail::to($user->email)->send($mail);
            }
        }catch(\Exception $e){
            return;
        }
    }
}
