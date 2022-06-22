@extends('dashboard.layout.master')
@section('title','Sub Categories')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Sub Categories</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="javaScript:void(0);" onclick="showAddEditSubCategoryModel();" data-toggle="tooltip" data-placement="top" title="Add Sub Categories" ><i class="fa fa-plus-circle" style="font-size: 25px;"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <form id="getEmpByStaus" name="getEmpByStaus" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Search </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="subCategorySearch" id="subCategorySearch" placeholder="Sub Category Name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="categorySelect" id="categorySelect" class="form-control col-md-7 col-xs-12">
                                    <option value="">Select</option>
                                    @if($categories)
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="sub-category-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title">Sub Category ID </th>
                                    <th class="column-title">Sub Category </th>
                                    <th class="column-title">Slug </th>
                                    <th class="column-title">Category</th>
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
    <div id="addEditSubCategoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sub Category</h4>
                </div>
                <div class="modal-body">
                    <form id="addEditSubCategoryForm" name="addEditSubCategoryForm" enctype="multipart/form-data"  class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subCategory">Sub Category <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="subCategory" id="subCategory" placeholder="Sub Category" class="form-control col-md-7 col-xs-12">
                                <div style="color: red;" id="subCategoryError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="slug" id="slug" placeholder="Sub Category" class="form-control col-md-7 col-xs-12">
                                <div style="color: red;" id="slugError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="category" id="category"  class="form-control col-md-7 col-xs-12">
                                    <option value="">Select</option>
                                    @if($categories)
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div style="color: red;" id="categoryError" class="error"></div>
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
                                <button type="submit" name="addEditSubCategoryBtn" id="addEditSubCategoryBtn" class="btn btn-success">Submit</button>
                                <button type="button" style="display: none;" name="addEditSubCategoryBtnLoader" id="addEditSubCategoryBtnLoader" class="btn btn-success"> <i class="fa fa-spinner fa-spin"></i>Saving...</button>
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
    <script type="text/javascript" src="{{asset('assets/js/admin/sub-category/sub-category-list.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/admin/sub-category/sub-category.js')}}"></script>
@endsection
