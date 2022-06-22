@extends('admin.layout.master')
@section('title','Profile')
@section('page-content')

    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Setting</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="changePasswordForm"  class="form-horizontal form-label-left">
                            <div class="form-group" id="currentPasswordDiv">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Current Password <span id="field-required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" name="previousPassword" id="previousPassword"  placeholder="Enter current password" class="form-control col-md-7 col-xs-12">
                                    <div style="color: red;display: none" id="previousPasswordError" >previousPasswordError</div>
                                </div>
                            </div>
                            <div id="newPasswordDiv" style="display: none;">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password  <span id="field-required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" name="newPassword" id="newPassword"  placeholder="Enter new password"  class="form-control col-md-7 col-xs-12">
                                        <div style="color: red;display: none" id="newPasswordError" >newPasswordError</div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password  <span id="field-required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" name="confPassword" id="confPassword"  placeholder="Confirm new password" class="form-control col-md-7 col-xs-12">
                                        <div style="color: red;display: none" id="confPasswordError" >confPasswordError</div>
                                    </div>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <input type="hidden" name="flag" id="flag" value="verify"/>
                                    <button type="submit" name="chagePassBtn" id="chagePassBtn" class="btn btn-success">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
