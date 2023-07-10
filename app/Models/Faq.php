<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Faq extends Model
{
    use HasFactory, LogsActivity;
    protected $fillable = ['title', 'answer'];
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    public function categories()
    {
        return $this->belongsToMany(FaqCategory::class, 'faq_faq_category','faq_id','faq_category_id');
    }
}
