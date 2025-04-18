<?php

namespace App\Http\Controllers\Kasir;

use Exception;
use App\Models\Member;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Traits\GenerateStrukPdf;
use App\Jobs\GenerateStrukPdfJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Services\Payments\PaymentGatewayInterface;
use App\Notifications\TransactionCreatedNotification;

class TransactionController extends Controller
{
    use GenerateStrukPdf;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Transactions";

        // get all transactions that belong to the authenticated user
        // $query->where('orders.user_id', $request->user()->id);
        $query = Transaction::with('order')->whereHas('order', function ($q) use ($request) {
            $q->where('user_id', $request->user()->id);
        });


        if ($request->start_date && $request->end_date) {
            $query->whereHas('order', function ($q) use ($request) {
                $q->whereBetween('order_date', [$request->start_date, $request->end_date]);
            });
        }
         else {
            // urutkan data $query berdasarkan asc dari order_date
            $query->join('orders', 'transactions.order_id', '=', 'orders.id')
                ->select('transactions.*', 'orders.order_date') // Pastikan memilih kolom yang dibutuhkan
                ->orderBy('orders.order_date', 'DESC')
                ->orderBy('transactions.id', 'DESC');
        }

        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        $transactions = $query->paginate(10)->appends(request()->query());

        $income = (clone $query)->where('payment_status', 'paid')->sum('cash');
        $outcome = (clone $query)->where('payment_status', 'paid')->sum('cash_change');

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
    public function store(Request $request, PaymentGatewayInterface $paymentService)
    {
        // Mulai DB transaction
        DB::beginTransaction();

        try {
            // Ambil item-item cart
            $itemCart = \Cart::getContent();

            $discount_total = 0;

            if ($request->no_telp_member) {
                $member = Member::where('no_telp', $request->no_telp_member)->first();
            }

            // Buat order baru
            $order = $request->user()->orders()->create([
                'order_date' => now(),
            ]);

            // Buat orderItems berdasarkan item cart
            foreach ($itemCart as $item) {
                $product = Product::find($item->id);

                if($product->discount) {
                    $discount_total += $item->quantity * ($product->discount->type == 'fixed' ? $product->discount->value : ($product->price * $product->discount->value) / 100);
                }

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
                'discount_total' => $discount_total
            ];

            if($request->metode_pembayaran == "qris") {
                // use data to generate qris at midtrans

                $midtrans = $paymentService->createTransaction([
                    'transaction_id' => $order->id,
                    'total_price' => $order->total_price,
                ]);

                $transactionData['payment_type'] = $midtrans['payment_type'];
                $transactionData['payment_url'] = $midtrans['actions_url'];
                $transactionData['cash'] = $midtrans['gross_amount'];
            }

            if ($request->cash) {
                $transactionData['cash_change'] = $request->cash - $order->total_price;
            }

            if(isset($member)) {
                $transactionData['member_id'] = $member->id;
                $additionalPoints = 0;

                if ($order->total_price > 200000) {
                    $additionalPoints = $order->total_price * 0.045;
                    $member->point += $additionalPoints;
                    $member->save();
                } elseif ($order->total_price > 100000) {
                    $additionalPoints = $order->total_price * 0.035;
                    $member->point += $additionalPoints;
                    $member->save();
                } elseif ($order->total_price > 50000) {
                    $additionalPoints = $order->total_price * 0.02;
                    $member->point += $additionalPoints;
                    $member->save();
                } elseif ($order->total_price > 25000) {
                    $additionalPoints = $order->total_price * 0.01;
                    $member->point += $additionalPoints;
                    $member->save();
                }

                if ($request->use_point && $request->use_point == true) {
                    $pointsToUse = min($member->point, $order->total_price);
                    $remainingPrice = $order->total_price - $pointsToUse;

                    if($member->point == 0 && $request->cash < $remainingPrice) {
                        throw new Exception("Transaction failed, insufficient points or cash", 400);
                    }

                    $transactionData['cash_change'] = $request->cash - ($order->total_price - $pointsToUse);
                    $transactionData['point_usage'] = $pointsToUse;
                    $member->point -= $pointsToUse;
                    $member->save();
                }
            }

            // Buat transaksi
            $transaction = $order->transaction()->create($transactionData);

            // Generate struk PDF
            // GenerateStrukPdfJob::dispatch($transaction);
            $this->generateStrukPdf($transaction);

            if (isset($member)) {
                Notification::route('mail', $member->email)->notify(new TransactionCreatedNotification($transaction, $member, $additionalPoints));
            }

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
                'error' => 'Transaction failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function callback(Request $request, PaymentGatewayInterface $paymentService)
    {
        try {
            return $paymentService->handleCallback($request);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Transaction failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
