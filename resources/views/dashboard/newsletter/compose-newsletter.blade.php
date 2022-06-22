@extends('dashboard.layout.master')
@section('title','Compose Newsletter')
@section('page-content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Compose Newsletter</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form id="composeNewsletterForm"  enctype="multipart/form-data" class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="title" id="title" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Newsletter Image <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="newsletter_image" id="newsletter_image"  class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Link <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="link" id="link"  class="form-control col-md-7 col-xs-12" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Short Description <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea  name="description" id="description" class="form-control col-md-7 col-xs-12"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="scheduled_at">Schedule <span id="field-required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="date" name="scheduled_at" id="scheduled_at" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Send Newsletter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive" style="margin-top:30px;">
                        <table class="table table-striped jambo_table bulk_action" id="newsletter-table" style="width: 100%">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">Sr.No</th>
                                <th class="column-title">Title</th>
                                <th class="column-title">Link</th>
                                <th class="column-title">Description</th>
                                <th class="column-title">Image</th>
{{--                                <th class="column-title">Scheduled at</th>--}}
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('assets/js/admin/newsletters/compose-newsletter.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/admin/newsletters/all-newsletters.js') }}"></script>
@endsection
