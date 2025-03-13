<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use App\Traits\GenerateStrukPdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    use GenerateStrukPdf;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Transactions";

        $query = Transaction::with('order.member');

        if ($request->start_date && $request->end_date) {
            $query->whereHas('order', function ($q) use ($request) {
                $q->whereBetween('order_date', [$request->start_date, $request->end_date]);
            });
        }

        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        $transactions = $query->paginate(10)->appends(request()->query());

        $income = Transaction::where('payment_status', 'paid')->sum('cash');
        $outcome = Transaction::where('payment_status', 'paid')->sum('cash_change');


        return view('dashboard.transactions.index', compact('title', 'transactions', 'income', 'outcome'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function print(Request $request, Transaction $transaction)
    {
        $title = "Print Transaction " . $transaction->invoice_number;

        return view('layouts.struk', compact('title', 'transaction'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function pdf(Request $request, Transaction $transaction)
    {
        $strukPath = Storage::disk('local')->path('/static/struk/' . $transaction->invoice_number . '.pdf');

        if (!file_exists($strukPath)) {
            $this->generateStrukPdf($transaction);
        }

        return response()->download($strukPath);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $title = "Detail Transaction";
        return view('dashboard.transactions.show', compact('title', 'transaction'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        Sweetalert::success('berhasil menghapus transaction dengan nomor invoice: ' . $transaction->invoice_number, 'Hapus Berhasil');
        return redirect()->route('dashboard.transactions.index');
    }

    public function streamStruk(string $invoice)
    {
        $transaction = Transaction::findByInvoice($invoice)->first();
        $strukPath = Storage::disk('local')->path('/static/struk/' . $transaction->invoice_number . '.pdf');

        if (!$transaction || !file_exists($strukPath)) {
            return abort(404);
        }

        return response()->file($strukPath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $transaction->invoice_number . '.pdf"'
        ]);
    }

    public function updateStatusPayment(Request $request, Transaction $transaction)
    {
        $request->validate([
            'payment_status' => 'required|in:unpaid,pending,paid'
        ]);

        $transaction->update([
            'payment_status' => $request->payment_status
        ]);

        Sweetalert::success('berhasil mengubah status pembayaran', 'Update Status Pembayaran');
        return redirect()->route('dashboard.transactions.show', $transaction);
    }
}
