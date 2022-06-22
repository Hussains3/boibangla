@extends('admin.layout.master')
@section('title','Attribute Options')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Attribute Options</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="javaScript:void(0);" onclick="showAddEditAttributeOptionModel();" data-toggle="tooltip" data-placement="top" title="Add Attribute Options" ><i class="fa fa-plus-circle" style="font-size: 25px;"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="filterNameSearch">Search </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="attributeOptionNameSearch" id="attributeOptionNameSearch" placeholder="Option name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="filter">Attribute </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="attributesSelect" name="attributesSelect">
                                    <option value="" >Select</option>
                                    @if($attributes)
                                        @foreach($attributes as $attribute)
                                            <option value="{{$attribute->id}}">{{$attribute->attribute_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped table-sm jambo_table bulk_action" id="attribute-option-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title">Attribute </th>
                                    <th class="column-title">Attribute Options</th>
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
    <div id="addEditAttributeOptionModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Filter Option</h4>
                </div>
                <div class="modal-body">
                    <form id="addEditAttributeOptionForm" name="addEditAttributeOptionForm"  class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="attributeName">Attribute Name <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="attributeName" id="attributeName"  class="form-control col-md-7 col-xs-12" style="width: 100%">
                                    <option value="" >Select</option>
                                    @if($attributes)
                                        @foreach($attributes as $attribute)
                                            <option value="{{$attribute->id}}">{{$attribute->attribute_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <div  id="attributeNameError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Attribute Option <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="attributeOption" id="attributeOption" placeholder="Attribute option name" class="form-control  col-md-7 col-xs-12">
                                <div id="attributeOptionError" class="error"></div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="editId" id="editId" value=""/>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" name="addEditAttributeOptionBtn" id="addEditAttributeOptionBtn" class="btn btn-success">Save</button>
                                <button type="button" style="display: none;" name="addEditAttributeOptionBtnLoader" id="addEditAttributeOptionBtnLoader" class="btn btn-success"> <i class="fa fa-spinner fa-spin"></i>Saving...</button>
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
    <script type="text/javascript" src="{{asset('assets/js/admin/attribute-options/attribute-options-list.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/admin/attribute-options/attribute-options.js')}}"></script>
@endsection
