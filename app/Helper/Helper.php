<?php
namespace App\Helper;
use App\Mail\OrderProcessed;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderBook;
use App\Models\WalletRequest;
use App\Services\NotificationService;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class Helper
{
    /**
     * This function sends when an order is processed : placed,confirmed and delivered
     * @param $orderId
     */
    public static function sendOrderProcessedMail($orderId)
    {
        $discountsArr = [];
        $totalDiscountPer = 0.0;
        $totalDiscountAmount = 0.0;
        $bookSubTotal = 0.0;
        $order = Order::getOrderDetail($orderId,'');
        $orderDetail = OrderBook::getOrderBookDetail($orderId,'');
        /*if ($order->discounts) {
            $discountsArr = explode(',', $order->discounts);
            if ($discountsArr){
                foreach ($discountsArr as $discount) {
                    $discount = Discount::select('discount')->where('coupon_name', $discount)->value('discount');
                    $totalDiscountPer = $totalDiscountPer + $discount;
                }
            }
            $totalDiscountAmount = $totalDiscountPer * 100;
        }
        $totalPaymentAmount = $order->payment_amount;*/
        if ($order) {
            $deliveryChargeAmount = ($order->delivery_charge ? $order->delivery_charge : 0);
            /**
             * Get the total discount %
             */
            if ($order->discounts) {
                $discountsArr = explode(',', $order->discounts);
                foreach ($discountsArr as $discount) {
                    $discount = Discount::select('discount')->where('coupon_name', $discount)->value('discount');
                    $totalDiscountPer = $totalDiscountPer + $discount;
                }
            }
            /**
             * Get the sub total sum of price of all books ordered
             */
            foreach ($orderDetail as $book) {
                $bookSubTotal = $bookSubTotal + $book->price * $book->quantity;
            }
            /**
             * Calculate the final total payment amount
             */
            if ($order->discounts) {
                $totalDiscountAmount = $bookSubTotal * $totalDiscountPer / 100;
                $totalPaymentAmount = ($bookSubTotal - $totalDiscountAmount) + $deliveryChargeAmount;
            } else {
                $totalPaymentAmount = $bookSubTotal + $totalDiscountAmount + $deliveryChargeAmount;
            }
            try {
                Mail::to($order->customer_email)
                    ->send(new OrderProcessed(
                    $order,
                    $orderDetail,
                    $discountsArr,
                    $totalPaymentAmount,
                    $totalDiscountAmount,
                    $totalDiscountPer,
                    $bookSubTotal,
                    $deliveryChargeAmount,
                ));
            } catch (\Exception $exception) {}
            return true;
        }
    }


    /**
     * This function returns the array of icon libraries
     * @return array
     */
    public static function iconLibrary()
    {
        return [
          ["icon_class" => "linearicons-dinner","icon_text" => "Dinner"],
          ["icon_class" => "linearicons-leaf","icon_text" => "Leaf"],
          ["icon_class" => "linearicons-pointer-right","icon_text" => "Pointer"],
          ["icon_class" => "linearicons-headphones","icon_text" => "Headphones"],
          ["icon_class" => "linearicons-cart-full","icon_text" => "Shopping Cart"],
          ["icon_class" => "flaticon-necklace","icon_text" => "Neckless"],
		  ["icon_class" => "icon-earphones","icon_text" => "Earphone"],
          ["icon_class" => "icon-heart","icon_text" => "Heart"],
          ["icon_class" => "icon-music-tone","icon_text" => "Music"],
          ["icon_class" => "icon-umbrella","icon_text" => "Umbrella"],
          ["icon_class" => "icon-trophy","icon_text" => "Trophy"],
          ["icon_class" => "icon-microphone","icon_text" => "Microphone"],
          ["icon_class" => "icon-social-youtube","icon_text" => "YouTube"],
          ["icon_class" => "ti ti-headphone-alt","icon_text" => "Headphones"],
          ["icon_class" => "ti ti-money","icon_text" => "Money"],
          ["icon_class" => "ti ti-shopping-cart","icon_text" => "Shopping Cart"],
          ["icon_class" => "ti ti-shopping-cart-full","icon_text" => "Shopping Cart"],
          ["icon_class" => "ti ti-star","icon_text" => "Star"],
          ["icon_class" => "ti ti-power-off","icon_text" => "Power Off"],
          ["icon_class" => "ti ti-book","icon_text" => "Book"],
          ["icon_class" => "ti ti-music","icon_text" => "Music"],
          ["icon_class" => "ti ti-cup","icon_text" => "Cup"],
          ["icon_class" => "ti ti-music-alt","icon_text" => "Music"],
          ["icon_class" => "ti ti-gift","icon_text" => "Gift"],
          ["icon_class" => "ti ti-crown","icon_text" => "Crown"],
          ["icon_class" => "ti ti-game","icon_text" => "Games"],
          ["icon_class" => "ti ti-video-clapper","icon_text" => "Video"],
          ["icon_class" => "ti ti-alarm-clock","icon_text" => "Alarm"],
          ["icon_class" => "ti ti-headphone","icon_text" => "Headphones"],
          ["icon_class" => "ti ti-medall","icon_text" => "Medalls"],
          ["icon_class" => "ti ti-palette","icon_text" => "Paintings"],
        ];
    }
    public static function generateToken()
    {
        $token =  sha1(time());
        if (User::where('remember_token',$token)->exists()){
            self::generateToken();
        }
        return $token;
    }

    /**
     * This is a helper function to just format the digits
     * @param $number
     * @return string
     */
    public static function formatTheNumber($number)
    {
        return number_format($number,2);
    }
    /**
     * This function generates unique wallet request id
     * @scope local
     * @return string
     */
    public static function generateWalletRequestId()
    {
        $random = substr(mt_rand(),0,5);
        $orderNumber = 'WLR'.$random;
        $orderNumberFound = WalletRequest::select('id')->where('request_id',$orderNumber)->exists();
        if ($orderNumberFound){
            self::generateWalletRequestId();
        }
        return $orderNumber;
    }

    /**
     * This function sends order processing notification to users
     * @param $orderId
     * @return bool
     * @throws \Pusher\PusherException
     */
    public static function orderProcessingNotify($orderId)
    {
        $order = Order::findOrFail($orderId);
        if ($order->status == Order::ORDER_PLCAED){
            $action = 'placed';
        }else if ($order->status == Order::CONFIRMED){
            $action = 'confirmed';
        }else if ($order->status == Order::PROCESSING){
            $action = 'processing';
        }else if ($order->status == Order::SHIPPED){
            $action = 'shipped';
        }else if ($order->status == Order::CANCELED){
            $action = 'canceled';
        }else{
            $action = 'delivered';
        }
        $message = "Your order #$order->order_no has been $action";
        $customer = User::where('id',$order->user_id)->first();
        return NotificationService::sendNotification($customer,$message);
    }

    /**
     * This function sends the notification to user
     * @param $userId
     * @param $message
     * @return bool
     * @throws \Pusher\PusherException
     */
    public static function sendNotificationToUser($userId,$message)
    {
        $user = User::where('id',$userId)->first();
        return NotificationService::sendNotification($user,$message);
    }
}
