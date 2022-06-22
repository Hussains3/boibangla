@extends('dashboard.layout.master')
@section('title','Categories')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Categories</h2><i class="linearicons-cart-full"></i> icon-gift

                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="javaScript:void(0);" onclick="showAddEditCategoryModel();" data-toggle="tooltip" data-placement="top" title="Add Categories" ><i class="fa fa-plus-circle" style="font-size: 25px;"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <form id="getEmpByStaus" name="getEmpByStaus" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Search </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="categorySearch" id="categorySearch" placeholder="Category" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="categoryStatus" id="categoryStatus" class="form-control">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Navigation Status</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="navigationStatus" id="navigationStatus" class="form-control">
                                    <option value="">All</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="x_content">

                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="category-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title">Category ID</th>
                                    <th class="column-title no-sort">Category Icon</th>
                                    <th class="column-title">Category Name</th>
                                    <th class="column-title">Category Slug</th>
                                    <th class="column-title">Discount</th>
                                    <th class="column-title no-sort">Navigation</th>
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


    <div id="addEditCategoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Category</h4>
                </div>
                <div class="modal-body">
                    <form id="addEditCategoryForm" name="addEditCategoryForm" enctype="multipart/form-data"  class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Category Name <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="category" id="category" placeholder="Category" class="form-control col-md-7 col-xs-12">
                                <div style="color: red;" id="categoryError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category_slug">Category Slug <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="category_slug" id="category_slug" placeholder="your-slug" class="form-control col-md-7 col-xs-12">
                                <div style="color: red;" id="category_slugError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount %<span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="discount" id="discount" class="form-control col-md-7 col-xs-12">
                                <div style="color: red;" id="discountError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="filter">Show in navigation </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="navigation" name="navigation">
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                                <div id="navigationError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Icon <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select id="categoryIcon" name="categoryIcon" data-show-content="true" data-live-search="true" class="form-control">
                                    <option value="">Select</option>
                                    @if($categoriesIcons)
                                        @foreach($categoriesIcons as $icon)
                                            <option value="{{$icon['icon_class']}}" data-icon="{{$icon['icon_class']}}">{{$icon['icon_text']}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div style="color: red;" id="categoryIconError" class="error"></div>
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
                                <button type="submit" name="addEditCategoryBtn" id="addEditCategoryBtn" class="btn btn-success">Submit</button>
                                <button type="button" style="display: none;" name="addEditCategoryBtnLoader" id="addEditCategoryBtnLoader" class="btn btn-success"> <i class="fa fa-spinner fa-spin"></i>Saving...</button>
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
<script type="text/javascript" src="{{asset('assets/js/admin/category/category-list.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/category/category.js')}}"></script>
@endpush
