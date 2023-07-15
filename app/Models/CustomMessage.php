<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use App\Services\CustomMessageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomMessage extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'code',
        'subject',
        'language',
        'message_email',
        'message_sms',
        'is_active',
    ];

    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', 1);
    }

    public function disactivable(): bool
    {
        //2: verification.message.
        //4: password.reset_message
        return !in_array($this->id, [2, 4]);
    }

    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = $value === 'on' ? 1 : 0;
    }

    protected $casts = [
        'is_active' => 'integer',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
}
