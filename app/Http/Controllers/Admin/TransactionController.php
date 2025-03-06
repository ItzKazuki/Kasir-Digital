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
    public function index()
    {
        $title = "Transactions";
        $transactions = Transaction::with('order.member')->paginate(10);
        return view('dashboard.transactions.index', compact('title', 'transactions'));
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
}
