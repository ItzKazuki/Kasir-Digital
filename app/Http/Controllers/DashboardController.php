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
        // Data Keuntungan Harian
        $dailyProfitData = Transaction::getDailyProfit();
        $dailyLabels = [];
        $dailyProfits = [];
        $dailySales = [];

        foreach ($dailyProfitData as $data) {
            $dailyLabels[] = $data->date;
            $dailyProfits[] = $data->profit;
        }

        $dailySalesData = Transaction::getDailySales();
        foreach ($dailySalesData as $data) {
            $dailySales[] = $data->sales;
        }

        // Data Keuntungan Mingguan
        $weeklyProfitData = Transaction::getWeeklyProfit();
        $weeklyLabels = [];
        $weeklyProfits = [];
        $weeklySales = [];

        foreach ($weeklyProfitData as $data) {
            $weeklyLabels[] = 'Week ' . $data->week . ' ' . $data->year;
            $weeklyProfits[] = $data->profit;
        }

        $weeklySalesData = Transaction::getWeeklySales();
        foreach ($weeklySalesData as $data) {
            $weeklySales[] = $data->sales;
        }

        // Data Keuntungan Bulanan
        $monthlyProfitData = Transaction::getMonthlyProfit();
        $monthlyLabels = [];
        $monthlyProfits = [];
        $monthlySales = [];

        foreach ($monthlyProfitData as $data) {
            $monthlyLabels[] = date("F", mktime(0, 0, 0, $data->month, 1)) . ' ' . $data->year;
            $monthlyProfits[] = $data->profit;
        }

        $monthlySalesData = Transaction::getMonthlySales();
        foreach ($monthlySalesData as $data) {
            $monthlySales[] = $data->sales;
        }

        $profit = Transaction::getTotalProfit();

        $total_product = Product::all()->count();
        $total_member = Member::all()->count();

        // Hitung total pendapatan
        $totalRevenue = Order::sum('total_price');

        // Hitung persentase keuntungan
        $profitPercentage = ($totalRevenue > 0) ? ($profit / $totalRevenue) * 100 : 0;

        $title = "Home";
        return view('dashboard.index', compact('title', 'dailyLabels', 'dailyProfits', 'dailySales', 'weeklyLabels', 'weeklyProfits', 'weeklySales', 'monthlyLabels', 'monthlyProfits', 'monthlySales', 'profit', 'total_product', 'total_member', 'profitPercentage'));
    }
}
