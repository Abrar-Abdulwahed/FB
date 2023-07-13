<?php

namespace App\Mail;

use App\Models\CustomMessage;
use App\Models\TicketMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReplyTicket extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user, $ticket_link, $message;
    /**
     * Create a new message instance.
     */
    public function __construct($user, TicketMessage $reply, CustomMessage $msg)
    {
        $this->user = $user;
        $this->subject = str_replace("id", $reply->ticket->id, $msg->subject);
        $this->ticket_link = route('user.ticket.show', $reply->ticket->id);
        $this->message = str_replace(["userName", "replier"], [$this->user->name, $reply->user->name], $msg->message_email);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.reply_ticket',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
