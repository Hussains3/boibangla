let passwordResetValidator = $("#resetPasswordForm").validate({
    rules: {
        reset_email:{
            required: true,
            email: true
        },
       /* reset_phone:{
            required: true,
            number: true,
        }, */
    },
    errorClass: "input-error",
    errorElement: "span",
    submitHandler: function (event) {
        event.preventDefault();
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
            },
        });
    }
});




let createNewPasswordValidator = $("#createNewPasswordForm").validate({
    rules: {
        password:{
            required: true,
        },
        confirm_password:{
            required: true,
        },
    },
    errorClass: "input-error",
    errorElement: "span",
    submitHandler: function () {
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
                window.location.href = BASE_URL+'sign-in';
            },
            complete: function () {
                $("#loader").hide();
            },
            error: function (errorData) {
               printValidationErrorMsg(errorData,createNewPasswordValidator);
            },
        });
    }
});
