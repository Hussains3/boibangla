@extends('dashboard.layout.master')
@section('title','Order Detail - '.$order->order_no)
@section('page-content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Order Detail</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <section class="content invoice">
                        <div class="row">
                            <div class="col-xs-12 invoice-header">
                                <h1>
                                    <span style="font-size: 30px;">ORDER #{{$order->order_no}}</span>
                                    <small class="pull-right">Date: {{$order->placed_date}}</small>
                                </h1>
                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-6 invoice-col">
                                From
                                <address>
                                    @lang('common.company_address')
                                </address>
                            </div>
                            <div class="col-sm-6 invoice-col">
                                To
                                <address>
                                    <strong>{{$order->full_name}}</strong>
                                    <br> {{$order->street_address}}
                                    <br>{{$order->state}}, {{$order->country_name}}
                                    <br> {{$order->town_city}} - {{$order->postal_code}}
                                    <br>Phone: {{$order->contact}}
                                    <br>Email: {{$order->email}}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 table">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Book</th>
                                        <th>SKU</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($orderDetail)
                                        @foreach($orderDetail as $key =>  $book)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{$book->book_name}} × {{$book->quantity}}</td>
                                                <td>{{ $book->sku }}</td>
                                                <td>৳ {{ $book->price * $book->quantity }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 table">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th>Subtotal</th>
                                            <td colspan="4">৳ {{$bookSubTotal}} </td>
                                        </tr>
                                        @if($discounts)
                                            <tr>
                                                <th>Discount</th>
                                                <td colspan="4">Coupon {{implode(',',$discounts)}} with total {{$totalDiscountPer}}% discount amount ৳ {{$totalDiscountAmount}}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <th>Shipping Charges</th>
                                            <td colspan="4">@if($deliveryChargeAmount) ৳ {{number_format($deliveryChargeAmount)}} @else Free @endif</td>
                                        </tr>
                                        <tr>
                                            <th>Payment Method</th>
                                            <td colspan="4">{{$order->payment_method}}</td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            <td colspan="4">৳{{number_format($totalPaymentAmount)}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row no-print">
                            <div class="col-xs-12">
                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
