@extends('profile.dashboard-master')


@section('dashboard-wraper')
<div class="contents">
    <h2 id="earnings-report">Payment Method</h2>
    <div class="address-box">
        <form action="{{route('caffiliation.update')}}" method="post" class="d-flex">
            @csrf
            @method('patch')
            <div>
                <label class="form-controll me-1" for="payee_name">Payee Name</label>
                <input class="new-txt-box" type="text" name="payee_name" id="payee_name" value="{{$affiliation->payee_name ?? Auth::user()->name}}" required>
            </div>
            <div>
                <label class="form-controll me-1" for="payment_mode">Peyment Method</label>
                <select name="payment_mode" id="payment_mode" class="new-txt-box" required>
                    <option value="bkash" {{$affiliation->payment_mode == 'bkash' ? 'selected' : ''}}>Bkash</option>
                    <option value="rocket" {{$affiliation->payment_mode == 'rocket' ? 'selected' : ''}}>Rocket</option>
                </select>
            </div>
            <div>
                <label class="form-controll me-1" for="payment_mode_details">Method Details</label>
                <input class="new-txt-box" type="text" name="payment_mode_details" id="payment_mode_details" value="{{$affiliation->payment_mode_details ?? ''}}" required>
            </div>
            <input type="submit" value="Save" class="btn-red-micro">
        </form>
    </div>
    <h2 id="earnings-report">Earnings Report </h2>
    <div>
        <div class="">
            <div class="d-flex align-items-center">
                <h3>Total Earning :</h3>
                <h3 class="ms-2 text-red">{{$affiliation->total_earning ?? 00.00}}</h3>
            </div>
        </div>
        <div class="">
            <div class="d-flex align-items-center">
                <h3 class="ms-2">Balance :</h3>
                <h3 class="ms-2 text-red">{{$affiliation->balance ?? 00.00}}</h3>
            </div>
        </div>
    </div>
    @if ($affiliation->total_earning < 1500)
    @endif
    <p class="text-red">You only can send withdraw request when your total earning is more then 1500tk and balance in not empty.</p>
    @if ($affiliation->total_earning >= 1500 && $affiliation->balance > 0)

    <div class="">
        <h2>Send a withdraw request</h2>
        <form action="{{route('Withdraws.store')}}" method="post">
            @csrf
            <input type="number" class="new-txt-box" name="ammount" id="price" max="{{$affiliation->balance}}" value="{{$affiliation->balance}}">
            <input type="hidden" name="affiliation_id" value="{{$affiliation->id}}">
            <input type="submit" value="Send Request" class="px-1 btn-red-micro">
        </form>
    </div>
    @endif


    @if (!empty($pendingReqiest))
    <div class=" mt-2">
        <table class="earningtable">
            <thead>
                    <th>Date</th>
                    <th>Ammount</th>
                    <th>Status</th>
                    <th>Remark</th>
            </thead>
            <tbody>
                @foreach ($pendingReqiest as $prq)

                <tr>
                    <td>{{date_format($prq->created_at,'d M Y')}}</td>
                    <td>{{$prq->ammount}}</td>
                    <td>
                        @if ($prq->status == 1)
                            Pending
                            @elseif ($prq->status  == 2)
                            Accepted
                            @else
                            Canceled
                        @endif
                    </td>
                    <td>{{$prq->note ?? ''}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection

