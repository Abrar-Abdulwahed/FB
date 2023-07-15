<?php

namespace App\Models;

use App\Events\TicketCreatedEvent;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory, LogsActivity, Notifiable;
    protected $fillable = ['user_id', 'ticket_category_id', 'subject', 'message','status'];
    
    // Events
    protected $dispatchesEvents = [
        'created' => TicketCreatedEvent::class,
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the ticket belongs to.
     */
    public function category()
    {
        return $this->belongsTo(TicketCategory::class, 'ticket_category_id');
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
}
