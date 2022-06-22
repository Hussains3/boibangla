<?php


namespace App\Services;

use App\Models\Order;
use App\Models\OrderProcessing;

class TrackingService
{
    /**
     * This function is service to get order tracking details
     * @param $orderNo
     * @return collection
     */
    public static function trackOrder($orderNo)
    {
        $orderId = Order::select('id')->whereOrderNo($orderNo)->value('id');
        return OrderProcessing::whereOrderId($orderId)->get();
    }
}
