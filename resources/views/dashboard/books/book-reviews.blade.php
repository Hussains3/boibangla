@extends('dashboard.layout.master')
@section('title','Book Reviews')
@section('page-content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><strong>Book Reviews : {{ $book->book_name }}</strong></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table class="table table-striped jambo_table bulk_action" id="book-reviews-table" style="width: 100%">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">Sr.No</th>
                                <th class="column-title">Name</th>
                                <th class="column-title">Rating</th>
                                <th class="column-title">Remark</th>
                                <th class="column-title">Status</th>
                                <th class="column-title">Pictures</th>
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
<div id="addEditTagsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tags</h4>
            </div>
            <div class="modal-body">
                <form id="addEditTagsForm" name="addEditTagsForm"  class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tag_name">Tag Name <span id="field-required">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="tag_name" id="tag_name" placeholder="Tag name" class="form-control col-md-7 col-xs-12">
                            <div id="tag_nameError" class="error"></div>
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                            <input type="hidden" name="editId" id="editId" value=""/>
                            <button class="btn btn-primary" type="reset">Reset</button>
                            <button type="submit" name="addEditTagBtn" id="addEditTagBtn" class="btn btn-success">Save</button>
                            <button type="button" style="display: none;" name="addEditTagBtnLoader" id="addEditTagBtnLoader" class="btn btn-success"> <i class="fa fa-spinner fa-spin"></i>Saving...</button>
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
<script>
    let bookId = "{{ $bookId }}";
</script>
<script type="text/javascript" src="{{asset('assets/js/admin/books/book-reviews.js')}}"></script>
@endsection
