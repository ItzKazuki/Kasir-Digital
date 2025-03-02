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

    public $timestamps = false;

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

    public static function getTotalProfit()
    {
        return self::join('order_details', 'transactions.order_id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->selectRaw('SUM(order_details.total_price - (order_details.quantity * (products.price - products.estimasi_keuntungan))) as profit')
            ->where('transactions.payment_status', 'paid')
            ->first()
            ->profit ?? 0;
    }


    // Keuntungan per Hari berdasarkan `order.order_date`
    public static function getDailyProfit()
    {
        return self::join('orders', 'transactions.order_id', '=', 'orders.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('transactions.payment_status', 'paid')
            ->selectRaw('DATE(orders.order_date) as date,
                             SUM(order_details.total_price - (order_details.quantity * (products.price - products.estimasi_keuntungan))) as profit')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }

    // Keuntungan per Bulan berdasarkan `order.order_date`
    public static function getMonthlyProfit()
    {
        return self::join('orders', 'transactions.order_id', '=', 'orders.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('transactions.payment_status', 'paid')
            ->selectRaw('MONTH(orders.order_date) as month, YEAR(orders.order_date) as year,
                             SUM(order_details.total_price - (order_details.quantity * (products.price - products.estimasi_keuntungan))) as profit')
            ->groupBy('month', 'year')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
    }

    // Keuntungan per Tahun berdasarkan `order.order_date`
    public static function getYearlyProfit()
    {
        return self::join('orders', 'transactions.order_id', '=', 'orders.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('transactions.payment_status', 'paid')
            ->selectRaw('YEAR(orders.order_date) as year,
                             SUM(order_details.total_price - (order_details.quantity * (products.price - products.estimasi_keuntungan))) as profit')
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();
    }
}
