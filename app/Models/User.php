<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Events\UserUpdated;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Notifications\CustomPasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'provider_token',
        'avatar',
        'is_banned',
        'banned_until',
        'last_activity',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email', 'avatar', 'is_banned', 'banned_until', 'last_activity', 'updated_at'])
            ->dontLogIfAttributesChangedOnly(['last_activity', 'updated_at']);
    }

    public function getAvatarImageAttribute()
    {
        return $this->avatar ? Storage::disk('avatars')->url($this->avatar) : Storage::disk('avatars')->url('default.png');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'banned_until' => 'datetime',
        'password' => 'hashed',
    ];

    // Events
    protected $dispatchesEvents = [
        'updated' => UserUpdated::class,
    ];

    // relations
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    public function emails()
    {
        return $this->hasMany(UserEmailHistory::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new CustomPasswordResetNotification($token));
    // }
    
}
