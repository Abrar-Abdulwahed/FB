<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class UserEmailHistory extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'title',
        'user_id',
        'text'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
    
    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
