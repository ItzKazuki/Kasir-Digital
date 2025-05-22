<?php

namespace App\Http\Controllers\Admin;

use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Reports";
        $query = Transaction::query();

        // Join ke tabel orders
        $query->join('orders', 'transactions.order_id', '=', 'orders.id')
            ->select('transactions.*', 'orders.order_date');

        // Filter berdasarkan tahun jika ada
        if ($request->year) {
            $query->whereYear('orders.order_date', $request->year);
        }

        // Filter berdasarkan bulan jika ada
        if ($request->month) {
            $query->whereMonth('orders.order_date', $request->month);
        }

        // Urutkan data
        $query->orderBy('orders.order_date', 'DESC')
            ->orderBy('transactions.id', 'DESC');

        $reports = $query->get();

        // dd($reports);

        return view('dashboard.reports.index', compact('title', 'reports'));
    }

    public function download(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $query = Transaction::query()
            ->join('orders', 'transactions.order_id', '=', 'orders.id')
            ->select('transactions.*', 'orders.order_date');

        if ($month && $year) {
            $query->whereMonth('orders.order_date', $month)
                ->whereYear('orders.order_date', $year);
        } elseif ($year) {
            $query->whereYear('orders.order_date', $year);
        }

        $transactions = $query->orderBy('orders.order_date', 'ASC')->get();

        $total = $transactions->sum('total_price');

        $pdf = FacadePdf::loadView('pdf.report', [
            'transactions' => $transactions,
            'total' => $total,
            'month' => $month,
            'year' => $year
        ]);

        $filename = "laporan_transaksi_{$month}_{$year}.pdf";

        return $pdf->download($filename);
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

        $years = Transaction::join('orders', 'transactions.order_id', '=', 'orders.id')
            ->select(DB::raw('YEAR(orders.order_date) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        // if (Report::where('date', $date)->exists()) {
        //     Sweetalert::error('Laporan untuk tanggal ini sudah ada.', 'Gagal');
        //     return redirect()->route('dashboard.reports.index');
        // }

        return view('dashboard.reports.create', compact('title', 'years'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'expenses' => 'nullable|numeric',
            'cash_before' => 'nullable|numeric',
            'cash_after' => 'nullable|numeric',
            'filter_type' => 'nullable|in:harian,bulanan,tahunan',
            'year' => 'nullable|integer',
            'month' => 'nullable|integer',
            'date' => 'nullable|date',
            'notes' => 'nullable|string|max:255',
        ]);

        $filterType = $request->filter_type;
        $year = $request->year ?? now()->year;
        $month = $request->month;
        $date = $request->date ?? $request->input('date', now()->toDateString());

        // Cek apakah laporan untuk tanggal ini sudah ada
        // if (Report::where('date', $date)->exists()) {
        //     Sweetalert::error('Gagal', 'Laporan untuk tanggal ini sudah ada.');
        //     return redirect()->route('dashboard.reports.index');
        // }

        // $transactions = Transaction::whereIn('order_id', function ($query) use ($date) {
        //     $query->select('id')
        //         ->from('orders')
        //         ->whereDate('created_at', $date);
        // })->get();

        if ($filterType === 'bulanan' && $month) {
            // Ambil transaksi berdasarkan bulan & tahun
            $transactions = Transaction::with('order')->whereIn('order_id', function ($query) use ($month, $year) {
                $query->select('id')
                    ->from('orders')
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month);
            })->get();
        } elseif ($filterType === 'tahunan') {
            // Ambil transaksi berdasarkan tahun
            $transactions = Transaction::with('order')->whereIn('order_id', function ($query) use ($year) {
                $query->select('id')
                    ->from('orders')
                    ->whereYear('created_at', $year);
            })->get();
        } else {
            // Default: harian (atau fallback)
            $transactions = Transaction::with('order')->whereIn('order_id', function ($query) use ($date) {
                $query->select('id')
                    ->from('orders')
                    ->whereDate('created_at', $date);
            })->get();
        }

        dd(count($transactions), $request->all(), $transactions->pluck('order_id')->toArray());

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
            'created_by' => $request->user()->full_name . ' (' . $request->user()->role . ')',
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
