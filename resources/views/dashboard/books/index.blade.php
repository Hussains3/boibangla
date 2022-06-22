@extends('dashboard.layout.master')
@section('title','Books')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Books</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="{{route('addBooks')}}"  data-toggle="tooltip" data-placement="top" title="Add Book" ><i class="fa fa-plus-circle" style="font-size: 25px;"></i></a></li>
                            <li><a href="javaScript:void(0)" onclick="showUploadBookModal();"  data-toggle="tooltip" data-placement="top" title="Upload Book" ><i class="fa fa-upload" style="font-size: 25px;"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Search </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="bookSearch" id="bookSearch" placeholder="Books" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </form>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="book-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title">Name</th>
                                    <th class="column-title">SKU</th>
                                    <th class="column-title">Regular Price</th>
                                    <th class="column-title">Sale Price</th>
                                    <th class="column-title">Stock</th>
                                    <th class="column-title">Stock Status</th>
                                    <th class="column-title">Unit</th>
                                    <th class="column-title">Rating</th>
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
    <div id="bookInfoModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Book Information</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" style="width: 100%">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">Sr.No</th>
                                <th class="column-title">Categories</th>
                            </tr>
                            </thead>
                            <tbody id="book_info_categories"></tbody>
                        </table>
                        <table class="table table-striped jambo_table bulk_action" style="width: 100%">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">Sr.No</th>
                                <th class="column-title">Sub Categories</th>
                            </tr>
                            </thead>
                            <tbody id="book_info_sub_categories"></tbody>
                        </table>
                        <table class="table table-striped jambo_table bulk_action" style="width: 100%">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">Sr.No</th>
                                <th class="column-title">Images</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td id="bookImgLabel"></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td id="bookImg1Label"></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td id="bookImg2Label"></td>
                            </tr>
                            </tbody>
                        </table>
                        <div id="description">
                            <h5>Book Description : </h5>
                            <div id="description_content"></div><div class="clearfix"></div>
                        </div>
                        <div id="additionalInfo">
                            <h5>Other Infomation : </h5>
                            <div id="other_info_content"></div><div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div id="uploadBookModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Books</h4>
                </div>
                <div class="modal-body">
                    <form id="uploadBookForm" name="uploadBookForm" enctype="multipart/form-data"  class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="book_file">Book File <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="book_file" id="book_file" onchange="validateFileUpload();" class="form-control col-md-7 col-xs-12">
                                <div id="book_fileError" class="error"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="book_images">Book Images <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="book_images[]" id="book_images" multiple class="form-control col-md-7 col-xs-12">
                                <div id="book_imagesError" class="error"></div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" name="uploadBookBtn" id="uploadBookBtn" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="pull-left"><a href="{{asset('uploads/demo-book-import/book-demo-import.csv')}}">Download sample CSV</a> </div>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('assets/js/admin/books/books-list.js')}}"></script>

@endsection
