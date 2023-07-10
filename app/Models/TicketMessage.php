<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Events\ReplyTicketCreatedEvent;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TicketMessage extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['ticket_id', 'user_id', 'message', 'is_admin'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Events
    protected $dispatchesEvents = [
        'created' => ReplyTicketCreatedEvent::class,
    ];
}
