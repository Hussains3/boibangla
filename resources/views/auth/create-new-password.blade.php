@extends('layouts.master')
@section('title','Password Reset')
@section('content')
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white">
                        <div class="heading_s1"><h3>Create Password</h3></div>
                        <form id="createNewPasswordForm">
                            <div class="form-group">
                                <input type="password" name="password" id="password"  class="form-control new-txt-box"  placeholder="Password">
                            </div>
                            <div class="form-group">
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control new-txt-box"  placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="token" value="{{$token}}">
                                <button type="submit" class="btn btn-red" style="margin-top: 10px" id="changeBtn">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $("#createNewPasswordForm").submit(function (e) {
        e.preventDefault();

        $.ajax({
                type: 'POST',
                url: BASE_URL + 'password/update',
                data : $("#createNewPasswordForm").serialize(),
                beforeSend:function(){
                    $('.input-error').remove();
                    $("#loader").show();
                },
                success: function (response) {
                    toastr.success(response.message);
                    $("#createNewPasswordForm")[0].reset();
                    window.location.href = BASE_URL+'login';
                },
                complete: function () {
                    $("#loader").hide();
                },
                error: function (errorData) {
                printValidationErrorMsg(errorData,createNewPasswordValidator);
                },
            });

    });
</script>
@endsection




