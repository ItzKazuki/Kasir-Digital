<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Wavey\Sweetalert\Sweetalert;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Transactions";
        $transactions = Transaction::all();
        return view('dashboard.transactions.index', compact('title', 'transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function print(Request $request, Transaction $transaction)
    {
        $title = "Print Transaction " . $transaction->invoice_number;

        // dd($transaction->cash);
        return view('dashboard.transactions.struk', compact('title', 'transaction'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function pdf(Request $request, Transaction $transaction)
    {
        //
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

    public function search(Request $request, string $invoice)
    {
        $transaction = Transaction::findByInvoice($invoice)->first();

        if (!$transaction) {
            return abort(404);
        }

        $title = "Print Transaction " . $transaction->invoice_number;
        return view('dashboard.transactions.struk', compact('title', 'transaction'));
    }
}
