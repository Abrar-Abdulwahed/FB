<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ShortLinkStatistics extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'short_link_id',
        'ip',
        'browser',
        'user_agent',
        'country',
        'visits',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
}
