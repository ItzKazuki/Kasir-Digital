<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'value',
        'start_date',
        'end_date',
        'status',
    ];

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = ($this->attributes['type'] === 'percentage') ? round($value) : $value;
    }

    // Relasi: Satu diskon bisa berlaku untuk banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Relasi: Satu diskon bisa berlaku untuk banyak order
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
