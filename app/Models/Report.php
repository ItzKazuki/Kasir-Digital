<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'date',              // Tanggal laporan
        'total_sales',       // Total penjualan
        'total_transactions',// Total jumlah transaksi
        'total_profit',      // Total keuntungan
        'cash_sales',        // Penjualan tunai
        'other_sales',       // Penjualan lainnya (e.g., e-wallet)
        'expenses',          // Total pengeluaran
        'net_profit',        // Laba bersih
        'cash_before',       // Kas awal
        'cash_after',        // Kas akhir
        'cash_difference',   // Selisih kas
        'created_by',    // User yang membuat laporan
        'notes',             // Catatan tambahan
    ];
}
