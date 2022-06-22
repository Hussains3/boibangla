@extends('layouts.master')
@section('title','Password Reset')
@section('content')
<div class="login_register_wrap section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-md-10">
                <div class="login_wrap">
                    <div class="padding_eight_all bg-white p-reset">
                        <div class="heading_s1"><h3>Password Reset</h3></div>
                        <form id="resetPasswordForm" action="{{route('resetMyPassword')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="reset_email" id="reset_email" class="new-txt-box"  placeholder="Your Email" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-red" style="margin-top: 10px">Reset Password</button>
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
    $("#resetPasswordForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: BASE_URL + 'password/verify',
            data : $("#resetPasswordForm").serialize(),
            beforeSend:function(){
                console.log('email found');
                $('.input-error').remove();
                $("#loader").show();
            },
            success: function (response) {
                toastr.success(response.message);
            },
            complete: function () {
                $("#loader").hide();
                $("#resetPasswordForm")[0].reset();
            },
            error: function (errorData) {
                printValidationErrorMsg(errorData,passwordResetValidator);
                console.log(errorData);
            },
        });

    });
</script>
@endsection




