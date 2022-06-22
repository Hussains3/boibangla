@extends('profile.dashboard-master')


@section('dashboard-wraper')
<div id="ps" class="ac-content">
    <div class="title">
        <table width="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr>
                    <td>
                        My Orders
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="myaccount-address">
        <ul class="listview image-listview flush">
        @forelse ($myOrders as $order)
            <li>
                <a href="{{route('getMyOrderDetail',['orderId'=>$order->id])}}" class="item">
                    @if($order->status == 1)
                        <div class="icon-box bg-warning">
                            <i class="linearicons-question-circle" style="color: white"></i>
                        </div>
                    @elseif($order->status == 2)
                        <div class="icon-box bg-primary">
                            <i class="ti-check" style="color: white"></i>
                        </div>
                    @elseif($order->status == 3)
                        <div class="icon-box bg-success">
                            <i class="ti-check" style="color: white"></i>
                        </div>
                    @elseif($order->status == 4)
                        <div class="icon-box bg-danger">
                            <i class="ti-close" style="color: white"></i>
                        </div>
                    @endif
                    <div class="in">
                        <div>
                            <div class="title">ORDER ID # {{$order->order_no}}</div>
                            <div class="text-small mb-05">Payment Method - {{$order->payment_method}}</div>
                            <div class="text-xsmall">Order date# {{$order->order_date}}</div>
                        </div>
                        @if($order->status == 1)
                            <div class="text-small mb-05 text-right">Order Pending</div>
                        @elseif($order->status == 2)
                            <div class="text-small mb-05 text-right">Order Confirmed</div>
                        @elseif($order->status == 3)
                            <div class="text-small mb-05 text-right">Order Delivered</div>
                        @elseif($order->status == 4)
                            <div class="text-small mb-05 text-right">Order Canceled</div>
                        @endif
                    </div>
                </a>
            </li>
            @empty
                <li>No orders yet</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
@section('script')

<script>
    function ClosePopup() {
    document.getElementById('ctl00_phBody_AccountSetting_fvCustomer_plnOTP').style.display = "none";
    }
</script>

@endsection

