
@extends('layouts.master')

@section('content')



<!-- START checkout -->
<div class="section">
    <div class="container">
        <form id="checkoutForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="heading_s3">
                        <h5>Select Address</h5>
                    </div>
                    <div class="addresses">
                        <ul class="listview image-listview flush">
                            @if($addresses)
                                @foreach($addresses as $key=>$address)
                                    <li>
                                        <a href="javaScript:void(0)" class="item">
                                            <div class="icon-box">
                                                <div class="payment_method">
                                                    <div class="payment_option">
                                                        <div class="custome-radio">
                                                            <input class="form-check-input" type="radio" name="address_option" id="address{{$address->id}}" {{ $key == 0 ? 'checked' : '' }} value="{{$address->id}}">
                                                            <label class="form-check-label" for="address{{$address->id}}"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="in">
                                                <div>
                                                    <div class="title">{{$address->address_name}}</div>
                                                    <div class="title text-small" id="name{{ $key }}">{{$address->full_name}}</div>
                                                    <div class="title text-small" id="mobile{{ $key }}">{{$address->contact}}</div>
                                                    <div class="text-small mb-05">{{$address->street_address}}<br/> {{$address->town_city}},{{$address->state}} - {{$address->postal_code}}</div>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                    <a href="{{route('addAddress')}}" class="btn btn btn-fill-out2 btn-block"> <i class="linearicons-plus"></i> Add New Address</a>
                    <div class="error" id="address_optionError"></div>
                    <div class="heading_s1" style="margin-top: 20px;">
                        <h5>Additional information</h5>
                    </div>
                    <div class="form-group mb-0">
                        <textarea rows="5" name="additional_info" id="additional_info" class="form-control" placeholder="Order notes"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="order_review">
                        <div class="heading_s1"><h4>Your Orders</h4></div>
                        <div class="table-responsive order_table">
                            <div class="spinner-red" id="checkout-loader"></div>
                        </div>
                        <div class="payment_method">
                            <div class="heading_s1"><h4>Payment</h4></div>
                            <div class="payment_option">
                                {{--<div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio" name="payment_option" id="paymentFromWallet" value="wallet" checked="">
                                    <label class="form-check-label" for="paymentFromWallet">Direct From Wallet | <a href="{{ route('viewCustomerDashboard') }}" target="_blank" class="theme-color">Add Money</a></label>
                                    <p data-method="wallet" class="payment-text" style="display: block;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </p>
                                </div>--}}
                                @if($cashOnDelivery == 'Yes')
                                    <div class="custome-radio">
                                        <input class="form-check-input" checked type="radio" name="payment_option" id="cod" value="cod">
                                        <label class="form-check-label" for="cod">Cash on delivery</label>
                                        <p data-method="cod" class="payment-text" >Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                    </div>
                                @endif
                                <div class="custome-radio">
                                    <input class="form-check-input" type="radio" name="payment_option" id="spay" value="spay">
                                    <label class="form-check-label" for="spay">ShurjoPay</label>
                                    <p data-method="spay" class="payment-text" >Complete your payment with ShurjoPay online payment gateway.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="placeOrderBtn" class="btn btn-fill-out btn-block">Place Order</button>
                        <a  href="#" onclick="event.preventDefault(); document.getElementById('surjoData').submit();" id="placeOrderSpay" class="btn btn-fill-out btn-block">Pay with ShurjoPay</a>
                        {{-- <a  href="javascript:void(0)" id="placeBtn" class="btn btn-fill-out btn-block">Place Order</a>--}}
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<form action="{{ route('send-money') }}" method="POST" id="surjoData" style="display: none;">
    @csrf
    <input type="hidden" name="total_amount" id="hidddenTotalAmount" >
    <input type="hidden" name="username" value="{{ \Illuminate\Support\Facades\Auth::user()->username }}" >
</form>
<!-- END SECTION SHOP -->


 @endsection

