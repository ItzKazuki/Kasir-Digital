<?php

namespace App\Observers;

use App\Models\Transaction;

class TransactionObserver
{
     /**
     * Handle the Transaction "created" event.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return void
     */
    public function created(Transaction $transaction)
    {
        $orderDetails = $transaction->order->orderDetails;
        $member = $transaction->member;

        if ($member && $member->status === 'inactive') {
            $member->status = 'active';
            $member->save();
        }

        foreach ($orderDetails as $orderDetail) {
            $product = $orderDetail->product;
            $product->stock -= $orderDetail->quantity;
            $product->save();
        }
    }
    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        //
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        //
    }
}
