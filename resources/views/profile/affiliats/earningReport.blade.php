@extends('profile.dashboard-master')


@section('dashboard-wraper')
<div class="contents">
    <h1 id="earnings-report">Earnings Report </h1>
    <div class="main-accout-table" style="display: flex;">


        <div class="address-box">
            <div class="">
                <h2>Total Earning</h2>
                <h3>{{$affiliation->total_earning ?? 00.00}}</h3>
            </div>
        </div>
        <div class="address-box">
            <div class="">
                <h2>Balance</h2>
                <h3>{{$affiliation->balance ?? 00.00}}</h3>
            </div>
        </div>
    </div>
    @if ($affiliation->total_earning < 1500 && $affiliation->balance <= 0)
    <p>You only can send withdraw request when your total earning is morethen 1500tk and balance in not empty.</p>
    @endif
    {{-- @if ($affiliation->total_earning >= 1500 && $affiliation->balance > 0)

    @endif --}}
    <div class="">
        <h2>Send a withdraw request</h2>
        <form action="" method="post">
            <input type="number" name="price" id="price">
            <input type="submit" value="Send Request" class="px-1 btn-red-micro">
        </form>
    </div>
</div>

@endsection

