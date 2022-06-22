<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Cart;
use App\Models\User;
use App\Helper\Helper;
use App\Models\OrderBook;
use App\Models\OrderProcessing;
use App\Models\Setting;

class AmarpayController extends Controller
{

    public function send(Request $request){

        $address = Address::where('id',$request->addressId)->first();

        if (!$address) {
            return back();
        }



        $url = 'https://sandbox.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
            $fields = [
                'store_id' => env('STORE_ID'), //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
                 'amount' => $request->total_amount, //transaction amount
                'payment_type' => 'VISA', //no need to change
                'currency' => 'BDT',  //currenct will be USD/BDT
                'tran_id' => 'BOIBANGLA'.date('YmdHi'), //transaction id must be unique from your end
                'cus_name' => $address->first_name.' '.$address->last_name,  //customer name
                'cus_email' => $address->email, //customer email address
                'cus_add1' => $address->street_address,  //customer address
                'cus_add2' => ' ', //customer address
                'cus_city' => $address->town_city,  //customer city
                'cus_state' => $address->state,  //state
                'cus_postcode' => $address->postal_code, //postcode or zipcode
                'cus_country' => 'Bangladesh',  //country
                'cus_phone' => $address->contact, //customer phone number
                'cus_fax' => 'Not¬Applicable',  //fax
                'ship_name' => $address->first_name.' '.$address->last_name, //ship name
                'ship_add1' => $address->street_address, //ship address
                'ship_add2' => ' ',
                'ship_city' => $address->town_city,
                'ship_state' => $address->state,
                'ship_postcode' => $address->postal_code,
                'ship_country' => 'Bangladesh',
                'desc' => 'payment description',
                'success_url' => route('ap-success'), //your success route
                'fail_url' => route('ap-fail'), //your fail route
                'cancel_url' => route('viewCheckout'), //your cancel url
                'opt_a' => '',  //optional paramter
                'opt_b' => '',
                'opt_c' => '',
                'opt_d' => '',
                'signature_key' => env('SIGNATURE_KEY')]; //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key

                $fields_string = http_build_query($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
            curl_close($ch);

            $this->redirect_to_merchant($url_forward);
    }

    function redirect_to_merchant($url) {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); }
          </script></head>
          <body onLoad="closethisasap();">

            <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
            <!-- for live url https://secure.aamarpay.com -->
          </body>
        </html>
        <?php
        exit;
    }

    // {"pg_service_charge_bdt":"33.01","amount_original":"943.00","gateway_fee":null,"pg_service_charge_usd":"Not-Available","pg_card_bank_name":"Not Available","pg_card_bank_country":"Not Available","card_number":"1234XXXXXXXXX123","card_holder":null,"status_code":"2","pay_status":"Successful","success_url":"http:\/\/127.0.0.1:8000\/set-apdata-success","fail_url":"http:\/\/127.0.0.1:8000\/set-apdata-fail","cus_name":"Sabbir Hussain","cus_email":"sabbir@mail.com","cus_phone":"01956113999","currency_merchant":"BDT","convertion_rate":null,"ip_address":"27.147.206.12","other_currency":"943.00","pg_txnid":"AAM1651439774271246","epw_txnid":"AAM1651439774271246","mer_txnid":"BOIBANGLA202205012116","store_id":"aamarpaytest","merchant_id":"aamarpaytest","currency":"BDT","store_amount":"909.99","pay_time":"2022-05-02 03:16:33","amount":"943.00","bank_txn":"1098004003728","card_type":"DBBL-NEXUS","reason":"Not Available","pg_card_risklevel":"0","pg_error_code_details":"Not Available","opt_a":null,"opt_b":null,"opt_c":null,"opt_d":null}

    public function success(Request $request){

        // return $request;
        $address = Address::select('id')
        ->where('email',$request->cus_email)
        ->where('contact',$request->cus_phone)
        ->first();

        // return $request;
        $conditions = '';
        // $userId  = Auth::id();
        $userId  = 1;
        // return $userId;
        $cartConditions = \Cart::getConditions();
        $cartItems = \Cart::getContent();
        $cartAmount = \Cart::getTotal();
        $deliveryCharge = Setting::getDeliveryCharge();
        $paymentAmount =  $request->amount;
        $orderPlaceDate = date('Y-m-d H:i:s');
        $orderNumber = $request->mer_txnid;

        if ($cartConditions){
            foreach($cartConditions as $condition) {
                $conditions  .=  $condition->getName().',';
            }
            $conditions = ltrim($conditions,',');
            $conditions = rtrim($conditions,',');
        }

        $checkoutData = [
            'order_no' => $orderNumber,
            'user_id' => $userId,
            'customer_address_id' => $address->id,
            'payment_method' => 1,
            'payment_amount' => $paymentAmount,
            'delivery_charge' => $deliveryCharge,
            'additional_info' => $request->opt_a,
            'discounts' => $conditions,
        ];
        $orderedbook = [];
        $order = Order::create($checkoutData);
        $order->save();
        foreach ($cartItems as $item){
            $orderedbook[] = [
                'order_id' => $order->id,
                'book_id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
            ];
        }

        $result =  OrderBook::insert($orderedbook);
        OrderProcessing::create(['order_id'=>$order->id,
            'status'=> OrderProcessing::ORDER_PLCAED,
            'remark'=> OrderProcessing::DEFAULT_REMARK,
            'processing_date'=> $orderPlaceDate
        ]);
        Helper::orderProcessingNotify($order->id);
        Helper::sendOrderProcessedMail(Order::getOrderIdByOrderNo($orderNumber));
        \Cart::clear();
        \Cart::clearCartConditions();

        return redirect()->route('viewCustomerOrders');
    }



    public function getOrderNumber()
    {
        $random = substr(mt_rand(),0,5);
        $orderNumber = strtoupper('boibangla').$random;
        $orderNumberFound = Order::select('id')->where('order_no',$orderNumber)->first();
        if ($orderNumberFound){
            $this->getOrderNumber();
        }
        return $orderNumber;
    }

    public function fail(Request $request){
        return $request;
    }





}
