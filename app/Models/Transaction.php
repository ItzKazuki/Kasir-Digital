<?php

namespace App\Models;

use Carbon\Carbon;
use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'member_id',
        'total_price',
        'payment_method',
        'payment_status',
        'cash',
        'cash_change'
    ];

    public $timestamps = false;

    protected static function boot()
    {
        parent::boot();
        static::observe(TransactionObserver::class);
    }

    //accessor untuk mendapatkan nomor invoice
    // format INV-yyyymmdd-001
    public function getInvoiceNumberAttribute()
    {
        $formatId = str_pad($this->id, 3, '0', STR_PAD_LEFT);
        return 'INV-' . Carbon::parse($this->order->order_date)->format('Ymd') . '-' . $formatId;
    }

    public function getStrukUrlAttribute()
    {
        return route('struk.search', ['invoice' => $this->invoice_number]);
    }

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

    public function scopeFindByInvoice(Builder $query, string $invoice)
    {
        // Pecah invoice jadi bagian-bagian
        if (preg_match('/INV-(\d{8})-(\d+)/', $invoice, $matches)) {
            $orderDate = date('Y-m-d', strtotime($matches[1])); // Format ke YYYY-MM-DD
            $transactionId = (int) $matches[2]; // Konversi ke integer

            return $query->where('transactions.id', $transactionId)
                ->whereHas('order', function ($q) use ($orderDate) {
                    $q->whereDate('order_date', $orderDate);
                });
        }

        return $query; // Jika format salah, kembalikan query tanpa filter
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

    public static function getWeeklyProfit()
    {
        return self::join('orders', 'transactions.order_id', '=', 'orders.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->where('transactions.payment_status', 'paid')
            ->selectRaw('YEAR(orders.order_date) as year, WEEK(orders.order_date) as week,
                         SUM(order_details.total_price - (order_details.quantity * (products.price - products.estimasi_keuntungan))) as profit')
            ->groupBy('year', 'week')
            ->orderBy('year', 'asc')
            ->orderBy('week', 'asc')
            ->get();
    }

    public static function getDailySales()
    {
        return self::join('orders', 'transactions.order_id', '=', 'orders.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('transactions.payment_status', 'paid')
            ->selectRaw('DATE(orders.order_date) as date, SUM(order_details.total_price) as sales')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
    }

    public static function getWeeklySales()
    {
        return self::join('orders', 'transactions.order_id', '=', 'orders.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('transactions.payment_status', 'paid')
            ->selectRaw('YEAR(orders.order_date) as year, WEEK(orders.order_date) as week, SUM(order_details.total_price) as sales')
            ->groupBy('year', 'week')
            ->orderBy('year', 'asc')
            ->orderBy('week', 'asc')
            ->get();
    }

    public static function getMonthlySales()
    {
        return self::join('orders', 'transactions.order_id', '=', 'orders.id')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('transactions.payment_status', 'paid')
            ->selectRaw('MONTH(orders.order_date) as month, YEAR(orders.order_date) as year, SUM(order_details.total_price) as sales')
            ->groupBy('month', 'year')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
    }
}
