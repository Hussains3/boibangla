@extends('admin.layout.master')
@section('title','Wallet Requests')
@section('page-content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Wallet Requests</h2>
                    <div class="clearfix"></div>
                </div>
                <form class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Search </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="search_name" id="search_name" placeholder="Search customer name" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Search By Id </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="request_id" id="request_id" placeholder="Search wallet request ID" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="search_status" id="search_status" class="form-control">
                                <option value="">All</option>
                                <option value="1">Pending</option>
                                <option value="2">Approved</option>
                                <option value="3">Archived</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="wallet-requests-table" style="width: 100%">
                            <thead>
                            <tr class="headings">
                                <th>Sr.No</th>
                                <th>Request Id</th>
                                <th>Txn Id</th>
                                <th>Request Date</th>
                                <th>Customer Name</th>
                                <th>Mobile</th>
                                <th>Request Amount</th>
                                <th>Method</th>
                                <th class="no-sort">Status</th>
                                <th class="no-sort">Action</th>
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
<script type="text/javascript" src="{{asset('assets/js/admin/wallet/wallet-list.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/wallet/wallet.js')}}"></script>
@endpush
