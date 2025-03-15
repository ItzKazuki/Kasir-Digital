<?php

namespace App\Http\Controllers\Kasir;

use App\Models\Member;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Traits\GenerateStrukPdf;
use App\Jobs\GenerateStrukPdfJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

        // get all transactions that belong to the authenticated user
        $query->whereHas('order', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        });

        if ($request->start_date && $request->end_date) {
            $query->whereHas('order', function ($q) use ($request) {
                $q->whereBetween('order_date', [$request->start_date, $request->end_date]);
            });
        } else {
            // urutkan data $query berdasarkan asc dari order_date
            $query->join('orders', 'transactions.order_id', '=', 'orders.id')
                ->orderBy('orders.order_date', 'DESC');
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
     * Search member by phone number.
     */
    public function searchMember(Request $request)
    {
        $member = Member::where('no_telp', $request->phone)->first();

        return response()->json($member);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Mulai DB transaction
        DB::beginTransaction();

        try {
            // Ambil item-item cart
            $itemCart = \Cart::getContent();

            $orderData = [
                'order_date' => now(),
            ];

            if ($request->no_telp_member) {
                $member = Member::where('no_telp', $request->no_telp_member)->first();

                if ($member) {
                    $orderData['member_id'] = $member->id;
                }
            }

            // Buat order baru
            $order = $request->user()->orders()->create($orderData);

            // Buat orderItems berdasarkan item cart
            foreach ($itemCart as $item) {
                $product = Product::find($item->id);

                // Cek apakah quantity orderItem lebih besar dari stock produk
                if ($product->stock < $item->quantity) {
                    // Rollback transaksi jika quantity lebih besar dari stock
                    DB::rollBack();
                    return response()->json([
                        'message' => 'Transaction failed, product stock is insufficient'
                    ], 400);
                }

                $order->orderDetails()->create([
                    'product_id' => $item->id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total_price' => $item->price * $item->quantity
                ]);

                // Kurangi stock produk
                $product->stock -= $item->quantity;
                $product->save();
            }

            $order->total_price = $order->orderDetails->sum('total_price');
            $order->save();

            $transactionData = [
                'cash' => $request->cash ?? 0,
                'payment_status' => $request->metode_pembayaran == "cash" ? 'paid' : 'pending',
                'payment_method' => $request->metode_pembayaran,
                'total_price' => $order->total_price,
            ];

            if($request->cash) {
                $transactionData['cash_change'] = $request->cash - $order->total_price;
            }

            if ($request->use_point && $request->use_point == true) {
                if (isset($member) && $member->point > 0) {
                    $pointsToUse = min($member->point, $order->total_price);

                    $transactionData['cash_change'] = $request->cash - ($order->total_price - $pointsToUse);
                    
                    $transactionData['point_usage'] = $pointsToUse;
                    $member->point -= $pointsToUse;
                    $member->save();
                } else {
                    return response()->json([
                        'message' => 'Transaction failed, member has insufficient points'
                    ], 400);
                }
            }

            // Buat transaksi
            $transaction = $order->transaction()->create($transactionData);

            // Generate struk PDF
            GenerateStrukPdfJob::dispatch($transaction);

            // $order->member->notify(new TransactionCreatedNotification($transaction, $order->member));

            // Hapus item cart
            \Cart::clear();

            // Commit DB transaction
            DB::commit();

            return response()->json([
                'message' => 'Transaction success',
                'redirect' => route('dashboard.transactions.show', $transaction->id)
            ]);
        } catch (\Exception $e) {
            // Rollback DB transaction jika terjadi error
            DB::rollBack();
            return response()->json([
                'message' => 'Transaction failed',
                'error' => $e->getMessage()
            ], 500);
        }
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
