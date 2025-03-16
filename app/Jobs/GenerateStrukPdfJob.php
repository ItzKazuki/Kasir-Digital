<?php

namespace App\Jobs;

use App\Models\Transaction;
use App\Traits\GenerateStrukPdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GenerateStrukPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, GenerateStrukPdf;

    protected $transaction;

    /**
     * Create a new job instance.
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $this->generateStrukPdf($this->transaction);
        } catch (\Exception $e) {
            Log::error('Failed to generate struk PDF: ' . $e->getMessage());
        }
    }
}
