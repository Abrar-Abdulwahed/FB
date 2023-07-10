<?php

namespace App\Mail;

use App\Models\CustomMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeUser extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user, $message;
    /**
     * Create a new message instance.
     */
    public function __construct($user, CustomMessage $msg)
    {
        $this->user = $user;
        $this->subject = $msg->subject;
        $this->message = str_replace("userName", $this->user->name, $msg->text);
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
            markdown: 'mail.welcome_user',
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
