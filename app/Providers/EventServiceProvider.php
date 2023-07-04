<?php

namespace App\Providers;

use App\Events\WelcomeUserEvent;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Mail\Events\MessageSent;
use App\Listeners\UserEmailHistorySaved;
use Illuminate\Mail\Events\MessageSending;
use App\Listeners\SendWelcomeUserNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        WelcomeUserEvent::class => [
            SendWelcomeUserNotification::class,
        ],
        // MessageSending::class => [
        //     LogSendingMessage::class,
        // ],
        MessageSent::class => [
            UserEmailHistorySaved::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
