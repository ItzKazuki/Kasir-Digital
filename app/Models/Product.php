<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Discount;
use App\Models\OrderDetail;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'barcode',
        'category_id',
        'discount_id',
        'price',
        'stock',
        'image_url',
        'description',
        'estimasi_keuntungan',
    ];

    protected static function boot()
    {
        parent::boot();
        static::observe(ProductObserver::class);
    }

    // Accessor untuk membuat field baru namun field lamanya tidak berubah
    public function getProductImageAttribute()
    {
        return $this->image_url ? Storage::url('static/images/products/' . $this->image_url) : "";
    }

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
