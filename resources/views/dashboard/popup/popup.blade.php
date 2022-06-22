@extends('admin.layout.master')
@section('title','Popup')
@section('page-content')
<div class="x_panel">
    <div class="x_title">
        <h2>Popup</h2>
    </div>
    <div class="x_content">
        <form id="popupForm" name="popupForm" class="form-horizontal form-label-left" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> Title <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="title" id="title" value="{{ $popup->title ?? '' }}" placeholder="Title" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> Link <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="link" id="link" value="{{ $popup->link ?? ''}}" placeholder="Link" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> Image <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="popup_image" id="popup_image" class="form-control col-md-7 col-xs-12"/>
                    <input type="hidden" name="pre_popup_image" id="pre_popup_image" value="{{ $popup->popup_image ?? ''}}"/>
                </div>
            </div>
            <div class="form-group">
                <label for="website_logo" class="control-label col-md-3 col-sm-3 col-xs-12"> Description </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="description" id="description" class="form-control col-md-7 col-xs-12" placeholder="Description">{{ $popup->description ?? ''}}</textarea>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit"  class="btn btn-success"><i class="fa fa-check-circle"></i> Save Details</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('footer-scripts')
<script type="text/javascript" src="{{asset('assets/js/admin/popup/popup.js')}}"></script>
@endpush
