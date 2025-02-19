<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total_price',
    ];

    // Relasi: Order Detail milik satu order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi: Order Detail berisi satu produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

