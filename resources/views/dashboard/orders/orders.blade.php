@extends('dashboard.layout.master')
@section('title','Orders')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Orders</h2>
                        <div class="clearfix"></div>
                    </div>
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Search </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="order_number" id="order_number" placeholder="Search order number" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="order_status" id="order_status" class="form-control">
                                    <option value="">All</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Confirmed</option>
                                    <option value="3">Processing</option>
                                    <option value="4">Shipping</option>
                                    <option value="5">Delivered</option>
                                    <option value="6">Cancled</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="order-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title">Order No</th>
                                    <th class="column-title">Order Date</th>
                                    <th class="column-title">Payment Method</th>
                                    <th class="column-title">Discounts</th>
                                    <th class="column-title">Total Amount</th>
                                    <th class="column-title no-sort">Status</th>
                                    <th class="column-title no-sort">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer-scripts')
<script type="text/javascript" src="{{asset('assets/js/admin/orders/orders-list.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/orders/orders.js')}}"></script>
@endpush
