
var requestMethod,requestApi;
$("form#updateProfileForm").on("submit",function (e) {
    e.preventDefault();
    if (validateProfileUpdateForm()){
        $("#loader").show();
        $("#updateProfileBtn").attr('disabled',true);

        requestMethod = 'POST';
        requestApi = 'customer/profile/update';
        $.ajax({
            type: requestMethod,
            url:BASE_URL+requestApi,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                if (response.status == "otpsent"){
                    alert(response.otp);
                   $("#otpField").removeClass('d-none');
                   $("#flag").val("verifyotp");
                }else if (response.status == 'wrongotp'){
                    createErrorMessages('OTP not matched','otpError');
                }else if (response.status == 'success'){
                    toastr.success(response.message);
                    $("#customer-avtar").attr("src",BASE_URL+"storage/uploads/profile/customer/"+response.profile_pic);
                    $("#pre_profile").val(response.profile_pic);
                    $("#otpField").addClass('d-none');
                    $("#otp").val("");
                    $("#flag").val("");
                    $("#profileModal").modal('hide');
                    window.location.reload();
                }
            },
            error:function(errorReponse){
                printErrorMessage(errorReponse);
            },
            complete: function () {
                $("#loader").hide();
                $("#updateProfileBtn").attr('disabled',false);
                scrollToTop();
            }
        });
    }
});

function validateProfileUpdateForm() {
    hideErrorMessages();
    var isValidated = true;
    var first_name = $("#first_name").val();
    var last_name = $("#last_name").val();
    var email = $("#email").val();
    var contact = $("#contact").val();
    var flag = $("#flag").val();
    var otp = $("#otp").val();

    if (!first_name){
        isValidated = false;
        createErrorMessages('Please enter first number','first_nameError');
    }
    if (!last_name){
        isValidated = false;
        createErrorMessages('Please enter last number','last_nameError');
    }
    if (!email){
        isValidated = false;
        createErrorMessages('Please enter email address','emailError');
    }
    if (!validateEmail(email)){
        isValidated = false;
        createErrorMessages('Please enter valid email address','emailError');
    }
    if (!contact){
        isValidated = false;
        createErrorMessages('Please enter contact','contactError');
    }
    if (flag !="" && otp == ''){
        isValidated = false;
        createErrorMessages('Please enter OTP','otpError');
    }

    scrollToTop();
    return isValidated;
}

/**
 * This block of code shows the selected profile pic name
 */
$('#profile_pic').on('change',function(e){
    if ($('#profile_pic').val()){
        let fileName = e.target.files[0].name;
        $('.custom-file-label').html(fileName);
    }
});

function editProfile() {
    $("#profileModal").modal('show');
}
