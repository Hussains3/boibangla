@extends('dashboard.layout.master')
@section('title', 'Dashboard')
@section('page-content')
    @role('admin')
    <div class="row tile_count">

        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-users"></i> Total Users</span>
            <div class="count">{{ $totalUser ?? 'Counting...' }}</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Total Categories</span>
            <div class="count">{{ $totalCategories ?? 'Counting...' }}</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-pagelines"></i> Total Books</span>
            <div class="count green">{{ $totalBooks ?? 'Counting...' }}</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-first-order"></i> Total Orders</span>
            <div class="count">{{ $totalOrders ?? 'Counting...' }}</div>
        </div>
    </div>
    <div class="row tile_count">
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-envelope-o"></i> Total Newsletters</span>
            <div class="count">{{ $totalNewsletters ?? 'Counting...' }}</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-dollar"></i> Total Collections</span>
            <div class="count">৳ {{ $totalCollection }}</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-dollar"></i> Total COD Order</span>
            <div class="count">{{ $totalCodOrder }}</div>
        </div>
    </div>

    @endrole
@endsection
