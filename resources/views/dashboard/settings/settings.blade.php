@extends('dashboard.layout.master')
@section('title','Settings')
@section('page-content')
<div class="x_panel">
    <div class="x_title">
        <h2>Settings</h2>
        <div class="clearfix"></div>
        <p>Note: <br/>
            1. If delivery charge is blank it means free delivery charge
        </p>
    </div>
    <div class="x_content">
        <form id="settingsUpdateForm" name="settingsUpdateForm" class="form-horizontal form-label-left" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> Delivery Charge <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="delivery_charge" id="delivery_charge" value="{{$deliveryCharge->setting_value}}" placeholder="Delivery charge" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-3 col-sm-3 col-xs-12"> Affiliation Rate <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="affiliation_charge" id="affiliation_charge" value="{{$affiliation_rate->setting_value}}" placeholder="Affiliation Rate" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> Offer Text <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="offer_text" id="offer_text" value="{{$offer_text->setting_value}}" placeholder="Offer text" class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> Cash On Delivery <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select type="text" name="cash_on_delivery" id="cash_on_delivery"  class="form-control col-md-7 col-xs-12">
                        <option value="Yes" @if($cashOnDelivery == 'Yes') selected @endif>Yes</option>
                        <option value="No" @if($cashOnDelivery == 'No') selected @endif>No</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="website_logo" class="control-label col-md-3 col-sm-3 col-xs-12"> Website Logo </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="website_logo" id="website_logo"  class="form-control col-md-7 col-xs-12">
                    <input type="hidden" name="pre_website_logo" id="pre_website_logo" value="{{ $websiteLogo }}"  class="form-control col-md-7 col-xs-12">
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> Meta Description <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea type="text" name="meta_description" id="meta_description" placeholder="Meta Description" class="form-control col-md-7 col-xs-12">{{ $seoData->meta_description ??'' }}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> Meta Keywords <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea type="text" name="meta_keywords" id="meta_keywords" placeholder="Meta Keywords" class="form-control col-md-7 col-xs-12">{{ $seoData->meta_keywords ?? '' }}</textarea>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit"  class="btn btn-success"><i class="fa fa-check-circle"></i> Update Settings</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@push('footer-scripts')
<script type="text/javascript" src="{{asset('assets/js/admin/settings/settings.js')}}"></script>
@endpush
