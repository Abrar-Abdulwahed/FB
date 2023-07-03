<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomMessage extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'type',
        'language',
        'text',
        'is_active',
    ];

    public function setIsActiveAttribute($value)
    {
        $this->attributes['is_active'] = $value === 'on' ? 1 : 0;
    }

    protected $casts = [
        'is_active' => 'integer',
    ];
    
}
