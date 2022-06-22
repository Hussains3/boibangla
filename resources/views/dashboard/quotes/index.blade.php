@extends('dashboard.layout.master')
@section('title','Quotes')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Quotes</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="quoteTable" style="width: 100%">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">Sr.No</th>
                                        <th class="column-title">Name</th>
                                        <th class="column-title">Organization Name</th>
                                        <th class="column-title">Phone</th>
                                        <th class="column-title">Book List</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($quotes as $quote)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $quote->name }}</td>
                                        <td>{{ $quote->organization_name }}</td>
                                        <td>{{ $quote->phone }}</td>
                                        <td>
                                            @if ($quote->book_list)
                                                <form action="{{route('fileDownload')}}" method="GET">
                                                    @csrf
                                                    <input type="hidden" name="file_url" value="{{$quote->book_list}}">
                                                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-download"></i></button>
                                                </form>
                                            @endif
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
    {{-- <script type="text/javascript" src="{{asset('assets/js/admin/quotes/quotes-list.js')}}"></script> --}}
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#quoteTable').DataTable();
    });
</script>
@endsection
