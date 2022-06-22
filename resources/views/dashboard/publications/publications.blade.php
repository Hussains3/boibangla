@extends('dashboard.layout.master')
@section('title','Publication')
@section('page-content')
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_title">
                        <h2>Publications</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="javaScript:void(0);" onclick="showAddEditPublicationModel();" data-toggle="tooltip" data-placement="top" title="Add Publications" ><i class="fa fa-plus-circle" style="font-size: 25px;"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <form class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Search </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="publicationNameSearch" id="publicationNameSearch" placeholder="Publication Name" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Status</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="publicationStatus" id="publicationStatus" class="form-control">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action" id="publication-table" style="width: 100%">
                                <thead>
                                <tr class="headings">
                                    <th class="column-title">Sr.No</th>
                                    <th class="column-title">Publication ID</th>
                                    <th class="column-title">Publication Logo</th>
                                    <th class="column-title">Publication Name</th>
                                    <th class="column-title">Discount</th>
                                    <th class="column-title">Description</th>
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


    {{-- Modal --}}
    <div id="addEditPublicationModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Publications</h4>
                </div>
                <div class="modal-body">
                    <form id="addEditPublicationForm" name="addEditPublicationForm" enctype="multipart/form-data"  class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="publicationName">Publication Name <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="publicationName" id="publicationName" placeholder="Publication Name" class="form-control col-md-7 col-xs-12">
                                <div  id="publicationNameError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="publicationName">Publication Slug <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="publicationSlug" id="publicationSlug" placeholder="Publication Slug" class="form-control col-md-7 col-xs-12">
                                <div  id="publicationSlugError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="category">Publication Logo </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="publicationLogo" id="publicationLogo"  class="form-control col-md-7 col-xs-12">
                                <input type="hidden" name="prePublicationLogo" id="prePublicationLogo"  class="form-control col-md-7 col-xs-12">
                                <div  id="publicationLogoError" class="error"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="discount">Discount %</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="discount" id="discount"  class="form-control col-md-7 col-xs-12">
                                <div  id="discountError" class="error"></div>
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
                                <button type="submit" name="addEditPublicationBtn" id="addEditPublicationBtn" class="btn btn-success">Submit</button>
                                <button type="button" style="display: none;" name="addEditPublicationBtnLoader" id="addEditPublicationBtnLoader" class="btn btn-success"> <i class="fa fa-spinner fa-spin"></i>Saving...</button>
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




    <script type="text/javascript" src="{{asset('assets/js/admin/publications/publications-list.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/admin/publications/publications.js')}}"></script>
@endsection
