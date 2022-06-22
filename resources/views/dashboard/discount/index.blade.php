@extends('dashboard.layout.master')
@section('title','Discounts')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Discounts</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="javaScript:void(0);" onclick="showAddEditDiscountModal();" data-toggle="tooltip" data-placement="top" title="Add Discount" ><i class="fa fa-plus-circle" style="font-size: 25px;"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Search </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="discountNameSearch" id="discountNameSearch" placeholder="Discount name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                    </form>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="discount-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title">ID</th>
                                    <th class="column-title">Coupon name</th>
                                    <th class="column-title">Discount</th>
                                    <th class="column-title">Description</th>
                                    <th class="column-title">Validity</th>
                                    <th class="column-title">Status</th>
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
    <div id="addEditDiscountModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Discount</h4>
                </div>
                <div class="modal-body">
                    <form id="addEditDiscountForm" name="addEditDiscountForm"   class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Coupon Name <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="couponName" id="couponName" placeholder="Coupon Name" class="form-control col-md-7 col-xs-12"/>
                                <div  id="couponNameError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount % <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="discount" id="discount" placeholder="%" class="form-control col-md-7 col-xs-12"/>
                                <div  id="discountError" class="error"></div>
                            </div>
                        </div>
                        {{-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Categories </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="categories[]" id="categories" multiple class="form-control select2 col-md-7 col-xs-12" style="width: 100%;">
                                    <option value="" disabled>Select</option>
                                    @if($categories)
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div id="categoriesError" class="error"></div>
                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">Description </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" placeholder="Description" class="form-control col-md-7 col-xs-12"></textarea>
                                <div  id="descriptionError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Start Date <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                <input type="text" readonly="" class="form-control has-feedback-right" name="startDate" id="startDate">
                                <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                                <div id="startDateError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Validity Date <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12 xdisplay_inputx form-group has-feedback">
                                <input type="text" name="validityDate" id="validityDate" readonly class="form-control has-feedback-right" >
                                <span class="fa fa-calendar-o form-control-feedback right" aria-hidden="true"></span>
                                <div id="validityDateError" class="error"></div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="editId" id="editId" value=""/>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" name="addEditDiscountBtn" id="addEditDiscountBtn" class="btn btn-success">Save</button>
                                <button type="button" style="display: none;" name="addEditDiscountBtnLoader" id="addEditDiscountBtnLoader" class="btn btn-success"> <i class="fa fa-spinner fa-spin"></i>Saving...</button>
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
<script type="text/javascript" src="{{asset('assets/js/admin/discount/discount-list.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/admin/discount/discount.js')}}"></script>
<!-- Initialize datetimepicker -->
<script>
    $('#startDate').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true,
        format: 'DD-MM-YYYY HH:mm'
    });
    $('#validityDate').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true,
        format: 'DD-MM-YYYY HH:mm'
    });
</script>
@endpush
