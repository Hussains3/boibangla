@extends('admin.layout.master')
@section('title','Profile')
@section('page-content')
<div class="x_panel">
    <div class="x_title">
        <h2>Profile</h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form id="adminProfileUpdateForm" name="adminProfileUpdateForm" enctype="multipart/form-data" class="form-horizontal form-label-left">
            <div class="form-group">
                <label for="name" class="control-label col-md-3 col-sm-3 col-xs-12"> Name <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name" id="name" value="{{$profile->name??''}}" class="form-control col-md-7 col-xs-12">
                    <div class="error" id="nameError"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input  type="text" name="email" id="email" value="{{$profile->email??''}}" class="form-control col-md-7 col-xs-12" >
                    <div class="error" id="emailError"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="profile" class="control-label col-md-3 col-sm-3 col-xs-12">Profile </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file"  name="profile" id="profile"  class="form-control col-md-7 col-xs-12"  >
                    <input type="hidden" name="preProfilePic" id="preProfilePic" value="{{$profile->profile_pic??''}}" >
                    <div class="error" id="profileError"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="contact" class="control-label col-md-3 col-sm-3 col-xs-12">Contact <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="contact" id="contact" maxlength="10" value="{{$profile->contact??''}}" class="form-control col-md-7 col-xs-12">
                    <div class="error" id="contactError"></div>
                </div>
            </div>
            <div class="form-group" id="password-input" style="display: none">
                <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">Password <span id="field-required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input  type="password" name="password" id="password"  class="form-control col-md-7 col-xs-12" >
                    <div class="error" id="passwordError"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="checkbox" class="form-check-input" id="change_password" name="change_password">
                    <label class="form-check-label" for="password_check">Do You want to change password?</label>
                </div>
            </div>
            <div class="ln_solid"></div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="submit" name="updateProfileBtn" id="updateProfileBtn" class="btn btn-success">Update Profile</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{asset('assets/js/admin/profile/profile.js')}}"></script>
@endsection
