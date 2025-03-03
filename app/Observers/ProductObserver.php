<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function creating(Product $product)
    {
        $product->estimasi_keuntungan = $product->price * $product->stock;
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
