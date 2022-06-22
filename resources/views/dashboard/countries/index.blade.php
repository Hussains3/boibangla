@extends('dashboard.layout.master')
@section('title','Countries')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Countries</h2>

                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="javaScript:void(0);" onclick="showAddEditCountryModel();" data-toggle="tooltip" data-placement="top" title="Add Countries" ><i class="fa fa-plus-circle" style="font-size: 25px;"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <form id="getEmpByStaus" name="getEmpByStaus" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Search </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="countrySearch" id="countrySearch" placeholder="Country" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </form>
                    <div class="x_content">

                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="country-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title">Country ID</th>
                                    <th class="column-title">Country Name</th>
                                    <th class="column-title">Short Name</th>
                                    <th class="column-title">Phone Code</th>
                                    <th class="column-title no-sort">Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="addEditCountryModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Country</h4>
                </div>
                <div class="modal-body">
                    <form id="addEditCountryForm" name="addEditCountryForm" enctype="multipart/form-data"  class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country Name <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="country" id="country" placeholder="Country" class="form-control col-md-7 col-xs-12">
                                <div style="color: red;" id="countryError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">Code<span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="code" id="code" placeholder="Country" class="form-control col-md-7 col-xs-12" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="5">
                                <div style="color: red;" id="countryCodeError" class="error"></div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="editId" id="editId" value=""/>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" name="addEditCountryBtn" id="addEditCountryBtn" class="btn btn-success">Submit</button>
                                <button type="button" style="display: none;" name="addEditCountryBtnLoader" id="addEditCountryBtnLoader" class="btn btn-success"> <i class="fa fa-spinner fa-spin"></i>Saving...</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('footer-scripts')
<script type="text/javascript" src="{{asset('assets/js/admin/country/country-list.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/country/country.js')}}"></script>
@endpush
