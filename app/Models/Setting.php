<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'value',
    ];
    protected function imageDefault(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Storage::url($this->attributes['site_logo']),
        );
    }
    public static function settings(){
        foreach(Setting::pluck('name')->all() as $key){
            $getSettings[$key]=Setting::where('name', $key)->value('value');
        }
        return $getSettings;
    }
}
