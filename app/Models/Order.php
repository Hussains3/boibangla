<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helper\Helper;
use App\Models\Setting;
use Barryvdh\Debugbar\Facades\Debugbar;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
class Order extends Model
{
    use HasFactory;

    const ORDER_PLCAED = 1;
    const CONFIRMED = 2;
    const PROCESSING = 3;
    const SHIPPED = 4;
    const DELIVERED = 5;
    const CANCELED = 6;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','order_no','customer_address_id','payment_method','payment_amount',
        'delivery_charge', 'additional_info','discounts','status','shurjopay_id',
    ];

    /**
     * The attributes that aren't mass assignable.
     * @var array
     */
    protected $guarded = ['created_at','updated_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['updated_at'];

    /**
     * fields will be Carbon-ized
     * @var array
     */
    protected $dates = ['created_at','updated_at'];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
        'order_no' => 'string',
        'customer_address_id' => 'int',
        'payment_method' => 'int',
        'payment_amount' => 'decimal:2',
        'delivery_charge' => 'decimal:2',
        'additional_info' => 'string',
        'discounts' => 'string',
        'status' => 'string',
        'shurjopay_id' => 'int',
    ];
    /**
     * Set the payment method type.
     *
     * @param  string  $value
     * @return void
     */
    public function setPaymentMethodAttribute($value){
        if ($value == 'spay'){
            $newValue = 0;
        }elseif ($value == 'wallet'){
            $newValue = 1;
        } else{
            $newValue = 2;
        }
        $this->attributes['payment_method'] = $newValue;
    }
    /**
     * Get the payment method type.
     *
     * @param  string  $value
     * @return string
     */
    public function getPaymentMethodAttribute($value)
    {
        if ($value == 1){
            $newValue = 'Wallet';
        }elseif ($value == 0){
            $newValue = 'spay';
        }else{
            $newValue = 'COD';
        }
        return $newValue;
    }
    /**
     * convert the order date timestamp for customer
     *
     * @param  string  $value
     * @return string
     */
    public function getOrderDateAttribute($value)
    {
        return date('d-m-Y h:i A',strtotime($value));
    }

    public function getPlacedDateAttribute($value)
    {
        return date("j,F  Y",strtotime($value));
    }

    public function getOrderStatusAttribute($value)
    {
        $orderStatus = '';
        if ($value == self::ORDER_PLCAED) {
            $orderStatus = 'Pending';
        }else if ($value == self::CONFIRMED) {
            $orderStatus = 'Confirmed';
        }else if ($value == self::DELIVERED) {
            $orderStatus = 'Delivered';
        }else if ($value == self::CANCELED) {
            $orderStatus = 'Canceled';
        }
        return $orderStatus;
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }


    /**
     * This function places order
     * @uses for customer
     * @param $checkoutRequest
     * @param $orderNumber
     * @param $conditions
     * @return collection
     */
    public static function placeOrder($checkoutRequest,$orderNumber,$conditions,$request)
    {
        $userId = Auth::id();
        $cartItems = \Cart::getContent();
        $cartAmount = \Cart::getTotal();
        $deliveryCharge = Setting::getDeliveryCharge();
        $paymentAmount =  round($cartAmount+$deliveryCharge);
        $orderPlaceDate = date('Y-m-d H:i:s');
        $checkoutData = [
            'order_no' => $orderNumber,
            'user_id' => $userId,
            'customer_address_id' => $checkoutRequest->address_option,
            'payment_method' => $checkoutRequest->payment_option,
            'payment_amount' => $paymentAmount,
            'delivery_charge' => $deliveryCharge,
            'additional_info' => $checkoutRequest->additional_info,
            'discounts' => $conditions,
        ];
        DB::beginTransaction();
        $order = self::create($checkoutData);
        foreach ($cartItems as $item){
            $orderedbook[] = [
              'order_id' => $order->id,
              'book_id' => $item->id,
              'quantity' => $item->quantity,
              'price' => $item->price,
            ];
        }
        $result =  OrderBook::insert($orderedbook);


        // Adding affiliation Items if affiliation available
        if ($request->cookie('bbaffiliator_id')) {
            $booksllug = $request->cookie('bbaffiliator_book');
            $affiliator = $request->cookie('bbaffiliator_id');
            $affiliation = Affiliation::where('affiliate_id',$affiliator)->first();
            $abook = Book::where('book_slug', $booksllug)->first();
            $afr = Setting::where('setting_name','=','affiliation_rate')->first();

            foreach ($cartItems as $item){
                if ($item->id == $abook->id) {
                    $newai = new AffiliationItem();
                    $newai->order_id = $order->id;
                    $newai->book_id = $abook->id;
                    $newai->ammount = $item->quantity*($item->price*($afr->setting_value/100));
                    $newai->user_id = Auth::user()->id;
                    $newai->affiliation_id = $affiliation->id;
                    $newai->status = 1;
                    $newai->save();
                }
            }
        }
        // Adding affiliation Items if affiliation available

        if ($checkoutRequest->payment_option == 'wallet'){
            self::deductFromWallet($userId,$paymentAmount);
        }
        OrderProcessing::create(['order_id'=>$order->id,
            'status'=> OrderProcessing::ORDER_PLCAED,
            'remark'=> OrderProcessing::DEFAULT_REMARK,
            'processing_date'=> $orderPlaceDate
        ]);
        Helper::orderProcessingNotify($order->id);
        DB::commit();
        return $result;
    }

    /**
     * This function updates new wallet ballance
     * @uses for customer
     * @param $userId
     * @param $cartAmount
     * @return collection
     */
    public static function deductFromWallet($userId,$cartAmount)
    {
        $currentWalletBalance = User::getCurrentWalletBalance($userId);
        $updatedBalance = $currentWalletBalance - $cartAmount;
        //RecentTransaction::create(['user_id'=>$userId,'amount'=>$cartAmount,'status'=>2]);
        return User::where('id',$userId)->update(['wallet_balance'=>$updatedBalance]);
    }

    /**
     * This function returns the order list
     * @uses for admin purpose
     * @param $request
     * @return collection
     */
    public static function getOrdersList($request)
    {
        $orderNumber = $request->order_number;
        $orderStatus = $request->order_status;
        return self::select('id','order_no','payment_method','payment_amount','discounts','status','created_at as order_date')
            ->when($orderNumber, function ($nameQuery) use ($orderNumber) {
                return $nameQuery->where('order_no', 'like',"%$orderNumber%");
            })
            ->when($orderStatus, function ($statusQuery) use ($orderStatus) {
                return $statusQuery->where('status',$orderStatus);
            })
            ->orderBy('id', 'DESC')
            ->get();
    }


    /**
     * This function returns the order list
     * @uses for admin purpose
     * @param $request
     * @return collection
     */
    public static function getOrdersListDay($request)
    {
        $from = $request->startdate;
        $to = $request->enddate;
        return self::select('id','order_no','payment_method','payment_amount','discounts','status','created_at as order_date')
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('id', 'DESC')
            ->get();
    }

    /**
     * This function returns the list of for a user
     * @uses for customer
     * @param $userId
     * @return collection
     */
    public static function getMyOrders($userId)
    {
        return self::select('id','order_no','payment_method','payment_amount','status','created_at as order_date')
            ->where('user_id',$userId)
            ->orderBy('id','DESC')
            ->paginate(10);
    }


    /**
     * This function confirms the order means it is valid
     * @param $orderId
     * @param $remark
     * @return collection
     * @uses for admin
     */
    public static function confirmOrder($orderId,$remark)
    {
        DB::beginTransaction();
        $processDate = date('Y-m-d H:i:s');
        self::where('id',$orderId)->update(['status'=> OrderProcessing::CONFIRMED]);
        $result = OrderProcessing::create(['order_id'=>$orderId,
            'status'=> OrderProcessing::CONFIRMED,
            'remark' => $remark,
            'processing_date'=>$processDate
        ]);
        DB::commit();
        return $result;
    }

    /**
     * This function markes the order to be processing
     * @param $orderId
     * @param $remark
     * @return collection
     * @uses for admin
     */
    public static function markProcessing($orderId,$remark)
    {
        DB::beginTransaction();
        $result =  self::where('id',$orderId)->update(['status'=> OrderProcessing::PROCESSING]);
        $processDate = date('Y-m-d H:i:s');
        OrderProcessing::create(['order_id'=>$orderId,
            'status'=> OrderProcessing::PROCESSING,
            'remark' => $remark,
            'processing_date'=>$processDate
        ]);
        DB::commit();
        return $result;
    }

    /**
     * This function markes the order to be Shipped
     * @param $orderId
     * @param $remark
     * @return collection
     * @uses for admin
     */
    public static function markShipped($orderId,$remark)
    {
        DB::beginTransaction();
        $result =  self::where('id',$orderId)->update(['status'=> OrderProcessing::SHIPPED]);
        $processDate = date('Y-m-d H:i:s');
        OrderProcessing::create(['order_id'=>$orderId,
            'status'=> OrderProcessing::SHIPPED,
            'remark' => $remark,
            'processing_date'=>$processDate
        ]);
        DB::commit();
        return $result;
    }

    /**
     * This function markes the order to be delivered
     * @param $orderId
     * @param $remark
     * @return collection
     * @uses for admin
     */
    public static function markDelivered($orderId,$remark)
    {
        DB::beginTransaction();
        $result =  self::where('id',$orderId)->update(['status'=> OrderProcessing::DELIVERED]);
        $processDate = date('Y-m-d H:i:s');
        OrderProcessing::create(['order_id'=>$orderId,
            'status'=> OrderProcessing::DELIVERED,
            'remark' => $remark,
            'processing_date'=>$processDate
        ]);
        DB::commit();
        return $result;
    }

    /**
     * This function cancels the order
     * @param $orderId
     * @param $remark
     * @return collection
     * @uses for admin
     */
    public static function cancelOrder($orderId, $remark)
    {
        DB::beginTransaction();
        $result =  self::where('id',$orderId)->update(['status'=> OrderProcessing::CANCELED]);
        $processDate = date('Y-m-d H:i:s');
        OrderProcessing::create(['order_id'=>$orderId,
            'status'=> OrderProcessing::CANCELED,
            'remark' => $remark,
            'processing_date' => $processDate
        ]);
        DB::commit();
        return $result;
    }

    /**
     * This function returns the complete detail of a customer order
     * @purpose : used to show the order detail in customer panel & sending mail
     * of order placed,confirmed and delivered
     * @param $orderId
     * @param $userId
     * @return collection
     */
    public static function getOrderDetail($orderId,$userId='')
    {
        return self::select('orders.id as order_id','orders.order_no','orders.payment_method','orders.payment_amount',
            'orders.additional_info','orders.discounts','orders.delivery_charge', 'orders.status as order_status','orders.status','orders.created_at as placed_date',
            'addresses.first_name','addresses.last_name','addresses.email',
            'addresses.contact','addresses.street_address','addresses.state',
            'addresses.town_city','addresses.postal_code','countries.name as country_name',
            'users.name','users.email as customer_email')
            ->join('addresses','orders.customer_address_id','addresses.id')
            ->leftJoin('countries','addresses.country','countries.id')
            ->join('users','orders.user_id','users.id')
            ->where(['orders.id'=>$orderId])
            /**
             * Apply user id, when using this from customer order detail
             */
            ->when($userId, function ($userQuery) use ($userId) {
                return $userQuery->where('orders.user_id',$userId);
            })
            ->first();
    }
    /**
     * This function just gives the order id against order number
     * @param $orderNo
     * @return collection
     */
    public static function getOrderIdByOrderNo($orderNo)
    {
        return self::select('id')->where('order_no',$orderNo)->value('id');
    }

    /**
     * This function returns the total count of orders placed by customer
     * @param $userId
     * @return int
     */
    public static function getMyTotalSpent($userId)
    {
        return self::where('user_id',$userId)
        ->where(function($query) {
            $query->where('status', self::CONFIRMED)
                ->orWhere('status', self::DELIVERED);
        })->sum('payment_amount');
    }
}
