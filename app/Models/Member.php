<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

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

