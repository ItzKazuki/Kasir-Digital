<?php

namespace App\Observers;

use App\Models\OrderDetail;

class OrderDetailObserver
{
    // Saat order detail dibuat, diperbarui, atau dihapus
    public function updateOrderTotalItems(OrderDetail $orderDetail)
    {
        $order = $orderDetail->order;
        if ($order) {
            $order->total_items = $order->orderDetails()->sum('quantity');
            $order->total_price = $order->orderDetails()->sum('total_price');
            $order->saveQuietly(); // Hindari infinite loop
        }
    }

    public function created(OrderDetail $orderDetail)
    {
        $this->updateOrderTotalItems($orderDetail);
    }

    public function updated(OrderDetail $orderDetail)
    {
        $this->updateOrderTotalItems($orderDetail);
    }

    public function deleted(OrderDetail $orderDetail)
    {
        $this->updateOrderTotalItems($orderDetail);
    }
}
