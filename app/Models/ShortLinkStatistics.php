<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLinkStatistics extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_link_id',
        'ip',
        'browser',
        'user_agent',
        'country',
        'visits',
    ];
}
