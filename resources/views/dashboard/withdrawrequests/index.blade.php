@extends('dashboard.layout.master')
@section('title','Withdraws')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Withdraw Request</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="applications-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Request Ammount</th>
                                    <th class="column-title">Avilable Ammount</th>
                                    <th class="column-title">Payment Method</th>
                                    <th class="column-title">Method Details</th>
                                    <th class="column-title">Status</th>
                                    <th class="column-title">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdrawRequests as $withdrawRequest)
                                        <tr>
                                            <td>{{$withdrawRequest->ammount}}</td>
                                            <td>{{$withdrawRequest->affiliation->balance}}</td>
                                            <td>{{$withdrawRequest->affiliation->payment_mode}}</td>
                                            <td>{{$withdrawRequest->affiliation->payment_mode_details}}</td>
                                            <td>
                                                @if ($withdrawRequest->status == 1)
                                                Pending
                                                @elseif ($withdrawRequest->status == 2)
                                                Accepted
                                                @else
                                                Rejected
                                                @endif
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'GET','route' => ['withdraws.show', $withdrawRequest->id],'style'=>'display:inline']) !!}
                                                {!! Form::hidden('id', $withdrawRequest->id) !!}
                                                <button type="submit" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button>
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('assets/js/admin/application/application-list.js')}}"></script>
@endsection
