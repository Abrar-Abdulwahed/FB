<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ShortLink extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = ['url', 'slug'];

    public function statistics()
    {
        return $this->hasMany(ShortLinkStatistics::class, 'short_link_id');
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
}
