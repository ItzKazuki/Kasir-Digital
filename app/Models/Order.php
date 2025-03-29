<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_date',
        'total_items',
        'total_price',
        'discount_id',
    ];

    protected $with = [
        'orderDetails',
        'user'
    ];

    // Relasi: Order dibuat oleh satu user (kasir/admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: Order bisa memiliki satu diskon (opsional)
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    // Relasi: Satu order bisa memiliki banyak order detail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Relasi: Satu order memiliki satu transaksi
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
