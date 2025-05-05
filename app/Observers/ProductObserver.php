<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function creating(Product $product)
    {
        $product->estimasi_keuntungan = $product->price * $product->stock;

        if (empty($product->barcode)) {
            $product->barcode = self::generateBarcode();
        }
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

    private static function generateBarcode()
    {
        do {
            $barcode = str_pad(mt_rand(0, 9999999999999), 13, '0', STR_PAD_LEFT);
        } while (Product::where('barcode', $barcode)->exists());

        return $barcode;
    }
}
