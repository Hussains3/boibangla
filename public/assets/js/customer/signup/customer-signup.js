/**
 * This block of code performs
 * customer signup
 */
/*$("form#customerSignUpForm").on("submit",function (e) {
    e.preventDefault();
    var mobile_number = $("#mobile_number").val();
    var password = $("#password").val();
    if(validateCustomerSignupForm()){
       $("#loader").show();
       $("#signupBtn").attr('disabled',true);
        $.ajax({
            type: 'POST',
            url:BASE_URL+'create-account',
            data:$("#customerSignUpForm").serialize(),
            success: function (response) {
                console.log(response);
                if (response.status == 'otpsent'){
                    alert(response.otp);
                    $("#mobile_field").hide('fast');
                    $("#otpField").show('fast');
                    $("#signupFlag").val('otpsent');
                }else if (response.status == 'wrongotp'){
                    createErrorMessages('Please enter correct OTP','otpError');
                }
                else if (response.status == 'otpverified'){
                    $("#mobile_field").hide('fast');
                    $("#otpField").hide('fast');
                    $("#emailField").show('fast');
                    $("#passwordField").show('fast');
                    $("#signupFlag").val('otpverified');
                }else if (response.status == "accountcreated"){
                    $(".account-created-success").show('fast');
                    $(".account-created-success").html(response.message);
                    alert(response.link);
                    setTimeout(function () {
                        window.location.href = BASE_URL+'customer/dashboard';
                    },2000)
                }
            },
            complete: function () {
                $("#loader").hide();
                $("#signupBtn").attr('disabled',false);
            },
            error:function (errorResponse) {
                printErrorMessage(errorResponse);
            }
        });
    }else {
       // $("#loader").hide();
        console.log("form not validated");
    }
});*/

let signupValidator = $("#customerSignUpForm").validate({
    rules: {
        mobile_number:{
            required: true,
            number: true,
        },
        email:{
            required: true,
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
            url: BASE_URL + 'create-account',
            data : $("#customerSignUpForm").serialize(),
            beforeSend:function(){
                $('.input-error').text("");
                $("#loader").show();
            },
            success: function (response) {
                if (response.status == 'alreadyexists'){
                    createErrorMessages('Mobile number already exists','mobile_numberError');
                }
                else if (response.status == 'mobileverified'){
                    $("#mobile_field").hide('fast');
                    $("#flag").val('mobileverified');
                    $("#screen2").removeClass('d-none');
                    $("#password").val("");
                }
                if (response.status == "accountcreated") {
                    $(".account-created-success").show('fast');
                    $(".account-created-success").html(response.message);
                    //alert(response.link);
                    setTimeout(function () {
                        window.location.href = BASE_URL+'customer/dashboard';
                    },2000)
                }
            },
            complete: function () {
                $("#loader").hide();
            },
            error: function (errorData) {
                printValidationErrorMsg(errorData,signupValidator);
            },
        });
    }
});
