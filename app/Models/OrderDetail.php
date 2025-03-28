<?php

namespace App\Models;

use App\Observers\OrderDetailObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total_price',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(OrderDetailObserver::class);
    }

    // public function setTotalPriceAttribute($value)
    // {
    //     $this->attributes['total_price'] = $this->attributes['quantity'] * $this->product->price;
    // }

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
