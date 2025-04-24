<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

trait StoreBase64Image
{
    public function storeBase64Image($filePath, $base64Image)
    {
        try {
            // convert base64 image to file
            $imageData = $base64Image;
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $imageData = base64_decode($imageData);

            // upload image products
            Storage::put($filePath, $imageData);
        } catch (\Exception $e) {
            // Log error to laravel.log
            Log::error('Failed to upload base64 image: ' . $e->getMessage(), [
                'filePath' => $filePath,
                'base64Image' => substr($base64Image, 0, 50) . '...', // Log sebagian base64 untuk keamanan
            ]);

            // Optionally, rethrow the exception if needed
            throw $e;
        }
    }
}
