<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEmailHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'recipient',
        'custom_message_id',
    ];

    // Relations
    public function custom_message()
    {
        return $this->belongsTo(CustomMessage::class);
    }
}
