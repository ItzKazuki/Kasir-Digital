<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Transactions";

        $query = Transaction::with('order.member');

        // get all transactions that belong to the authenticated user
        $query->whereHas('order', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        });

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
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // buat transaksi baru di sini, yang pertama pasti ambi item item cart nya
        $itemCart = \Cart::getContent();

        // buat order baru
        $order = $request->user()->orders()->create([
            'order_date' => now(),
            'status' => 'unpaid'
        ]);

        // buat orderItems berdasarkan item cart
        foreach ($itemCart as $item) {
            $order->orderDetails()->create([
                'product_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'total_price' => $item->price * $item->quantity
            ]);
        }

        $order->total_price = $order->orderDetails->sum('total_price');
        $order->save();

        // buat transaksi
        $transaction = $order->transaction()->create([
            'cash' => $request->cash,
            'payment_status' => 'paid',
            'payment_method' => 'cash',
            'total_price' => $order->total_price
        ]);

        // hapus item cart
        \Cart::clear();

        return response()->json([
            'message' => 'Transaction success',
            'redirect' => route('dashboard.transactions.show', $transaction->id)
        ]);
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
