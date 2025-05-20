<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Reports";
        $reports = Report::query();

        if ($request->start_date && $request->end_date) {
            $reports->whereBetween('date', [$request->start_date, $request->end_date]);
        }

        $reports = $reports->paginate(10);
        return view('dashboard.reports.index', compact('title', 'reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Create Reports";
        $date = now()->toDateString();

        // if (now()->format('H:i') < '22:00' || now()->format('H:i') > '23:59') {
        //     Sweetalert::error('Pembuatan laporan hanya tersedia pada jam 10-12 malam.', 'Gagal');
        //     return redirect()->route('dashboard.reports.index');
        // }

        if (Report::where('date', $date)->exists()) {
            Sweetalert::error('Laporan untuk tanggal ini sudah ada.', 'Gagal');
            return redirect()->route('dashboard.reports.index');
        }

        return view('dashboard.reports.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil data transaksi harian
        $date = $request->input('date', now()->toDateString());

        // Validasi input
        $request->validate([
            'expenses' => 'nullable|numeric',
            'cash_before' => 'nullable|numeric',
            'cash_after' => 'nullable|numeric',
        ]);

        // Cek apakah laporan untuk tanggal ini sudah ada
        if (Report::where('date', $date)->exists()) {
            Sweetalert::error('Gagal', 'Laporan untuk tanggal ini sudah ada.');
            return redirect()->route('dashboard.reports.index');
        }

        $transactions = Transaction::whereIn('order_id', function ($query) use ($date) {
            $query->select('id')
            ->from('orders')
            ->whereDate('created_at', $date);
        })->get();

        // Hitung data laporan
        $filteredTransactions = $transactions->whereNotIn('payment_status', ['pending', 'unpaid']);
        $totalSales = $filteredTransactions->sum('total_price');
        $totalTransactions = $filteredTransactions->count();
        $cashSales = $filteredTransactions->where('payment_method', 'cash')->sum('total_price');
        $otherSales = $filteredTransactions->whereNotIn('payment_method', ['cash'])->sum('total_price');
        $expenses = $request->input('expenses', 0); // Input manual untuk pengeluaran
        $totalProfit = $totalSales - $filteredTransactions->sum('cost_price'); // Keuntungan kotor
        $netProfit = $totalProfit - $expenses; // Laba bersih
        $cashBefore = $request->input('cash_before', 0); // Input manual untuk kas awal
        $cashAfter = $request->input('cash_after', 0); // Input manual untuk kas akhir
        $cashDifference = $cashAfter - $cashBefore; // Selisih kas

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
            'created_by' => $request->user()->full_name . ' ('.$request->user()->role.')',
            'notes' => $request->input('notes', ''),
        ]);

        return redirect()->route('dashboard.reports.index')->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        $title = "Detail Report";
        return view('dashboard.reports.show', compact('title', 'report'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
