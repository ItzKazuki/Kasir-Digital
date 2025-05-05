<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Order;
use Illuminate\Support\Str;
use Laravolt\Avatar\Avatar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'full_name',
        'no_telp',
        'email',
        'password',
        'profile_img',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Send a password reset notification to the user.
     *
     * @param  string  $token
     */
    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new CustomResetPassword($token));
    }

    // Mutator untuk hashing password
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Accessor untuk membuat field baru namun field lamanya tidak berubah
    public function getProfileImageAttribute()
    {
        return $this->profile_img
            ? Storage::url('static/images/profiles/' . $this->profile_img)
            : null;
    }

    // Relasi: User (kasir/admin) bisa menangani banyak order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
