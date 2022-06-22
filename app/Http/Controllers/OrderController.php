<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderBook;
use Illuminate\Support\Facades\Auth;
use App\Models\Review;
use App\Models\OrderProcessing;
use App\Models\Discount;
use Symfony\Component\HttpFoundation\Request;
use App\Helper\Helper;
use App\Helper\ResponseHelper;

class OrderController extends Controller
{


    /**
     * This function loads the page to load the orders
     * @return view
     */
    public function index()
    {
        return view('dashboard.orders.orders');
    }


    /**
     * This function loads the page to load the orders
     * @return view
     */
    public function bydate()
    {
        return view('dashboard.orders.ordersbydate');
    }


    public function mail()
    {
        return view('emails.customer.order-marked');
    }

    /**
     * This function returns the list of orders
     * @param Request $request
     * @return json
     * @throws \Exception
     */
    public function getOrdersList(Request $request)
    {
        $orders = Order::getOrdersList($request);
        return datatables($orders)->addIndexColumn()->make(true);
    }

    /**
     * This function returns the list of orders
     * @param Request $request
     * @return json
     * @throws \Exception
     */
    public function getOrdersListDay(Request $request)
    {
        $orders = Order::getOrdersListDay($request);
        return datatables($orders)->addIndexColumn()->make(true);
    }







    /**
     * This function markes the order is valid and confirms it
     * @param Request $request
     * @return json
     */
    public function confirmOrder(Request $request)
    {
        $confirm = Order::confirmOrder($request->orderId,$request->remark);
        if ($confirm){
            Helper::orderProcessingNotify($request->orderId);
            Helper::sendOrderProcessedMail($request->orderId);
            $response = response()->json(['status'=>'success','message'=>'Order confirmed successfully']);
        }else{
            $response = response()->json(['status'=>'error','message'=>'Some Error']);
        }
        return $response;
    }

    /**
     * This function markes the order is processing
     * @param Request $request
     * @return json
     */
    public function markProcessing(Request $request)
    {
        $deliver = Order::markProcessing($request->orderId,$request->remark);
        if ($deliver){
            Helper::orderProcessingNotify($request->orderId);
            Helper::sendOrderProcessedMail($request->orderId);
            $response = response()->json(['status'=>'success','message'=>'Order marked to processing successfully']);
        }else{
            $response = response()->json(['status'=>'error','message'=>'Some Error']);
        }
        return $response;
    }
    /**
     * This function markes the order is delivered
     * @param Request $request
     * @return json
     */
    public function markShipped(Request $request)
    {
        $deliver = Order::markShipped($request->orderId,$request->remark);
        if ($deliver){
            Helper::orderProcessingNotify($request->orderId);
            Helper::sendOrderProcessedMail($request->orderId);
            $response = response()->json(['status'=>'success','message'=>'Order marked to shipped successfully']);
        }else{
            $response = response()->json(['status'=>'error','message'=>'Some Error']);
        }
        return $response;
    }

    /**
     * This function markes the order is delivered
     * @param Request $request
     * @return json
     */
    public function markDelivered(Request $request)
    {
        $deliver = Order::markDelivered($request->orderId,$request->remark);
        if ($deliver){
            Helper::orderProcessingNotify($request->orderId);
            Helper::sendOrderProcessedMail($request->orderId);
            $response = response()->json(['status'=>'success','message'=>'Order marked to delivered successfully']);
        }else{
            $response = response()->json(['status'=>'error','message'=>'Some Error']);
        }
        return $response;
    }

    /**
     * This function cancels the order
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cancelOrder(Request $request)
    {
        try {
            $deliver = Order::cancelOrder($request->orderId, $request->remark);
            if ($deliver){
                Helper::orderProcessingNotify($request->orderId);
                Helper::sendOrderProcessedMail($request->orderId);
                $response = ResponseHelper::successResponse('Order marked to canceled successfully');
            }else{
                $response = ResponseHelper::errorResponse('Some error occurred');
            }
        }catch (\Exception $exception) {
            $response = ResponseHelper::errorResponse('Some error occurred' . $exception->getMessage());
        }
        return $response;
    }

    /**
     * This function shows the order detail for a order
     * @param $orderId
     * @return view
     */
    public function getOrderDetail($orderId)
    {
        $discountsArr = [];
        $totalDiscountPer = 0.0;
        $totalDiscountAmount = 0.0;
        $bookSubTotal = 0.0;
        $order = Order::getOrderDetail($orderId,'');
        $orderDetail = OrderBook::getOrderBookDetail($orderId,'');
        if ($order) {
            $deliveryChargeAmount = ($order->delivery_charge?$order->delivery_charge:0);
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
            foreach ($orderDetail as $book){
                $bookSubTotal = $bookSubTotal+$book->price * $book->quantity;
            }
            /**
             * Calculate the final total payment amount
             */
            if ($order->discounts) {
                $totalDiscountAmount = $bookSubTotal * $totalDiscountPer / 100;
                $totalPaymentAmount = ($bookSubTotal - $totalDiscountAmount) + $deliveryChargeAmount;
            }else{
                $totalPaymentAmount = $bookSubTotal + $totalDiscountAmount + $deliveryChargeAmount;
            }
            return view('dashboard.orders.order-detail', [
                'order' => $order,
                'orderDetail' => $orderDetail,
                'discounts' => $discountsArr,
                'totalPaymentAmount' => $totalPaymentAmount,
                'deliveryChargeAmount' =>$deliveryChargeAmount,
                'totalDiscountAmount' => $totalDiscountAmount,
                'totalDiscountPer' => $totalDiscountPer,
                'bookSubTotal' =>$bookSubTotal,
            ]);
        }else{
            abort(404);
        }
    }

