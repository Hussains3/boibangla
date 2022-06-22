@extends('profile.dashboard-master')


@section('dashboard-wraper')
<div class="contents">
    <h1 id="earnings-report">Earnings Report </h1>
    <div class="main-accout-table" style="display: flex;">


        <div class="address-box">
            <div class="">
                <h2>Total Earning</h2>
                <h3>{{$user->total_earning ?? 00.00}}</h3>
            </div>
        </div>
        <div class="address-box">
            <div class="">
                <h2>Balance</h2>
                <h3>{{$user->balande ?? 00.00}}</h3>
            </div>
        </div>
    </div>
</div>

@endsection

