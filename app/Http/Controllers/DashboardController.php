<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Member;
use App\Models\Product;
use App\Models\OrderDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // dd(Transaction::getTotalProfit());
        // Data Keuntungan Harian
        $dailyProfitData = Transaction::getDailyProfit();
        $dailyLabels = [];
        $dailyProfits = [];

        foreach ($dailyProfitData as $data) {
            $dailyLabels[] = $data->date;
            $dailyProfits[] = $data->profit;
        }

        // Data Keuntungan Bulanan
        $monthlyProfitData = Transaction::getMonthlyProfit();
        $monthlyLabels = [];
        $monthlyProfits = [];

        foreach ($monthlyProfitData as $data) {
            $monthlyLabels[] = date("F", mktime(0, 0, 0, $data->month, 1)) . ' ' . $data->year;
            $monthlyProfits[] = $data->profit;
        }

        // Data Keuntungan Tahunan
        $yearlyProfitData = Transaction::getYearlyProfit();
        $yearlyLabels = [];
        $yearlyProfits = [];

        foreach ($yearlyProfitData as $data) {
            $yearlyLabels[] = $data->year;
            $yearlyProfits[] = $data->profit;
        }

        $profit = Transaction::getTotalProfit();

        $total_product = Product::all()->count();
        $total_member = Member::all()->count();

        // Hitung total pendapatan
        $totalRevenue = Order::sum('total_price');

        // Hitung total biaya berdasarkan harga beli produk
        // $totalCost = OrderDetail::sum('purchase_price');

        // Hitung persentase keuntungan
        $profitPercentage = ($totalRevenue > 0) ? ($profit / $totalRevenue) * 100 : 0;

        $title = "Home";
        return view('dashboard.index', compact('title', 'dailyLabels', 'dailyProfits', 'monthlyLabels', 'monthlyProfits', 'yearlyLabels', 'yearlyProfits', 'profit', 'total_product', 'total_member', 'profitPercentage'));
    }
}
