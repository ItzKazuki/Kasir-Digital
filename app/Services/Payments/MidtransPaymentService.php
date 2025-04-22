<?php

namespace App\Services\Payments;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MidtransPaymentService implements PaymentGatewayInterface
{
    public function createTransaction(array $data)
    {
        // Implement Midtrans logic here
        $res = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->withBasicAuth(config('payment.midtrans.server_key'), '')
        ->post('https://api.sandbox.midtrans.com/v2/charge', [
            'payment_type' => 'gopay',
            'transaction_details' => [
                'order_id' => $data['transaction_id'],
                'gross_amount' => $data['total_price'],
            ]
        ]);

        if($res->status() !== 200) {
            throw new \Exception('Failed to create transaction: ' . $res->body(), $res->status());
        }

        $response = $res->json();

        return [
            'status_code' => $response['status_code'] ?? null,
            'order_id' => $response['order_id'] ?? null,
            'merchant_id' => $response['merchant_id'] ?? null,
            'payment_type' => $response['payment_type'] ?? null,
            'transaction_status' => $response['transaction_status'] ?? null,
            'fraud_status' => $response['fraud_status'] ?? null,
            'actions_url' => $response['actions'][0]['url'] ?? null,
            'expiry_time' => $response['expiry_time'] ?? null,
            'gross_amount' => $response['gross_amount'] ?? null,
        ];

    }

    public function checkPaymentStatus($orderId)
    {
        // Implement Midtrans logic here
        $res = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->withBasicAuth(config('payment.midtrans.server_key'), '')
        ->get('https://api.sandbox.midtrans.com/v2/' . $orderId . '/status');

        if($res->status() !== 200) {
            throw new \Exception('Failed to check payment status: ' . $res->body(), $res->status());
        }

        return $res->json();
    }

    public function handleCallback(Request $request)
    {
        $signature = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . config('payment.midtrans.server_key') );

        if ($signature !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 400);
        }

        $transaction = Transaction::where('order_id', $request->order_id)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->payment_status = $request->transaction_status == 'settlement' ? 'paid' : 'unpaid';
        $transaction->save();

        return response()->json(['message' => 'Transaction updated successfully'], 200);
    }
}
