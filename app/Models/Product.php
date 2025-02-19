<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'discount_id',
        'price',
        'stock',
        'image_url',
        'description',
    ];

    // Relasi: Produk milik satu kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi: Produk bisa memiliki satu diskon (opsional)
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    // Relasi: Produk bisa masuk dalam banyak order detail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
