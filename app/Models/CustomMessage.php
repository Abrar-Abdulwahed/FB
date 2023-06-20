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
    ];
}
