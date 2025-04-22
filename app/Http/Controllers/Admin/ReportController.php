<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Reports";
        return view('dashboard.reports.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Reports";
        return view('dashboard.reports.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil data transaksi harian
        $date = $request->input('date', now()->toDateString());
        $transactions = Transaction::whereDate('created_at', $date)->get();

        // Hitung data laporan
        $totalSales = $transactions->sum('total_price');
        $totalTransactions = $transactions->count();
        $cashSales = $transactions->where('payment_method', 'cash')->sum('total_price');
        $otherSales = $transactions->whereNotIn('payment_method', ['cash'])->sum('total_price');
        $expenses = $request->input('expenses', 0); // Input manual untuk pengeluaran
        $totalProfit = $totalSales - $transactions->sum('cost_price'); // Keuntungan kotor
        $netProfit = $totalProfit - $expenses; // Laba bersih
        $cashBefore = $request->input('cash_before', 0); // Input manual untuk kas awal
        $cashAfter = $request->input('cash_after', 0); // Input manual untuk kas akhir
        $cashDifference = $cashAfter - $cashBefore; // Selisih kas


        // Validasi input
        $request->validate([
            'expenses' => 'nullable|numeric',
            'cash_before' => 'nullable|numeric',
            'cash_after' => 'nullable|numeric',
        ]);

        // Simpan data ke tabel reports
        Report::create([
            'date' => $date,
            'total_sales' => $totalSales,
            'total_transactions' => $totalTransactions,
            'cash_sales' => $cashSales,
            'other_sales' => $otherSales,
            'expenses' => $expenses,
            'net_profit' => $netProfit,
            'total_profit' => $totalProfit,
            'cash_before' => $cashBefore,
            'cash_after' => $cashAfter,
            'cash_difference' => $cashDifference,
            'created_by' => $request->user()->full_name,
            'notes' => $request->input('notes', ''),
        ]);

        return redirect()->route('reports.index')->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
