<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'members';

    protected $fillable = [
        'full_name',
        'no_telp',
        'point',
        'email',
        'status',
    ];

    // Relasi: Member bisa memiliki banyak order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Relasi: Member bisa memiliki banyak transaksi
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
