@extends('layouts.master')

@section('individualcss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0/css/bootstrap.min.css" integrity="sha512-NZ19NrT58XPK5sXqXnnvtf9T5kLXSzGQlVZL9taZWeTBtXoN3xIfTdxbkQh6QSoJfJgpojRqMfhyqBAAEeiXcA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('title','Track Order')
@section('content')
<div class="section">
    <div class="container">
        <div class="field_form">
            <p class="text-center leads theme-color"><strong>Track Your Order From Anywhere</strong></p>
            <form id="track-order-form">
               <div class="row justify-content-center">
                   <div class="col">
                       <div class="input-group input-group">
                           <input type="text" name="order_no" id="order_no" placeholder="Order No." class="form-control" required="required">
                           <span class="input-group-btn"><button type="submit" id="trackOrderBtn" class="btn btn-fill-out"> <i class="fa fa-search"></i> Track</button></span>
                       </div>
                       <div id="order_noError" class="error"></div>
                   </div>
               </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div id="tracking-data">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('assets/js/customer/order-tracking/order-tracking.js')}}" type="text/javascript"></script>
@endsection
