@extends('customer.layout.master-page-support')
@section('title','My Orders')
@section('page-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 hide-in-mobile">
            @include('customer.layout.customer-menus')
        </div>
        <div class="col-md-9" style="padding: 5px;">
            <div class="section customer-home-section pt-1">
                <div class="wallet-card">
                    <h3>My Orders</h3>
                    <div class="my-orders">
                        @if(count($myOrders))
                        <ul class="listview image-listview flush">
                            @foreach($myOrders as $order)
                            <li>
                                <a href="{{route('orderDetail',['orderId'=>$order->id])}}" class="item">
                                    @if($order->status == 1)
                                        <div class="icon-box bg-warning">
                                            <i class="linearicons-question-circle" style="color: white"></i>
                                        </div>
                                    @elseif($order->status == 2)
                                        <div class="icon-box bg-primary">
                                            <i class="ti-check" style="color: white"></i>
                                        </div>
                                    @elseif($order->status == 3)
                                        <div class="icon-box bg-success">
                                            <i class="ti-check" style="color: white"></i>
                                        </div>
                                    @elseif($order->status == 4)
                                        <div class="icon-box bg-danger">
                                            <i class="ti-close" style="color: white"></i>
                                        </div>
                                    @endif
                                    <div class="in">
                                        <div>
                                            <div class="title">ORDER ID # {{$order->order_no}}</div>
                                            <div class="text-small mb-05">Payment Method - {{$order->payment_method}}</div>
                                            <div class="text-xsmall">Order date# {{$order->order_date}}</div>
                                        </div>
                                        @if($order->status == 1)
                                            <div class="text-small mb-05 text-right">Order Pending</div>
                                        @elseif($order->status == 2)
                                            <div class="text-small mb-05 text-right">Order Confirmed</div>
                                        @elseif($order->status == 3)
                                            <div class="text-small mb-05 text-right">Order Delivered</div>
                                        @elseif($order->status == 4)
                                            <div class="text-small mb-05 text-right">Order Canceled</div>
                                        @endif
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                        @else
                            <p>No orders yet</p>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-12">
{{--                            {{ $myOrders->links() }}--}}
                            @include('customer.layout.pagination', ['paginator' => $myOrders])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
