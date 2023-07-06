<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Ad extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = ['name', 'message', 'type', 'start_date', 'end_date', 'country', 'gender', 'min_age', 'max_age'];
    protected $dates = ['start_date', 'end_date'];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
    public function created_at()
    {
        return $this->created_at->format('Y-m-d');
    }
    public function updated_at()
    {
        return $this->updated_at->format('Y-m-d');
    }
    public function start_date()
    {
        return $this->start_date->format('Y-m-d');
    }
    public function end_date()
    {
        return $this->end_date->format('Y-m-d');
    }
}
