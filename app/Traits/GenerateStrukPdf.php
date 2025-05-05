<?php

namespace App\Traits;

use App\Models\Transaction;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Log;
use Spatie\Browsershot\Browsershot;
use Spatie\LaravelPdf\Enums\Orientation;

trait GenerateStrukPdf
{
    public function generateStrukPdf(Transaction $transaction)
    {
        if (config('app.generate_pdf') && config('app.node.path') && config('app.node.npm')) {
            $height = 170;

            // check if npm and node is executable
            if (!is_executable(config('app.node.path')) || !is_executable(config('app.node.npm'))) {
                // send log to laravel
                Log::error('Node or NPM is not executable', [
                    'node_path' => config('app.node.path'),
                    'npm_path' => config('app.node.npm'),
                ]);
                
                return;
            }

            if ($transaction->order->orderDetails()->count() > 1) {
                $height = $height + ($transaction->order->orderDetails()->count() * 5);
            }

            Pdf::view('layouts.struk', compact('transaction'))
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
}
