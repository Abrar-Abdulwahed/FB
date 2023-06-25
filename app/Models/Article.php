<?php

namespace App\Models;

use Cocur\Slugify\Slugify;
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

    public static function generateSlug($title)
    {
        $slugify = new Slugify();

        $slug = $slugify->slugify($title);

        $count = 0;
        $originalSlug = $slug;

        while (self::slugExists($slug)) {
            $count++;
            $slug = $originalSlug . '-' . $count;
        }

        return $slug;
    }

    protected static function slugExists($slug)
    {
        return static::where('slug', $slug)->exists();
    }
}
