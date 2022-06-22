@extends('dashboard.layout.master')
@section('title','Banner')
@section('page-content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Banners</h2>
                    <div class="clearfix"></div>
                    <p>Note: <br/>
                        1. Banner upload size is: 805x280
                    </p>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a href="javaScript:void(0);" onclick="showAddEditBannerModel();" data-toggle="tooltip" data-placement="top" title="Add Banner" ><i class="fa fa-plus-circle" style="font-size: 25px;"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <form class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="banner_filter" id="banner_filter" class="form-control">
                                <option value="">All</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>
                </form>

                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="banner-image-table" style="width: 100%">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">Sr.No</th>
                                <th class="column-title no-sort">Banner name</th>
                                <th class="column-title no-sort">Banner Image</th>
                                <th class="column-title no-sort">Status</th>
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
<div id="addEditBannerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addEditBannerForm" name="addEditBannerForm"  class="form-horizontal form-label-left">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Banner</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="media">File <span id="field-required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="file" name="media" id="media" class="form-control col-md-7 col-xs-12">
                        <input type="hidden" name="pre_file" id="pre_file" value="" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="media">Title <span id="field-required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="title" id="title" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="media">Sub Title <span id="field-required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="sub_title" id="sub_title" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="media">Button Label <span id="field-required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="button_label" id="button_label" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="media">Link <span id="field-required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="button_link" id="button_link" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="editId" id="editId" value=""/>
                <input type="hidden" name="additional_data" id="additional_data" value="" />
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('footer-scripts')
    <script type="text/javascript" src="{{asset('assets/js/admin/media/banner-list.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/admin/media/manage-banner.js')}}"></script>
@endpush