    // --------------------------------------------------------- v costomer section

    /**
     * This function returns the order details and shows in a view
     * @param $orderId
     * @return View
     */
    public function getMyOrderDetail($orderId)
    {
        $userId = Auth::id();
        $discountsArr = [];
        $totalDiscountPer = 0.0;
        $totalDiscountAmount = 0.0;
        $order = Order::getOrderDetail($orderId,$userId);
        $orderDeliveryDate = OrderProcessing::getDeliveredDate($orderId);
        $orderDetail = OrderBook::getOrderBookDetail($orderId,$userId);
        $orderProcessing = OrderProcessing::getOrderProcessing($orderId);
        $myRatedBooks = Review::getMyRatedBooks($orderId);
        $bookSubTotal = 0.0;
        if ($order) {
            $deliveryChargeAmount = ($order->delivery_charge?$order->delivery_charge:0);
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
            foreach ($orderDetail as $book){
                $bookSubTotal = $bookSubTotal+$book->price * $book->quantity;
            }
            /**
                * Calculate the final total payment amount
                */
            if ($order->discounts) {
                $totalDiscountAmount = $bookSubTotal * $totalDiscountPer / 100;
                $totalPaymentAmount = ($bookSubTotal - $totalDiscountAmount) + $deliveryChargeAmount;
            }else{
                $totalPaymentAmount = $bookSubTotal + $totalDiscountAmount + $deliveryChargeAmount;
            }
            return view('orders.order-detail', [
                'order' => $order,
                'orderDetail' => $orderDetail,
                'discounts' => $discountsArr,
                'totalPaymentAmount' => $totalPaymentAmount,
                'deliveryChargeAmount' =>$deliveryChargeAmount,
                'totalDiscountAmount' => $totalDiscountAmount,
                'totalDiscountPer' => $totalDiscountPer,
                'orderProcessing' => $orderProcessing,
                'orderDeliveryDate' => $orderDeliveryDate,
                'myRatedBooks' => $myRatedBooks,
                'bookSubTotal' =>$bookSubTotal,
            ]);
        }
        abort(404);
    }

    /**
     * This functionn prints/downloads the order invoice
     * @param $orderId
     * @return \View
     */
    public function downloadInvoice($orderId)
    {

        $userId = Auth::id();
        $order = Order::getOrderDetail($orderId,$userId);
        $orderDetail = OrderBook::getOrderBookDetail($orderId,$userId);
        $totalDiscountPer = 0.0;
        $totalDiscountAmount = 0.0;
        $discountsArr = [];
        if ($order) {
            if ($order->discounts) {
                $discountsArr = explode(',', $order->discounts);
                foreach ($discountsArr as $discount) {
                    $discount = Discount::select('discount')->where('coupon_name', $discount)->value('discount');
                    $totalDiscountPer = $totalDiscountPer + $discount;
                }
                $totalDiscountAmount = $totalDiscountPer * 100;
            }
            $totalPaymentAmount = $order->payment_amount;

        /*   $pdf = \PDF::loadView('customer.orders.order-invoice', ['order' => $order, 'orderDetail' => $orderDetail,
                'discounts' => $discountsArr, 'totalPaymentAmount' => $totalPaymentAmount,
                'totalDiscountAmount' => $totalDiscountAmount, 'totalDiscountPer' => $totalDiscountPer]);
            return $pdf->download('posts2.pdf');*/

            return view('orders.order-invoice', ['order' => $order, 'orderDetail' => $orderDetail,
                'discounts' => $discountsArr, 'totalPaymentAmount' => $totalPaymentAmount,
                'totalDiscountAmount' => $totalDiscountAmount, 'totalDiscountPer' => $totalDiscountPer]);
        }
            abort(404);

    }
}
