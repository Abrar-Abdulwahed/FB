<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $fillable  = [
        'title',
        'slug',
        'description',
        'content',
        'image'
    ];

    public function imagePath(): Attribute
    {
        if ($this->image) {
            return Attribute::make(
                get: fn ($value) => Storage::url('images/' . $this->image),
            );
        }
    }
}
