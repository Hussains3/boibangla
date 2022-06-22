@extends('dashboard.layout.master')
@section('title','Queries')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Queries</h2>
                        <div class="clearfix"></div>
                    </div>
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="search_name">Search </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="search_name" id="search_name" placeholder="Name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </form>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="queries-table" style="width: 100%">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">Sr.No</th>
                                        <th class="column-title">Name</th>
                                        <th class="column-title">Email</th>
                                        <th class="column-title">Phone</th>
                                        <th class="column-title">Subject</th>
                                        <th class="column-title">Message</th>
                                        <th class="column-title">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('assets/js/admin/queries/queries-list.js')}}"></script>
@endsection
