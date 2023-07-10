<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\UserEmailHistory;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEmailHistorySaved
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
    public function handle(MessageSent $event): void
    {
        UserEmailHistory::create([
            'user_id' => User::where('email', $event->message->getTo()[0]->getAddress())->first()?->id ?? auth()->user()->id,
            'title' => $event->message->getSubject(),
            'text'  => $event->message->getBody()->getParts()[0]->getBody(),
        ]);
    }
}
