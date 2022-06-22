@extends('dashboard.layout.master')
@section('title','Books Request')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Books Request</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="bookRequestTable" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title">Book Name</th>
                                    <th class="column-title">Writer or Publisher</th>
                                    <th class="column-title">Requester Name</th>
                                    <th class="column-title">Requester Phone</th>
                                    <th class="column-title">Requester Email</th>
                                    <th class="column-title">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookRequests as $bookRequest)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $bookRequest->book_name }}</td>
                                        <td>{{ $bookRequest->writer_publisher_name}}</td>
                                        <td>{{ $bookRequest->name}}</td>
                                        <td>{{ $bookRequest->phone}}</td>
                                        <td>{{ $bookRequest->email}}</td>
                                        <td>
                                            {!! Form::open(['method' => 'DELETE','route' => ['bookRequests.destroy', $bookRequest->id],'style'=>'display:inline']) !!}
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
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

@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#bookRequestTable').DataTable();
    });

</script>
@endsection
