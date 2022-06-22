@extends('dashboard.layout.master')
@section('title','Other media')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Other Images</h2>
                        <ul class="nav navbar-right panel_toolbox" style="display: none">
                            <li><a href="javaScript:void(0);" onclick="showAddEditBannerModel();" data-toggle="tooltip" data-placement="top" title="Add" ><i class="fa fa-plus-circle" style="font-size: 25px;"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="other-image-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title no-sort">Banner Image</th>
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
    <div id="addOtherImagesModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addEditOtherImagesForm" name="addEditOtherImagesForm"  class="form-horizontal form-label-left">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Other Image</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="media">Image <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="image" id="image" class="form-control col-md-7 col-xs-12">
                                <input type="hidden" name="pre_image" id="pre_image" value="" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Link <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="link" id="link" placeholder="Link" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" value=""/>
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('footer-scripts')
    <script type="text/javascript" src="{{asset('assets/js/admin/media/other-images.js')}}"></script>
@endpush

