<?php

namespace App\Models;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Article extends Model
{
    use HasFactory , LogsActivity;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'image',
        'user_id'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
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

    public function comments()
    {
        return $this->hasMany(ArticleComment::class, 'article_id');
    }

    protected function imageDefault(): Attribute
    {
        if (!$this->image) {
            return Attribute::make(
                get: fn($value) => Storage::url('articles/default.png'),
            );
        }
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, 'article_category', 'article_id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
}
