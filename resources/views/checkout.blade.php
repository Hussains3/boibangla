@extends('layouts.master')

@section('content')
    <div class="checkout-wrapper">
        <div class="checkout-head-new">
            <h1>
                Checkout Your Cart
            </h1>
        </div>
        <div class="checkout">

            <form id="checkoutForm">

                <span id="lblMsgInfo" class="message-info" style="display: none;"></span>

                <div class="login">

                    <div id="">
                        <div class="customer">
                            <div class="title" style="border-bottom: 1px solid #ccc;">
                                Shipping Address
                            </div>

                            <div class="checkout-bg address-payment">

                                <div class="returning saved-address">
                                    <div class="bs-main-head">
                                        <h2>Select from Saved Addresses
                                        </h2>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mobile90">
                                            <div class="heading_s3">
                                                <h5>Select Address</h5>
                                            </div>
                                            <div class="addresses mb-1">
                                                <ul class="listview image-listview flush">


                                                    @forelse ($addresses as $key=>$address)
                                                        {{-- Address --}}
                                                        <div class="prv-address">

                                                            <div class="top">
                                                                <div class="icon-box">
                                                                    <div class="payment_method">
                                                                        <div class="payment_option">
                                                                            <div class="custome-radio">
                                                                                <input class="form-check-input" type="radio"
                                                                                    name="address_option"
                                                                                    id="address{{ $address->id }}"
                                                                                    {{ $key == 0 ? 'checked' : '' }}
                                                                                    value="{{ $address->id }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="name">
                                                                    {{ $address->full_name }}
                                                                </div>
                                                                <div class="right-action">
                                                                    <a href="#">
                                                                        <input type="image"
                                                                            name="ctl00$cpBody$ctrl0$imgEdit"
                                                                            id="ctrl0_imgEdit"
                                                                            title="Edit" src="images/edit.png" alt="Edit"
                                                                            style="border-width:0px;margin: 0 10px 0 0">
                                                                    </a><a href="#">
                                                                        <input type="image"
                                                                            name="ctl00$cpBody$ctrl0$imgDelete"
                                                                            id="ctrl0_imgDelete"
                                                                            title="Delete" src="images/delete.png"
                                                                            alt="Delete"
                                                                            onclick="return confirm('Are you sure you want to delete address?');"
                                                                            style="border-width:0px;margin: 0 10px 0 0">
                                                                    </a>
                                                                </div>
                                                            </div>


                                                            <div class="address-box">
                                                                <p>
                                                                    <span>
                                                                        {{ $address->street_address }}
                                                                    </span>
                                                                    <span>
                                                                        {{ $address->town_city }}
                                                                    </span>
                                                                    <span>
                                                                        {{ $address->state }} - {{ $address->postal_code }}
                                                                    </span>
                                                                    <span>
                                                                        <label
                                                                            id="ctrl0_lblMobile">Mobile:
                                                                            {{ $address->contact }}</label>
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>

                                                    @empty

                                                        <div id="ctrl0_divNoShipping"
                                                            class="no-shipping-address">
                                                            The shipping address will be saved to your account to help you a
                                                            faster checkout
                                                            with your next orders.
                                                        </div>
                                                    @endforelse
                                                </ul>
                                            </div>
                                            <a href="{{ route('addAddress') }}" class="btn-red" style="margin-top: 20px"> <i
                                                    class="linearicons-plus"></i> Add New Address</a>
                                            <div class="error" id="address_optionError"></div>

                                        </div>
                                    </div>

                                </div>
                                <div class="new checkout-aditional-info">
                                    <div class="">
                                        <h5>Additional information</h5>
                                    </div>
                                    <div class="form-group mb-0">
                                        <textarea rows="5" name="additional_info" id="additional_info" class="form-control"
                                            placeholder="Order notes"></textarea>
                                    </div>
                                    <div class="order_review">
                                        <div class="payment_method">
                                            <div class="">
                                                <h4>Payment</h4>
                                            </div>
                                            <div class="payment_option">
                                                {{-- <div class="custome-radio">
                                                <input class="form-check-input" required="" type="radio" name="payment_option" id="paymentFromWallet" value="wallet" checked="">
                                                <label class="form-check-label" for="paymentFromWallet">Direct From Wallet | <a href="{{ route('viewCustomerDashboard') }}" target="_blank" class="theme-color">Add Money</a></label>
                                                <p data-method="wallet" class="payment-text" style="display: block;">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </p>
                                            </div> --}}
                                                @if ($cashOnDelivery == 'Yes')
                                                    <div class="custome-radio">
                                                        <input class="form-check-input" checked type="radio"
                                                            name="payment_option" id="cod" value="cod">
                                                        <label class="form-check-label" for="cod">Cash on delivery</label>
                                                        <p data-method="cod" class="payment-text">Please send your cheque
                                                            to Store Name, Store Street, Store Town, Store State / County,
                                                            Store Postcode.</p>
                                                    </div>
                                                @endif
                                                <div class="custome-radio">
                                                    <input class="form-check-input" type="radio" name="payment_option"
                                                        id="spay" value="spay">
                                                    <label class="form-check-label" for="spay">Amar Pay</label>
                                                    <p data-method="spay" class="payment-text">Complete your payment with
                                                        AmarPay online payment gateway.
                                                    </p>
                                                    <p data-method="spay" class="payment-text">(বি:দ্র: কিছু কিছু ক্ষেত্রে
                                                        আপনার অর্ডারে থাকা বই/পণ্যের মূল্য প্রকাশক/সরবরাহকারীর পক্ষ থেকে
                                                        বিভিন্ন কারণে পরিবর্তন হতে পারে। এছাড়া আপনার অর্ডারের বই/পণ্য
                                                        প্রকাশক/ সরবরাহকারীর কাছে নাও থাকতে পারে। এই ধরণের অনাকাঙ্ক্ষিত
                                                        বিষয়গুলোর জন্য আমরা দুঃখিত ও ক্ষমাপ্রার্থী।)
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" id="placeOrderBtn" class="btn-red">Place Order</button>
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('amarData').submit();"
                                            id="placeOrderSpay" class="btn-red">Pay with Amarpay</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                {{-- Order Summary --}}
                <div class="order-summary">
                    <div class="ordersummary-inn">
                        <div class="head order-summary-head">
                            <h4>Payment</h4>
                            <div class="clearfloat">
                            </div>
                        </div>
                        <div class="mid-details">
                            <div class="table-responsive order_table">
                                <div class="spinner-red" id="checkout-loader"></div>
                            </div>
                        </div>
                        <div class="ftdelivery"><label id="OrderSummary_lblShippingTime"
                                class="deliverytime">Ships within 5-7 days.</label></div>
                    </div>
                </div>
            </form>

        </div>
    </div>



    <form action="{{ route('send-money') }}" method="POST" id="amarData" style="display: none;">
        @csrf
        <input type="hidden" name="total_amount" id="hidddenTotalAmount">
        <input type="hidden" name="username" value="{{ \Illuminate\Support\Facades\Auth::user()->username }}">
        <input type="hidden" name="addressId" id="hiddenAddressID">
    </form>
