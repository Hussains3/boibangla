@extends('dashboard.layout.master')
@section('title','Withdraws')
@section('page-content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h2>Withdraw Request</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <table class="table table-striped jambo_table bulk_action" id="applications-table" style="width: 100%">
                <thead>
                <tr class="headings">
                    <th class="column-title">Request Ammount</th>
                    <th class="column-title">Avilable Ammount</th>
                    <th class="column-title">Payment Method</th>
                    <th class="column-title">Method Details</th>
                    <th class="column-title">Status</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$wrq->ammount}}</td>
                        <td>{{$wrq->affiliation->balance}}</td>
                        <td>{{$wrq->affiliation->payment_mode}}</td>
                        <td>{{$wrq->affiliation->payment_mode_details}}</td>
                        <td>
                            @if ($wrq->status == 1)
                            Pending
                            @elseif ($wrq->status == 2)
                            Accepted
                            @else
                            Rejected
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        @if ($wrq->status == 1)
        <div class="col-md-4 card p-4">
            <h3>To Reject This request</h3>
            <form action="{{route('withdraws.update', $wrq->id)}}" method="post">
                @csrf
                @method('patch')
                <label for="note" class="form-lable">Cause of Rejection</label>
                <input type="text" name="note" id="note" class="form-control" required>
                <input type="hidden" name="status" value="3">
                <input type="hidden" name="id" value="{{$wrq->id}}">
                <button type="submit" class="btn btn-sm btn-danger" style="margin-top: 10px;">Reject</button>
            </form>
        </div>
        @endif
        @if ($wrq->status != 2)
        <div class="col-md-4 card p-4">
            <h3>To Accept This request</h3>
            <form action="{{route('withdraws.update', $wrq->id)}}" method="post">
                @csrf
                @method('patch')
                <label for="note" class="form-lable">Transaction Details</label>
                <input type="text" name="note" id="note" class="form-control" required>
                <label for="ammount" class="form-lable">Ammount</label>
                <input type="text" name="ammount" id="ammount" class="form-control" required>
                <input type="hidden" name="status" value="2">
                <input type="hidden" name="id" value="{{$wrq->id}}">
                <button type="submit" class="btn btn-sm btn-success" style="margin-top: 10px;">Accept</button>
            </form>
        </div>
        @endif
    </div>
@endsection
