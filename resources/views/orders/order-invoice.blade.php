<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('web/assets/bootstrap/css/bootstrap.min.css')}}">
    <title>Order Invoice</title>
    <style>
        .invoice {
            padding: 30px;
        }

        .invoice h2 {
            margin-top: 0px;
            line-height: 0.8em;
        }

        .invoice .small {
            font-weight: 300;
        }

        .invoice hr {
            margin-top: 10px;
            border-color: #ddd;
        }

        .invoice .table tr.line {
            border-bottom: 1px solid #ccc;
        }

        .invoice .table td {
            border: none;
        }

        .invoice .identity {
            margin-top: 10px;
            font-size: 1.1em;
            font-weight: 300;
        }

        .invoice .identity strong {
            font-weight: 600;
        }


        .grid {
            position: relative;
            width: 100%;
            background: #fff;
            color: #666666;
            border-radius: 2px;
            margin-bottom: 25px;
            box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<div class="container">
    <div class="grid invoice">
        <div class="grid-body">
            <div class="invoice-title">
                <div class="row">
                    <div class="col-xs-12">
                        <img src="{{asset('assets/images/admin_website_logo.png')}}" alt="" height="35">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-10">
                        <h2>invoice<br>
                        <span class="small">order #{{$order->order_no}}</span></h2>
                    </div>
                    <div class="col" align="right">Order Date : {{$order->placed_date}}</div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col align-self-start">
                    <address>
                        <strong>Shipped from</strong><br>
                        @lang('common.company_address')
                    </address>
                </div>
                <div class="col align-self-end">
                    <address>
                        <strong>Shipped To:</strong><br>
                        {{$order->full_name}}<br>
                        {{$order->street_address}}<br>
                        {{$order->state}}, {{$order->country_name}}<br>
                        {{$order->town_city}} - {{$order->postal_code}}<br>
                        Phone:{{$order->contact}}<br/>
                        Email:{{$order->email}}
                    </address>
                </div>
            </div>

            <h4>ORDER SUMMARY</h4> <br/>
            <table class="table table-bordered">
                <thead>
                <tr class="line">
                    <td><strong>#</strong></td>
                    <td ><strong>PROJECT</strong></td>
                    <td ><strong>Qty</strong></td>
                    <td ><strong>RATE</strong></td>
                    <td class="text-right"><strong>SUBTOTAL</strong></td>
                </tr>
                </thead>
                <tbody>
                @if($orderDetail)
                    @foreach($orderDetail as $key => $product)
                        <tr class="line">
                            <td>{{$key+1}}</td>
                            <td align="left">{{$product->product_name}} </td>
                            <td>{{$product->quantity}}</td>
                            <td>৳{{$product->price}}</td>
                            <td class="text-right">৳{{number_format($product->price * $product->quantity)}}</td>
                        </tr>
                    @endforeach
                @endif
                <tr class="line">
                    <th colspan="4"  class="text-right">Subtotal</th>
                    @if(isset($discounts))
                        <td colspan="4" class="text-right">৳{{number_format($totalPaymentAmount + $totalDiscountAmount)}} </td>
                    @endif
                </tr>

                <tr class="line">
                    <th colspan="4"  class="text-right">Shipping</th>
                    <td colspan="4" class="text-right">
                        @if (($totalPaymentAmount + $totalDiscountAmount) < 1500)
                            50
                        @else
                            Free
                        @endif
                    </td>
                </tr>
                <tr class="line">
                    <th colspan="4"  class="text-right">Payment Method</th>
                    <td colspan="4" class="text-right">{{$order->payment_method}}</td>
                </tr>
                @if($discounts)
                    <tr class="line">
                        <th colspan="4"  class="text-right">Coupon Code</th>
                        <td colspan="4" class="text-right">{{implode(',',$discounts)}} with total {{$totalDiscountPer}} % discount</td>
                    </tr>
                @endif
                </tbody>
                <tfoot>
                <tr class="line">
                    <th colspan="4" class="text-right">Total</th>
                    <td colspan="4" class="text-right">৳{{number_format($totalPaymentAmount)}}</td>
                </tr>
                </tfoot>
            </table>
            <div class="row">
                <div class="col-md-12 text-right identity">
                    <p><strong>Regards <br/>
                            {{ config('app.name') }}</strong></p>
                </div>
            </div>
        </div>
    </div>
  </div>
<script>
    window.print();
</script>
</body>
</html>
