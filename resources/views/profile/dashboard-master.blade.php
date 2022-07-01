@extends('layouts.master')


@section('content')
    <div id="">
        <!-- Information div for search result page -->

        <div class="myaccount-wrapper p-1">
            <div class="checkout-head">
                <h1>My Account</h1>
                <div class="mobile-menu-extends">
                    @role('admin')
                    <a class="" href="{{ route('dashboard') }}" style="margin-top: 10px;">Dashboard</a>
                    @endrole
                    <a class="" href="{{ route('logout.perform') }}" style="margin-top: 10px;">Logout</a>
                </div>

            </div>
            <div class="d-flex my-1 flex-sm-column">
                <div class="account-left">
                    {{-- active --}}
                    <ul class="ac-tabs">
                        <li class=""><a href="{{ route('myaccount') }}">My Account</a></li>
                        <li> <a href="{{ route('viewCustomerOrders') }}">My Orders</a></li>
                        <li> <a href="{{ route('viewCustomerWishlist') }}">My Wishlist</a></li>
                        <li> <a href="{{ route('viewCustomerRatigReviews') }}">Rating & Reviews</a></li>
                        <li> <a href="{{ route('viewCustomerAddresses') }}">My Addresses</a></li>
                        {{-- <li> <a href="{{ route('viewCustomerChangePassword') }}">Change Password</a></li> --}}
                        @role('affiliator')
                        <li>
                            <hr>
                        </li>
                        <li> <a href="{{ route('affiliLinks') }}">Links & Buttons</a></li>
                        <li> <a href="{{ route('earningReport') }}">Earning Report</a></li>
                        {{-- <li> <a href="{{ route('affiliatorProduct') }}">Products Report</a></li> --}}
                        @endrole

                    </ul>
                </div>
                <div class="ac-container">
                    <div class="fadeinout">
                        @include('messages')
                    </div>
                    @yield('dashboard-wraper')

                </div>
                <div style="clear:both;"></div>
            </div>
        </div>


        <!-- Search Result Div End -->
        <!-- Footer Section Start -->
        <!-- Footer Section End -->
        <div style="clear: both"></div>
        <div class="push"></div>
    </div>
@endsection



@section('script')
@yield('inner-script')
<script>
    $(document).ready(function () {
        // $(selector).fadeOut();
        $(".fadeinout").delay(50).fadeIn(800);
        $(".fadeinout").delay(3000).fadeOut(800);
    });
</script>

@endsection