@endsection


@section('script')
    <script src="{{ asset('assets/js/customer/login/customer-login.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/customer/cart/create-update-cart.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/customer/checkout/checkout.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.18/sweetalert2.all.min.js"
        integrity="sha512-kW/Di7T8diljfKY9/VU2ybQZSQrbClTiUuk13fK/TIvlEB1XqEdhlUp9D+BHGYuEoS9ZQTd3D8fr9iE74LvCkA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var paymentBtnType = $('[name="payment_option"]:checked').val();

        if (paymentBtnType === 'cod') {
            $('#placeOrderSpay').css('display', 'none');
            $('#placeOrderBtn').css('display', 'block');

        }
        elseif(paymentBtnType === 'spay') {
            $('#placeOrderSpay').css('display', 'block');
            $('#placeOrderBtn').css('display', 'none');
        }
    </script>
    <script>
        var addressID = $('input[name="address_option"]').val();
        $('#hiddenAddressID').val(addressID);


        $(document).ready(function() {

            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            const url_data = {
                'status': urlParams.get('status'),
                'msg': urlParams.get('msg'),
                'tx_id': urlParams.get('tx_id'),
                'bank_tx_id': urlParams.get('bank_tx_id'),
                'amount': urlParams.get('amount'),
                'bank_status': urlParams.get('bank_status'),
                'sp_code': urlParams.get('sp_code'),
                'sp_code_des': urlParams.get('sp_code_des'),
                'sp_payment_option': urlParams.get('sp_payment_option'),
                'custom1': urlParams.get('custom1'),
                'custom2': urlParams.get('custom2'),
                'custom3': urlParams.get('custom3'),
                'custom4': urlParams.get('custom4'),
            }


            if (url_data.status === 'Success') {
                $('#spay').attr('checked', 'checked');
                $('#cod').removeAttr('checked');
                $.ajax({
                    url: BASE_URL + 'set-spdata-session',
                    method: 'POST',
                    data: url_data,
                    success: function(data) {
                        console.log(data);
                    }
                })
            }



            if ((url_data.status != null) && ((url_data.status === 'Failed') || (url_data.status === 'Canceled'))) {
                $('#spay').attr('checked', 'checked');
                $('#cod').removeAttr('checked');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong! Please try again.',
                    // footer: '<a href="">Why do I have this issue?</a>'
                });
            }


            // show hide amar pay button
            var paymentBtnType = $("[name='payment_option']:checked").val();

            if (paymentBtnType === 'cod') {
                $('#placeOrderSpay').css('display', 'none');
                $('#placeOrderBtn').css('display', 'block');
            }
            if (paymentBtnType === 'spay') {
                $('#placeOrderSpay').css('display', 'block');
                $('#placeOrderBtn').css('display', 'none');

                setTimeout(function() {
                    $('#spay').trigger('click');
                }, 1000)

            }

            if ((url_data.tx_id != null) && (url_data.status === 'Success')) {
                setTimeout(function() {
                    $('#placeOrderBtn').trigger('click');
                }, 2000);
            }
        })
    </script>
@endsection
