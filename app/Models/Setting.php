<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Setting extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = [
        'name',
        'value',
    ];

    public static function settings()
    {
        $getSettings = [];
        foreach (Setting::pluck('name')->all() as $key) {
            $getSettings[$key] = Setting::where('name', $key)->value('value');
        }
        return $getSettings;
    }
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }
}
