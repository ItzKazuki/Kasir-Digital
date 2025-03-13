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
        // Get filter parameters from request
        $revenueStart = request('revenue_start');
        $revenueEnd = request('revenue_end');
        $saleStart = request('sale_start');
        $saleEnd = request('sale_end');

        $dailyProfitData = Transaction::getDailyProfit();
        $dailySalesData = Transaction::getDailySales();
        $weeklyProfitData = Transaction::getWeeklyProfit();
        $weeklySalesData = Transaction::getWeeklySales();
        $monthlyProfitData = Transaction::getMonthlyProfit();
        $monthlyProfitData = Transaction::getMonthlyProfit();
        $monthlySalesData = Transaction::getMonthlySales();

        // Data Keuntungan Harian
        $dailyProfitLabels = [];
        $dailySalesLabels = [];
        $dailySales = [];
        $dailyProfits = [];
        // Data Keuntungan Mingguan
        $weeklyProfitLabels = [];
        $weeklySalesLabels = [];
        $weeklySales = [];
        $weeklyProfits = [];
        // Data Keuntungan Bulanan
        $monthlyProfitLabels = [];
        $monthlySalesLabels = [];
        $monthlySales = [];
        $monthlyProfits = [];

        // Apply filters to the data if provided
        if ($revenueStart && $revenueEnd) {
            $dailyProfitData = $dailyProfitData->whereBetween('date', [$revenueStart, $revenueEnd]);
            $weeklyProfitData = $weeklyProfitData->whereBetween('date', [$revenueStart, $revenueEnd]);
            $monthlyProfitData = $monthlyProfitData->whereBetween('date', [$revenueStart, $revenueEnd]);
        }

        if ($saleStart && $saleEnd) {
            $dailySalesData = $dailySalesData->whereBetween('date', [$saleStart, $saleEnd]);
            $weeklySalesData = $weeklySalesData->whereBetween('date', [$saleStart, $saleEnd]);
            $monthlySalesData = $monthlySalesData->whereBetween('date', [$saleStart, $saleEnd]);
        }

        // dd($weeklyProfitData);

        foreach ($dailyProfitData as $data) {
            $dailyProfitLabels[] = $data->date;
            $dailyProfits[] = $data->profit;
        }

        foreach ($dailySalesData as $data) {
            $dailySalesLabels[] = $data->date;
            $dailySales[] = $data->sales;
        }

        foreach ($weeklyProfitData as $data) {
            $weeklyProfitLabels[] = 'Week ' . $data->week . ' ' . $data->year;
            $weeklyProfits[] = $data->profit;
        }

        foreach ($weeklySalesData as $data) {
            $weeklySalesLabels[] = 'Week ' . $data->week . ' ' . $data->year;
            $weeklySales[] = $data->sales;
        }

        foreach ($monthlyProfitData as $data) {
            $monthlyProfitLabels[] = date("F", mktime(0, 0, 0, $data->month, 1)) . ' ' . $data->year;
            $monthlyProfits[] = $data->profit;
        }

        foreach ($monthlySalesData as $data) {
            $monthlySalesLabels[] = date("F", mktime(0, 0, 0, $data->month, 1)) . ' ' . $data->year;
            $monthlySales[] = $data->sales;
        }

        $profit = Transaction::getTotalProfit();

        $total_product = Product::all()->count();
        $total_member = Member::all()->groupBy('status');

        // Hitung total pendapatan
        $totalRevenue = Transaction::sum('total_price');

        // Hitung persentase keuntungan
        $profitPercentage = ($totalRevenue > 0) ? round($profit / $totalRevenue) : 0;

        $title = "Home";
        return view('dashboard.index', compact(
            'title', 'profit', 'total_product', 'total_member', 'profitPercentage',
            'dailyProfitLabels', 'dailySalesLabels', 'dailySales', 'dailyProfits',
            'weeklyProfitLabels', 'weeklySalesLabels', 'weeklySales', 'weeklyProfits',
            'monthlyProfitLabels', 'monthlySalesLabels', 'monthlySales', 'monthlyProfits'
        ));
    }
}
