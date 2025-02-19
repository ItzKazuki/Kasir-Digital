<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'member_id',
        'total_price',
        'payment_method',
        'payment_status',
    ];

    // Relasi: Transaksi terkait dengan satu order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi: Transaksi bisa memiliki satu member (opsional)
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
