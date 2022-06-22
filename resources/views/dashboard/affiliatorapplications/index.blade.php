@extends('dashboard.layout.master')
@section('title','Tags')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Affiliation applications</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="applications-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Application ID</th>
                                    <th class="column-title">Applicant Name</th>
                                    <th class="column-title" colspan="3">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($applications as $application)
                                        <tr>
                                            <td>{{$application->id}}</td>
                                            <td>{{$application->applicant->name}}</td>
                                            <td><a href="{{ route('users.show', $application->applicant->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></a></td>
                                            <td>
                                                {!! Form::open(['method' => 'PATCH','route' => ['affiliationapplication.update', $application->applicant->id],'style'=>'display:inline']) !!}
                                                {!! Form::hidden('user_id', $application->applicant->id) !!}
                                                {!! Form::hidden('id', $application->id) !!}
                                                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-check"></i></button>
                                                {!! Form::close() !!}
                                            </td>
                                            <td>
                                                {!! Form::open(['method' => 'DELETE','route' => ['affiliationapplication.destroy', $application->id],'style'=>'display:inline']) !!}
                                                {!! Form::hidden('applicationID', $application->id) !!}
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
