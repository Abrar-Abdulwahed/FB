<?php

namespace App\Models;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Page extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable  = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'is_in_footer',
        'is_in_menu',
        'is_active',
    ];

    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }

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
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

}
