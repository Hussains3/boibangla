@extends('layouts.master')
@section('individualcss')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0/css/bootstrap.min.css" integrity="sha512-NZ19NrT58XPK5sXqXnnvtf9T5kLXSzGQlVZL9taZWeTBtXoN3xIfTdxbkQh6QSoJfJgpojRqMfhyqBAAEeiXcA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('title','Order Detail')
@section('content')
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }
        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }
        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }
        .rate:not(:checked) > label:before {
            content: '★ ';
        }
        .rate > input:checked ~ label {
            color: #ffc700;
        }
        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
        }
        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
        }
    </style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9" style="padding: 5px;">
            <div class="section customer-home-section pt-1">
                <div class="wallet-card">
                    <h3>Order Detail</h3>
                    <div class="my-orders">
                        <div class="card">
                            <div class="order-header">
                                <div class="order-header__actions"><a href="{{route('viewCustomerOrders')}}" class="btn btn-xs btn-secondary">Back to list</a></div>
                                <h5 class="order-header__title">Order # {{$order->order_no}}</h5>
                                <div class="order-header__subtitle">Was placed on <mark class="order-header__date">{{$order->placed_date}}</mark>
                                    and is  <mark class="order-header__status">{{$order->order_status}}</mark>.
                                </div>
                            </div>
                            <div class="card-divider"></div>
                            <div class="card-table">
                                <div class="table-responsive-sm">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Book</th>
                                            @if($order->status == 3)
                                            <th>Rate & Review</th>
                                            @endif
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody class="card-table__body card-table__body--merge-rows">
                                        @if($orderDetail)
                                            @foreach($orderDetail as $book)
                                            <tr>
                                                <td>{{$book->book_name}} × {{$book->quantity}}</td>
                                                @if($order->status == 3)
                                                <td>
                                                    @if($myRatedBooks && in_array($book->id,$myRatedBooks))
                                                        <span class="linearicons-check"></span>
                                                    @else
                                                        <strong>
                                                            <a href="javaScript:void(0)" class="theme-color text-bold" onclick="rateBook('{{$order->order_id}}','{{$book->id}}');" style="text-decoration: none">
                                                                <span class="linearicons-star" style="color:#FF324D"></span> Rate this
                                                            </a>
                                                        </strong>
                                                    @endif
                                                </td>
                                                @endif
                                                <td>৳ {{ $book->price * $book->quantity }}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tbody class="card-table__body card-table__body--merge-rows">
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
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3 no-gutters mx-n2">
                            <div class="col-sm-6 col-12 px-2">
                                <div class="card address-card address-card--featured">
                                    <div class="address-card__badge">Order Processing</div>
                                    <div class="address-card__body">
                                        <div id="tracking-data">
                                            @if($orderProcessing)
                                                @foreach($orderProcessing as $processing)
                                                    @php
                                                    $statusClass = '';
                                                    if ($processing->status == 1){
                                                        $statusClass = 'status-pending';
                                                    }else if ($processing->status == 2){
                                                       $statusClass = 'status-confirmed';
                                                    }else{
                                                        $statusClass = 'status-delivered';
                                                    }
                                                    @endphp
                                                <div class="tracking-item">
                                                    <div class="tracking-icon {{$statusClass}}">
                                                        <i class="fa fa-check"></i>
                                                    </div>
                                                    <div class="tracking-date" style="font-size: 12px;">{{date('j,F Y h:i:s A',strtotime($processing->processing_date))}}</div>
                                                    <div class="tracking-content">{{$processing->remark}}</div>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                         <ul class="list-group list-group-flush">
                                             <li class="list-group-item"><a href="{{route('viewTrackOrder')}}" target="_blank">Track your order</a> </li>
                                             @if($order->status == 3)
                                             <li class="list-group-item">Delivered on {{date('j,F  Y',strtotime($orderDeliveryDate))}}</li>
                                            @endif
                                             <li class="list-group-item"><i class="fa fa-file-pdf"></i> <a href="{{route('downloadInvoice',[$order->order_id])}}">Download Invoice PDF</a> </li>
                                         </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 px-2">
                                <div class="card address-card address-card--featured">
                                    <div class="address-card__badge">Delivery Address</div>
                                    <div class="address-card__body">
                                        <div class="address-card__name">{{$order->full_name}}</div>
                                        <div class="address-card__row">
                                            {{$order->street_address}}<br />
                                            {{$order->state}}, {{$order->country_name}}<br />
                                            {{$order->town_city}} - {{$order->postal_code}}
                                        </div>
                                        <div class="address-card__row">
                                            <div class="address-card__row-title">Phone Number</div>
                                            <div class="address-card__row-content">{{$order->contact}}</div>
                                        </div>
                                        <div class="address-card__row">
                                            <div class="address-card__row-title">Email Address</div>
                                            <div class="address-card__row-content">{{$order->email}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="rateBookModal" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="rateBookForm">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Rate & Review</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="rate">
                                <input type="radio" id="star5" name="rating" value="5" checked/>
                                <label for="star5" title="5 stars">5 stars</label>
                                <input type="radio" id="star4" name="rating" value="4" />
                                <label for="star4" title="4 stars">4 stars</label>
                                <input type="radio" id="star3" name="rating" value="3" />
                                <label for="star3" title="3 stars">3 stars</label>
                                <input type="radio" id="star2" name="rating" value="2" />
                                <label for="star2" title="2 stars">2 stars</label>
                                <input type="radio" id="star1" name="rating" value="1"  />
                                <label for="star1" title="1 star">1 star</label>
                            </div>
                        </div>
                    </div>
                    <div id="ratingError" class="error"></div>
                    <div class="form-group mt-4">
                        <label for="review">Review this book</label>
                        <textarea type="text" name="review" id="review" placeholder="Enter review"  class="form-control form-control"></textarea>
                        <div id="reviewError" class="error"></div>
                    </div>
                    <div class="form-group mt-4">
                        <div class="custom-file">
                            <input type="file" id="book_pictures" name="book_pictures[]" multiple class="custom-file-input">
                            <label class="custom-file-label" for="book_pictures">Choose file</label>
                            <div id="book_picturesError" class="error"></div>
                        </div>
                    </div>
                    <p class="text-mute">Your rating and reviews make our day</p>
                </div>
                <div class="modal-footer border-0">
                    <input type="hidden" name="book_id" id="book_id" value="" />
                    <input type="hidden" name="order_id" id="order_id" value="" />
                    <button type="submit" id="addReviewBtn" class="btn btn-fill-out btn-block">Rate
                        <span id="addReviewBtnLoader" class="spinner-border spinner-border-sm d-none" role="status"><span class="sr-only"> </span></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('customer-js')
    <script src="{{asset('assets/js/customer/orders/rate-and-reviews.js')}}" type="text/javascript"></script>
@endsection
