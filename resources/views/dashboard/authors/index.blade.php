@extends('dashboard.layout.master')
@section('title','Authors')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Authors</h2>

                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="javaScript:void(0);" onclick="showAddEditAuthorModel();" data-toggle="tooltip" data-placement="top" title="Add Authors" ><i class="fa fa-plus-circle" style="font-size: 25px;"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <form id="getEmpByStaus" name="getEmpByStaus" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Search </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="authorSearch" id="authorSearch" placeholder="Author" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </form>
                    <div class="x_content">

                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="author-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title">Author ID</th>
                                    <th class="column-title">Photo</th>
                                    <th class="column-title">Author Name</th>
                                    <th class="column-title">Author Slug</th>
                                    <th class="column-title">Author Discount</th>
                                    <th class="column-title">Status</th>
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


    <div id="addEditAuthorModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Author</h4>
                </div>
                <div class="modal-body">
                    <form id="addEditAuthorForm" name="addEditAuthorForm" enctype="multipart/form-data"  class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Author Name <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="name" id="name" placeholder="Author" class="form-control col-md-7 col-xs-12">
                                <div style="color: red;" id="authorError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="author_slug">Author Slug <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="slug" id="author_slug" placeholder="your-slug" class="form-control col-md-7 col-xs-12">
                                <div style="color: red;" id="author_slugError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">Author Image </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="photo" id="photo" class="form-control col-md-7 col-xs-12">
                                <div style="color: red;" id="photoError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount %</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="discount" id="discount" class="form-control col-md-7 col-xs-12">
                                <div style="color: red;" id="discountError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea type="text" name="description" id="description" placeholder="Description" class="form-control col-md-7 col-xs-12"></textarea>
                                <div style="color: red;" id="descriptionError" class="error"></div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="editId" id="editId" value=""/>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" name="addEditAuthorBtn" id="addEditAuthorBtn" class="btn btn-success">Submit</button>
                                <button type="button" style="display: none;" name="addEditAuthorBtnLoader" id="addEditAuthorBtnLoader" class="btn btn-success"> <i class="fa fa-spinner fa-spin"></i>Saving...</button>
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
<script type="text/javascript" src="{{asset('assets/js/admin/authors/author-list.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/authors/author.js')}}"></script>
@endpush
