<?php

namespace App\Services\Payments;

use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    public function createTransaction(array $data);
    public function handleCallback(Request $request);
    public function checkPaymentStatus(int $orderId);
}
