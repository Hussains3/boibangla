<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('emails.css.mailer-css-2')
</head>
<body>
<div style="margin-top: 20px;border: 1px solid #ddddd6;">
    <center>
        <img src="{{ asset('assets/images/admin_website_logo.png') }}" style="margin-top: 20px;"/>
    </center>
    <div style="padding: 20px; ">
        <div class="order-success">
            <center>
                @if($order->status == 1)
                     <img src="https://i.imgur.com/bfoeLs3.png">
                @elseif($order->status == 2)
                    <img src="https://i.imgur.com/tBi3ZXB.png">
                @elseif($order->status == 3)
                    <img src="https://i.imgur.com/xMiA6qm.png">
                @elseif($order->status == 4)
                    <img src="{{ asset('assets/images/icons/error-icon.PNG') }}" width="80" height="80"/>
                @endif
            </center>
        </div>
        <h3 class="card-title" style="text-align: center">Thank you for your order <strong>#{{ $order->order_no }}</strong> has been
            @if($order->status == 1)
                placed
            @elseif($order->status == 2)
                confirmed
            @elseif($order->status == 3)
                delivered
            @elseif($order->status == 4)
                Canceled
            @endif
        </h3>
        @if($order->status == 4)
            <br/>
            <center>
                Please send your queries to {{ config('constants.footer_email') }}
            </center>
        @endif
        <p class="card-text">
            Hello {{$order->first_name}}, <br/>
            Thanks for letting us take care of your needs. <br/>
            We’re delighted to let you know that your order has been successfully placed by our trained delivery executive.

            @if($order->status == 3) <br/><br/>
            We request you to please review your order, it will take less than 2 minutes.
             <a href="{{ route('orderDetail',['orderId' => $order->order_id]) }}">Click here</a>
            @endif
        </p>
        @if($order->status == 2)
        <h5 class="card-title">Estimated Delivery date : {{ date('d M Y', strtotime("+5 days"))}}</h5>
        @endif
        <div class="my-orders">
            <div class="card-divider"></div>
            <div class="card-table">
                <div class="table-responsive-sm">
                    <table>
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody class="card-table__body card-table__body--merge-rows">
                        @if($orderProducts)
                            @foreach($orderProducts as $product)
                                <tr>
                                    <td>{{$product->product_name}} × {{$product->quantity}}</td>
                                    <td>৳{{number_format($product->price * $product->quantity)}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                        <tbody class="card-table__body card-table__body--merge-rows">
                        <tr>
                            <th>Subtotal</th>
                            <td colspan="4">৳ {{$productSubTotal}} </td>
                        </tr>
                        <tr>
                            <th>Shipping Charges</th>
                            <td colspan="4">@if($deliveryChargeAmount) ৳ {{number_format($deliveryChargeAmount)}} @else Free @endif</td>
                        </tr>
                        <tr>
                            <th>Payment Method</th>
                            <td colspan="4">{{$order->payment_method}}</td>
                        </tr>
                        @if($discounts)
                            <tr>
                                <th>Coupon Code</th>
                                <td colspan="4">{{implode(',',$discounts)}} with total {{$totalDiscountPer}} % discount</td>
                            </tr>
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Total</th>
                            <td colspan="4">৳{{number_format($totalPaymentAmount)}}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-divider"></div>
        <div style="margin-top:20px;">
            <center>
                <a href="{{ route('viewTrackOrder') }}" style="color: #FF324D;">Track Your Order</a>
            </center>
        </div>
        <div class="card-body">
            <h5 class="card-title">Delivery Address</h5>
            <p class="card-text">{{$order->full_name}}<br/>
                {{$order->email}}<br/>
                {{$order->contact}},<br/>
                {{$order->street_address}}<br/>
                {{$order->state}} - {{$order->country_name}}<br />
                {{$order->town_city}} - {{$order->postal_code}}
            </p>
        </div>
        <div class="card-divider" style="margin-top:20px;"></div><br/>
        <div class="card-body">
            <h6 class="card-subtitle mb-2 text-muted">Thanks & Regards<br/>
               @lang('common.company_address_2')
            </h6>
        </div>
    </div>
</div>
</body>
</html>
