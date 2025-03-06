<?php

namespace App\Traits;

use App\Models\Transaction;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Enums\Orientation;

trait GenerateStrukPdf
{
    public function generateStrukPdf(Transaction $transaction)
    {
        $height = 150;

        if ($transaction->order->orderDetails()->count() > 1) {
            $height = $height + ($transaction->order->orderDetails()->count() * 5);
        }

        Pdf::view('dashboard.transactions.struk', compact('transaction'))
            ->withBrowsershot(function (Browsershot $browsershot) {
                $browsershot
                    ->noSandbox()
                    ->setNodeBinary(config('app.node.path'))
                    ->setNpmBinary(config('app.node.npm'));
            })
            ->disk('local')
            ->orientation(Orientation::Portrait)
            ->paperSize(96, $height, 'mm')
            ->save('/static/struk/' . $transaction->invoice_number . '.pdf');
    }
}
