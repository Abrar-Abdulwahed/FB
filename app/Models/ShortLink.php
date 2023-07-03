<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'slug'];

    public function statistics()
    {
        return $this->hasMany(ShortLinkStatistics::class, 'short_link_id');
    }
}
