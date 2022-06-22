
let loginValidator = $("#customerLoginForm").validate({
    rules: {
        mobile:{
            required: true,
            number: true,
        },
        password:{
            required: true,
        },
    },
    errorClass: "input-error",
    errorElement: "span",
    submitHandler: function () {
        $.ajax({
            type: 'POST',
            url:BASE_URL+'check-login',
            data:$("#customerLoginForm").serialize(),
            beforeSend:function(){
                $("#loginBtn").attr('disabled',true);
                $("#loginBtnLoader").removeClass('d-none');
            },
            success: function (response) {
                console.log(response);
                if (response.status == "success"){
                    var redirection = $("#redirection").val();
                    if (redirection == 'sign-in'){
                        window.location.href = BASE_URL+'customer/dashboard';
                    }else if(redirection == 'cart'){
                        window.location.href = BASE_URL+'checkout';
                    }
                }else{
                    $(".account-login-failed").show();
                    $(".account-login-failed").html("Invalid mobile/password");
                }
            },
            error:function(errorResponse){
                printValidationErrorMsg(errorResponse,loginValidator);
            },
            complete: function () {
                $("#loginBtnLoader").addClass('d-none');
                $("#loginBtn").attr('disabled',false);
                scrollToTop();
            }
        });
    }
});
