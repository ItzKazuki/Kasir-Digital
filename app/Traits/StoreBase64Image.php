<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait StoreBase64Image
{
    public function storeBase64Image($filePath, $base64Image)
    {
        // convert base64 image to file
        $imageData = $base64Image;
        $imageData = str_replace('data:image/png;base64,', '', $imageData);
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageData = base64_decode($imageData);

        // upload image products
        Storage::put($filePath, $imageData);
    }
}
